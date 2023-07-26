{{-- @extends('adminlte::page') --}}
@extends('layouts.nueva')


@section('title', 'Ubicaciones')

@section('content_header')
    <h1>Ubicaciones de los ambientes</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('ubicaciones.create') }}">Nueva Ubicación</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered mt-4" id="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción de las ubicaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ubicaciones as $ubicacion)
                        <tr>
                            <td>{{ $ubicacion->id }}</td>
                            <td>{{ $ubicacion->descripcion }}</td>
                            <td>
                                <a class="btn btn-sm edit-b"
                                    href="{{ route('ubicaciones.edit', $ubicacion->id) }}">Editar</a>
                                <a class="btn btn-sm ver-b" target="_blank"
                                    href="https://www.google.com/maps/search/?api=1&query={{ $ubicacion->latitud }},{{ $ubicacion->longitud }}">Ver
                                    Ubicacion</a>

                                <div style="display: inline-block">
                                    <form action="{{ route('ubicaciones.destroy', $ubicacion->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button style="margin-right: 10px" type="submit"
                                            class="btn btn-sm eliminar-b">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    {{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#table').DataTable({
            autoWidth:false
        });
    </script> --}}
@endsection
