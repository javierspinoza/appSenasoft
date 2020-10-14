<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Facturas;
class FacturasController extends Controller
{
    public function index()
    {
       
    }

    public function getFact(Request $request)
    {
        $facturas = Facturas::select('id','date','iva','estado','total')->orderBy('id')->get();
        return[
            'facturas'=>$facturas
        ];
    }

    public function store(Request $request)
    {
        $facturas         = new Facturas();
        $facturas->date   = $request->date;
        $facturas->iva    = $request->iva;
        $facturas->estado = $request->estado;
        $facturas->total  = $request->total;

        $facturas->save();

    }

    public function update(Request $request)
    {
        $facturas         = Facturas::findOrFail($request->id);
        $facturas->date   = $request->date;
        $facturas->iva    = $request->iva;
        $facturas->estado = $request->estado;
        $facturas->total  = $request->total;
        
        $facturas->save();

    }

    public function destroy(Request $request)
    {
        $facturas = Facturas::findOrFail($request->id);
        $facturas->delete();
    }
}
