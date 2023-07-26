{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Mantenimiento')

@section('content_header')
<h1>Registrar nuevo Mantenimiento</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('mantenimientos.store') }}" method="post">
            <div class="row g-2">
                <div class="col-6 position-relative">
                    @csrf
                    <label for="descripcion">Ingrese una descripcion del mantenimiento</label>
                    <textarea type="text" name="descripcion" class="form-control"> </textarea><br>
                    @error('descripcion')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>

                <div class="col-6 position-relative">
                    <label for="tipoMantenimiento">Selecione el tipo de mantenimiento</label>
                    <select name="tipoMantenimiento"class="form-control">
                        <option value="">--Selecione un tipo--</option>
                        <option value="Correctivo">Correctivo</option>
                        <option value="Predictivo">Predictivo</option>
                    </select>
                    @error('tipoMantenimiento')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>

                <div class="col-6 position-relative">
                    <label for="id_ambiente">Selecione su Ambiente</label>
                    <select name="id_ambiente" id="select-traslado-ambiente" class="form-control">
                        <option value="">--Selecione un Ambiente--</option>
                        @foreach ($ambientes as $ambiente)
                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_ambiente')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>

                <div class="col-6 position-relative">
                    <label for="id_activo">Selecione un Activo </label>
                    <select name="id_activo" id="select-traslado-activo" class="form-control">
                        <option value="">--Selecione un Activo--</option>
                    </select>
                    @error('id_activo')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
            </div>
            <br>
            <button class="btn btn-sm submit-b" type="submit">Solicitar Mantenimiento</button>
            <button class="btn btn-sm volver-b">
                <a class="text-white button-editar" class="text-white"
                    href="{{ route('mantenimientos.index') }}">volver</a>
            </button>
        </form>
    </div>
</div>

@stop

@section('css')
{{--     <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
var service = '<?php echo env('SERVICE', '') ?>'
</script>
<script src="{{ asset('js/mantenimiento/create.js') }}"></script>
@stop