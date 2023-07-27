{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-membresia')

@section('content_header')
    <h1>Nuevo membresia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('membresias.store') }}" method="post">
                @csrf
                <div class="row g-2">

                    <div class="col-6 position-relative">
                        <label for="fecha_ini">Ingrese la fecha de inicio</label>
                        <input type="date" name="fecha_ini" class="form-control"> <br>
                        @error('fecha_ini')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="fecha_fin">Ingrese la fecha de fin</label>
                        <input type="date" name="fecha_fin" class="form-control"> <br>
                        @error('fecha_fin')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="iduser">Ingrese el usuario</label>
                        <input type="text" name="iduser" class="form-control"> <br>
                        @error('iduser')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div class="col-6 position-relative">
                        <label for="idtipomembresia">Ingrese la membresia</label>
                        <input type="text" name="idtipomembresia" class="form-control"> <br>
                        @error('idtipomembresia')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    

                </div>

                <button class="btn btn-sm submit-b" type="submit">Registrar membresia</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('membresias.index') }}">volver</a>
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
