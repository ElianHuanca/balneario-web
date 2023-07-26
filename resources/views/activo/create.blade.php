{{-- @extends('adminlte::page') --}}
@extends('layouts.nueva')
@section('title', 'Canal 11-Activo')

@section('content_header')
<h1>Registrar nuevo Activo</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('activos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div id="nombre" class="col">
                    <label for="nombre">Ingrese el nombre del nuevo activo</label>
                    <input type="text" name="nombre" class="form-control"> <br>
                    @error('nombre')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
                <div id="codigo" class="col">
                    <label for="codigo">Escriba el código del activo</label>
                    <input type="text" name="codigo" class="form-control"><br>
                    @error('codigo')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div id="vida_util" class="col">
                    <label for="vida_util">vida útil del activo (en meses)</label>
                    <input type="text" name="vida_util" class="form-control"><br>
                    @error('vida_util')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
                <div id="valor" class="col">
                    <label for="valor">Valor del activo</label>
                    <input type="text" name="valor" class="form-control"><br>
                    @error('valor')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div id="periodo_mantenimiento" class="col">
                    <label for="periodo_mantenimiento">periodo de mantenimiento (en meses)</label>
                    <input type="text" name="periodo_mantenimiento" class="form-control"><br>
                    @error('periodo_mantenimiento')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
                <div id="ambiente" class="col">
                    <label for="ambiente">Seleccione el ambiente</label>
                    @if(count($ambientes) ==0)
                    <select name="id_ambiente" id="id_ambiente" class="form-control">
                        <option value="">--No tiene un ambiente a cargo--</option>
                    </select>
                    @error('id_ambiente')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                    @else
                    <select name="id_ambiente" id="id_ambiente" class="form-control">
                        @foreach ($ambientes as $ambiente)
                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_ambiente')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                    @endif
                </div>
            </div>

            <div class="row">
                <div id="categoria" class="col">
                    <label for="categoria">Seleccione la categoría</label>
                    <select name="id_categoria" id="id_categoria" class="form-control">
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
                <div id="tipo_ingreso" class="col">
                    <label for="tipo_ingreso">Seleccione el tipo de ingreso</label>
                    <select name="id_tipo_ingreso" id="tipo_ingreso" class="form-control">
                        @foreach ($tipoIngresos as $tipoIngreso)
                        <option value="{{ $tipoIngreso->id }}">{{ $tipoIngreso->nombre }}</option>
                        @endforeach
                    </select>
                    @error('tipo_ingreso')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div id="estado" class="col-6">
                    <label for="estado">Seleccione el estado de llegada del activo</label>
                    <select name="id_estado" id="id_estado" class="form-control">
                        @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                    @error('estado')
                    <small class="text-danger">*{{ $message }}</small>
                    <br><br>
                    @enderror
                </div>
            </div>

            {{-- SUBIR FOTOS --}}
            <div id="fotos" class="mt-3">
                <label for="fotos">Seleccione las fotos para subir</label>
                <input type="file" name="fotos[]" id="" multiple>
            </div>

            <button class="btn btn-sm submit-b" type="submit">Registrar Activo</button>
            <button class="btn btn-sm volver-b">
                <a class="text-white button-editar" href="{{ route('activos.index') }}">volver</a>
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