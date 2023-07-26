{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Ambiente')

@section('content_header')
    <h1>Editar un ambiente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ambientes.update', $ambiente->id) }}" method="post" enctype="multipart/form-data">
                <div>
                    @csrf
                    @method('put')
                    <label for="nombre">Nombre del ambiente</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $ambiente->nombre) }}">
                    <br>
                    @error('nombre')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>
                <div>
                    <label for="dimension">Dimensión del ambiente</label>
                    <input type="text" name="dimension" class="form-control"
                        value="{{ old('dimension', $ambiente->dimension) }}"><br>
                    @error('dimension')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="persona">Seleccione la persona responsable</label>
                        <select name="id_persona" id="persona" class="form-control ">
                            <option value="{{ old('id_persona', $persona->id) }}">{{ $persona->nombre }}</option>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                            @endforeach
                        </select>
                        @error('persona')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="ubicacion">Seleccione la ubicacion del ambiente</label>
                        <select name="id_ubicacion" id="ubicacion" class="form-control ">
                            <option value="{{ old('id_ubicacion', $ubicacion->id) }}">{{ $ubicacion->descripcion }}
                            </option>
                            @foreach ($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->descripcion }}</option>
                            @endforeach
                        </select>
                        @error('ubicacion')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-sm mt-3 mb-4 submit-b" type="submit">Actualizar Ambiente</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('ambientes.index') }}">volver</a>
                </button>
                <div>
                    <label for="fotos">Seleccione las fotos para subir</label>
                    <input type="file" name="fotos[]" id="" multiple>
                </div>
            </form>

            {{-- LISTAR FOTOS --}}
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
                                        <div class="d-flex align-items-center">
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
