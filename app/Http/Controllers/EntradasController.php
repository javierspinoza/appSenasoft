<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Entradas;

class EntradasController extends Controller
{
    public function index(){

    $entradas = Entradas::join('proveedores', 'entradas.id_proveedores', '=', 'proveedores.id')
    ->join('sucursales', 'entradas.id_sucursales', '=', 'sucursales.id')
    ->select( 'proveedores.nombre as nomProve','sucursales.nombre as nomSucur',)
    ->orderBy('nombre','asc')->get();
return [
    'entradas' => $entradas,
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