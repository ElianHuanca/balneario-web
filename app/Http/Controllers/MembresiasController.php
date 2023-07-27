<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Membresias;
use App\Models\Pagos;
use Illuminate\Http\Request;

class MembresiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $membresias = Membresias::all();
        return view('membresia.index', compact('membresias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('membresia.create');
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
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'iduser' => 'required',
            'idtipomembresia' => 'required',
        ]);
        $pago = new Pagos();
        $pago->tipo_pago='QR';
        $pago->monto_total=0;
        $pago->fecha=$request->fecha_ini;
        $pago->save();
        
        $membresia = new Membresias($request->all());
        $membresia->timestamps = false;
        $membresia->idpago=$pago->id;
        $membresia->save();
        return redirect()->route('membresias.index');
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
        $membresia = Membresias::findOrFail($id);
        return view('membresia.edit', compact('membresia'));
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
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'iduser' => 'required',
            'idtipomembresia' => 'required',
            'idpago' => 'required',
        ]);
        $membresia = Membresias::find($id);
        $membresia->timestamps = false;
        $membresia->update($request->all());
        $membresia->save();
        return redirect()->route('membresias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Membresias::destroy($id);
        return redirect('membresias');
    }
}
