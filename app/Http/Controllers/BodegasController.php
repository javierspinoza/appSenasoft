<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Bodegas;

class BodegasController extends Controller
{
   
    public function index()
    {
    $bodegas=join('sucursales','bodegas.id_sucursal','=','bodegas.id')
    ->select('sucursales.nombre as nomSucur')
            
    ->orderBy('nombre','asc')->get();
    return[
        'bodegas'=>$bodegas
    ];
}


 
public function store(Request $request)
    {
        $bodegas         = new Bodegas();
        $bodegas->nombre = $request->nombre;

        
        $bodegas->save();
    }

    public function update(Request $request)
    {
        $bodegas         = Bodegas::findOrFail($request->id);
        $bodegas->nombre = $request->nombre;
        $bodegas->save();
    }

    public function destroy(Request $request)
    {
        $bodegas = Bodegas::findOrFail($request->id);
        $bodegas->delete();
    }
}
