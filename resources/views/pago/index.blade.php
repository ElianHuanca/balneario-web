{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'pagos')

@section('content_header')
    <h1>Listado De pagos</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('pagos.create') }}">Nueva pago</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered mt-4" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>                            
                            <th>tipo_pago</th>
                            <th>monto_total</th>
                            <th>fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $pago->id }}</td>                                
                                <td>{{ $pago->tipo_pago }}</td>
                                <td>{{ $pago->monto_total }}</td>
                                <td>{{ $pago->fecha }}</td>
                                <td>
                                    <a class="btn btn-sm edit-b"
                                        href="{{ route('pagos.edit', $pago) }}">Editar</a>
                                    <!-- <a class="btn btn-primary btn-sm" href="{{ route('pagos.show', $pago->id) }}">Ver</a> -->

                                    <div style="display: inline-block">
                                        <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST">
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
