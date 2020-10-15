<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tenan;

class TenanController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {

        $buscar=$request->nombre;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $tenans= Tenan::orderBy('nombre','nit','asc')->paginate(4);
        }else {
            $tenans= Tenan::where($criterio, 'like', '%'.$buscar. '%')-orderby('nombre','nit','asc')->paginate(4);
        }


        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
        
        
        return [

            'pagination'=>[
                'total'=> $tenans -> total(),
                'current_page'=> $tenans -> currentPage(),
                'per_page'=> $tenans -> perPage(),
                'last_page'=> $tenans -> lastPage(),
                'from'=> $tenans -> firstItem(),
                'to'=> $tenans -> lastItem(),
            ],

            'tenans'=>$tenans
        ];
    }
    public function getTenan(Request $request)
    {
        $tenans = Tenan::select('id','nombre','nit')
            ->orderBy('nombre', 'asc')->get();
        return [
            'tenans' => $tenans];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $tenans= new Tenan();
        $tenans->nombre = $request->nombre;
        $tenans->nit = $request->nit;
        $tenans->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $tenans= Tenan::findOrfail($request->id);
        $tenans->nombre = $request->nombre;
        $tenans->nit = $request->nit;
        $tenans->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $tenans= Tenan::findOrfail($request->id);
        $tenans->delete();
    }
}
