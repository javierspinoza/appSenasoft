<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tenan;

class TenanController extends Controller
{
    public function index()
    {
        $tenans = Tenan::orderBy('nombre', 'asc')->get();
        return [
            'tenans' => $tenans,
        ];
    }
    public function getTenan(Request $request)
    {
        $tenans = Tenan::select('id', 'nombre', 'nit')->orderBy('nombre', 'asc')->get();
        return [
            'tenans' => $tenans,
        ];
    }
    public function store(Request $request)
    {
        $tenans = new Tenan();
        $tenans->nombre = $request->nombre;
        $tenans->nit = $request->nit;

        $tenans->save();
    }

    public function update(Request $request)
    {
        $tenans = Tenan::findOrFail($request->id);
        $tenans->nombre = $request->nombre;
        $tenans->nombre = $request->nit;
        $tenans->save();
    }

    public function destroy(Request $request)
    {
        $tenans = Tenan::findOrFail($request->id);
        $tenans->delete();
    }
}
