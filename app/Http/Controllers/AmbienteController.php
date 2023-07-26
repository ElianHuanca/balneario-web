<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Activo;
use App\Models\Persona;
use App\Models\Pagina;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;




class AmbienteController extends Controller
{
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $user = Auth::user();
        // dd($user);
        $ambientes = [];
        if(Session::has('idRolUser') && Session::get('idRolUser')==1){
        $ambientes = DB::table('ambiente')
            ->join('persona', 'ambiente.id_persona', '=', 'persona.id')
            ->select('ambiente.*', 'persona.nombre as responsable')->get();
        }else{
            $ambientes = DB::table('ambiente')
            ->join('persona', 'ambiente.id_persona', '=', 'persona.id')
            ->where('persona.id','=',$user->id_persona)
            ->select('ambiente.*', 'persona.nombre as responsable')->get();
        }
        //return $ambientes;

        return view('ambiente.index', compact('ambientes'));
    }

    public function create()
    {
        Pagina::contarPagina(\request()->path());
        $personas = Persona::all();
        $ubicaciones = Ubicacion::all();
        return view('ambiente.create', compact('personas', 'ubicaciones'));
    }

    public function store(Request $request)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'nombre' => 'required|unique:ambiente,nombre',
            'dimension' => 'required',
            'id_persona' => 'required',
            'id_ubicacion' => 'required'
        ]);
        $ambiente = new Ambiente($request->all());
        $ambiente->timestamps = false;
        $ambiente->save();

        // check if there are images to save
        if ($request->hasFile('fotos')) {
            $fotografiaC = new FotografiaController();
            foreach ($request->file('fotos') as $foto) {
                $fotografiaC->saveFotos($foto, $ambiente->id, 1);
            }
        }
        //save a QrCode for the new Ambiente
        $fotografiaC = new FotografiaController();
        $fotografiaC->generateQr($ambiente->id, 1);

        return redirect()->route('ambientes.index');
    }

    public function show($id)
    {
        Pagina::contarPagina(\request()->path());
        $ambiente = Ambiente::find($id);
        $persona = Persona::find($ambiente->id_persona);
        $ubicacion = Ubicacion::find($ambiente->id_ubicacion);
        $activos = Activo::where('id_ambiente', $ambiente->id)->get();
        $fotos = DB::table('fotografia')->where('id_tabla', $ambiente->id)->where('tipo_tabla', 1)->get();
        $qr = []; 
        foreach ($fotos as $key => $value) {
            if (str_contains($value->url, "QR")) {
                //$selected = $value;
                $qr[] = $value;
                $fotos->forget($key);
            }
        }
        return view('ambiente.show', compact('ambiente', 'persona', 'ubicacion', 'fotos', 'qr', 'activos'));
    }


    public function edit($id)
    {
        Pagina::contarPagina(\request()->path());
        $ambiente = Ambiente::find($id);
        $persona = Persona::find($ambiente->id_persona);
        $ubicacion = Ubicacion::find($ambiente->id_ubicacion);
        $personas = Persona::all();
        $ubicaciones = Ubicacion::all();
        $fotos = DB::table('fotografia')->where('id_tabla', $ambiente->id)->where('tipo_tabla', 1)->get();
        //$qr = DB::table('fotografia')->where('id_tabla', $ambiente->id)->where('tipo_tabla', 1)->where('url', 'like', '%QR%')->get();

        $qr = []; 
        foreach ($fotos as $key => $value) {
            if (str_contains($value->url, "QR")) {
                //$selected = $value;
                $qr[] = $value;
                $fotos->forget($key);
            }
        }
        //return $qr;
        return view('ambiente.edit', compact('ambiente', 'persona', 'ubicacion', 'personas', 'ubicaciones', 'fotos', 'qr'));
    }


    public function update(Request $request, $id)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'nombre' => "required|unique:ambiente,nombre, $id",
            'dimension' => 'required',
            'id_persona' => 'required',
            'id_ubicacion' => 'required'
        ]);
        $ambiente = Ambiente::find($id);
        $ambiente->timestamps = false;
        $ambiente->update($request->all());

        if ($request->hasFile('fotos')) {
            $fotografiaC = new FotografiaController();
            foreach ($request->file('fotos') as $foto) {
                $fotografiaC->saveFotos($foto, $ambiente->id, 1);
            }
        }

        return redirect()->route('ambientes.show', ['ambiente' => $ambiente->id]); 
    }

    public function destroy($id)
    {
        Ambiente::destroy($id);
        return redirect('ambientes');
    }
    public function getActivosAmbientesById($id){
        $activos = DB::table('ambiente as a')
        ->join('activo as a2', 'a2.id_ambiente', '=', 'a.id')
        ->where('a.id', '=', $id)
        ->orderBy('a2.id', 'asc')
        ->select('a2.*')->get();
        return $activos;
    }
}
