@extends('layouts.app')
@section('titre' , 'Réalisations' )
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Réalisations
        </a>
    </li>
@endsection

@section('main')
    <div class="content">
        <div class="card card-primary col-sm-10" style="margin-left: auto;margin-right: auto;">
            <div class="card-header bg-light " style="text-align: center">
                <h3>Les diagrammes</h3>
            </div>
            <div class="card-body row" >
                <div class="card card-primary col-md-6 row">
                    <div class="card-header bg-light" style="text-align: center">
                        <h1 class="text-lg font-weight-bold text-center " style="font-style: italic;">
                            Les prévisions par structure
                        </h1>
                    </div>
                    <div class="card-body">
                        <!-- L'élément "#mon-chart" où placer le chart -->
                        <div id="mon-chart" style="height: 500px; width: auto;" ></div>
                    </div>
                </div>

                <div class="card card-primary col-md-6 row">
                    <div class="card-header bg-light" style="text-align: center">
                        <h1 class="text-lg font-weight-bold text-center" style="font-style: italic;">
                            Les prévisions par indicateurs
                        </h1>
                    </div>
                    <div class="card-body">
                        <!-- L'élément "#mon-chart" où placer le chart -->
                        <div id="mon-chart1" style="height: 500px; width: auto;" ></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@include('partials.main-modal', ['id' => 'createProg'])
@include('partials.main-modal', ['id' => 'showProg'])
@include('partials.main-modal', ['id' => 'editProg'])

@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Le code du Chart
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Structures', 'Prévisions'],
                @foreach ($structures as $structure) // On parcourt les catégories
                [ "{{ $structure->nom_struct }}", {{ $structure->previsions->count() }} ], // Proportion des produits de la catégorie
                @endforeach
            ]);

            var options = {
                title: 'Proportion des produits par catégorie', // Le titre
                is3D : true // En 3D
            };

            // On crée le chart en indiquant l'élément où le placer "#mon-chart"
            var chart = new google.visualization.PieChart(document.getElementById('mon-chart'));

            // On désine le chart avec les données et les options
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Indicateurs', 'Sous Indicateurs', 'Prévisions' ],
                @foreach ($indicateurs as $structure) // On parcourt les catégories
                [ '{{ $structure->lib_ind }}', {{ $structure->sousIndicateurs->count() }}, {{ $structure->previsions->count() }} ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Performance Catégories - Produits - Ventes',
                    subtitle: 'Produits, Ventes pour chaque catégorie',
                },
                bars: 'vertical' // Direction "verticale" pour les bars
            };

            var chart = new google.charts.Bar(document.getElementById('mon-chart1'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endsection
