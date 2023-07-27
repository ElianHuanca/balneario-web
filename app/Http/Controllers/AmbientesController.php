<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Ambientes;
use Illuminate\Http\Request;

class AmbientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $ambientes = Ambientes::all();
        return view('ambiente.index', compact('ambientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('ambiente.create');
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
            'precio' => 'required',   
            'capacidad' => 'required',          
        ]);
        $ambiente= new Ambientes($request->all());    
        $ambiente->timestamps = false;    
        $ambiente->save();
        return redirect()->route('ambientes.index');
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
        $ambiente = Ambientes::findOrFail($id);
        return view('ambiente.edit', compact('ambiente'));
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
            'precio' => 'required',   
            'capacidad' => 'required',
        ]);
        $ambiente = Ambientes::find($id);      
        $ambiente->timestamps = false;  
        $ambiente->update($request->all()); 
        $ambiente->save(); 
        return redirect()->route('ambientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ambientes::destroy($id);
        return redirect('ambientes');
    }
}
