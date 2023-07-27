{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Balneario-user')

@section('content_header')
    <h1>Editar un user</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="row g-2">

                    <div class="col-12 position-relative">
                        <label for="ci">Ingrese el ci</label>
                        <input type="text" name="ci" class="form-control" value="{{ old('ci', $user->ci) }}">
                        <br>
                        @error('ci')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-12 position-relative">
                        <label for="name">Ingrese el nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        <br>
                        @error('name')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="email">Ingrese un email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email) }}"> <br>
                        @error('email')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    {{-- <div class="col-6 position-relative">
                        <label for="password">Ingrese su nueva contraseña</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password', $user->password) }}"> <br>
                        @error('password')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div> --}}

                    <div class="col-6 position-relative">
                        <label for="fecha_nacimiento">Ingrese nueva fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}"> <br>
                        @error('fecha_nacimiento')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    

                    <div class="col-6 position-relative">
                        <label for="id_rol">Seleccione un rol</label>
                        <select name="id_rol" id="id_rol" class="form-control">
                            <option value="{{ $role[0]->id }}">{{ $role[0]->nombre }} </option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_rol')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <br>
                <button class="btn btn-sm submit-b" type="submit">Actualizar user</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('users.index') }}">volver</a>
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
