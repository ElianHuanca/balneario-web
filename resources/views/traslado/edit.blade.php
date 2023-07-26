{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Traslado')

@section('content_header')
    <h1>Editar un traslado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('traslados.update', $traslado->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row g-2">
                    <div class="col-6 position-relative">
                        <label for="descripcion">Ingrese una descripcion</label>
                        <textarea type="text" name="descripcion" class="form-control">{{ old('descripcion', $traslado->descripcion) }}</textarea> <br>
                        @error('descripcion')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="id_persona">Selecione un responsable</label>
                        <select name="id_persona" id="select-traslado-persona" class="form-control">
                            <option value="{{ $traslado->id_persona }}" selected>{{ $persona->nombre }}</option>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_persona')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="id_ambiente_destino">¿Donde se trasladara el activo?</label>
                        <select name="id_ambiente_destino" id="select-traslado-ambiente-destino" class="form-control">
                            <option value="">--Selecione un Ambiente--</option>
                            @foreach ($ambientes as $ambiente)
                                <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_ambiente_destino')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>


                    <div class="col-6 position-relative">
                        <label for="id_activo">Activo Selecionado</label>
                        <select name="id_activo" id="select-traslado-activo" class="form-control">
                            <option value="{{ $activo->id }}">{{ $activo->nombre }}</option>
                        </select>
                        @error('id_activo')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <br>
                <button class="btn btn-sm submit-b" type="submit">Actualizar Traslado</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('traslados.index') }}">volver</a>
                </button>
            </form>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
