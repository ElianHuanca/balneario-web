{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'ingresos')

@section('content_header')
    <h1>Listado De ingresos</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('ingresos.create') }}">Nueva ingreso</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered mt-4" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>                            
                            <th>fecha</th>
                            <th>idUser</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingresos as $ingreso)
                            <tr>
                                <td>{{ $ingreso->id }}</td>                                
                                <td>{{ $ingreso->fecha }}</td>
                                <td>{{ $ingreso->iduser }}</td>
                                <td>
                                    <a class="btn btn-sm edit-b"
                                        href="{{ route('ingresos.edit', $ingreso) }}">Editar</a>
                                    <!-- <a class="btn btn-primary btn-sm" href="{{ route('ingresos.show', $ingreso->id) }}">Ver</a> -->

                                    <div style="display: inline-block">
                                        <form action="{{ route('ingresos.destroy', $ingreso->id) }}" method="POST">
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
