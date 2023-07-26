{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Activos')

@section('content_header')
    <h1>Listado de Activos del canal 11</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn" href="{{ route('activos.create') }}">Nuevo Activo</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mt-4" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>código</th>
                            <th>nombre</th>
                            <th>fecha I</th>
                            <th>vida útil</th>
                            <th>valor</th>
                            <th>periodo Mantenimiento</th>
                            <th>último mantenimiento</th>
                            <th>id ambiente</th>
                            <th>id categoría</th>
                            <th>id tipo ingreso</th>
                            <th>id estado</th>
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activos as $activo)
                            <tr>
                                <td>{{ $activo->id }}</td>
                                <td>{{ $activo->codigo }}</td>
                                <td>{{ $activo->nombre }}</td>
                                <td>{{ $activo->fecha_ingreso }}</td>
                                <td>{{ $activo->vida_util }}</td>
                                <td>{{ $activo->valor }}</td>
                                <td>{{ $activo->periodo_mantenimiento }}</td>
                                <td>{{ $activo->ultimo_mantenimiento }}</td>
                                <td>{{ $activo->nombre_ambiente }}</td>
                                <td>{{ $activo->nombre_categoria }}</td>
                                <td>{{ $activo->nombre_tipo_ingreso }}</td>
                                <td>{{ $activo->nombre_estado }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-start">
                                        <a style="margin-right: 5px " class="btn btn-sm edit-b"
                                            href="{{ route('activos.edit', $activo->id) }}">Editar</a>
                                        <a style="margin-right: 5px" class="btn btn-sm ver-b"
                                            href="{{ route('activos.show', $activo->id) }}">Ver</a>

                                        <form action="{{ route('activos.destroy', $activo->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm eliminar-b">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#table').DataTable({
            autoWidth: false
        });
    </script>
@endsection
