<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::join('tenans','productos.id_tenan','=','tenans.id'
        )
            ->select('producto.id','producto.nombre','tenan.nombre as nomTen')
            ->orderBy('nombre', 'asc')
            ->get();
        return [
            'productos' => $productos,
        ];
    }

    public function getProdu(Request $request)
    {
        $productos = Productos::select(
            'id',
            'nombre',
            'precio_venta',
            'stock',
            'descripcion'
        )
            ->orderBy('nombre', 'asc')
            ->get();
        return [
            'productos' => $productos,
        ];
    }

    public function store(Request $request)
    {
        $productos = new Productos();
        $productos->nombre = $request->nombre;
        $productos->precio_venta = $request->precio_venta;
        $productos->stock = $request->stock;
        $productos->descripcion = $request->descripcion;
        $productos->id_tenan = $request->idTenan;
        $productos->save();
    }

    public function update(Request $request)
    {
        $productos = Productos::findOrFail($request->id);
        $productos->nombre = $request->nombre;
        $productos->precio_venta = $request->precio_venta;
        $productos->stock = $request->stock;
        $productos->descripcion = $request->descripcion;
        $productos->id_tenan = $request->idTenan;
        $productos->save();
    }

    public function destroy(Request $request)
    {
        $productos = Productos::findOrFail($request->id);
        $productos->delete();
    }
}
