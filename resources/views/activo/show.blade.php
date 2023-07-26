{{-- @extends('adminlte::page') --}}
@extends('layouts.nueva')
{{-- @extends('layouts.principal') --}}

@section('title', 'Canal 11-Activo')

@section('content_header')
<h1>Detalle Activo</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <button class="btn">
            <a class="text-white" href="{{ route('activos.index') }}">volver</a>
        </button>
        <br><br>
        <div class="container-fluid border rounded">
            <div class="row">
                <div class="col-7 border-right">
                    {{-- MOSTRAR QR --}}
                    <div class="d-flex justify-content-center">
                        @if (count($qr) > 0)
                        <img class="mt-2 mb-4" src="{{ $qr[0]->url }}" alt="" width="130" height="130">
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-4 border-right">
                            <label for="nombre" class="p-0 m-0">Nombre del activo</label>
                            <span class="d-block mb-3">{{ $activo->nombre }}</span>
                            <label for="codigo" class="p-0 m-0">Código del activo</label>
                            <span class="d-block mb-3">{{ $activo->codigo }}</span>
                            <label for="fecha_ingreso" class="m-0 p-0">Fecha ingreso</label>
                            <span class="d-block mb-3">{{ $activo->fecha_ingreso }}</span>
                            <label for="vida_util" class="m-0 p-0">Vida útil</label>
                            <span class="d-block mb-3">{{ $activo->vida_util }}</span>
                            <label for="valor" class="p-0 m-0">Valor del activo</label>
                            <span class="d-block mb-3">{{ $activo->valor }}</span>
                            <label for="periodo_mantenimiento" class="p-0 m-0">Periodo mantenimiento</label>
                            <span class="d-block mb-3">{{ $activo->periodo_mantenimiento }}</span>
                        </div>

                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="ultimo_mantenimiento" class="m-0 p-0">Ultimo mantenimiento:</label>
                                    <span class="d-block mb-3">{{ $activo->ultimo_mantenimiento }}</span>
                                    <label for="persona_name" class="m-0 p-0">Responsable del activo:</label>
                                    <span class="d-block mb-3">{{ $persona->nombre }}</span>
                                    <label for="persona_ci" class="m-0 p-0">Ci:</label>
                                    <span class="d-block mb-3">{{ $persona->ci }}</span>
                                    <label for="persona_phone" class="m-o p-0">Teléfono:</label>
                                    <span class="d-block mb-3">{{ $persona->telefono }}</span>
                                </div>
                                <div class="col">
                                    <label for="categoria_nombre" class="m-0 p-0">Categoría del activo:</label>
                                    <span class="d-block mb-3">{{ $categoria->nombre }}</span>
                                    <label for="tipo_ingreso" class="m-0 p-0">Tipo de ingreso:</label>
                                    <span class="d-block mb-3">{{ $tipoIngreso->nombre }}</span>
                                    <label for="id_estado" class="m-0 p-0">Estado del activo:</label>
                                    <span class="d-block mb-3">{{ $estado->nombre }}</span>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <!-- <button class="btn mt-3 mb-2 mr-2 show-mantenimiento-b">
                                        <a class="text-white" href="{{ route('activos.edit', $activo->id) }}">Realizar
                                            mantenimiento</a>
                                    </button> -->
                                <button class="btn mt-3 mb-2 mr-2 show-editar-b">
                                    <a class="text-white" href="{{ route('activos.edit', $activo->id) }}">Editar
                                        Activo</a>
                                </button>
                            </div>
                        </div>

                    </div>


                    {{-- Mapa --}}
                </div>
                <div id="map" style="width: 40%; height: 500px;"></div>
            </div>
        </div>
    </div>
    {{-- LISTAR FOTOS --}}
    <div class="container-fluid mt-4">
        <h2>Registro de fotografías:</h2>
        <div class="row row-cols-4">
            @if (count($fotos) > 0)
            @foreach ($fotos as $foto)
            <div class="p-0 d-flex flex-column align-items-center">
                <img class="img-thumbnail" src="{{ $foto->url }}" alt="" {{-- width="300" height="300" --}}>
                <span>fecha registro: {{ $foto->fecha }}</span>
                <a target="_blank" href="{{ $foto->url }}">Ver Imagen completa</a>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>




@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
<link rel="stylesheet" href="{{ asset('css/app2.css') }}">
@stop

@section('js')
    {{-- init maps --}}
    <script type="text/javascript">
        const coordenada = {
            lat: {{ $ubicacion['latitud'] }},
            lng: {{ $ubicacion['longitud'] }}
        };
    </script>
    <script type="text/javascript" src="{{ asset('js/map/mapa2.js') }}"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvUexPfr0cJLlaF08zCb1X3aggukbaIAI&callback=setMap"></script>
    {{-- Env maps --}}
@stop
