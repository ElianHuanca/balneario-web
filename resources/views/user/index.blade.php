{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'users')

@section('content_header')
    <h1>users</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('users.create') }}">Nuevo user</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered mt-4" id="users">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha Nacimiento</th>
                        <th>Rol del user</th>                        
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->ci }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->fecha_nacimiento }}</td>
                            <td>{{ $user->rolUser }}</td>                            
                            <td>
                                <a class="btn btn-sm edit-b" href="{{ route('users.edit', $user->id) }}">Editar</a>
                                <div style="display: inline-block">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
        $('#users').DataTable({
            autoWidth: false
        });
    </script>
@endsection
