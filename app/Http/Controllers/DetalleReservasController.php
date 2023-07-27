<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\Pagina;
use App\Models\DetalleReservas;
use Illuminate\Http\Request;

class DetalleReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $detalleReservas = DetalleReservas::all();
        return view('detalle_reserva.index', compact('detalleReservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        $ambientes = Ambientes::all();
        return view('detalle_reserva.create',compact('ambientes'));
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
            'idreserva' => 'required',
            'idambiente' => 'required',            
        ]);
        $detalleReserva= new DetalleReservas($request->all());    
        $detalleReserva->timestamps = false;    
        $detalleReserva->save();
        return redirect()->route('detalle_reservas.index');
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
        $detalleReserva = DetalleReservas::findOrFail($id);
        $ambientes = Ambientes::all();
        return view('detalle_reserva.edit', compact('detalleReserva','ambientes'));
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
            'idreserva' => 'required',
            'idambiente' => 'required',
        ]);
        $detalleReserva = DetalleReservas::find($id);      
        $detalleReserva->timestamps = false;  
        $detalleReserva->update($request->all()); 
        $detalleReserva->save(); 
        return redirect()->route('detalle_reservas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DetalleReservas::destroy($id);
        return redirect('detalle_reservas');
    }
}
