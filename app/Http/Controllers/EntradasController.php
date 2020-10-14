<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entradas;

class EntradasController extends Controller
{
    public function index()
    {
        $entradas = Entradas::join(
            'proveedores',
            'entradas.id_proveedores',
            '=',
            'proveedores.id'
        )
            ->join('sucursales', 'entradas.id_sucursales', '=', 'sucursales.id')
            ->select(
                'proveedores.nombre as nomProve',
                'sucursales.nombre as nomSucur'
            )
            ->orderBy('nombre', 'asc')
            ->get();
        return [
            'entradas' => $entradas,
        ];
    }
    public function getEnt(Request $request)
    {
        $entradas = Entradas::select('id', 'fecha', 'estado', 'nombre')
            ->orderBy('fecha')
            ->get();
        return [
            'entradas' => $entradas,
        ];
    }
    public function store(Request $request)
    {
        $entradas = new Entradas();
        $entradas->date = $request->date;
        $entradas->estado->$request->estado;
        $entradas->nombre = $request->nombre;

        $entradas->save();
    }

    public function update(Request $request)
    {
        $entradas = Entradas::findOrFail($request->id);
        $entradas->date = $request->date;
        $entradas->estado->$request->estado;
        $entradas->nombre = $request->nombre;
        $entradas->save();
    }

    public function destroy(Request $request)
    {
        $entradas = Entradas::findOrFail($request->id);
        $entradas->delete();
    }
}
