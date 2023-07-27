<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Membresias;
use App\Models\Pagos;
use App\Models\TiposMembresias;
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
        $tipos=TiposMembresias::all();
        return view('membresia.create',compact('tipos'));
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
            'tipo_pago' => 'required',
            'idtipomembresia' => 'required',
        ]);
        $pago = new Pagos();
        $pago->tipo_pago=$request->tipo_pago;
        $pago->monto_total=0;
        $pago->fecha=now();
        $pago->save();
        
        $membresia = new Membresias();
        $membresia->fecha_ini=now();        
        $tipo = TiposMembresias::where('id', $request->idtipomembresia)->first();

        $dias=$tipo->duracion * 30;
        
        $membresia->fecha_fin=now()->addDays($dias);
        $membresia->idtipomembresia=$request->idtipomembresia;
        $user = auth()->user();
        $membresia->iduser=$user->id;
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
        $membresia=Membresias::find($id);
        $pago=Pagos::where('id', $membresia->idpago)->first();      
        
        Membresias::destroy($id);
        if ($pago) {
            $pago->delete(); 
        }
        //Pagos::destroy($pago->id);
        return redirect('membresias');
    }
}
