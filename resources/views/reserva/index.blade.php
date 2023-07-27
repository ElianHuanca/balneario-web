{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'reservas')

@section('content_header')
    <h1>Listado De reservas</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('reservas.create') }}">Nueva reserva</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered mt-4" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>                            
                            <th>fecha</th>
                            <th>turno</th>
                            <th>idUser</th>
                            <th>idPago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                            <tr>
                                <td>{{ $reserva->id }}</td>                                
                                <td>{{ $reserva->fecha }}</td>
                                <td>{{ $reserva->turno }}</td>
                                <td>{{ $reserva->iduser }}</td> 
                                <td>{{ $reserva->idpago }}</td> 
                                <td>
                                    <a class="btn btn-sm edit-b"
                                        href="{{ route('reservas.edit', $reserva) }}">Editar</a>
                                    <!-- <a class="btn btn-primary btn-sm" href="{{ route('reservas.show', $reserva->id) }}">Ver</a> -->

                                    <div style="display: inline-block">
                                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST">
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
