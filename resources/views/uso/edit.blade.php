{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-producto')

@section('content_header')
    <h1>Editar producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('productos.update', $producto) }}" method="post">
                @csrf
                @method('put')
                <div class="row g-2">                    

                    <div class="col-6 position-relative">
                        <label for="nombre">Ingrese el nombre de la producto</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $producto->nombre) }}">
                        <br>
                        @error('nombre')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    
                    <div class="col-6 position-relative">
                        <label for="precio">Ingrese su nro. celular</label>
                        <input type="text" name="precio" class="form-control"
                            value="{{ old('precio', $producto->precio) }}"> <br>
                        @error('precio')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-sm submit-b" type="submit">Actualizar producto</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('productos.index') }}">volver</a>
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
