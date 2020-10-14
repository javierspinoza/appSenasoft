<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Roles;

class RolesController extends Controller
{
    public function index()
    { 
        $roles=Roles::orderBy('nombre','asc')->get();
        return[
            'roles'=>$roles
        ];
    }
    public function getRoles(Request $request){
        
        $roles = Roles::select('id','nombre')->orderBy('nombre','asc')->get();
        return[
            'roles'=>$roles
        ];
    }
    public function store(Request $request)
    {
        $roles         = new Roles();
        $roles->nombre = $request->nombre;

        
        $roles->save();
    }

    public function update(Request $request)
    {
        $roles         = Roles::findOrFail($request->id);
        $roles->nombre = $request->nombre;
        $roles->save();
    }

    public function destroy(Request $request)
    {
        $roles = Roles::findOrFail($request->id);
        $roles->delete();
    }
}
