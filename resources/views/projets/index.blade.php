@extends('layouts.app')
@section('titre', 'Liste des projets')
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>Projets</a>
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
                    <option value="Démarré" @if ($type=="Démarré" ) selected @endif>Démarré</option>
                    <option value="En cours" @if ($type=="En cours" ) selected @endif>En cours</option>
                    <option value="Terminé" @if ($type=="Terminé" ) selected @endif>Terminé</option>
                </select>
                <small class="text-danger" id="typeSpan"> </small>
            </div>

            <h1 class="row float-right">
                <a href="{{ route('projets.create') }}" class="btn btn-primary float-right ml-4"> 
                    <i class="fa fa-plus-circle"></i> Nouveau projet
                </a>
            </h1>
        </div>
        <div class="card-body">
            @include('projets.table')
        </div>
    </div>
</div>
@endsection

@include('partials.main-modal', ['id' => 'createProj'])
@include('partials.main-modal', ['id' => 'editProj'])
@include('partials.main-modal', ['id' => 'accessProj'])

@section('scripts')
<script type="text/javascript">
    // Affichage du formulaire d'enregistrement d'un projet
    $(document).on('click', '#createproj-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('projets.create') !!}";
        $.get(url)
            .done(function(data) {
                $('#createProj .modal-content').html(data);
                $('#createProj').modal('show');
            })
    });

    // Affichage des détails du projet
    $(document).on('click', '#detailProj', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#showProj .modal-content').html(data);
                $('#showProj').modal('show');
            })
    });

    // Affichage du formulaire d'evaluationn du projet
    $(document).on('click', '#evaluerProj', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.get(url)
            .done(function(data) {
                $('#accessProj .modal-content').html(data);
                $('#accessProj').modal('show');
            })
    });

    // validation du formulaire de validation
    $(document).on('click', '#edit-projet-btn', function(e) {
        $.ajax({
                method: $('#access-projet-form').attr('method'),
                url: $('#access-projet-form').attr('action'),
                data: $('#access-projet-form').serialize()
            })
            .done(function() {
                success("projet evalué avec succès!");
                actualiseTable("#accessProj")
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#access-projet-form input[name=' + i + ']';
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

    // Suppression du projet
    $(document).on('click', '#supprimerProj', function(e) {
        var url = $(this).attr('data-url');
        question('Voulez-vous supprimer le projet ?', function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("Projet supprimé avec succès");
                actualiseTableDelete();
            })
        })
    });

    // Actualisation du tableau des projets
    function actualiseTable(idModal) {
        var url = "{!! route('projets.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $(idModal).modal('toggle');
                $('#projets-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('projets.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#projets-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }
</script>

<script type="text/javascript">
    function getFiltre() {
        var annee_id = $('#annee').val();
        var type = $('#type').val();
        document.location.href = "{{asset('/projets')}}?ae=" + annee_id + "&ty=" + type;
    }
</script>
@endsection
