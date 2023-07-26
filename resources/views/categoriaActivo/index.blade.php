{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Categorías')

@section('content_header')
<h1>Categorías de Activos</h1>
@stop
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{ route('categorias.create') }}">Nueva Categoría</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered mt-4" id="categorias">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <a class="btn btn-sm edit-b" href="{{ route('categorias.edit', $categoria) }}">Editar</a>
                        @if(Session::has('idRolUser') && Session::get('idRolUser')==1)
                        <div style="display: inline-block">
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
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
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
$('#categorias').DataTable({
    autoWidth: false
});
</script>
@endsection