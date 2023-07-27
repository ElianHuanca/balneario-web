{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Balneario-user')

@section('content_header')
    <h1>Nuevo usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="row g-2">

                    <div class="col-12 position-relative">
                        <label for="ci">Ingrese el ci</label>
                        <input type="text" name="ci" class="form-control"> <br>
                        @error('ci')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-12 position-relative">
                        <label for="name">Ingrese el nombre</label>
                        <input type="text" name="name" class="form-control"> <br>
                        @error('name')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="email">Ingrese un email</label>
                        <input type="email" name="email" class="form-control"> <br>
                        @error('email')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    <div class="col-6 position-relative">
                        <label for="password">Ingrese su contraseña</label>
                        <input type="password" name="password" class="form-control"> <br>
                        @error('password')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="fecha_nacimiento">Ingrese su fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control"> <br>
                        @error('fecha_nacimiento')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    
                    <div class="col-6 position-relative">
                        <label for="id_rol">Seleccione un rol</label>
                        <select name="id_rol" id="id_rol" class="form-control">
                            <option value="">--Selecione un rol--</option>
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
                <button class="btn btn-sm submit-b" type="submit">Registrar user</button>
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
