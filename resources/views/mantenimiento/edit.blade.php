{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Traslado')

@section('content_header')
<h1>Editar una solicitud</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row g-2">
                @if(Session::has('idRolUser') && Session::get('idRolUser')==2)
                <div class="col-6 position-relative">
                    <label for="descripcion">Ingrese una descripcion del mantenimiento</label>
                    <textarea type="text" name="descripcion"
                        class="form-control">{{ old('descripcion', $mantenimiento->descripcion) }} </textarea><br>
                    @error('descripcion')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>

                <div class="col-6 position-relative">
                    <label for="tipoMantenimiento">Selecione el tipo de mantenimiento</label>
                    <select name="tipoMantenimiento" class="form-control">
                        <option value="{{$mantenimiento->tipo}}">{{$mantenimiento->tipo}}</option>
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
                        <option value="{{$activo->id}}">{{$activo->nombre}}</option>
                    </select>
                    @error('id_activo')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
            </div>
            @endif
            @if(Session::has('idRolUser') && Session::get('idRolUser')==3)
            <div class="col-6 position-center">
                <label for="id_estado">Cambiar el estado del mantenimiento</label>
                <select name="id_estado" class="form-control">
                    <option value="">--Seleccione un estado--</option>
                    @foreach($estadosMantenimiento as $estado)
                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>

                    @endforeach
                </select>
                @error('id_estado')
                <small class="text-danger">*{{ $message }}</small>
                <br><br>
                @enderror
            </div>
    </div>
    @endif
</div>
</div>
<br>
<button class="btn btn-sm submit-b" type="submit">Actualizar Mantenimiento</button>
<button class="btn btn-sm volver-b">
    <a class="text-white button-editar" href="{{ route('mantenimientos.index') }}">volver</a>
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
var service = '<?php echo env('SERVICE', '') ?>'
</script>
<script src="{{ asset('js/mantenimiento/create.js') }}"></script>
@stop