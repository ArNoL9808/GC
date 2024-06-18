<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function list_patients()
    {
        return view('gc.patients.list-patient'); // Asegúrate de tener una vista llamada list-patients.blade.php
    }

    
    public function new_patient()
    {
        return view('gc.patients.new-patient'); // Asegúrate de tener una vista llamada list-patients.blade.php
    }
}
