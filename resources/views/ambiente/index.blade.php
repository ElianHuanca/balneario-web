{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Ambientes')

@section('content_header')
<h1>Listado de ambientes del canal 11</h1>
@stop
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        @if(Session::has('idRolUser') && Session::get('idRolUser')==1)
        <a class="btn btn-primary" href="{{ route('ambientes.create') }}">Nuevo Ambiente</a>
        @endif
    </div>
    <div class="card-body">
        @if(count($ambientes)>0)
        <table class="table table-striped table-bordered mt-4" id="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre Ambiente</th>
                    <th>Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ambientes as $ambiente)
                <tr>
                    <td>{{ $ambiente->id }}</td>
                    <td>{{ $ambiente->nombre }}</td>
                    <td>{{ $ambiente->responsable }}</td>
                    <td>
                        <a class="btn btn-sm edit-b" href="{{ route('ambientes.edit', $ambiente->id) }}">Editar</a>
                        <a class="btn btn-sm ver-b" href="{{ route('ambientes.show', $ambiente->id) }}">Ver</a>
                        @if(Session::has('idRolUser') && Session::get('idRolUser')==1)
                        <div style="display: inline-block">
                            <form action="{{ route('ambientes.destroy', $ambiente->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button style="margin-right: 10px" type="submit"
                                    class="btn btn-sm eliminar-b">Eliminar</button>
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h3>No tiene un ambiente a cargo</h3>
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