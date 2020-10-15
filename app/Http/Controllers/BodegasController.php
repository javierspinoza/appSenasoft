<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Bodegas;

class BodegasController extends Controller
{
   
    public function index()
    {
    $bodegas=Bodegas::join('sucursales','bodegas.id_sucursal','=','sucursales.id')
    ->select('bodegas.id','bodegas.nombre','sucursales.nombre as nomSucur')
            
    ->orderBy('nombre','asc')->get();
    return[
        'bodegas'=>$bodegas
    ];
}

public function store(Request $request)
    {
        $bodegas=new Bodegas();
        $bodegas->nombre=$request->nombre;
        $bodegas->id_sucursal = $request->id_sucursal;
        
        $bodegas->save();
    }

    public function update(Request $request)
    {
        $bodegas = Bodegas::findOrfail($request->id);
        $bodegas->nombre = $request->nombre;
        $bodegas->id_sucursal = $request->id_sucursal;
        $bodegas->save();
    }

    public function destroy(Request $request)
    {
        $bodegas = Bodegas::findOrfail($request->id);
        $bodegas->delete();
    }
}