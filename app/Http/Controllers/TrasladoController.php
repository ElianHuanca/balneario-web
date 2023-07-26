<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ActivoController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Persona;
use App\Models\Pagina;
use App\Models\Ambiente;
use App\Models\Activo;
use App\Models\Traslado;
use Illuminate\Support\Facades\DB;


class TrasladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $traslados = DB::table('traslado_activo')
        ->join('activo', 'traslado_activo.id_activo', '=', 'activo.id')
        ->join('ambiente', 'traslado_activo.id_ambiente', '=', 'ambiente.id')
        ->join('persona', 'traslado_activo.id_persona', '=', 'persona.id')
        ->select('traslado_activo.*', 'activo.nombre as nombreActivo','persona.nombre as responsable', 'ambiente.nombre as nombreAmbiente')->get();
        // return $traslados;
        
        return view('traslado.index',compact('traslados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        $personas = Persona::all();
        $ambientes = Ambiente::all();
        $activos  = Activo::all();
        return view('traslado.create',compact('personas','ambientes','activos'));
        
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
            'descripcion' => 'required',
            'id_persona' => 'required',
            'id_ambiente_origen' => 'required',
            'id_activo' => 'required',
            'id_ambiente_destino' => 'required',

        ]);
        $traslado = new Traslado();
        $traslado->descripcion = $request->descripcion;
        $traslado->fecha_traslado = now();
        $traslado->id_activo = $request->id_activo;
        $traslado->id_ambiente = $request->id_ambiente_destino;
        $traslado->id_persona = $request->id_persona;
        $traslado->timestamps = false;

        $traslado->save();

        //! actualizando activo
        $activoControl = new ActivoController();
        $activoControl->setAmbiente($request->id_activo, $request->id_ambiente_destino);
        return redirect()->route('traslados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $traslado = Traslado::find($id);
        $personas = Persona::all();
        $activo = Activo::find($traslado->id_activo);
        $persona = Persona::find($traslado->id_persona);
        $ambientes = Ambiente::all();


        return view('traslado.edit',compact('traslado','personas','ambientes','persona','activo'));
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
            'descripcion' => 'required',
            'id_persona' => 'required',
            'id_ambiente_destino' => 'required',
            'id_activo' => 'required'
        ]);
        $traslado = Traslado::find($id);
        $traslado->timestamps = false;
        $traslado->descripcion = $request->descripcion;
        $traslado->fecha_traslado = now();
        $traslado->id_activo = $request->id_activo;
        $traslado->id_ambiente = $request->id_ambiente_destino;
        $traslado->id_persona = $request->id_persona;

        $traslado->save();
        
        //! actualizando activo
        $activoControl = new ActivoController();
        $activoControl->setAmbiente($traslado->id_activo, $traslado->id_ambiente);
        return redirect()->route('traslados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Traslado::destroy($id);
        return redirect('traslados');
    }
}