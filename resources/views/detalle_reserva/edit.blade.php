{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Balneario-detalle_reserva')

@section('content_header')
    <h1>Editar detalle_reserva</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('detalle_reservas.update', $detalleReserva) }}" method="post">
                @csrf
                @method('put')
                <div class="row g-2">

                    <div class="col-6 position-relative">
                        <label for="idreserva"> id de la reservao</label>
                        <input type="text" name="idreserva" class="form-control"
                            value="{{ old('idreserva', $detalleReserva->idreserva) }} " readonly>
                        <br>
                        @error('idreserva')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>


                    <div class="col-6 position-relative">
                        <label for="idambiente">Ingrese el ambiente</label>
                        {{-- <input type="text" name="idambiente" class="form-control"
                            value="{{ old('idambiente', $detalle_reserva->idambiente) }}"> <br> --}}
                        <select name="idambiente" class="form-control">
                            @foreach ($ambientes as $ambiente)
                                <option value="{{ $ambiente->id }}" @if($ambiente->id === $detalleReserva->idambiente) selected @endif>{{ $ambiente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('idambiente')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-sm submit-b" type="submit">Actualizar detalle_reserva</button>
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
