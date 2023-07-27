<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\Pagina;
use App\Models\Pagos;
use App\Models\Reservas;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $reservas = Reservas::all();
        return view('reserva.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(\request()->path());
        $ambientes=Ambientes::all();
        return view('reserva.create',compact('ambientes'));
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
            'turno' => 'required',  
            'tipo_pago' => 'required',     
        ]);

        $pago = new Pagos();
        $pago->tipo_pago=$request->tipo_pago;
        $pago->monto_total=0;
        $pago->fecha=now();
        $pago->save();

        $reserva= new Reservas($request->all());
        $user = auth()->user();
        $reserva->iduser=$user->id;
        $reserva->idpago=$pago->id;
        $reserva->timestamps = false; 
        $reserva->save();


        return redirect()->route('reservas.index');
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
        $reserva = Reservas::findOrFail($id);
        return view('reserva.edit', compact('reserva'));
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
            'turno' => 'required',
        ]);
        $reserva = Reservas::find($id);      
        $reserva->timestamps = false;  
        $reserva->update($request->all()); 
        $reserva->save(); 
        return redirect()->route('reservas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservas::destroy($id);
        return redirect('reservas');
    }
}
