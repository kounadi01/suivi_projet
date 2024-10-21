@extends('layouts.app')
@section('titre' , "Liste des entreprises" )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Entreprises
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
                <a href="#" class="btn btn-primary float-right ml-4" id="createfournisseur-btn"> <i class="fa fa-plus-circle"></i> Nouvelle entreprise</a>
            </h1>
        </div>
        <div class="card-body">
            @include('fournisseur.table')
        </div>
    </div>
</div>
@include('fournisseur.create')
@endsection


@include('partials.main-modal', ['id' => 'showFrs'])
@include('partials.main-modal', ['id' => 'editFrs'])

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
    $(document).on('click', '#createfournisseur-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('fournisseurs.create') !!}";
        $('#create-fournisseur').modal('show');
    });

    // Validation du formulaire d'enregistrement de annee-exercice
    $(document).on('click', '#create-fournisseur-btn', function(e) {
        $.ajax({
                method: $('#create-fournisseur-form').attr('method'),
                url: $('#create-fournisseur-form').attr('action'),
                data: $('#create-fournisseur-form').serialize()
            })
            .done(function() {
                console.log('data');
                success("fournisseur enregistré avec succès!");
                actualiseTable('#create-fournisseur')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-fournisseur-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });


    // affichage du formulaire de modification de profil
    $(document).on('click', '#modifierFrs', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#editFrs .modal-content').html(data);
                $('#editFrs').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-fournisseur-btn', function(e) {
        $.ajax({
                method: $('#edit-fournisseur-form').attr('method'),
                url: $('#edit-fournisseur-form').attr('action'),
                data: $('#edit-fournisseur-form').serialize()
            })
            .done(function() {
                success("fournisseur modifié avec succès!");
                actualiseTable("#editFrs")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-fournisseur-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Suppression d'un profil
    $(document).on('click', '#supprimerFrs', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous supprimer le fournisseur ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("fournisseur bien supprimé")
                actualiseTableDelete()
            })
        })
    })


    // actualisation du tableau des annee-exercices
    function actualiseTable(idModal) {
        var url = "{!! route('fournisseurs.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#fournisseurs-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('fournisseurs.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#fournisseurs-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection