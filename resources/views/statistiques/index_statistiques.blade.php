@extends('layouts.app')
@section('titre' , 'Liste des communes' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Communes
    </a>
</li>
@endsection

@section('main')
    <div class="content">
        <div class="card card-primary">
            <div class="card-header bg-light">
                <h1 class="row float-right">
                    <a href="#" class="btn btn-primary float-right ml-4" id="createcommune-btn"> <i class="fa fa-plus-circle"></i> Nouvelle commune</a>
                </h1>
            </div>
            <div class="card-body">
                <div class="card">
                    <div id="ca_graph" >
                    </div>
                    <div id="ca_hist" >
                    </div>
                    <div id="ca_hist2" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    @piechart('Graphique', 'ca_graph')
    @columnchart('Finances', 'ca_hist')
    @columnchart('Previsions', 'ca_hist2')
@endsection
