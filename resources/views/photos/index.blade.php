@extends('layouts.app')
@section('titre' , 'Liste des photos' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Photos
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
                <a href="{{route('photos.create')}}" class="btn btn-primary float-right ml-4"> <i class="fa fa-plus-circle"></i> Nouvelle photo</a>

            </h1>
        </div>
        <div class="card-body">
            @include('photos.table')
        </div>
    </div>
</div>
@endsection

@include('partials.main-modal', ['id' => 'createProg'])
@include('partials.main-modal', ['id' => 'editStruct'])

@section('scripts')
<script type="text/javascript">
    // Affichage du formulaire d'enregistrement d'un programme
    $(document).on('click', '#createstruct-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('photos.create') !!}";
        $.get(url)
            .done(function(data) {
                $('#createStruct .modal-content').html(data);
                $('#createStruct').modal('show');
            })
    });


    //Affichage des détails de la photo
    $(document).on('click', '#detailStruct', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#showStruct .modal-content').html(data);
                $('#showStruct').modal('show');
            })
    });

    // affichage du formulaire de modification de la photo
    $(document).on('click', '#modifierStruct', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#editStruct .modal-content').html(data);
                $('#editStruct').modal('show');
            })
    });



    //Suppression de la photo
    $(document).on('click', '#supprimerStruct', function(e) {
        var url = $(this).attr('data-url');
        question('Voulez-vous supprimer le Photo ?', function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Photo bien supprimé");
                actualiseTableDelete()
            })
        })
    });
    // actualisation du tableau des photos
    function actualiseTable(idModal) {
        var url = "{!! route('photos.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#photos-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('photos.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#photos-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection