<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetricaController extends Controller
{
    public function index(Request $request){
        if(view()->exists($request->path())){
            return view($request->path());
        }
        return view('errors.404');
    }
}
