@extends('layouts.app')
@section('titre', 'Liste des projets')
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>Projets</a>
</li>
@endsection

@section('main')
<div class="content">
    <div class="clearfix"></div>
    <div class="card card-primary">
        @if(session('statut'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('statut') }}
        </div>
        @endif
        <div class="card-header bg-light">
            <h1 class="row float-right">
                <a href="{{ route('projets.create') }}" class="btn btn-primary float-right ml-4"> 
                    <i class="fa fa-plus-circle"></i> Nouveau projet
                </a>
            </h1>
        </div>
        <div class="card-body">
            @include('projets.table')
        </div>
    </div>
</div>
@endsection

@include('partials.main-modal', ['id' => 'createProj'])
@include('partials.main-modal', ['id' => 'editProj'])

@section('scripts')
<script type="text/javascript">
    // Affichage du formulaire d'enregistrement d'un projet
    $(document).on('click', '#createproj-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('projets.create') !!}";
        $.get(url)
            .done(function(data) {
                $('#createProj .modal-content').html(data);
                $('#createProj').modal('show');
            })
    });

    // Affichage des détails du projet
    $(document).on('click', '#detailProj', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#showProj .modal-content').html(data);
                $('#showProj').modal('show');
            })
    });

    // Affichage du formulaire de modification du projet
    $(document).on('click', '#modifierProj', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#editProj .modal-content').html(data);
                $('#editProj').modal('show');
            })
    });

    // Suppression du projet
    $(document).on('click', '#supprimerProj', function(e) {
        var url = $(this).attr('data-url');
        question('Voulez-vous supprimer le projet ?', function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Projet supprimé avec succès");
                actualiseTableDelete();
            })
        })
    });

    // Actualisation du tableau des projets
    function actualiseTable(idModal) {
        var url = "{!! route('projets.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#projets-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('projets.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#projets-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection
