<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaActivo;
use App\Models\Pagina;

class CategoriaActivoController extends Controller
{
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $categorias = CategoriaActivo::all();
        return view('categoriaActivo.index', compact('categorias'));
    }

    public function create()
    {
        Pagina::contarPagina(\request()->path());
        return view('categoriaActivo.create');
    }

    public function store(Request $request)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'nombre' => 'required|unique:categoria_activo'
        ]);
        $categoria = new CategoriaActivo($request->all());
        $categoria->timestamps = false;
        $categoria->save();
        return redirect()->route('categorias.index');
    }

    public function show($id)
    {
        Pagina::contarPagina(\request()->path());
        return 'No necesary view for this.';
    }

    public function edit(CategoriaActivo $categoria)
    {
        Pagina::contarPagina(\request()->path());
        return view('categoriaActivo.edit', compact('categoria'));
    }

    public function update(Request $request, CategoriaActivo $categoria)
    {
        Pagina::contarPagina(\request()->path());
        $this->validate($request, [
            'nombre' => "required|unique:categoria_activo,nombre",

        ]);
        //$categoria = CategoriaActivo::findOrFail($categoria->id);
        $categoria->timestamps = false;
        $categoria->nombre = $request->nombre;

        $categoria->save();
        return redirect()->route('categorias.index');
    }

    public function destroy(CategoriaActivo $categoria)
    {
        CategoriaActivo::destroy($categoria->id);
        return redirect('categorias');
    }
}
