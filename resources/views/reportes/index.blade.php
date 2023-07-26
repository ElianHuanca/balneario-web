{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'Personas')

@section('content_header')
    <h1>Reportes</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card" style="width: 70%;
                            margin: 0% auto">
        <div class="card-header">
            {{-- <a class="btn btn-primary" href="{{route('personas.create')}}">Nueva Persona</a> --}}
        </div>
        <div class="card-body">
            <form action="{{ route('reportes.validar') }}" method="POST">
                @csrf

                <h3 class="">Datos del reporte</h3>

                <div class="row">

                    <div class="item col col-lg col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-preprend ">
                                    <span class="input-group-text rounded-0">Nombre file*</span>
                                </div>
                                <input type="text" name='nombre' placeholder="Nombre del reporte" required>
                            </div>
                        </div>                        
                    </div>

                    <div class="item col col-lg col-md-6 col-sm-6">
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-preprend ">
                                    <span class="input-group-text rounded-0">Extension del reporte*</span>
                                </div>
                                <select name="extension" id="" required>
                                    <option selected value="">Selecciona un tipo de archivo</option>
                                    <option value="pdf">PDF</option>
                                    <option value="xlsx">EXCEL</option>
                                </select>
                            </div>
                        </div>    
                    </div>

                </div>

                <div class="row">
                    <div class="item col col-lg col-md-6 col-sm-6">
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-preprend ">
                                    <span class="input-group-text rounded-0">Contenido del reporte*</span>
                                </div>
                                <select name="modelo" id="select-modelo" required>
                                    <option selected value="">Selecciona el contenido del reporte</option>
                                    @foreach ($modelos as $model)
                                        <option value="{{ $model }}">{{ $model }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>

                    <div class="item col col-lg col-md-6 col-sm-6">
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-preprend ">
                                    <span class="input-group-text rounded-0">Tipo de reporte*</span>
                                </div>
                                <select name="tipo" id="select-tipo">
                                    <option selected value="">por defecto</option>
                                    <option value="personalizada">personalizada</option>
                                </select>
                            </div>
                        </div>    
                    </div>
                </div>



                {{-- INICIO PERSONALIZACION --}}
                <div id="div-personalizar"  hidden>
                    <h3 class="">Filtros del reporte</h3>
                    <div class="">
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-preprend ">
                                    <span class="input-group-text rounded-0">Ordenar:</span>
                                </div>
                                <select name='order' class="">
                                    <option selected value="">Selecciona un orden</option>
                                    <option value="asc">Ascendente</option>
                                    <option value="desc">Descendente</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-preprend ">
                                    <span class="input-group-text rounded-0">Ordenar por:</span>
                                </div>
                                <select name='orderBy' id="select-atribute">
                                    <option selected value="">Selecciona un atributo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-preprend ">
                                    <span class="input-group-text rounded-0">Cantidad de registros:</span>
                                </div>
                                <select name='cantidad'>
                                    <option selected value="">Selecciona una cantidad</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="1000">1000</option>
                                    <option value="all">Todo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Fin de personalizacion --}}

                <div>
                    {{-- <button type="button"> Limpiar</button> --}}
                    <button type="submit" class="btn btn-primary btn-xs" target="_blank">Descargar</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    {{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#table').DataTable({
            autoWidth:false
        });
    </script> --}}
    <script>
        var service = '<?php echo env('SERVICE', '') ?>'
    </script>
    <script>

        console.log('ya esta en reporte index');
        console.log(service);
        $(function() {
            $('#select-modelo').on('change', onSelectProjectChange);
        });

        function onSelectProjectChange() {
            var model_id = $(this).val();
            let atributos = '<option value="">Selecciona un atributo</option>';
            if (!model_id) { //tiene un valor
                $('#select-atribute').html(atributos);
            } else {
                // cargar atributos
                let path = `${service}/api/tables-atributes/${model_id}`;
                $.get(path, function(data) {
                    for (let i = 0; i < data.length; i++) {
                        atributos += '<option value="' + data[i] + '">' + data[i] + '</option>'
                    }
                    $('#select-atribute').html(atributos);
                });
            }
        }
        
        $(function() {
            $('#select-tipo').on('change', selectTipo);
        });
        
        function selectTipo() {
            console.log('select-tipo-->combo');
            var tipo_id = $(this).val();
            if (tipo_id) {
                document.getElementById('div-personalizar').removeAttribute("hidden");
            } else {
                document.getElementById('div-personalizar').setAttribute("hidden", "");
            }
        }
    </script>
@endsection
