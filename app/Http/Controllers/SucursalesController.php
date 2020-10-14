<?php

namespace App\Http\Controllers;
use App\Sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index()
    {
        $sucursales = join('tenans', 'sucursales.id_tenan', '=', 'tenans.id')
            ->select('sucursales.nombre', 'tenan.nombre as nomTen')
            ->orderBy('nombre', 'asc')
            ->get();
        return [
            'sucursales' => $sucursales,
        ];
    }
    public function getSucur(Request $request)
    {
        $sucursales = Sucursales::select('id', 'nombre')
            ->orderBy('nombre', 'asc')
            ->get();
        return [
            'sucursales' => $sucursales,
        ];
    }

    public function store(Request $request)
    {
        $sucursales = new Sucursales();
        $sucursales->nombre = $request->nombre;

        $sucursales->save();
    }

    public function update(Request $request)
    {
        $sucursales = Sucursales::findOrFail($request->id);
        $sucursales->nombre = $request->nombre;
        $sucursales->save();
    }

    public function destroy(Request $request)
    {
        $sucursales = Sucursales::findOrFail($request->id);
        $sucursales->delete();
    }
}
