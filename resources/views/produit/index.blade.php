@extends('layouts.app')
@section('titre' , "Liste des biens et services" )
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
                <a href="#" class="btn btn-primary float-right ml-4" id="createproduit-btn"> <i class="fa fa-plus-circle"></i> Nouvelle produit</a>
            </h1>
        </div>
        <div class="card-body">
            @include('produit.table')
        </div>
    </div>
</div>
@include('produit.create')
@endsection


@include('partials.main-modal', ['id' => 'showProd'])
@include('partials.main-modal', ['id' => 'editProd'])

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
    $(document).on('click', '#createproduit-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('produits.create') !!}";
        $('#create-produit').modal('show');
    });

    // Validation du formulaire d'enregistrement de annee-exercice
    $(document).on('click', '#create-produit-btn', function(e) {
        $.ajax({
                method: $('#create-produit-form').attr('method'),
                url: $('#create-produit-form').attr('action'),
                data: $('#create-produit-form').serialize()
            })
            .done(function() {
                console.log('data');
                success("Produit enregistré avec succès!");
                actualiseTable('#create-produit')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-produit-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });


    // affichage du formulaire de modification de profil
    $(document).on('click', '#modifierProd', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#editProd .modal-content').html(data);
                $('#editProd').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-produit-btn', function(e) {
        $.ajax({
                method: $('#edit-produit-form').attr('method'),
                url: $('#edit-produit-form').attr('action'),
                data: $('#edit-produit-form').serialize()
            })
            .done(function() {
                success("Produit modifié avec succès!");
                actualiseTable("#editProd")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-produit-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Suppression d'un profil
    $(document).on('click', '#supprimerProd', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous supprimer le produit ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Produit bien supprimé")
                actualiseTableDelete()
            })
        })
    })


    // actualisation du tableau des annee-exercices
    function actualiseTable(idModal) {
        var url = "{!! route('produits.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#produits-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('produits.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#produits-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection