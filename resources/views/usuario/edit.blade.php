{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-usuario')

@section('content_header')
    <h1>Editar un usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="row g-2">
                    <div class="col-12 position-relative">
                        <label for="name">Ingrese el nombre de la usuario</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}">
                        <br>
                        @error('name')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="email">Ingrese un email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $usuario->email) }}"> <br>
                        @error('email')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div class="col-6 position-relative">
                        <label for="password">Ingrese su nueva contraseña</label>
                        <input type="password" name="password" class="form-control"> <br>
                        @error('password')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="id_persona">Persona con el usuario</label>
                        <select name="id_persona" id="id_persona" class="form-control">
                            <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                        </select>
                        @error('id_persona')
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
                <button class="btn btn-sm submit-b" type="submit">Actualizar usuario</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('usuarios.index') }}">volver</a>
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
