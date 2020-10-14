<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Det_facturas;

class Det_facturasController extends Controller
{
    public function index()
    {
        $det_facturas = Det_facturas::join('facturas', 'det_facturas.id_facturas', '=', 'facturas.id')
        ->join('productos','det_facturas.id_productos','=','productos.id')
        ->select('facturas.id', 'productos.nombre')
            ->orderBy('nombre','asc')->get();
        return [
            'det_facturas' => $det_facturas,
        ];
    }
    public function getDetFac(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}

