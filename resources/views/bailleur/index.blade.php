@extends('layouts.app')
@section('titre', "Bailleurs des projets")
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Bailleurs des projets
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
                <a href="#" class="btn btn-primary float-right ml-4" id="createbailleur-btn"> <i class="fa fa-plus-circle"></i> Nouveau bailleur</a>
            </h1>
        </div>
        <div class="card-body">
            @include('bailleur.table')
        </div>
    </div>
</div>
@include('bailleur.create')
@endsection

@include('partials.main-modal', ['id' => 'showDep'])
@include('partials.main-modal', ['id' => 'editBailleur'])

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

    // Affichage du formulaire d'enregistrement d'un bailleur
    $(document).on('click', '#createbailleur-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('bailleurs.create') !!}";
        $('#create-bailleur').modal('show');
    });

    // Validation du formulaire d'enregistrement de bailleur
    $(document).on('click', '#create-bailleur-btn', function(e) {
        $.ajax({
                method: $('#create-bailleur-form').attr('method'),
                url: $('#create-bailleur-form').attr('action'),
                data: $('#create-bailleur-form').serialize()
            })
            .done(function() {
                console.log('data');
                success("Bailleur enregistré avec succès!");
                actualiseTable('#create-bailleur')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-bailleur-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Affichage des détails d'un bailleur
    $(document).on('click', '#detailBailleur', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#showBailleur .modal-content').html(data);
                $('#showBailleur').modal('show');
            })
    });

    // affichage du formulaire de modification de bailleur
    $(document).on('click', '#modifierBailleur', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#editBailleur .modal-content').html(data);
                $('#editBailleur').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-bailleur-btn', function(e) {
        $.ajax({
                method: $('#edit-bailleur-form').attr('method'),
                url: $('#edit-bailleur-form').attr('action'),
                data: $('#edit-bailleur-form').serialize()
            })
            .done(function() {
                success("Bailleur modifié avec succès!");
                actualiseTable("#editBailleur")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-bailleur-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Suppression d'un bailleur
    $(document).on('click', '#supprimerBailleur', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous supprimer le bailleur ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Bailleur bien supprimé")
                actualiseTableDelete()
            })
        })
    })


    // actualisation du tableau des bailleurs
    function actualiseTable(idModal) {
        var url = "{!! route('bailleurs.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#bailleur-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('bailleurs.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#bailleur-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }


</script>
@endsection
