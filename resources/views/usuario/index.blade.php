{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('usuarios.create') }}">Nuevo Usuario</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered mt-4" id="usuarios">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre Usuario</th>
                        <th>Email</th>
                        <th>Rol del usuario</th>
                        <th>Le pertenece a</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->rolUser }}</td>
                            <td>{{ $usuario->nombrePersona }}</td>
                            <td>
                                <a class="btn btn-sm edit-b" href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                                <div style="display: inline-block">
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
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
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#usuarios').DataTable({
            autoWidth: false
        });
    </script>
@endsection
