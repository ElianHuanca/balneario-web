<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\TiposMembresias;
use Illuminate\Http\Request;

class TiposMembresiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $tiposMembresias = TiposMembresias::all();
        return view('tipomembresia.index', compact('tiposMembresias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('tipomembresia.create');
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
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'duracion' => 'required',
        ]);

        $tipomembresia = new TiposMembresias($request->all());
        $tipomembresia->save();
        return redirect()->route('tiposMembresias.index');
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
        $tipomembresia = TiposMembresias::findOrFail($id);
        return view('tipomembresia.edit', compact('tipomembresia'));
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
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'duracion' => 'required',
        ]);
        $tipomembresia = TiposMembresias::find($id);        
        $tipomembresia->update($request->all());
        $tipomembresia->save();
        return redirect()->route('tiposMembresias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TiposMembresias::destroy($id);
        return redirect('tiposMembresias');
    }
}
