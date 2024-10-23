@extends('layouts.app')
@section('titre', 'Modifier un projet')
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>Projets</a>
</li>
@endsection

@section('css')
    <style>
        .error { color: red; background-color: #acf; }
    </style>
@endsection

@section('main')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="clearfix"></div>
            <div class="card card-light">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header text-center">Modifier un projet</div>
                {!! Form::model($projet, ['route' => ['projets.update', $projet->id], 'method' => 'put', 'class' => "main-form", 'id' => "regForm"]) !!}
                {!! csrf_field() !!}
                <div class="card-body">
                    @include('projets.fields_edit')
                </div>
                <div class="card-footer row justify-content-center" style="float: right;">
                    {!! Form::submit('Envoyer', ['class' => 'btn-lg btn-success mr-2']) !!}
                    <button type="reset" aria-label="Close" class="btn-lg btn-primary ml-2" data-dismiss="modal">Annuler</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<a href="javascript:history.back()" class="btn btn-primary ml-0 mb-5">
    <span class="glyphicon glyphicon-circle-arrow-left"></span><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i>&nbsp; Retour
</a>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#regForm").validate({
            errorClass: 'errors',
            rules: {
                libelle: { required: true },
                description: { required: true },
                quantite_total: { required: true },
                montant_total: { required: true },
                etat_execution: { required: true },
                localisation: { required: true },
                coordonnateur: { required: true },
                'composantes[]': { required: true }
            },
            messages: {
                libelle: { required: "Veuillez fournir un libellé" },
                description: { required: "Veuillez fournir une description" },
                quantite_total: { required: "Veuillez fournir une quantité totale" },
                montant_total: { required: "Veuillez fournir un montant total" },
                etat_execution: { required: "Veuillez fournir un état d'exécution" },
                localisation: { required: "Veuillez fournir une localisation" },
                coordonnateur: { required: "Veuillez sélectionner un coordonnateur" },
                'composantes[]': { required: "Veuillez sélectionner au moins une composante" }
            }
        });
    });
</script>
@endsection
