{{-- @extends('adminlte::page') --}}
@extends('layouts.nueva')
@section('title', 'Canal 11-Activo')

@section('content_header')
    <h1>Editar Activo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('activos.update', $activo->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div id="nombre" class="col">
                        <label for="nombre">Nombre del activo</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $activo->nombre) }}"> <br>
                        @error('nombre')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div id="codigo" class="col">
                        <label for="codigo">Código del activo</label>
                        <input type="text" name="codigo" class="form-control"
                            value="{{ old('codigo', $activo->codigo) }}"><br>
                        @error('codigo')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div id="vida_util" class="col">
                        <label for="vida_util">vida útil del activo</label>
                        <input type="text" name="vida_util" class="form-control"
                            value="{{ old('vida_util', $activo->vida_util) }}"><br>
                        @error('vida_util')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div id="valor" class="col">
                        <label for="valor">Valor del activo</label>
                        <input type="text" name="valor" class="form-control"
                            value="{{ old('valor', $activo->valor) }}"><br>
                        @error('valor')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div id="periodo_mantenimiento" class="col">
                        <label for="periodo_mantenimiento">periodo de mantenimiento (en meses)</label>
                        <input type="text" name="periodo_mantenimiento" class="form-control"
                            value="{{ old('periodo_mantenimiento', $activo->periodo_mantenimiento) }}"><br>
                        @error('periodo_mantenimiento')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div id="ambiente" class="col">
                        <label for="ambiente">Seleccione el ambiente</label>
                        <select name="id_ambiente" id="id_ambiente" class="form-control">
                            <option value="{{ old('id_ambiente', $ambiente->id) }}">{{ $ambiente->nombre }}</option>
                            @foreach ($ambientes as $ambiente)
                                <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('ambiente')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div id="categoria" class="col">
                        <label for="categoria">Seleccione la categoría</label>
                        <select name="id_categoria" id="id_categoria" class="form-control">
                            <option value="{{ old('id_categoria', $categoria->id) }}">{{ $categoria->nombre }}</option>
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
                            <option value="{{ old('id_tipo_ingreso', $tipoIngreso->id) }}">{{ $tipoIngreso->nombre }}
                            </option>
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
                            <option value="{{ old('id_estado', $estado->id) }}">{{ $estado->nombre }}</option>
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
                    <label for="fotos">Subir nuevas fotos para el activo</label>
                    <input type="file" name="fotos[]" id="" multiple>
                </div>

                <button class="btn btn-sm submit-b" type="submit">Actualizar Activo</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('activos.index') }}">volver</a>
                </button>
            </form>

            {{-- EDITAR FOTOS --}}
            <div class="container-fluid mt-4">
                <h2>Registro de fotografías</h2>
                <div class="row row-cols-4">
                    @if (count($fotos) > 0)
                        @foreach ($fotos as $foto)
                            <form action="{{ route('fotografias.destroy', $foto->id) }}" method="POST">
                                <div class="p-0 d-flex flex-column border">
                                    @csrf
                                    @method('delete')
                                    <img class="img-thumbnail" src="{{ $foto->url }}" alt="">
                                    <div class="row">
                                        <div class="col d-flex flex-column">
                                            <span>fecha registro: {{ $foto->fecha }}</span>
                                            <a target="_blank" href="{{ $foto->url }}">Ver Imagen completa</a>
                                        </div>
                                        <div class="d-flex align-items-center p-2">
                                            <button type="submit" class="btn text-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @endif
                </div>
            </div>
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
