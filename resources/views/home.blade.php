{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Dashboard')

@section('content_header')
<h1>Vista principal</h1>
@stop

@section('content')
<div class="container mt-auto card text-center">
    <div class="card-body">

        <p class="card-text">Bienvenido Al Sitio Web Balnerio Playa Caribe</p>

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