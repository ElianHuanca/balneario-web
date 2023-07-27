{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Balneario-producto')

@section('content_header')
    <h1>Nuevo ambiente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ambientes.store') }}" method="post">
                @csrf
                <div class="row g-2">                    
                    <div class="col-6 position-relative">
                        <label for="nombre">Ingrese el nombre del ambiente</label>
                        <input type="text" name="nombre" class="form-control"> <br>
                        @error('nombre')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>                    

                    <div class="col-6 position-relative">
                        <label for="precio">Ingrese el Precio</label>
                        <input type="text" name="precio" class="form-control"> <br>
                        @error('precio')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="capacidad">Ingrese la capacidad</label>
                        <input type="number" name="capacidad" class="form-control"> <br>
                        @error('capacidad')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-sm submit-b" type="submit">Registrar ambiente</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('ambientes.index') }}">volver</a>
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
