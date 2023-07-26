{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Ambiente')

@section('content_header')
    <h1>Registrar nuevo ambiente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ambientes.store') }}" method="post" enctype="multipart/form-data">
                <div>
                    @csrf
                    <label for="nombre">Ingrese el nombre del nuevo ambiente</label>
                    <input type="text" name="nombre" class="form-control"> <br>
                    @error('nombre')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>

                <div>
                    <label for="dimension">Escriba la dimensión del nuevo ambiente</label>
                    <input type="text" name="dimension" class="form-control"><br>
                    @error('dimension')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>

                <div>
                    <label for="persona">Seleccione la persona responsable</label>
                    <select name="id_persona" id="persona" class="form-control">
                        @foreach ($personas as $persona)
                            <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                        @endforeach
                    </select>
                    @error('persona')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>

                <div>
                    <label for="ubicacion">Seleccione la ubicacion del ambiente</label>
                    <select name="id_ubicacion" id="ubicacion" class="form-control">
                        @foreach ($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->descripcion }}</option>
                        @endforeach
                    </select>
                    @error('ubicacion')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>

                {{-- SUBIR FOTOS --}}
                <div>
                    <label for="fotos">Seleccione las fotos para subir</label>
                    <input type="file" name="fotos[]" id="" multiple>
                </div>

                <button class="btn btn-sm submit-b" type="submit">Crear Ambiente</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('ambientes.index') }}">volver</a>
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
