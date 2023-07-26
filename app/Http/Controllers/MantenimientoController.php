<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mantenimiento;
use App\Models\Activo;
use App\Models\Ambiente;
use App\Models\Persona;
use App\Models\Pagina;
use App\Models\EstadoMantenimiento;
use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;




class MantenimientoController extends Controller
{
    
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $user = Auth::user();
        $authController = new UserController();
        $permiso = $authController->getRolUserAuthenticated();
        $mantenimientos =[];
        switch($permiso->id_rol) {
            case 1:
                $mantenimientos = DB::table('orden_mantenimiento as mantenimiento')
                ->join('activo', 'activo.id', '=', 'mantenimiento.id_activo')
                ->join('ambiente', 'ambiente.id', '=', 'activo.id_ambiente')
                ->join('persona', 'persona.id', '=', 'ambiente.id_persona')
                ->join('estado_mantenimiento as estado', 'estado.id', '=', 'mantenimiento.id_estado_mantenimiento')
                ->select(
                    'mantenimiento.*',
                    'activo.nombre as activo',
                    'ambiente.nombre as ambiente',
                    'persona.nombre as responsable',
                    'estado.nombre as estado')
                    ->get();
                    return view('mantenimiento.index', compact('mantenimientos'));
                break;
            case 2:
                //!Trayendo mi ambiente 
                $ambiente = DB::table('ambiente')
                ->join('persona', 'ambiente.id_persona', '=', 'persona.id')
                ->where('persona.id','=',$user->id_persona)
                ->select('ambiente.*', 'persona.nombre as responsable')->get()->first();
                $mantenimientos = DB::table('orden_mantenimiento as mantenimiento')
                ->join('activo', 'activo.id', '=', 'mantenimiento.id_activo')
                ->join('ambiente', 'ambiente.id', '=', 'activo.id_ambiente')
                ->join('persona', 'persona.id', '=', 'ambiente.id_persona')
                ->join('estado_mantenimiento as estado', 'estado.id', '=', 'mantenimiento.id_estado_mantenimiento')
                ->where('ambiente.id','=',$ambiente->id)
                ->select(
                    'mantenimiento.*',
                    'activo.nombre as activo',
                    'ambiente.nombre as ambiente',
                    'persona.nombre as responsable',
                    'estado.nombre as estado')
                    ->get();
                    return view('mantenimiento.index', compact('mantenimientos'));
                break;
            case 3:
                $mantenimientos = DB::table('orden_mantenimiento as mantenimiento')
                ->join('activo', 'activo.id', '=', 'mantenimiento.id_activo')
                ->join('ambiente', 'ambiente.id', '=', 'activo.id_ambiente')
                ->join('persona', 'persona.id', '=', 'ambiente.id_persona')
                ->join('estado_mantenimiento as estado', 'estado.id', '=', 'mantenimiento.id_estado_mantenimiento')
                ->where('mantenimiento.id_estado_mantenimiento','=',1)
                ->select(
                    'mantenimiento.*',
                    'activo.nombre as activo',
                    'ambiente.nombre as ambiente',
                    'persona.nombre as responsable',
                    'estado.nombre as estado')
                    ->get();
                    return view('mantenimiento.index', compact('mantenimientos'));
                break;
            default:
            return redirect('mantenimientos');
        }
    }

    public function create()
    {
        Pagina::contarPagina(\request()->path());
        $user = Auth::user();
        $ambientes = DB::table('ambiente')
        ->join('persona', 'ambiente.id_persona', '=', 'persona.id')
        ->where('persona.id','=',$user->id_persona)
        ->select('ambiente.*', 'persona.nombre as responsable')->get();
        $activos  = Activo::all();
        //return $activos;
        return view('mantenimiento.create', compact('ambientes','activos'));
    }

    public function store(Request $request)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'descripcion' => 'required',
            'tipoMantenimiento' => 'required',
            'id_ambiente' =>'required',
            'id_activo' => 'required'
        ]);
        $mantenimiento = new Mantenimiento();
        $mantenimiento->tipo = $request->tipoMantenimiento;
        $mantenimiento->fecha_solicitud = now();
        $mantenimiento->descripcion = $request->descripcion;
        $mantenimiento->id_activo = $request->id_activo;
        $mantenimiento->id_estado_mantenimiento =1;
        $mantenimiento->timestamps = false;
        $mantenimiento->save();
        return redirect()->route('mantenimientos.index');

        //
    }

    public function show($id)
    {
        Pagina::contarPagina(\request()->path());
        //
    }

    public function edit($id)
    {
        Pagina::contarPagina(\request()->path());
        $mantenimiento = Mantenimiento::find($id);
        $user = Auth::user();
        $activo = Activo::find($mantenimiento->id_activo);
        $estadosMantenimiento = EstadoMantenimiento::all();
        $ambientes = DB::table('ambiente')
        ->join('persona', 'ambiente.id_persona', '=', 'persona.id')
        ->where('persona.id','=',$user->id_persona)
        ->select('ambiente.*', 'persona.nombre as responsable')->get();
        // dd($ambientes);
        return view('mantenimiento.edit', compact('mantenimiento','ambientes','activo','estadosMantenimiento'));
        
    }

    
    public function update(Request $request, $id)
    {
        Pagina::contarPagina(\request()->path());
        $user = Auth::user();
        $authController = new UserController();
        $permiso = $authController->getRolUserAuthenticated();

        switch($permiso->id_rol) {
            case 2:
                $this->validate($request, [
                    'descripcion' => 'required',
                    'tipoMantenimiento' => 'required',
                    'id_ambiente' =>'required',
                    'id_activo' => 'required'
                ]);
                //!si es responsable
                $mantenimiento = Mantenimiento::find($id);
                $mantenimiento->tipo = $request->tipoMantenimiento;
                $mantenimiento->fecha_solicitud = now();
                $mantenimiento->descripcion = $request->descripcion;
                $mantenimiento->id_activo = $request->id_activo;
                $mantenimiento->id_estado_mantenimiento =1;
                $mantenimiento->timestamps = false;
                $mantenimiento->save();
                return redirect()->route('mantenimientos.index');
                break;
            case 3:
                $this->validate($request, [
                    'id_estado' => 'required',
                ]);
                //!si es empresa
                $mantenimiento = Mantenimiento::find($id);
                $mantenimiento->id_estado_mantenimiento =$request->id_estado;
                $mantenimiento->timestamps = false;
                $mantenimiento->save();
                return redirect()->route('mantenimientos.index');
                break;
            default:
                return redirect('mantenimientos');
        }        




    }

    public function destroy($id)
    {
        //
    }
}