{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Balneario-detalle reserva')

@section('content_header')
    <h1>Nuevo detalle reserva</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('detalle_reservas.store') }}" method="post">
                @csrf
                <div class="row g-2">                    
                    <div class="col-6 position-relative">
                        <label for="idreserva">Ingrese el id de la reserva</label>
                        <input type="text" name="idreserva" class="form-control"> <br>
                        @error('idreserva')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>                    

                    <div class="col-6 position-relative">
                        <label for="idambiente">Ingrese el ambiente que desea</label>
                        {{-- <input type="text" name="idambiente" class="form-control"> <br> --}}
                        <select name="idambiente" class="form-control">
                            @foreach($ambientes as $ambiente)
                                <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('idambiente')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-sm submit-b" type="submit">Registrar detalle reserva</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('detalle_reservas.index') }}">volver</a>
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
