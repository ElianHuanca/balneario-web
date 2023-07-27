{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-uso')

@section('content_header')
    <h1>Nuevo uso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('usos.store') }}" method="post">
                @csrf
                <div class="row g-2">
                    {{-- <div class="col-6 position-relative">
                        <label for="fecha">Ingrese la fecha</label>
                        <input type="date" name="fecha" class="form-control"> <br>
                        @error('fecha')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div> --}}

                    <div class="col-6 position-relative">
                        <label for="cantidad">Ingrese la cantidad</label>
                        <input type="number" name="cantidad" class="form-control"> <br>
                        @error('cantidad')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>


                    <div class="col-6 position-relative">
                        <label for="idproducto">Ingrese el id del producto</label>
                        <input type="text" name="idproducto" class="form-control"> <br>
                        @error('idproducto')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="idambiente">Ingrese el id del ambiente</label>
                        <input type="text" name="idambiente" class="form-control"> <br>
                        @error('idambiente')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-sm submit-b" type="submit">Registrar uso</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('usos.index') }}">volver</a>
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
