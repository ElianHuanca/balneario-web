{{-- @extends('adminlte::page') --}}
@extends('layouts.nueva')


@section('title', 'Canal 11-Ubicacion')
@section('content_header')
    <h1>Editar Ubicacion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ubicaciones.update', $ubicacion->id) }}" method="post">
                <div>
                    @csrf
                    @method('put')
                    <label for="descripcion">Ingrese la descripción de la nueva ubicación</label>
                    <input type="text" name="descripcion" class="form-control"
                        value="{{ old('descripcion', $ubicacion->descripcion) }}"> <br>
                    @error('descripcion')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>

                <div>
                    <label for="latitud">Latitud</label>
                    <input type="text" name="latitud" class="form-control" id="latitud"
                        value="{{ old('latitud', $ubicacion->latitud) }}"><br>
                    @error('latitud')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>
                <div>
                    <label for="longitud">Longitud</label>
                    <input type="text" name="longitud" class="form-control" id="longitud"
                        value="{{ old('longitud', $ubicacion->longitud) }}"><br>
                    @error('longitud')
                        <small class="text-danger">*{{ $message }}</small>
                        <br><br>
                    @enderror
                </div>
                {{-- Mapa --}}
                <div id="mapa">
                    <div id="map" style="width: 60%; height: 500px;"></div>
                </div>
                <button class="btn btn-sm submit-b" type="submit">Actualizar Ubicación</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('ubicaciones.index') }}">volver</a>
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    

    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script> --}}

    {{-- <script src="{{asset('js/app2.js')}}"></script> --}}
    <script type="text/javascript">
        const coordenada = {
            lat: {{ $ubicacion['latitud'] }},
            lng: {{ $ubicacion['longitud'] }}
        };
    </script>

    <script type="text/javascript" src="{{ asset('js/map/mapa2.js') }}"></script>
    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxph9T1koe4cRoEUGVAgFgvDFhqpgFYCU&callback=initMap"></script> --}}
     <script async
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvUexPfr0cJLlaF08zCb1X3aggukbaIAI&callback=initMap">
    </script>  
@stop
