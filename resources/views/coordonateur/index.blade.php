@extends('layouts.app')
@section('titre', "Coordonateurs des projets")
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Coordonateurs des projets
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
                <a href="#" class="btn btn-primary float-right ml-4" id="createcoordonateur-btn"> <i class="fa fa-plus-circle"></i> Nouveau coordonateur</a>
            </h1>
        </div>
        <div class="card-body">
            @include('coordonateur.table')
        </div>
    </div>
</div>
@include('coordonateur.create')
@endsection

@include('partials.main-modal', ['id' => 'showDep'])
@include('partials.main-modal', ['id' => 'editCoordonateur'])

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

    $(document).on('click', '#createcoordonateur-btn', function(e) {
        e.preventDefault();
        $('#create-coordonateur').modal('show');
    });

    $(document).on('click', '#create-coordonateur-btn', function(e) {
        $.ajax({
                method: $('#create-coordonateur-form').attr('method'),
                url: $('#create-coordonateur-form').attr('action'),
                data: $('#create-coordonateur-form').serialize()
            })
            .done(function() {
                success("Coordonateur enregistré avec succès!");
                actualiseTable('#create-coordonateur')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-coordonateur-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    $(document).on('click', '#modifierCoordonateur', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#editCoordonateur .modal-content').html(data);
                $('#editCoordonateur').modal('show');
            })
    });

    $(document).on('click', '#edit-coordonateur-btn', function(e) {
        $.ajax({
                method: $('#edit-coordonateur-form').attr('method'),
                url: $('#edit-coordonateur-form').attr('action'),
                data: $('#edit-coordonateur-form').serialize()
            })
            .done(function() {
                success("Coordonateur modifié avec succès!");
                actualiseTable("#editCoordonateur")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-coordonateur-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    $(document).on('click', '#supprimerCoordonateur', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous supprimer le coordonateur ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Coordonateur bien supprimé")
                actualiseTableDelete()
            })
        })
    })

    function actualiseTable(idModal) {
        var url = "{!! route('coordonateurs.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#coordonateur-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('coordonateurs.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#coordonateur-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>
@endsection
