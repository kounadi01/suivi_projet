@extends('layouts.app')
@section('titre' , "Composantes des projets" )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Composantes des projets
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
                <a href="#" class="btn btn-primary float-right ml-4" id="createcomposante-btn"> <i class="fa fa-plus-circle"></i> Nouvelle composante</a>
            </h1>
        </div>
        <div class="card-body">
            @include('composante.table')
        </div>
    </div>
</div>
@include('composante.create')
@endsection


@include('partials.main-modal', ['id' => 'showDep'])
@include('partials.main-modal', ['id' => 'editComposante'])

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
    $(document).on('click', '#createcomposante-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('composantes.create') !!}";
        $('#create-composante').modal('show');
    });

    // Validation du formulaire d'enregistrement de annee-exercice
    $(document).on('click', '#create-composante-btn', function(e) {
        $.ajax({
                method: $('#create-composante-form').attr('method'),
                url: $('#create-composante-form').attr('action'),
                data: $('#create-composante-form').serialize()
            })
            .done(function() {
                console.log('data');
                success("Composante enregistrée avec succès!");
                actualiseTable('#create-composante')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-composante-form input[name=' + i + ']';
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
    $(document).on('click', '#modifierComposante', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#editComposante .modal-content').html(data);
                $('#editComposante').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-composante-btn', function(e) {
        $.ajax({
                method: $('#edit-composante-form').attr('method'),
                url: $('#edit-composante-form').attr('action'),
                data: $('#edit-composante-form').serialize()
            })
            .done(function() {
                success("phase modifié avec succès!");
                actualiseTable("#editComposante")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-composante-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Suppression d'un profil
    $(document).on('click', '#supprimerComposante', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous supprimer la composante ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Composante bien supprimée")
                actualiseTableDelete()
            })
        })
    })


    // actualisation du tableau des annee-exercices
    function actualiseTable(idModal) {
        var url = "{!! route('composantes.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#composante-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('composantes.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#composante-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection