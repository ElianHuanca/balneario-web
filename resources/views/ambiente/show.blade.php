{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-Ambiente')

@section('content_header')
<h1>Detalle Ambiente</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <button class="btn btn-primary">
            <a class="text-white" href="{{route('ambientes.index')}}">volver</a>
        </button>
        <br><br>
        <div class="container-fluid border">
            <div class="row">
                <div class="col border-right">
                    {{-- MOSTRAR QR --}}
                    <div class="d-flex justify-content-center">
                        @if (count($qr)>0)
                        <img class="mt-2 mb-4" src="{{$qr[0]->url}}" alt="" width="120" height="120">
                        @endif
                    </div>

                    <div class="row">
                        <div class="col border-right">
                            <label for="nombre" class="">Nombre del ambiente</label>
                            <input disabled type="text" name="nombre" class="form-control"
                                value="{{$ambiente->nombre}}"> <br>

                            <label for="dimension">Dimensión del ambiente</label>
                            <input disabled type="text" name="dimension" class="form-control"
                                value="{{$ambiente->dimension}}"><br>
                        </div>

                        <div class="col">
                            <label for="persona-name">Persona responsable del ambiente:</label>
                            <input disabled type="text" name="persona-name" class="form-control"
                                value="{{$persona->nombre}}">
                            <label for="persona-ci">Ci:</label>
                            <input disabled type="text" name="persona-ci" class="form-control" value="{{$persona->ci}}">
                            <label for="persona-phone">Teléfono:</label>
                            <input disabled type="text" name="persona-phone" class="form-control"
                                value="{{$persona->telefono}}">

                            <button class="btn btn-primary mt-3 mb-2">
                                <a class="text-white" href="{{route('ambientes.edit', $ambiente->id)}}">Editar
                                    Ambiente</a>
                            </button>
                        </div>
                    </div>


                </div>

                {{-- Mapa --}}
                <div class="col">
                    <div id="map" style="width: 100%; height: 400px;"></div>
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
                    <img class="img-thumbnail" src="{{$foto->url}}" alt="" {{-- width="300" height="300" --}}>
                    <span>fecha registro: {{$foto->fecha}}</span>
                    <a target="_blank" href="{{$foto->url}}">Ver Imagen completa</a>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        {{-- LISTADO DE ACTIVOS DEL AMBIENTE --}}
        <h2 class="mt-5">Activos dentro del ambiente:</h2>
        <div class="container-fluid border">
            <table class="table table-striped table-bordered mt-4" id="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>código</th>
                        <th>nombre</th>
                        <th>Fecha I</th>
                        <th>vida útil</th>
                        <th>valor</th>
                        <th>periodo mantenimiento</th>
                        <th>último mantenimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activos as $activo)
                    <tr>
                        <td>{{$activo->id}}</td>
                        <td>{{$activo->codigo}}</td>
                        <td>{{$activo->nombre}}</td>
                        <td>{{$activo->fecha_ingreso}}</td>
                        <td>{{$activo->vida_util}}</td>
                        <td>{{$activo->valor}}</td>
                        <td>{{$activo->periodo_mantenimiento}}</td>
                        <td>{{$activo->ultimo_mantenimiento}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{route('activos.show',$activo->id)}}">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
$('#table').DataTable({
    autoWidth: false
});
</script>

{{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvUexPfr0cJLlaF08zCb1X3aggukbaIAI&callback=initMap"></script>  --}}
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