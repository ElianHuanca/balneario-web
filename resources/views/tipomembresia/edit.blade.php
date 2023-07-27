{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Balneario-tipomembresia')

@section('content_header')
    <h1>Editar tipomembresia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tiposMembresias.update', $tipomembresia) }}" method="post">
                @csrf
                @method('put')
                <div class="row g-2">                    

                    <div class="col-6 position-relative">
                        <label for="nombre">Ingrese el nombre de la tipomembresia</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $tipomembresia->nombre) }}">
                        <br>
                        @error('nombre')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="descripcion">Ingrese una descripcion de la tipomembresia</label>
                        <input type="text" name="descripcion" class="form-control"
                            value="{{ old('descripcion', $tipomembresia->descripcion) }}">
                        <br>
                        @error('descripcion')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                    
                    <div class="col-6 position-relative">
                        <label for="precio">Ingrese el precio</label>
                        <input type="text" name="precio" class="form-control"
                            value="{{ old('precio', $tipomembresia->precio) }}"> <br>
                        @error('precio')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>

                    <div class="col-6 position-relative">
                        <label for="duracion">Ingrese la duracion(meses)</label>
                        <input type="text" name="duracion" class="form-control"
                            value="{{ old('duracion', $tipomembresia->duracion) }}"> <br>
                        @error('duracion')
                            <small class="text-danger">*{{ $message }}</small>
                            <br><br>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-sm submit-b" type="submit">Actualizar tipomembresia</button>
                <button class="btn btn-sm volver-b">
                    <a class="text-white button-editar" href="{{ route('tiposMembresias.index') }}">volver</a>
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
