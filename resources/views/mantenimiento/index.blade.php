{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Traslados')

@section('content_header')
<h1>Mantenimientos Realizados</h1>
@stop
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        @if(Session::has('idRolUser') && Session::get('idRolUser')==2)
        <a class="btn btn-primary" href="{{ route('mantenimientos.create') }}">Solicitar nuevo mantenimientos</a>
        @endif
    </div>
    <div class="card-body">

        @if (count($mantenimientos) == 0)
            @if(Session::has('idRolUser') && Session::get('idRolUser')==2)
                <h1>Usted no ha realizado ningún mantenimiento!</h1>
            @endif
            
            @if(Session::has('idRolUser') && Session::get('idRolUser')==3)
                <h1>No hay mantenimientos pendientes!</h1>
            @endif
        @else
        <table class="table table-striped table-bordered mt-4" id="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Activo</th>
                    <th>Estado</th>
                    <th>Ambiente</th>
                    <th>Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mantenimientos as $mantenimiento)
                <tr>
                    <td>{{ $mantenimiento->id }}</td>
                    <td>{{ $mantenimiento->tipo }}</td>
                    <td>{{ $mantenimiento->fecha_solicitud }}</td>
                    <td>{{ $mantenimiento->descripcion }}</td>
                    <td>{{ $mantenimiento->activo }}</td>
                    <td>{{ $mantenimiento->estado }}</td>
                    <td>{{ $mantenimiento->ambiente }}</td>
                    <td>{{ $mantenimiento->responsable }}</td>
                    <td>
                        @if(Session::has('idRolUser') && Session::get('idRolUser')!=1)
                        <a class="btn btn-sm edit-b"
                            href="{{ route('mantenimientos.edit', $mantenimiento->id) }}">Editar</a>
                        @else
                        Solo puede ver los mantenimientos
                        @endif
                        <!-- <form action="{{ route('mantenimientos.destroy', $mantenimiento->id) }}" method="POST">
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
$('#table').DataTable({
    autoWidth: false
});
</script>
@endsection