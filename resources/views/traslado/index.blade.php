{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Traslados')

@section('content_header')
    <h1>Traslados de Activos</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('traslados.create') }}">Nueva Traslado</a>
        </div>
        <div class="card-body">

            @if (count($traslados) == 0)
                <h1>Sin traslados por ahora!</h1>
            @else
                <table class="table table-striped table-bordered mt-4" id="traslados">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descripcion</th>
                            <th>Fecha de traslado</th>
                            <th>Id Activo</th>
                            <th>Nombre Activo</th>
                            <th>Ambiente</th>
                            <th>Responsable</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($traslados as $trasladoActual)
                            <tr>
                                <td>{{ $trasladoActual->id }}</td>
                                <td>{{ $trasladoActual->descripcion }}</td>
                                <td>{{ $trasladoActual->fecha_traslado }}</td>
                                <td>{{ $trasladoActual->id_activo }}</td>
                                <td>{{ $trasladoActual->nombreActivo }}</td>
                                <td>{{ $trasladoActual->nombreAmbiente }}</td>
                                <td>{{ $trasladoActual->responsable }}</td>
                                <td>
                                    <a class="btn btn-sm edit-b"
                                        href="{{ route('traslados.edit', $trasladoActual->id) }}">Editar</a>
                                    <!-- <form action="{{ route('traslados.destroy', $trasladoActual->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#traslados').DataTable({
            autoWidth: false
        });
    </script>
@endsection
