{{-- @extends('adminlte::page') --}}

@extends('layouts.nueva')

@section('title', 'estadisticas')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="card"  style="width: 70%;
        margin: 0% auto">
        <div class="card-header">
            {{-- <a class="btn btn-primary" href="{{route('personas.create')}}">Nueva Persona</a> --}}
            <h3>Estadisticas</h3>
        </div>

        <div class="card-body">
            <!--  Inicio table de reportes -->
            <div class="row" >
                <div class="item col col-lg-2 col-md-2 col-sm-2"></div>
                <div class="item col col-lg-8 col-md-8 col-sm-8" >
                    <div class="form-group">
                        <div class="input-group ">
                            <div class="input-group-preprend ">
                                <span class="input-group-text rounded-0">seleccione año*</span>
                            </div>
                            <select name="" id="select-fecha">
                                <option value=""> seleccione año </option>
                                <option value="2020"> 2020 </option>
                                <option value="2021"> 2021 </option>
                                <option value="2022"> 2022 </option>
                                <option value="2023"> 2023 </option>
                                <option value="2024"> 2024 </option>
                                <option value="2025"> 2025 </option>
                                <option value="2026"> 2026 </option>
                                <option value="2027"> 2027 </option>
                                <option value="2028"> 2028 </option>
                                <option value="2029"> 2029 </option>
                                <option value="2030"> 2030 </option>
                            </select>
                        </div>
                    </div>
                </div>                              
            </div>

            <div class="row">
                <div class="item col col-lg-1 col-md-1 col-sm-1"></div>
                <div class="item col col-lg-8 col-md-8 col-sm-8">
                    <div class="form-group">
                        <div class="input-group ">
                            <div class="input-group-preprend ">
                                <span class="input-group-text rounded-0">Tipo de reporte*</span>
                            </div>
                            <select name="" id="select-report">
                                <option value="">selecciones tipo de reporte</option>
                                @foreach ($reportes as $report)
                                    <option value="{{ $report['id'] }}">{{ $report['descripcion'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>    
                </div>  
            </div>
            <hr>
            
            <div class="row">
                <img id="img-est" class="wrap" style="margin: 0% auto;   width: 800%" 
                    {{-- src="https://chart.apis.google.com/chart?chs=700x300&cht=p&chd=t:45,25,10,20&chl=Valencia|Madrid|Barcelona|Lugo%22%20width=%22400%22%20height=%22100%22" --}}
                    {{-- src="https://media.istockphoto.com/id/1322104312/es/foto/libertad-cadenas-que-se-transforman-en-aves-concepto-de-carga.jpg?s=612x612&w=0&k=20&c=jwGtdxbTQRwdZrpfr0-cPcaV0gP8xk9muMyPKqmxKYU=" --}}
                    src="https://www.ida.cl/wp-content/uploads/sites/5/2016/12/Reportes-de-metricas-para-guiar-las-decisiones-de-un-proyecto-digital.jpg"
                    alt="">
            </div>
        </div>
@stop

    @section('js')
        <script>
            var service = '<?php echo env('SERVICE', ''); ?>'
        </script>
        <script>
            let selectReport = '#select-report';
            console.log('ya esta(reportes)');
            var selectFecha = document.getElementById("select-fecha");

            $(function() {
                $(selectReport).on('change', onSelectReport);
            });

            function onSelectReport() {
                var tipo_reporte = $(this).val();
                console.log(tipo_reporte);
                var year = selectFecha.value;
                console.log(year);

                if (!tipo_reporte) {
                    alert('SELECCIONE UN TIPO DE REPORTE');
                    return;
                }
                if (!year) {
                    alert('SELECCIONE UN AÑO');
                    return;
                }

                let path = `${service}/api/reportes/${tipo_reporte}/${year}`;
                $.get(path, function(data) {
                    console.log(data.data);
                    if (!("data" in data)) {
                        alert('OCURRIO UN PROBLEMA EN EL SERVIDOR');
                    } else {
                        if (data.data.length === 0) {
                            alert('NO SE ENCONTRARON DATOS');
                            document.getElementById('img-est').setAttribute("src", "#");
                        } else {
                            document.getElementById('img-est').setAttribute("src", data.data);
                        }
                    }
                });

            }
        </script>
    @endsection
