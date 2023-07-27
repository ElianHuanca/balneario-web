{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Balneario-ambiente')

@section('content_header')
    <h1>Editar ambiente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ambientes.update', $ambiente) }}" method="post">
                @csrf
                @method('put')
                <div class="row g-2">                    

                    <div class="col-6 position-relative">
                        <label for="nombre">Ingrese el nombre de la ambiente</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $ambiente->nombre) }}">
                        <br>
                        @error('nombre')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    
                    <div class="col-6 position-relative">
                        <label for="precio">Precio</label>
                        <input type="text" name="precio" class="form-control"
                            value="{{ old('precio', $ambiente->precio) }}"> <br>
                        @error('precio')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="capacidad">Capacidad</label>
                        <input type="number" name="capacidad" class="form-control"
                            value="{{ old('capacidad', $ambiente->capacidad) }}"> <br>
                        @error('capacidad')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                </div>
                <button class="btn btn-sm submit-b" type="submit">Actualizar ambiente</button>
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
