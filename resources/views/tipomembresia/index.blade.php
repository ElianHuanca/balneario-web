{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'tiposMembresias')

@section('content_header')
    <h1>Listado De tiposMembresias</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('tiposMembresias.create') }}">Nueva tiposMembresia</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered mt-4" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>                            
                            <th>Nombre</th>
                            <th>descripcion</th>
                            <th>precio</th>
                            <th>duracion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiposMembresias as $tiposMembresia)
                            <tr>
                                <td>{{ $tiposMembresia->id }}</td>                                
                                <td>{{ $tiposMembresia->nombre }}</td>
                                <td>{{ $tiposMembresia->descripcion }}</td>
                                <td>{{ $tiposMembresia->precio }}</td>
                                <td>{{ $tiposMembresia->duracion }} (Meses)</td>
                                <td>
                                    <a class="btn btn-sm edit-b"
                                        href="{{ route('tiposMembresias.edit', $tiposMembresia) }}">Editar</a>
                                    <!-- <a class="btn btn-primary btn-sm" href="{{ route('tiposMembresias.show', $tiposMembresia->id) }}">Ver</a> -->

                                    <div style="display: inline-block">
                                        <form action="{{ route('tiposMembresias.destroy', $tiposMembresia->id) }}" method="POST">
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
