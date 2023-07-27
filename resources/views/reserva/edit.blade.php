{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-reserva')

@section('content_header')
    <h1>Editar reserva</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('reservas.update', $reserva) }}" method="post">
                @csrf
                @method('put')
                <div class="row g-2">                    

                    <div class="col-6 position-relative">
                        <label for="fecha">Ingrese fecha</label>
                        <input type="date" name="fecha" class="form-control"
                            value="{{ old('fecha', $reserva->fecha) }}">
                        <br>
                        @error('fecha')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    
                    <div class="col-6 position-relative">
                        <label for="turno">ingrese turno</label>
                        <input type="text" name="turno" class="form-control"
                            value="{{ old('turno', $reserva->turno) }}"> <br>
                        @error('turno')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-sm submit-b" type="submit">Actualizar reserva</button>
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
