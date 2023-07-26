{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Canal 11-usuario')

@section('content_header')
    <h1>Nueva usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="post">
                @csrf
                <div class="row g-2">
                    <div class="col-12 position-relative">
                        <label for="name">Ingrese el nombre de la usuario</label>
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
                        <label for="id_persona">Seleccione a una persona para este usuario</label>
                        <select name="id_persona" id="id_persona" class="form-control">
                            @if (count($personas) > 0)
                                <option value="">--Selecione una persona--</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                                @endforeach
                            @else
                                <option value="">--Registre una persona primero--</option>
                            @endif
                        </select>
                        @error('id_persona')
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
                        </select>
                        @error('id_rol')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <br>
                <button class="btn btn-sm submit-b" type="submit">Registrar usuario</button>
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
