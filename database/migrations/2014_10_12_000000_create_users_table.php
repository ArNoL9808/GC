<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla de roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insert roles into roles table
        DB::table('roles')->insert([
            ['name' => 'Administrador'],
            ['name' => 'Doctor'],
            ['name' => 'Paciente']
        ]);

        // Tabla de usuarios
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 15)->nullable();
            $table->string('profile_photo')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->boolean('status')->default(true); // true = activo, false = inactivo
            $table->string('direccion', 255)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->text('alergias')->nullable();
            $table->text('antecedentes_medicos')->nullable();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert default admin user into users table
        User::create([
            'firstname' => 'Admin', 
            'lastname' => 'Dreammeld',
            'email' => 'admin@dreammeld.com',
            'password' => Hash::make('dreammeld'), 
            'role_id' => 1, 
            'email_verified_at' => '2022-06-21 17:04:58',
            'created_at' => now(),
        ]);

        // Tabla de clinicas
        Schema::create('clinicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('direccion', 255);
            $table->string('telefono', 20);
            $table->timestamps();
        });

        // Tabla de citas
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('clinica_id')->constrained()->onDelete('cascade');
            $table->string('tipo_cita', 100); // Tipo de cita (descripción)
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada']); // Estado de la cita
            $table->text('comentarios')->nullable(); // Comentarios adicionales
            $table->timestamps();
        });

        // Tabla de historiales clínicos
        Schema::create('historiales_clinicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario (paciente)
            $table->date('fecha_consulta');
            $table->string('motivo_consulta', 255);
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->text('notas')->nullable();
            $table->text('receta')->nullable();
            $table->date('proxima_cita')->nullable();
            $table->string('estado_consulta', 50);
            $table->timestamps();
        });

        // Tabla de tratamientos
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del tratamiento específico
            $table->text('descripcion')->nullable(); // Descripción detallada del tratamiento
            $table->decimal('costo', 10, 2); // Costo del tratamiento
            $table->time('duracion_estimada'); // Duración estimada del tratamiento
            $table->timestamps();
        });

        // Tabla pivot tratamientos_user
        Schema::create('tratamientos_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tratamiento_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla de archivos
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->timestamps();
        });

        // Tabla de pagos
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tratamiento_id')->constrained()->onDelete('cascade'); // Relación con el tratamiento
            $table->decimal('monto', 8, 2);
            $table->timestamps();
        });

        // Tabla de historial de pagos
        Schema::create('historial_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pago_id')->constrained('pagos')->onDelete('cascade'); // Relación con la tabla de pagos
            $table->date('fecha_pago');
            $table->decimal('monto', 8, 2);
            $table->timestamps();
        });

        // Tabla pivot clinica_user
        Schema::create('clinica_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('clinica_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinica_user');
        Schema::dropIfExists('historial_pagos');
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('archivos');
        Schema::dropIfExists('tratamientos_user');
        Schema::dropIfExists('tratamientos');
        Schema::dropIfExists('citas');
        Schema::dropIfExists('historiales_clinicos');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('clinicas');
    }
};
