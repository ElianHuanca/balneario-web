{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Categoria')

@section('content_header')
    <h1>Editar categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria) }}" method="post">
                @csrf
                @method('put')
                <label for="name">Editar Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre) }}"> <br>
                @error('nombre')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                @enderror
                <button class="btn btn-sm submit-b" type="submit">Actualizar categoría</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" class="text-white" href="{{ route('categorias.index') }}">volver</a>
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
