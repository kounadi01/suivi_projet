@extends('layouts.app')
@section('titre' , 'Employeurs' )
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Graphique
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
                <div class="card card-primary col-md-12 row">
                    <div class="card-header bg-light" style="text-align: center">
                        <h1 class="text-lg font-weight-bold text-center " style="font-style: italic;">
                            La masse salariale par département
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
                            La masse salariale par département
                        </h1>
                    </div>
                    <div class="card-body">
                        <!-- L'élément "#mon-chart" où placer le chart -->
                        <div id="mon-chart1" style="height: 500px; width: auto;" ></div>
                    </div>
                </div>

                {{--Graphe de la masse salariale--}}
                <div class="card card-primary col-md-6 row">
                    <div class="card-header bg-light" style="text-align: center">
                        <h1 class="text-lg font-weight-bold text-center " style="font-style: italic;">
                            L'effectif par département
                        </h1>
                    </div>
                    <div class="card-body">
                        <!-- L'élément "#mon-chart" où placer le chart -->
                        <div id="mon-chart2" style="height: 500px; width: auto;" ></div>
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

    <script type ="text/javascript">

        $(document).on('click', '#recherchesalaire-btn', function (e) {
            e.preventDefault();
            var url = "{!! route('statiques.effsal') !!}";
            var annee = document.getElementById('annee').value;
            var mois = document.getElementById('mois').value;
            // var dep = document.getElementById('id_dep').value;
            // var tit = document.getElementById('id_titre').value;
            $.get(url+'?annee='+annee+'&mois='+mois)
                .done(function (data) {
                    document.location.href = url+'?annee='+annee+'&mois='+mois;
                })
        });

    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Age', 'Total','Age'],
                @foreach (\App\Models\Employer::pyramideAge($annee,$mois) as $item) // On parcourt les catégories
                [ '{{ $item->age }}', {{ $item->nbr }}, {{ $item->age }} ],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Pyramide des ages',
                    subtitle: 'Evolution des ages',
                },
                bars: 'vertical' // Direction "verticale" pour les bars
            };

            var chart = new google.charts.Bar(document.getElementById('mon-chart1'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <script type="text/javascript">
        //google.charts.load('current', {'packages':['bar']});
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Age', 'Total','Première bissectrice'],
                @foreach (\App\Models\Employer::pyramideAge($annee,$mois) as $ind=>$item) // On parcourt les catégories
                [ '{{ $item->age }}', {{ $item->nbr }}, {{ $ind }} ],
                @endforeach
            ]);

            var options = {
                // chart: {
                //     title: 'Performance Catégories - Produits - Ventes',
                //     subtitle: 'Produits, Ventes pour chaque catégorie',
                // },
                // bars: 'vertical' // Direction "verticale" pour les bars
                title: 'Pyramide des ages',
                subtitle: 'Evolution des ages',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            // var chart = new google.charts.Bar(document.getElementById('mon-chart3'));
            //
            // chart.draw(data, google.charts.Bar.convertOptions(options));
            var chart = new google.visualization.LineChart(document.getElementById('mon-chart2'));

            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        // Le code du Chart
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Département', 'Salaire'],
                @foreach (\App\Models\Employer::pyramideAge($annee,$mois) as $item) // On parcourt les catégories
                [ "{{ $item->age }}", {{ $item->nbr }} ], // Proportion des produits de la catégorie
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
@endsection
