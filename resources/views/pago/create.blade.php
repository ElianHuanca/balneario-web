{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-pago')

@section('content_header')
    <h1>Nuevo pago</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pagos.store') }}" method="post">
                @csrf
                <div class="row g-2">                    
                    <div class="col-6 position-relative">
                        <label for="tipo_pago">Ingrese el tipo de pago</label>
                        <input type="text" name="tipo_pago" class="form-control"> <br>
                        @error('tipo_pago')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>   
                    
                    <div class="col-6 position-relative">
                        <label for="monto_total">Ingrese el monto total</label>
                        <input type="text" name="monto_total" class="form-control"> <br>
                        @error('monto_total')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="fecha">Ingrese la fecha</label>
                        <input type="date" name="fecha" class="form-control"> <br>
                        @error('fecha')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-sm submit-b" type="submit">Registrar pago</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('pagos.index') }}">volver</a>
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
