{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-reserva')

@section('content_header')
    <h1>Nuevo reserva</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('reservas.store') }}" method="post">
                @csrf
                <div class="row g-2">                    
                    <div class="col-6 position-relative">
                        <label for="fecha">Ingrese la fecha</label>
                        <input type="date" name="fecha" class="form-control"> <br>
                        @error('fecha')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>                    

                    <div class="col-6 position-relative">
                        <label for="turno">Ingrese el turno</label>
                        <input type="text" name="turno" class="form-control"> <br>
                        @error('turno')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>


                    <div class="col-6 position-relative">
                        <label for="iduser">Ingrese el id del usuario</label>
                        <input type="text" name="iduser" class="form-control"> <br>
                        @error('iduser')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="idpago">Ingrese el id del pago</label>
                        <input type="text" name="idpago" class="form-control"> <br>
                        @error('idpago')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                </div>

                <button class="btn btn-sm submit-b" type="submit">Registrar reserva</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('reservas.index') }}">volver</a>
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
