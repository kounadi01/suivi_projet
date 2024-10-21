@extends('layouts.app')
@section('titre' , 'Liste des sociétés' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Sociétés
    </a>
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
                <a href="{{route('societes.create')}}" class="btn btn-primary float-right ml-4"> <i class="fa fa-plus-circle"></i> Nouvelle société</a>

            </h1>
        </div>
        <div class="card-body">
            @include('societes.table')
        </div>
    </div>
</div>
@endsection

@include('partials.main-modal', ['id' => 'createProg'])
@include('partials.main-modal', ['id' => 'editSoc'])

@section('scripts')
<script type="text/javascript">
    // Affichage du formulaire d'enregistrement d'un programme
    $(document).on('click', '#createsoc-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('societes.create') !!}";
        $.get(url)
            .done(function(data) {
                $('#createSoc .modal-content').html(data);
                $('#createSoc').modal('show');
            })
    });


    //Affichage des détails de la structure
    $(document).on('click', '#detailSoc', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#showSoc .modal-content').html(data);
                $('#showSoc').modal('show');
            })
    });

    // affichage du formulaire de modification de la structure
    $(document).on('click', '#modifierSoc', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#editSoc .modal-content').html(data);
                $('#editSoc').modal('show');
            })
    });



    //Suppression de la structure
    $(document).on('click', '#supprimerSoc', function(e) {
        var url = $(this).attr('data-url');
        question('Voulez-vous supprimer la société ?', function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Société bien supprimée");
                actualiseTableDelete()
            })
        })
    });
    // actualisation du tableau des societes
    function actualiseTable(idModal) {
        var url = "{!! route('societes.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#societes-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('societes.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#societes-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection