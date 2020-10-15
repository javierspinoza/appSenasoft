<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usuarios;
use App\Personas;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Usuarios::join('personas','usuarios.id_personas','=','personas.id')
            ->join('roles','usuarios.id_roles','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tp_document','personas.direccion','personas.telefono','personas.email','usuarios.usuario','usuarios.password','usuarios.condicion','usuarios.id_roles','roles.nombre as rol')
            ->orderBy('personas.id', 'desc')->paginate(10);
        }
        else{
            $personas = Usuarios::join('personas','usuarios.id_personas','=','personas.id')
            ->join('roles','usuarios.id_roles','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tp_document','personas.direccion','personas.telefono','personas.email','usuarios.usuario','usuarios.password','usuarios.condicion','usuarios.idrol','roles.nombre as rol')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $persona = new Personas();
            $persona->nombre = $request->nombre;
            $persona->tp_document = $request->tipo_documento;
            $persona->numero = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $user = new Usuarios();
            $user->id = $persona->id;
            $user->id_roles = $request->idrol;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';            
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = Usuarios::findOrFail($request->id);
            $persona = Personas::findOrFail($user->id);
            $persona->nombre = $request->nombre;
            $persona->tp_document = $request->tipo_documento;
            $persona->numero = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->id_roles = $request->idrol;
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = Usuarios::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = Usuarios::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
}
