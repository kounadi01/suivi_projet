@extends('layouts.app')
@section('titre' , "Liste des produits" )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Liste des produits
    </a>
</li>
@endsection
@section('css')

@endsection
@section('main')
<div class="content">
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

            <div class="row float-left" style="width: 100px;border:2px double blue;color: white">
                <select class="form-control" name="annee" id="annee" onChange="getFiltre(this.value);">
                    <option value="">Sélectionnez l'année</option>
                    @foreach(\App\Models\AnneeExercice::all() as $annee )
                    <option style="" value="{{$annee ->id}}" @if ($annee->id == $ae)
                        selected
                        @endif
                        >

                        {{$annee->annee_exercice}}
                    </option>
                    @endforeach
                </select>
                <small class="text-danger" id="anneeSpan"> </small>
            </div>
            <div class="row float-left" style="width: 200px;border:2px double blue;color: white;margin-left: 10px;">
                <select class="form-control" name="type" id="type" onChange="getFiltre(this.value);">
                    <option value="tout" @if ($type=="tout" ) selected @endif>Tout</option>
                    <option value="service" @if ($type=="service" ) selected @endif>Service</option>
                    <option value="bien" @if ($type=="bien" ) selected @endif>Bien</option>
                </select>
                <small class="text-danger" id="typeSpan"> </small>
            </div>

            <h1 class="row float-right">
                <a href="#" data-url="{!! route('listeProduits.create') !!}" class="btn btn-primary float-right ml-1" id="copierList" data-tooltip="Copier la liste"> <i class="fa fa-paste"></i> Reconduire</a>
                <a href="{{route('produits.index')}}" class="btn btn-primary float-right ml-1"> <i class="fa fa-plus-circle"></i> Nouveau produit</a>
            </h1>
        </div>
        <div class="card-body">
            @include('liste-produit.table')
        </div>
    </div>
</div>

@endsection


@include('partials.main-modal', ['id' => 'show-liste'])
@include('partials.main-modal', ['id' => 'editList'])
@include('partials.main-modal', ['id' => 'pasteList'])

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
    $(document).on('click', '#createliste-produit-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('listeProduits.create') !!}";
        $('#create-liste-produit').modal('show');
    });

    // Validation du formulaire d'enregistrement de annee-exercice
    $(document).on('click', '#create-liste-produit-btn', function(e) {
        $.ajax({
                method: $('#create-liste-produit-form').attr('method'),
                url: $('#create-liste-produit-form').attr('action'),
                data: $('#create-liste-produit-form').serialize()
            })
            .done(function() {
                success("Liste enregistrée avec succès!");
                actualiseTable('#create-liste-produit')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-liste-produit-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    // affichage du formulaire de modification de profil
    $(document).on('click', '#modifierList', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        //console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#editList .modal-content').html(data);
                $('#editList').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-liste-produit-btn', function(e) {
        $.ajax({
                method: $('#edit-liste-produit-form').attr('method'),
                url: $('#edit-liste-produit-form').attr('action'),
                data: $('#edit-liste-produit-form').serialize()
            })
            .done(function() {
                success("Liste modifiée avec succès!");
                actualiseTable("#editList")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#edit-liste-produit-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    //Suppression d'un profil
    $(document).on('click', '#supprimerList', function(e) {
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
        var annee_id = $('#annee').val();
        var url = "{!! route('listeProduits.getListe') !!}?ae=" + annee_id;
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#liste-produit-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('listeProduits.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#liste-produit-table-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }


    $(document).on('click', '#copierliste-produit-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('listeProduits.copier') !!}";
        $('#copier-liste-produit').modal('show');
    });


    $(document).on('click', '#copier-liste-produit-btn', function(e) {
        $.ajax({
                method: $('#copier-liste-produit-form').attr('method'),
                url: $('#copier-liste-produit-form').attr('action'),
                data: $('#copier-liste-produit-form').serialize()
            })
            .done(function() {
                success("Liste copiée avec succès!");
                actualiseTable('#copier-liste-produit')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#copier-liste-produit-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });

    // Affichage du formulaire d'enregistrement d'une annee-exercice
    $(document).on('click', '#copierList', function(e) {
        e.preventDefault();
        var annee_id = $('#annee').val();
        var url = $(this).attr('data-url') + "?ae=" + annee_id;
        console.log(url);
        $.get(url)
            .done(function(data) {
                //console.log(data);
                $('#pasteList .modal-content').html(data);
                $('#pasteList').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#paste-liste-produit-btn', function(e) {
        $.ajax({
                method: $('#paste-liste-produit-form').attr('method'),
                url: $('#paste-liste-produit-form').attr('action'),
                data: $('#paste-liste-produit-form').serialize()
            })
            .done(function() {
                success("Liste copier avec succès!");
                actualiseTable("#pasteLst")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#paste-liste-produit-form input[name=' + i + ']';
                            $(input + '+small').text(error[0]);
                            $(input).parent().addClass('has-error');
                            $(key).text(error[0]);
                        });
                    }
                }
            );
    });
</script>

<script type="text/javascript">
    function getFiltre() {
        var annee_id = $('#annee').val();
        var type = $('#type').val();
        document.location.href = "{{asset('/listeProduits')}}?ae=" + annee_id + "&ty=" + type;
    }
</script>
@endsection