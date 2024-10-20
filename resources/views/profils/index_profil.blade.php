@extends('layouts.app')
@section('titre' , 'Liste des Profils' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Profil
    </a>
</li>
@endsection

@section('main')
    <div class="content">
        <div class="card card-primary">
            <div class="card-header bg-light">
                <h1 class="row float-right">
                    <a href="#" class="btn btn-primary float-right ml-4" id="createprofil-btn"> <i class="fa fa-plus-circle"></i> Nouveau profil</a>
                </h1>
            </div>
            <div class="card-body">
                @include('profils.table')
            </div>
        </div>
    </div>
@endsection

@include('partials.main-modal', ['id' => 'createProfil'])
@include('partials.main-modal', ['id' => 'showProfil'])
@include('partials.main-modal', ['id' => 'editProfil'])

@section('scripts')
    <script type ="text/javascript">

        $(function () {
            $('.select2').each(function () {
                $(this).select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        });


    // Affichage du formulaire d'enregistrement d'une region
        $(document).on('click', '#createprofil-btn', function (e) {
            e.preventDefault();
            var url = "{!! route('profils.create') !!}";
            $.get(url)
                    .done(function (data) {
                        $('#createProfil .modal-content').html(data);
                        $('#createProfil').modal('show');
                    })
        });  

        // Validation du formulaire d'enregistrement de Region
        $(document).on('click', '#create-profil-btn', function (e) {
            $.ajax(
            {
                method: $('#create-profil-form').attr('method'),
                url: $('#create-profil-form').attr('action'),
                data: $('#create-profil-form').serialize()
            })
            .done(function() {
                success("Profil enregistré avec succès!");
                actualiseTable('#createProfil')
            })
            .fail(
                (data)=>{
                        if(data.status == 422) {
                            $.each(data.responseJSON.errors, function (i, error) {
                                var key="#"+i+"Span";
                                var input = '#create-profil-form input[name=' + i + ']';
                                $(input + '+small').text(error[0]);
                                $(input).parent().addClass('has-error');
                                $(key).text(error[0]);
                            });
                        }
                    }
            );
        });   
        
        //Affichage des détails d'un profil
        $(document).on('click', '#detailProfil', function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.get(url)
                    .done(function (data) {
                        $('#showProfil .modal-content').html(data);
                        $('#showProfil').modal('show');
                    })
        });

        // affichage du formulaire de modification de profil
        $(document).on('click', '#modifierProfil', function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.get(url)
                    .done(function (data) {
                        $('#editProfil .modal-content').html(data);
                        $('#editProfil').modal('show');
                    })
        });

        // validation du formulaire de validation
        $(document).on('click', '#edit-profil-btn', function (e) {
            $.ajax(
            {
                method: $('#edit-profil-form').attr('method'),
                url: $('#edit-profil-form').attr('action'),
                data: $('#edit-profil-form').serialize()
            })
            .done(function() {
                success("Profil modifiée avec succès!");
                actualiseTable("#editProfil")
            })
            .fail(
                (data)=>{
                        if(data.status == 422) {
                            $.each(data.responseJSON.errors, function (i, error) {
                                var key="#"+i+"Span";
                                var input = '#edit-profil-form input[name=' + i + ']';
                                $(input + '+small').text(error[0]);
                                $(input).parent().addClass('has-error');
                                $(key).text(error[0]);
                            });
                        }
                    }
            );
        });

        //Suppression d'un profil
        $(document).on('click', '#supprimerProfil', function (e) {
            var url = $(this).attr('data-url');
            question("Voulez-vous supprimer le profil ?", function () {
                    $.ajax({
                        url: url,
                        method: 'GET'
                    }).done(function () {
                        success("Profil bien supprimée")
                        actualiseTableDelete()
                    })
                })
        })
        // actualisation du tableau des profils
        function actualiseTable(idModal){
            var url = "{!! route('profils.getListe') !!}";
                $.get(url)
                        .done(function (data) {
                            $(idModal).modal('toggle');
                            $('#profils-table').html(data);
                            clientSideDataTable.destroy();
                            makeClientSideDataTable();
                        })
        }

        function actualiseTableDelete(){
            var url = "{!! route('profils.getListe') !!}";
                $.get(url)
                        .done(function (data) {
                            $('#profils-table').html(data);
                            clientSideDataTable.destroy();
                             makeClientSideDataTable();
                        })
        }
    </script>
@endsection
