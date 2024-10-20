@extends('layouts.app')
@section('titre' , "Liste des phases" )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Employers
    </a>
</li>
@endsection
@section('css')

@endsection
@section('main')
<div class="content">
    <div class="card card-primary">
        <div class="card-header bg-light">
            <h1 class="row float-right">
                <a href="#" class="btn btn-primary float-right ml-4" id="createphase-btn"> <i class="fa fa-plus-circle"></i> Nouvelle phase</a>
            </h1>
        </div>
        <div class="card-body">
            @include('phase.table')
        </div>
    </div>
</div>
@include('phase.create')
@endsection


@include('partials.main-modal', ['id' => 'showDep'])
@include('partials.main-modal', ['id' => 'editDep'])

@section('scripts')

<script type="text/javascript">
    $(function() {
        $('.select2').each(function() {
            $(this).select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });

    });

    // Affichage du formulaire d'enregistrement d'une annee-exercice
    $(document).on('click', '#createphase-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('phases.create') !!}";
        $('#create-phase').modal('show');
    });

    // Validation du formulaire d'enregistrement de annee-exercice
    $(document).on('click', '#create-phase-btn', function(e) {
        $.ajax({
                method: $('#create-phase-form').attr('method'),
                url: $('#create-phase-form').attr('action'),
                data: $('#create-phase-form').serialize()
            })
            .done(function() {
                console.log('data');
                success("phase enregistré avec succès!");
                actualiseTable('#create-phase')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-phase-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });


    //Affichage des détails d'un profil
    $(document).on('click', '#detailProfil', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                $('#showProfil .modal-content').html(data);
                $('#showProfil').modal('show');
            })
    });

    // affichage du formulaire de modification de profil
    $(document).on('click', '#modifierDep', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#editDep .modal-content').html(data);
                $('#editDep').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-phase-btn', function(e) {
        $.ajax({
                method: $('#edit-phase-form').attr('method'),
                url: $('#edit-phase-form').attr('action'),
                data: $('#edit-phase-form').serialize()
            })
            .done(function() {
                success("phase modifié avec succès!");
                actualiseTable("#editDep")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-phase-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Suppression d'un profil
    $(document).on('click', '#supprimerDep', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous supprimer le phase ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("phase bien supprimé")
                actualiseTableDelete()
            })
        })
    })


    // actualisation du tableau des annee-exercices
    function actualiseTable(idModal) {
        var url = "{!! route('phases.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#phases-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('phases.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#phases-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection