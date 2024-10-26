@extends('layouts.app')
@section('titre' , 'Tableau de bord' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Tableau de bord
    </a>
</li>
@endsection

@section('main')
@if(session('statut'))
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ session('statut') }}
</div>

@endif
<div class="content">
    <div id="homeStatistique">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Statistique de l'année</label>
                {!! Form::select('annee_id',$anneeExercices,$annee_id,['required','class'=>'form-control select2','id'=>'annee_id']) !!}
            </div>
            
        </div>

        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>35 %</h3>
                        <p>Taux total</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>45</h3>
                        <p>Projets terminés</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>52</h3>
                        <p>Projets en cours</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Projets en retard</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            <!-- Donut chart -->
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                        Proportion des projets terminés
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                <canvas id="myDonutChartPrev" width="300" height="300"></canvas>
                </div>
                <!-- /.card-body-->
                </div>
            </div>

            <div class="col-md-4">
            <!-- Donut chart -->
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                        Proportion des projets en cours
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                <canvas id="myDonutChartReal" width="300" height="300"></canvas>
                </div>
                <!-- /.card-body-->
                </div>
            </div>

            <div class="col-md-4">
            <!-- Donut chart -->
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                        Proportion des projets en retard
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                <canvas id="myDonutChartRetard" width="300" height="300"></canvas>
                </div>
                <!-- /.card-body-->
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- BAR CHART -->
            
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script src="{{asset('plugins/chart.js/npm_chart.js')}}"></script>
<script src="{{asset('plugins/chart.js/chartjs-plugin-datalabels.js')}}"></script>
<script>
    // Données pour le graphique
    const donnees = <?php echo json_encode($data) ?>;
    const dataprevisions = <?php echo json_encode($dataprevision); ?>;
    const datarealisations = <?php echo json_encode($datarealisation); ?>;

    const data = {
        labels: donnees[0],
        datasets: [{
                label: 'Montant des biens',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: donnees[1],
            },
            {
                label: 'Montant des services',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                // backgroundColor: '#28a745',
                borderColor: 'rgba(210, 214, 222, 1)',
                // borderColor: '#28a745',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: donnees[2],
            },
        ]
    };

    // Configuration du graphique
    
    myDonutdataprev = dataprevisions[1]; // Les valeurs à représenter
    myDonutdatareal = datarealisations[1]; 

    myDonutConfigprev = {
        type: 'doughnut',
        data: {
            labels: dataprevisions[0],
            datasets: [{
                data: myDonutdataprev,
                backgroundColor: ['#28a745', '#36A2EB'], // Les couleurs pour chaque segment
                hoverBackgroundColor: ['#28a745', '#36A2EB']
            }]
        },
        options: {
            esponsive: true,
            maintainAspectRatio: false,
            plugins: {
                datalabels: {
                    color: '#fff', // Couleur du texte
                    // formatter: (value, ctx) => {
                    //     return value; // Affiche la valeur
                    // },
                    formatter: (value, ctx) => {
                        let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0); // Calcul de la somme totale
                        console.log(ctx.chart.data.datasets[0])
                        let percentage = (value / sum * 100).toFixed(2) + "%"; // Calcul du pourcentage
                        return percentage; // Affiche le pourcentage
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 10,
                    font: {
                        weight: 'bold',
                        size: '16'
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Activer le plugin
    };

    myDonutConfigreal = {
        type: 'doughnut',
        data: {
            labels: datarealisations[0],
            datasets: [{
                data: myDonutdatareal,
                backgroundColor: ['#28a745', '#36A2EB'], // Les couleurs pour chaque segment
                hoverBackgroundColor: ['#28a745', '#36A2EB']
            }]
        },
        options: {
            esponsive: true,
            maintainAspectRatio: false,
            plugins: {
                datalabels: {
                    color: '#fff', // Couleur du texte
                    // formatter: (value, ctx) => {
                    //     return value; // Affiche la valeur
                    // },
                    formatter: (value, ctx) => {
                        let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0); // Calcul de la somme totale
                        console.log(ctx.chart.data.datasets[0])
                        let percentage = (value / sum * 100).toFixed(2) + "%"; // Calcul du pourcentage
                        return percentage; // Affiche le pourcentage
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 10,
                    font: {
                        weight: 'bold',
                        size: '16'
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Activer le plugin
    };

    myDonutConfigretard = {
        type: 'doughnut',
        data: {
            labels: datarealisations[0],
            datasets: [{
                data: myDonutdatareal,
                backgroundColor: ['#28a745', '#36A2EB'], // Les couleurs pour chaque segment
                hoverBackgroundColor: ['#28a745', '#36A2EB']
            }]
        },
        options: {
            esponsive: true,
            maintainAspectRatio: false,
            plugins: {
                datalabels: {
                    color: '#fff', // Couleur du texte
                    // formatter: (value, ctx) => {
                    //     return value; // Affiche la valeur
                    // },
                    formatter: (value, ctx) => {
                        let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0); // Calcul de la somme totale
                        console.log(ctx.chart.data.datasets[0])
                        let percentage = (value / sum * 100).toFixed(2) + "%"; // Calcul du pourcentage
                        return percentage; // Affiche le pourcentage
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 10,
                    font: {
                        weight: 'bold',
                        size: '16'
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Activer le plugin
    };

    // Création du graphique
    window.onload = function() {
        // var ctx = document.getElementById('barchart').getContext('2d');
        // new Chart(ctx, config);

        // var ctxLine = document.getElementById('lineChart').getContext('2d');
        // new Chart(ctxLine, configLine);

        var ctxDonutPrev = document.getElementById('myDonutChartPrev').getContext('2d');
        new Chart(ctxDonutPrev, myDonutConfigprev);

        var ctxDonutReal = document.getElementById('myDonutChartReal').getContext('2d');
        new Chart(ctxDonutReal, myDonutConfigreal);

        var ctxDonutRetard = document.getElementById('myDonutChartRetard').getContext('2d');
        new Chart(ctxDonutRetard, myDonutConfigretard);
    };
</script>


</script>


<script>
    // changement d'une année exercice
    $(document).on('change', '#annee_id', function(e) {
        var annee_id = e.target.value;
        grapheUpdate(annee_id);
    })
    //reactualisation des données du tableau de bord
    function grapheUpdate(annee_Id) {
        //  $('#grapheAff').empty();
        $.get('{{ url('
                dashboard ') }}/' + annee_Id)
            .done(function(data) {
                $('#homeStatistique').replaceWith(data);
            })
    }
</script>
@endsection