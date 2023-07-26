<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Pagina;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $personas = Persona::all();
        return view('persona.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('persona.create');
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
            'ci' => 'required|unique:persona',
            'nombre' => 'required|unique:persona',
            'fecha_nac' => 'required',
            'genero' => 'required',
            'telefono' => 'required|unique:persona'

        ]);
        $persona = new Persona($request->all());
        $persona->timestamps = false;
        $persona->save();
        return redirect()->route('personas.index');
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
    public function edit(Persona $persona)
    {
        Pagina::contarPagina(\request()->path());
        // return $persona;
        return view('persona.edit',compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'ci' => "required|unique:persona,ci,$persona->id",
            'nombre' => "required|unique:persona,nombre,$persona->id",
            'fecha_nac' => 'required',
            'genero' => 'required',
            'telefono' => "required|unique:persona,telefono,$persona->id"

        ]);
        //$persona = personaActivo::findOrFail($persona->id);
        $persona->timestamps = false;
        $persona->ci = $request->ci;
        $persona->nombre = $request->nombre;
        $persona->fecha_nac = $request->fecha_nac;
        $persona->genero = $request->genero;
        $persona->telefono = $request->telefono;

        $persona->save();
        return redirect()->route('personas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Persona::destroy($id);
        return redirect('personas');
    }
}
