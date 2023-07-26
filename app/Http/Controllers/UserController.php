<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pagina;
use App\Models\Persona;
use App\Models\User;
use App\Models\Rol;
use App\Models\Permiso;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $usuarios = DB::table('users as u')
        ->select('u.id', 'u.name', 'u.email', 'p.nombre as nombrePersona', 'r.nombre as rolUser')
        ->join('persona as p', 'u.id_persona', '=', 'p.id')
        ->join('permiso2 as p2', 'p2.id_user', '=','u.id' )
        ->join('rol as r','r.id','=','p2.id_rol')
        ->get();
        $this->getRolUserAuthenticated();
        // dd($usuarios);
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        // $personas = Persona::all();
        $personas = DB::select(
            "SELECT p.* 
            FROM persona p 
            LEFT JOIN users u ON p.id = u.id_persona 
            WHERE u.id_persona IS NULL"); //devuelve solo personas sin usuarios
        $roles = Rol::all();
        return view('usuario.create',compact('personas','roles'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'name' => "required|unique:users",
            'email' => "required|unique:users",
            'password' => 'required',
            'id_persona' => 'required',
            'id_rol' => "required"
        ]);
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_persona = $request->id_persona;
        $usuario->timestamps = true;
        $usuario->save();

        $id_user = $usuario->id;
        //!Guardar permiso2
        $permiso2 = new Permiso();
        $permiso2->id_user = $id_user;
        $permiso2->id_rol = $request->id_rol;
        $permiso2->usuario = $usuario->name;
        $permiso2->fecha_inicio = now();
        $permiso2->fecha_fin = now();
        $permiso2->estado  = TRUE;
        $permiso2->timestamps = false;
        $permiso2->save();
        return redirect()->route('usuarios.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Pagina::contarPagina(\request()->path());
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Pagina::contarPagina(\request()->path());
        $usuario = User::find($id);
        $persona= Persona::find($usuario->id_persona);
        $role= DB::table('permiso2')
        ->join('users','users.id','=','permiso2.id_user')
        ->join('rol','rol.id','=','permiso2.id_rol')
        ->where('users.id','=',$usuario->id)
        ->select('rol.*')->get();
        //  dd($role);
        $roles = Rol::all();
        return view('usuario.edit',compact('usuario','persona','role','roles'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Pagina::contarPagina(\request()->path());
        
        $this->validate($request, [
            'name' => "required|unique:users,name,$id",
            'email' => "required|unique:users,email,$id",
            'password' => 'required',
            'id_persona' => 'required',
            'id_rol' => "required"
        ]);
        
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_persona = $request->id_persona;
        $usuario->timestamps = false;
        $usuario->save();
        
        //!Actualizar permiso2
        $permisoActual = DB::table('permiso2')
        ->join('users','users.id','=','permiso2.id_user')
        ->join('rol','rol.id','=','permiso2.id_rol')
        ->where('users.id','=',$id)
        ->select('permiso2.*')->get()->first();
        // dd($permisoActual);
        $permiso2 = Permiso::where('id_user', $id)->where('id_rol', $permisoActual->id_rol)->first();
        $permiso2->id_user = $id;
        $permiso2->id_rol = $request->id_rol;
        $permiso2->usuario = $usuario->name;
        $permiso2->fecha_inicio = now();
        $permiso2->fecha_fin = now();
        $permiso2->estado  = TRUE;
        $permiso2->timestamps = false;
        
        // dd($permiso2);
        $permiso2->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('usuarios');
    }
    public function getRolUserAuthenticated(){
        $user = Auth::user();
        $permiso = DB::table('permiso2')
            ->where('id_user', $user->id)
            ->where('usuario', $user->name)
            ->get()->first();
            return $permiso;
    }
}