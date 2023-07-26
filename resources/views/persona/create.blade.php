{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Persona')

@section('content_header')
    <h1>Nueva Persona</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('personas.store') }}" method="post">
                @csrf
                <div class="row g-2">
                    <div class="col-6 position-relative">
                        <label for="ci">Ingrese el nro. de carnet</label>
                        <input type="text" name="ci" class="form-control"> <br>
                        @error('ci')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="nombre">Ingrese el nombre de la persona</label>
                        <input type="text" name="nombre" class="form-control"> <br>
                        @error('nombre')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="fecha_nac">Ingrese la fecha de nacimiento</label>
                        <input type="date" name="fecha_nac" class="form-control"> <br>
                        @error('fecha_nac')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="genero">Seleccione su genero</label>
                        <select name="genero" id="genero" class="form-control">
                            <option value="Masculino">Marculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                        @error('genero')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div class="col-6 position-relative">
                        <label for="telefono">Ingrese su nro. celular</label>
                        <input type="text" name="telefono" class="form-control"> <br>
                        @error('telefono')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-sm submit-b" type="submit">Registrar Persona</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('personas.index') }}">volver</a>
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
