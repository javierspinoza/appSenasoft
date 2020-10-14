<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Tenan;

class TenanController extends Controller
{
    public function index()
    {
        $tenan=Tenan::orderBy('nombre','asc')->get();
        return[
            'tenans'=>$tenan
        ];
    }
    public function getArea(Request $request){
        
        $tenan = Tenan::select('id','nombre','nit')->orderBy('nombre','asc')->get();
        return[
            'tenans'=>$tenan
        ];
    }
    public function store(Request $request)
    {
        $tenan         = new Tenan();
        $tenan->nombre = $request->nombre;

        
        $tenan->save();
    }

    public function update(Request $request)
    {
        $tenan         = Tenan::findOrFail($request->id);
        $tenan->nombre = $request->nombre;
        $tenan->save();
    }

    public function destroy(Request $request)
    {
        $tenan = Tenan::findOrFail($request->id);
        $tenan->delete();
    }
}
