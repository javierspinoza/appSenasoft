<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursales;

class SucursalesController extends Controller
{

    public function index()
    {
        $sucursales=Sucursales::join('tenans','sucursales.id_tenan','=','tenans.id')
        ->select('sucursales.id','sucursales.nombre','sucursales.direccion','tenans.nombre as nomTenan')
        ->orderBy('nombre','asc')->get();
        return[           
            'sucursales'=>$sucursales
        ];
    }
 
    public function store(Request $request)
    {
        $sucursales=new Sucursales();
        $sucursales->nombre=$request->nombre;
        $sucursales->direccion=$request->direccion;
        $sucursales->id_tenan=$request->idTenan;
        $sucursales->save();
    }

    public function update(Request $request)
    {
        $sucursales=Sucursales::findOrfail($request->id);
        $sucursales->nombre=$request->nombre;
        $sucursales->direccion=$request->direccion;
        $sucursales->id_tenan=$request->idTenan;
        $sucursales->save();
        }
 
    public function destroy(Request $request)
    {
        $sucursales=Sucursales::findOrfail($request->id);
        $sucursales->delete();
    }
}