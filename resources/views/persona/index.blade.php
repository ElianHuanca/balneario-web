{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Personas')

@section('content_header')
    <h1>Listado de personas del canal 11</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('personas.create') }}">Nueva Persona</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered mt-4" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nro. Carnet</th>
                            <th>Nombre Persona</th>
                            <th>Fecha Nac.</th>
                            <th>Genero</th>
                            <th>Nro. Celular</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $personaActual)
                            <tr>
                                <td>{{ $personaActual->id }}</td>
                                <td>{{ $personaActual->ci }}</td>
                                <td>{{ $personaActual->nombre }}</td>
                                <td>{{ $personaActual->fecha_nac }}</td>
                                <td>{{ $personaActual->genero }}</td>
                                <td>{{ $personaActual->telefono }}</td>
                                <td>
                                    <a class="btn btn-sm edit-b"
                                        href="{{ route('personas.edit', $personaActual) }}">Editar</a>
                                    <!-- <a class="btn btn-primary btn-sm" href="{{ route('personas.show', $personaActual->id) }}">Ver</a> -->

                                    <div style="display: inline-block">
                                        <form action="{{ route('personas.destroy', $personaActual->id) }}" method="POST">
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
