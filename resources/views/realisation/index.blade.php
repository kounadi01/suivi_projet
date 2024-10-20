@extends('layouts.app')
@section('titre' , "Liste des réalisations" )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Liste des reponses
    </a>
</li>
@endsection
@section('css')
<style type="text/css">
    #gris {
        input: disabled;
    }

    div p:first-child {
        font-weight: bold;
        font-size: 1.2em;
    }

    p,
    p a {
        color: #aaa;
        text-decoration: none;
    }

    p a:hover,
    p a:focus {
        text-decoration: underline;
    }

    p+p {
        margin-top: 3em;
    }

    form p {
        margin: 25px 0;
        color: #34495E;
    }

    .detail {
        position: absolute;
        text-align: right;
        right: 5px;
        bottom: 5px;
        width: 50%;
    }

    a[href*="intent"] {
        display: inline-block;
        margin-top: 0.4em;
        padding-left: 25px;
        background: url(bird.png) 0 4px no-repeat;
    }

    a[href^="https://twitter.com"] {
        color: #1da1f2;
    }


    /*
		Demo CSS code
	*/

    [type="checkbox"]:not(:checked),
    [type="checkbox"]:checked {
        position: absolute;
        left: -9999px;
    }

    [type="checkbox"]:not(:checked)+label,
    [type="checkbox"]:checked+label {
        position: relative;
        padding-left: 75px;
        cursor: pointer;
    }

    [type="checkbox"]:not(:checked)+label:before,
    [type="checkbox"]:checked+label:before,
    [type="checkbox"]:not(:checked)+label:after,
    [type="checkbox"]:checked+label:after {
        content: '';
        position: absolute;
    }

    [type="checkbox"]:not(:checked)+label:before,
    [type="checkbox"]:checked+label:before {
        left: 0;
        top: -3px;
        width: 65px;
        height: 30px;
        background: #DDDDDD;
        border-radius: 15px;
        -webkit-transition: background-color .2s;
        -moz-transition: background-color .2s;
        -ms-transition: background-color .2s;
        transition: background-color .2s;
    }

    [type="checkbox"]:not(:checked)+label:after,
    [type="checkbox"]:checked+label:after {
        width: 20px;
        height: 20px;
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        -ms-transition: all .2s;
        transition: all .2s;
        border-radius: 50%;
        background: #7F8C9A;
        top: 2px;
        left: 5px;
    }

    /* on checked */
    [type="checkbox"]:checked+label:before {
        background: #34495E;
    }

    [type="checkbox"]:checked+label:after {
        background: #39D2B4;
        top: 2px;
        left: 40px;
    }

    [type="checkbox"]:checked+label .ui,
    [type="checkbox"]:not(:checked)+label .ui:before,
    [type="checkbox"]:checked+label .ui:after {
        position: absolute;
        left: 6px;
        width: 65px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
        line-height: 22px;
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        -ms-transition: all .2s;
        transition: all .2s;
    }

    [type="checkbox"]:not(:checked)+label .ui:before {
        content: "Non";
        left: 32px;
        color: red;
    }

    [type="checkbox"]:checked+label .ui:after {
        content: "Oui";
        color: #39D2B4;
    }

    [type="checkbox"]:focus+label:before {
        border: 1px dashed #777;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
        margin-top: -1px;
    }
</style>
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

            <div class="row float-left" style="width: 200px;border:2px double blue;color: white">
                <select class="form-control" name="annee" id="annee" onChange="getFiltreIndex(this.value);">
                    <option value="0">Toutes les années</option>
                    @foreach(\App\Models\AnneeExercice::all() as $annee )
                    <option style="" value="{{$annee ->id}}" @if(isset($ae)) @if ($annee->id == $ae)
                        selected
                        @endif
                        @endif
                        >
                        {{$annee->annee_exercice}}
                    </option>
                    @endforeach
                </select>
                <small class="text-danger" id="anneeSpan"> </small>
            </div>
            <div class="row float-left" style="width: 400px;border:2px double blue;color: white;margin-left: 10px;">
                <select class="form-control" name="structure_id" id="structure_id" onChange="getFiltreIndex(this.value);">
                    @if(\App\Models\User::authUserProfil()->nom=='Administrateur')
                    <option value="0">Toutes les structures</option>
                    @foreach(\App\Models\Structure::all() as $structure )
                    <option style="" value="{{$structure ->id}}" @if(isset($st)) @if ($structure->id == $st)
                        selected
                        @endif
                        @endif
                        >

                        {{$structure->nom_struct}}
                    </option>
                    @endforeach
                    @else
                    <option value="{{\App\Models\User::infoUserConnect()->structure_id}}">{{\App\Models\User::infoUserConnect()->nom_struct}}</option>
                    @endif
                </select>
                <small class="text-danger" id="structure_idSpan"> </small>
            </div>
            <!-- <div class="row float-left" style="width: 200px;border:2px double blue;color: white;margin-left: 10px;">
                
                <small class="text-danger" id="typeSpan"> </small>
            </div> -->
            @if(\App\Models\User::authUserProfil()->nom != 'Administrateur')
            @if (\App\Models\Reponse::getStatutRealisation(\App\Models\AnneeExercice::anneeActive()->id,Auth::user()->structure_id))
            <h1 class="row float-right">
                <a href="{{route('approvisions.create')}}" class="btn btn-primary float-right ml-4"> <i class="fa fa-plus-circle"></i> Nouvelle reponse</a>
            </h1>
            @endif
            @endif
        </div>
        <div class="card-body">
            @include('realisation.table')
        </div>
    </div>
</div>

@endsection


@include('partials.main-modal', ['id' => 'show-liste'])
@include('partials.main-modal', ['id' => 'editList'])

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
    $(document).on('click', '#createreponse-btn', function(e) {
        e.preventDefault();
        var url = "{!! route('reponses.create') !!}";
        $('#create-reponse').modal('show');
    });

    // Validation du formulaire d'enregistrement de annee-exercice
    $(document).on('click', '#create-reponse-btn', function(e) {
        $.ajax({
                method: $('#create-reponse-form').attr('method'),
                url: $('#create-reponse-form').attr('action'),
                data: $('#create-reponse-form').serialize()
            })
            .done(function() {
                success("Liste enregistrée avec succès!");
                actualiseTable('#create-reponse')
            })
            .fail(
                (data) => {
                    if (data.status == 422) {
                        $.each(data.responseJSON.errors, function(i, error) {
                            var key = "#" + i + "Span";
                            var input = '#create-reponse-form input[name=' + i + ']';
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
    $(document).on('click', '#edit-reponse-btn', function(e) {
        $.ajax({
                method: $('#edit-reponse-form').attr('method'),
                url: $('#edit-reponse-form').attr('action'),
                data: $('#edit-reponse-form').serialize()
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
                            var input = '#edit-reponse-form input[name=' + i + ']';
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
        question("Voulez-vous supprimer le reponse ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("reponse bien supprimé")
                actualiseTableDelete()
            })
        })
    })

    //Envoyer la liste
    $(document).on('click', '#envoyerList', function(e) {
        var url = $(this).attr('data-url');
        question("Voulez-vous envoyer la liste ?", function() {
            $.ajax({
                url: url,
                method: 'GET'
            }).done(function() {
                success("La liste bien envoyée")
                actualiseTableDelete()
            })
        })
    })

    // actualisation du tableau des annee-exercices
    function actualiseTable(idModal) {
        var url = "{!! route('reponses.getListe') !!}";
        $.get(url)
            .done(function(data) {
                console.log(data);
                $(idModal).modal('toggle');
                $('#reponse-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function actualiseTableDelete() {
        var url = "{!! route('reponses.getListe') !!}";
        $.get(url)
            .done(function(data) {
                $('#reponse-table').html(data);
                clientSideDataTable.destroy();
                makeClientSideDataTable();
            })
    }

    function getFiltreIndex() {
        var annee_id = $('#annee').val();
        var structure_id = $('#structure_id').val();
        document.location.href = "{{asset('/reponses')}}?ae=" + annee_id + "&st=" + structure_id;
    }

    function getFiltre() {
        var annee_id = $('#annee').val();
        var type = $('#type').val();
        document.location.href = "{{asset('/approvisions/create')}}?ae=" + annee_id + "&ty=" + type;
    }
</script>


@endsection