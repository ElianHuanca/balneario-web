<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\CategoriaActivo;
use App\Models\Ambiente;
use App\Models\Ubicacion;
use App\Models\TipoIngreso;
use App\Models\Persona;
use App\Models\Pagina;
use App\Models\Estado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

class ActivoController extends Controller
{
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $activos = null;
        $user = Auth::user();
        if(Session::has('idRolUser') && Session::get('idRolUser')==1){
        $activos = DB::table('activo')
            ->join('ambiente', 'ambiente.id', '=', 'activo.id_ambiente')
            ->join('categoria_activo', 'categoria_activo.id', '=', 'activo.id_categoria')
            ->join('tipo_ingreso', 'tipo_ingreso.id', '=', 'activo.id_tipo_ingreso')
            ->join('estado_activo', 'estado_activo.id', '=', 'activo.id_estado')
            ->select(
                'activo.*',
                'ambiente.nombre as nombre_ambiente',
                'categoria_activo.nombre as nombre_categoria',
                'tipo_ingreso.nombre as nombre_tipo_ingreso',
                'estado_activo.nombre as nombre_estado')
            ->get();
        }else{
            // respomsable
            $activos = DB::table('activo')
            ->join('ambiente', 'ambiente.id', '=', 'activo.id_ambiente')
            ->join('categoria_activo', 'categoria_activo.id', '=', 'activo.id_categoria')
            ->join('tipo_ingreso', 'tipo_ingreso.id', '=', 'activo.id_tipo_ingreso')
            ->join('estado_activo', 'estado_activo.id', '=', 'activo.id_estado')
            ->where('ambiente.id_persona', '=',$user->id_persona)
            ->select(
                'activo.*',
                'ambiente.nombre as nombre_ambiente',
                'categoria_activo.nombre as nombre_categoria',
                'tipo_ingreso.nombre as nombre_tipo_ingreso',
                'estado_activo.nombre as nombre_estado')
            ->get();

        }

        return view('activo.index', compact('activos'));
    }

    public function create()
    {
        Pagina::contarPagina(\request()->path());
        $user = Auth::user();
        // dd($user);
        $ambientes = [];
        if(Session::has('idRolUser') && Session::get('idRolUser')==1){
            $ambientes = Ambiente::all();
        }else{
            $ambientes = DB::table('ambiente')
            ->join('persona', 'ambiente.id_persona', '=', 'persona.id')
            ->where('persona.id','=',$user->id_persona)
            ->select('ambiente.*', 'persona.nombre as responsable')->get();
        }
        $categorias = CategoriaActivo::all();
        $tipoIngresos = TipoIngreso::all();
        $estados = Estado::all();

        return view('activo.create', compact('ambientes', 'categorias', 'tipoIngresos', 'estados'));
    }

    public function store(Request $request)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'nombre' => 'required',
            'codigo' => 'required|unique:activo,codigo',
            'vida_util' => 'required',
            'valor' => 'required',
            'periodo_mantenimiento' => 'required',
            'id_ambiente' => 'required',
            'id_categoria' => 'required',
            'id_tipo_ingreso' => 'required',
            'id_estado' => 'required'
        ]);
        $activo = new Activo($request->all());
        $activo->fecha_ingreso = now();
        $activo->ultimo_mantenimiento= now();
        $activo->timestamps = false;
        $activo->save();

        // check if there are images to save
        if ($request->hasFile('fotos')) {
            $fotografiaC = new FotografiaController();
            foreach ($request->file('fotos') as $foto) {
                $fotografiaC->saveFotos($foto, $activo->id, 2);
            }
        }
        //save a QrCode for the new Activo
        $fotografiaC = new FotografiaController();
        $fotografiaC->generateQr($activo->id, 2);

        return redirect()->route('activos.show', ['activo' => $activo->id]);
    }

    public function show($id)
    {
        Pagina::contarPagina(\request()->path());
        $activo = Activo::find($id);
        $ambiente = Ambiente::find($activo->id_ambiente);
        $persona = Persona::find($ambiente->id_persona);
        $ubicacion = Ubicacion::find($ambiente->id_ubicacion);
        $categoria = CategoriaActivo::find($activo->id_categoria);
        $tipoIngreso = TipoIngreso::find($activo->id_tipo_ingreso);
        $estado = Estado::find($activo->id_estado);

        $fotos = DB::table('fotografia')->where('id_tabla', $activo->id)->where('tipo_tabla', 2)->get();
        $qr = []; 
        foreach ($fotos as $key => $value) {
            if (str_contains($value->url, "QR")) {
                //$selected = $value;
                $qr[] = $value;
                $fotos->forget($key);
            }
        }
        return view('activo.show', compact(
                'activo',
                'ambiente',
                'persona',
                'ubicacion',
                'categoria',
                'tipoIngreso',
                'estado',
                'fotos',
                'qr'
            ));
    }

    public function edit($id)
    {
        Pagina::contarPagina(\request()->path());
        $activo = Activo::find($id);
        $ambiente = Ambiente::find($activo->id_ambiente);
        $ambientes = Ambiente::all();
        $categoria = CategoriaActivo::find($activo->id_categoria);
        $categorias = CategoriaActivo::all();
        $tipoIngreso = TipoIngreso::find($activo->id_tipo_ingreso);
        $tipoIngresos = TipoIngreso::all();
        $estado = Estado::find($activo->id_estado);
        $estados = Estado::all();
        $fotos = DB::table('fotografia')->where('id_tabla', $activo->id)->where('tipo_tabla', 2)->get();

        $qr = []; 
        foreach ($fotos as $key => $value) {
            if (str_contains($value->url, "QR")) {
                //$selected = $value;
                $qr[] = $value;
                $fotos->forget($key);
            }
        }

        return view('activo.edit',compact(
                'activo',
                'ambiente',
                'ambientes',
                'categoria',
                'categorias',
                'tipoIngresos',
                'tipoIngreso',
                'estado',
                'estados',
                'fotos'
            ));

    }

    public function update(Request $request, $id)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'nombre' => 'required',
            'codigo' => "required|unique:activo,codigo, $id",
            'vida_util' => 'required',
            'valor' => 'required',
            'periodo_mantenimiento' => 'required',
            'id_ambiente' => 'required',
            'id_categoria' => 'required',
            'id_tipo_ingreso' => 'required',
            'id_estado' => 'required'
        ]);

        $activo = Activo::find($id);
        $activo->timestamps = false;
        $activo->update($request->all());

        if ($request->hasFile('fotos')) {
            $fotografiaC = new FotografiaController();
            foreach ($request->file('fotos') as $foto) {
                $fotografiaC->saveFotos($foto, $activo->id, 2);
            }
        }
        return redirect()->route('activos.show', ['activo' => $activo->id]); 
    }

    public function destroy($id)
    {
        Activo::destroy($id);
        return redirect('activos');
    }

    public function setAmbiente($idActivo,$idAmbiente){
        try {
            DB::table('activo')
            ->where('id', '=', $idActivo)
            ->update(['id_ambiente' => $idAmbiente]);
        } catch (\Throwable $th) {
            throw $th->message();
        }
    }
}