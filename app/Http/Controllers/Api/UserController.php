<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        // Obtener todos los pacientes
        $patients = User::all();

        return response()->json(['status' => true, 'patients' => $patients]);
    }
    
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar la solicitud
            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|max:100',
                'lastName' => 'required|string|max:100',
                'email' => 'required|string|email|max:100|unique:users',
                'phone' => 'nullable|string|max:15',
                'birthdate' => 'nullable|date',
                'gender' => 'nullable|string|in:male,female,other',
                'address' => 'nullable|string|max:255',
                'allergies' => 'nullable|string',
                'medicalHistory' => 'nullable|string',
                'profilePhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
            }

            // Generar UUID
            $uuid = Uuid::uuid4()->toString();

            // Crear nuevo usuario
            $user = new User();
            $user->firstname = $request->firstName;
            $user->lastname = $request->lastName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->birthdate = $request->birthdate;
            $user->gender = $request->gender;
            $user->direccion = $request->address;
            $user->alergias = $request->allergies;
            $user->antecedentes_medicos = $request->medicalHistory;
            $user->role_id = $request->role_id;
            $user->password = Hash::make('defaultpassword');
            $user->uuid = $uuid;
            $user->fecha_registro = Carbon::now();

            // Manejar la carga de la foto de perfil
            if ($request->hasFile('profilePhoto')) {
                $file = $request->file('profilePhoto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('users/' . $user->id, $fileName, 'public');
                $user->profile_photo = $filePath;
            }

            $user->save();

            DB::commit();

            return response()->json(['status' => true, 'message' => 'User created successfully', 'uuid' => $user->uuid]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'An error occurred while creating the user', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $uuid)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $uuid . ',uuid',
            'phone' => 'nullable|string|max:15',
            'birthdate' => 'nullable|date',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'allergies' => 'nullable|string|max:500',
            'medicalHistory' => 'nullable|string|max:500',
            'profilePhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        try {
            $user = User::where('uuid', $uuid)->firstOrFail();

            // Update the user data
            $user->firstname = $request->firstName;
            $user->lastname = $request->lastName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->birthdate = $request->birthdate ? Carbon::parse($request->birthdate) : null;
            $user->gender = $request->gender;
            $user->direccion = $request->direccion;
            $user->alergias = $request->alergias;
            $user->antecedentes_medicos = $request->antecedentes_medicos;

            // Handle profile photo upload
            if ($request->hasFile('profilePhoto')) {
                $file = $request->file('profilePhoto');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(storage_path('app/public/users/' . $user->id), $filename);
                $user->profile_photo = 'users/' . $user->id . '/' . $filename;
            }

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Usuario actualizado correctamente',
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'No se pudo actualizar el usuario', 'error' => 'No se encontraron los datos del usuario'], 500);
        }
    }

    public function show($uuid)
    {
        try {
            $patient = User::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Datos del paciente',
                'patient' => $patient
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'No se encontraron datos del paciente',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al obtener datos del paciente',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
