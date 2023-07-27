<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Usos;
use Illuminate\Http\Request;

class UsosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $usos = Usos::all();
        return view('uso.index', compact('usos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('uso.create');
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
            /* 'fecha' => 'required', */
            'cantidad' => 'required',        
            'idproducto' => 'required', 
            'idambiente' => 'required',     
        ]);
        $uso= new Usos($request->all());    
        $uso->fecha=now();
        $uso->timestamps = false;    
        $uso->save();
        return redirect()->route('usos.index');
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
        $uso = Usos::findOrFail($id);
        return view('uso.edit', compact('uso'));
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
        ]);
        $uso = Usos::find($id);      
        $uso->timestamps = false;  
        $uso->update($request->all()); 
        $uso->save(); 
        return redirect()->route('usos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Usos::destroy($id);
        return redirect('usos');
    }
}
