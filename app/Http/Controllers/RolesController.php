<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {

        $buscar=$request->nombre;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $roles= Roles::orderBy('nombre','asc')->paginate(4);
        }else {
            $roles= Roles::where($criterio, 'like', '%'.$buscar. '%')-orderby('nombre','asc')->paginate(4);
        }


        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
        
        
        return [

            'pagination'=>[
                'total'=> $roles -> total(),
                'current_page'=> $roles -> currentPage(),
                'per_page'=> $roles -> perPage(),
                'last_page'=> $roles -> lastPage(),
                'from'=> $roles -> firstItem(),
                'to'=> $roles -> lastItem(),
            ],

            'roles'=>$roles
        ];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $roles= new Roles();
        $roles->nombre = $request->nombre;
        $roles->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $roles= Roles::findOrfail($request->id);
        $roles->nombre = $request->nombre;
        $roles->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $roles= Roles::findOrfail($request->id);
        $roles->delete();
    }
}
