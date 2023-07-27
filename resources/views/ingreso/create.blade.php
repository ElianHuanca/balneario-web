{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-ingreso')

@section('content_header')
    <h1>Nuevo ingreso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ingresos.store') }}" method="post">
                @csrf
                <div class="row g-2">                    
                    <div class="col-6 position-relative">
                        <label for="fecha">Ingrese la fecha de ingreso</label>
                        <input type="date" name="fecha" class="form-control"> <br>
                        @error('fecha')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>                    

                    <div class="col-6 position-relative">
                        <label for="iduser">Ingrese el id de usuario</label>
                        <input type="text" name="iduser" class="form-control"> <br>
                        @error('iduser')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-sm submit-b" type="submit">Registrar ingreso</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('ingresos.index') }}">volver</a>
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
