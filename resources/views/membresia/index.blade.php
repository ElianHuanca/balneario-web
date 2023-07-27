{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'membresias')

@section('content_header')
    <h1>Listado De membresias</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('membresias.create') }}">Nueva membresia</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered mt-4" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>                            
                            <th>fecha_ini</th>
                            <th>fecha_fin</th>
                            <th>iduser</th>
                            <th>idtipomembresia</th>
                            <th>idpago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($membresias as $membresia)
                            <tr>
                                <td>{{ $membresia->id }}</td>                                
                                <td>{{ $membresia->fecha_ini }}</td>
                                <td>{{ $membresia->fecha_fin }}</td>
                                <td>{{ $membresia->iduser }}</td>
                                <td>{{ $membresia->idtipomembresia }}</td>
                                <td>{{ $membresia->idpago }}</td>
                                <td>
                                    {{-- <a class="btn btn-sm edit-b"
                                        href="{{ route('membresias.edit', $membresia) }}">Editar</a>
                                    <!-- <a class="btn btn-primary btn-sm" href="{{ route('membresias.show', $membresia->id) }}">Ver</a> --> --}}

                                    <div style="display: inline-block">
                                        <form action="{{ route('membresias.destroy', $membresia->id) }}" method="POST">
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
