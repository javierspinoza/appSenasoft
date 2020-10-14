<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personas;

class PersonasController extends Controller
{
    public function index()
    {
        $personas = Personas::join(
            'tenans',
            'personas.id_tenan',
            '=',
            'tenan.id'
        )
            ->select('tenan.nombre as nomTen')
            ->orderBy('nombre', 'asc')
            ->get();
        return [
            'personas' => $personas,
        ];
    }

    public function getPerson(Request $request)
    {
        $personas = Personas::select('id', 'nombre')
            ->orderBy('nombre', 'asc')
            ->get();
        return [
            'Personas' => $personas,
        ];
    }

    public function store(Request $request)
    {
        $personas = new Personas();
        $personas->nombre = $request->nombre;
        $personas->numero = $request->numero;
        $personas->direccion = $request->direccion;
        $personas->telefono = $request->telefono;
        $personas->email = $request->email;
        $personas->tp_document = $request->tp_document;
        $personas->save();
    }

    public function update(Request $request)
    {
        $personas = Personas::findOrFail($request->id);
        $personas->nombre = $request->nombre;
        $personas->numero = $request->numero;
        $personas->direccion = $request->direccion;
        $personas->telefono = $request->telefono;
        $personas->email = $request->email;
        $personas->tp_document = $request->tp_document;
        
        $personas->save();
    }

    public function destroy(Request $request)
    {
        $personas = Personas::findOrFail($request->id);
        $personas->delete();
    }
}
