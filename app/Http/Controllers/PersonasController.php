<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Personas;

class PersonasController extends Controller
{
    public function index()
    {
        $personas = Personas::join('tenans', 'personas.id_tenan', '=', 'tenan.id')
        ->select(
        'personas.id',
        'personas.nombre',
        'personas.numero',
        'personas.direccion',
        'personas.telefono',
        'personas.email',
        'personas.tp_document',
        'personas.is_usuario',
        'personas.is_cliente',
        'personas.is_proveerdor',
        'personas.is_vendedor',
        'personas.id_tenan',
        'tenan.nombre as nomTen')
            ->orderBy('nombre','asc')->get();
        return [
            'personas' => $personas,
        ];
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}