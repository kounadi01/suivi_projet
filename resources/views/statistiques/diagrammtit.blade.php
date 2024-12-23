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
                <div class="row float-left" style="width: 100px;border:2px double blue;margin-left: 0%">
                    {!! Form::selectRange('annee', 2000, 2150,$annee,['class'=>'form-control','placeholder'=>'Année','id'=>'annee']) !!}
                    <small class="text-danger" id="anneeSpan" > </small>
                </div>
                <div class="row float-left" style="width: 120px;border:2px double blue;margin-left: 0%">
                    {!! Form::select('mois',
                        array('01' => 'Janvier','02' => 'Février','03' => 'Mars','04' => 'Avril',
                        '05' => 'Mai','06' => 'Juin','07' => 'Juillet','08' => 'Aout',
                        '09' => 'Septembre','10' => 'Octobre','11' => 'Octobre','12' => 'Décembre'),
                        $mois,['required','class'=>'form-control','placeholder'=>'Mois','id'=>'mois']) !!}
                    <small class="text-danger" id="code_progSpan" > </small>
                </div>
                <div class="row float-left" style="width: auto;border:2px double blue;margin-left: 0%">
                    {!! Form::select('departement_id',$departements,$dep_id,['required','class'=>'form-control select1','id'=>'dep_id','placeholder'=>'Tous les départements']) !!}
                    <small class="text-danger" id="dep_idSpan" > </small>
                </div>
                <div class="row float-left" style="width: auto;margin-left: 0%">
                    <a href="#"
                       {{--data-url="{!! route('statiques.effsal') !!}"--}}
                       id="recherchesalaire-btn" class="btn btn-primary float-right ml-3">
                        <i class="fa fa-search"></i>Rechercher
                    </a>
                </div>
                <div class="row float-right" style="width: auto;text-decoration: underline;
                    font-style: italic;font-weight: bold;font-size: 18px;border:2px double blue;"
                >
                    Effectif total =  {{\App\Models\Departement::effectifTotal($annee,$mois)->effectif}}<br>
                    Masse salariale totale =  {{\App\Models\Departement::effectifTotal($annee,$mois)->salaire}}
                </div>
            </div>
            <div class="card-body row" >
                <div class="card card-primary col-md-6 row">
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

                <div class="card card-primary col-md-6 row">
                    <div class="card-header bg-light" style="text-align: center">
                        <h1 class="text-lg font-weight-bold text-center" style="font-style: italic;">
                            L'effectif par département
                        </h1>
                    </div>
                    <div class="card-body">
                        <!-- L'élément "#mon-chart" où placer le chart -->
                        <div id="mon-chart3" style="height: 500px; width: auto;" ></div>
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
                ['Département', 'Salaire'],
                @foreach (\App\Models\Departement::effectifTit($annee,$mois,$dep_id) as $item) // On parcourt les catégories
                [ "{{ $item->nom }}", {{ $item->salaire }} ], // Proportion des produits de la catégorie
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
                ['Département', 'Effectif','Salaire'],
                @foreach (\App\Models\Departement::effectifTit($annee,$mois,$dep_id) as $item) // On parcourt les catégories
                [ '{{ $item->nom }}', {{ $item->salaire }}, {{ $item->effectif }} ],
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

    <script type="text/javascript">
        // Le code du Chart
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Département', 'Effectif'],
                @foreach (\App\Models\Departement::effectifTit($annee,$mois,$dep_id) as $item) // On parcourt les catégories
                [ "{{ $item->nom }}", {{ $item->effectif }} ], // Proportion des produits de la catégorie
                @endforeach
            ]);

            var options = {
                title: 'Proportion des produits par catégorie', // Le titre
                is3D : true // En 3D
            };

            // On crée le chart en indiquant l'élément où le placer "#mon-chart"
            var chart = new google.visualization.PieChart(document.getElementById('mon-chart2'));

            // On désine le chart avec les données et les options
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        //google.charts.load('current', {'packages':['bar']});
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Département', 'Effectif','Salaire'],
                @foreach (\App\Models\Departement::effectifTit($annee,$mois,$dep_id) as $item) // On parcourt les catégories
                [ '{{ $item->nom }}', {{ $item->effectif }}, {{ $item->salaire }} ],
                @endforeach
            ]);

            var options = {
                // chart: {
                //     title: 'Performance Catégories - Produits - Ventes',
                //     subtitle: 'Produits, Ventes pour chaque catégorie',
                // },
                // bars: 'vertical' // Direction "verticale" pour les bars
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            // var chart = new google.charts.Bar(document.getElementById('mon-chart3'));
            //
            // chart.draw(data, google.charts.Bar.convertOptions(options));
            var chart = new google.visualization.LineChart(document.getElementById('mon-chart3'));

            chart.draw(data, options);
        }
    </script>

    <script type ="text/javascript">

        $(document).on('click', '#recherchesalaire-btn', function (e) {
            e.preventDefault();
            var url = "{!! route('statiques.effsaltit') !!}";
            var annee = document.getElementById('annee').value;
            var mois = document.getElementById('mois').value;
            var dep_id = document.getElementById('dep_id').value;
            // var dep = document.getElementById('id_dep').value;
            // var tit = document.getElementById('id_titre').value;
            $.get(url+'?annee='+annee+'&mois='+mois+'&dep_id='+dep_id)
                .done(function (data) {
                    document.location.href = url+'?annee='+annee+'&mois='+mois+'&dep_id='+dep_id;
                })
        });

    </script>
@endsection
