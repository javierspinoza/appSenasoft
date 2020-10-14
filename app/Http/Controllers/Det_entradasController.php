<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Det_entradas;

class Det_entradasController extends Controller
{
    public function index()
    {
        {
            $det_entradas = Det_entradas::join('facturas', 'det_entradas.id_facturas', '=', 'facturas.id')
            ->join('productos','det_entradas.id_productos','=','productos.id')
            ->select('facturas.id', 'productos.nombre')
            ->orderBy('nombre','asc')->get();
            return [
            'det_entradas' => $det_entradas,
            ];
        }
    }

    public function store(Request $request)
    {
        $det_entradas           = new Det_entradas();
        $det_entradas->cantidad = $request->cantidad;
        $det_entradas->precio   = $request->precio;

        $det_entradas->save();
    }

    public function update(Request $request)
    {
        $det_entradas           = Det_entradas::findOrFail($request->id);
        $det_entradas->cantidad = $request->cantidad;
        $det_entradas->precio   = $request->precio;

        $det_entradas->save();
    }

    public function destroy(Request $request)
    {
        $det_entradas = Det_entradas::findOrFail($request->id);
        $det_entradas->delete();
    }
}
