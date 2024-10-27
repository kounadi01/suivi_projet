@extends('layouts.app')
@section('titre', 'Modifier un projet')
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>Projets</a>
</li>
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
                quantite_total: { required: true, number: true },
                montant_total: { required: true, digits: true },
                etat_execution: { required: true },
                localisation: { required: true },
                date_demarrage: { required: true },
                date_fin_probable: { required: true, greaterThan: "#date_demarrage" },
                categorie: { required: true },
                taux_physique: { required: true, number: true },
                taux_financier: { required: true, number: true },
                statut: { required: true },
                unite: { required: true },
                bailleur: { required: true },
                nature: { required: true },
                entreprise: { required: true },
                societe: { required: true },
                coordonnateur: { required: true },
                'composantes[]': { required: true }
            },
            messages: {
                libelle: { required: "Veuillez fournir un libellé" },
                description: { required: "Veuillez fournir une description" },
                quantite_total: { required: "Veuillez fournir une quantité totale", number: "Veuillez entrer un nombre valide" },
                montant_total: { required: "Veuillez fournir un montant total", digits: "Veuillez entrer un nombre entier" },
                etat_execution: { required: "Veuillez fournir un état d'exécution" },
                localisation: { required: "Veuillez fournir une localisation" },
                coordonnateur: { required: "Veuillez sélectionner un coordonnateur" },
                'composantes[]': { required: "Veuillez sélectionner au moins une composante" },
                date_demarrage: { required: "Veuillez fournir une date de démarrage" },
                date_fin_probable: { required: "Veuillez fournir une date de fin probable", greaterThan: "La date de fin probable doit être supérieure ou égale à la date de démarrage." },
                categorie: { required: "Veuillez fournir une catégorie" },
                taux_physique: { required: "Veuillez fournir le taux physique", number: "Veuillez entrer un nombre valide" },
                taux_financier: { required: "Veuillez fournir le taux financier", number: "Veuillez entrer un nombre valide" },
                statut: { required: "Veuillez fournir un statut" },
                unite: { required: "Veuillez fournir une unité" },
                bailleur: { required: "Veuillez sélectionner un bailleur" },
                nature: { required: "Veuillez sélectionner une nature de projet" },
                entreprise: { required: "Veuillez sélectionner une entreprise" },
                societe: { required: "Veuillez sélectionner une société" },
                coordonnateur: { required: "Veuillez sélectionner un coordonnateur" },
                'composantes[]': { required: "Veuillez sélectionner au moins une composante" }
            },
            errorPlacement: function(error, element) {
                error.css("color", "red");
                error.insertAfter(element);
            }
        });
    });
</script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    })
</script>


@endsection
