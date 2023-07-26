<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;
use App\Models\Pagina;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $ubicaciones = Ubicacion::all();
        return view('ubicacion.index', compact('ubicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('ubicacion.create');
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
            'latitud' => 'required',
            'longitud' => 'required'
        ]);
        $ubicacion= new Ubicacion($request->all());
        $ubicacion->timestamps = false;
        $ubicacion->save();
        return redirect()->route('ubicaciones.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        Pagina::contarPagina(\request()->path());
        $ubicacion = Ubicacion::findOrFail($id);
        return view('ubicacion.edit', compact('ubicacion'));
    }

    public function update(Request $request, $id)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'descripcion' => 'required',
            'latitud' => 'required',
            'longitud' => 'required'
        ]);
        $ubicacion = Ubicacion::find($id);
        $ubicacion->timestamps = false;
        $ubicacion->update($request->all()); 
        $ubicacion->save(); 
        return redirect()->route('ubicaciones.index');
    }

    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);
        Ubicacion::destroy($id);
        return redirect()->route('ubicaciones.index');
    }
}
