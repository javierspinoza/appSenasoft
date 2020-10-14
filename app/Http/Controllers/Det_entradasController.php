<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Det_entradas;

class Det_entradasController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        $det_entradas         = new Det_entradas();
        $det_entradas->nombre = $request->nombre;

        
        $det_entradas->save();
    }

    public function update(Request $request)
    {
        $det_entradas         = Det_entradas::findOrFail($request->id);
        $det_entradas->nombre = $request->nombre;
        $det_entradas->save();
    }

    public function destroy(Request $request)
    {
        $det_entradas = Det_entradas::findOrFail($request->id);
        $det_entradas->delete();
    }
}
