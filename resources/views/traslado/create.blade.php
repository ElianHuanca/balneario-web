{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Traslado')

@section('content_header')
    <h1>Nuevo Traslado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('traslados.store') }}" method="post">
                @csrf
                <div class="row g-2">
                    <div class="col-6 position-relative">
                        <label for="descripcion">Ingrese una descripcion</label>
                        <textarea type="text" name="descripcion" class="form-control"></textarea> <br>
                        @error('descripcion')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <br>
                        <label for="id_persona">Selecione un responsable</label>
                        <select name="id_persona" id="select-traslado-persona" class="form-control">
                            <option value="">--Selecione un responsable--</option>
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
                        <label for="id_ambiente_origen">Selecione un Ambiente</label>
                        <select name="id_ambiente_origen" id="select-traslado-ambiente" class="form-control">
                            <option value="">--Selecione un Ambiente--</option>
                            @foreach ($ambientes as $ambiente)
                                <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_ambiente_origen')
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

                    <div class="col-6 position-relative">
                        <br>
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
                </div>

                <br>

                <button class="btn btn-sm submit-b" type="submit">Registrar Traslado de Activo</button>
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
    <script>
        var service = '<?php echo env('SERVICE', ''); ?>'
    </script>
    <script src="{{ asset('js/traslado/create.js') }}"></script>
@stop
