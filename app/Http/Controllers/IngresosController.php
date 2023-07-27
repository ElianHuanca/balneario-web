<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Ingresos;
use Illuminate\Http\Request;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $ingresos = Ingresos::all();
        //var_dump($ingresos);
        return view('ingreso.index', compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('ingreso.create');
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
            'fecha' => 'required',
            'iduser' => 'required',            
        ]);
        $ingreso= new Ingresos($request->all());    
        $ingreso->timestamps = false;    
        $ingreso->save();
        return redirect()->route('ingresos.index');
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
        $ingreso = Ingresos::findOrFail($id);
        return view('ingreso.edit', compact('ingreso'));
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
            'fecha' => 'required',
            'iduser' => 'required',
        ]);
        $ingreso = Ingresos::find($id);      
        $ingreso->timestamps = false;  
        $ingreso->update($request->all()); 
        $ingreso->save(); 
        return redirect()->route('ingresos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ingresos::destroy($id);
        return redirect('ingresos');
    }
}
