@extends('layouts.app')
@section('titre' , 'Liste approvisionnement' )
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Nouveau
    </a>
</li>
@endsection

@section('main')
<div class="content col-sm-10" style="margin-left: auto;margin-right: auto;">
    <div class="card card-primary">
        <div class="card-header bg-light">
            <div class="row float-left" style="width: 100px;border:2px double blue;color: white">
                <select class="form-control" name="annee" id="annee" onChange="getFiltre(this.value);">
                    <option value="{{\App\Models\AnneeExercice::anneeActive()->id}}">{{\App\Models\AnneeExercice::anneeActive()->annee_exercice}}</option>
                </select>
                <small class="text-danger" id="anneeSpan"> </small>
            </div>
            
            <h1 class="row float-right">
                <a href="{!! route('demandes.index') !!}" class="btn btn-primary float-right ml-4"> <i class="fa fa-plus-circle"></i> Retour</a>
            </h1>
           
        </div>
        <div class="card-body">
            <div class="form-group col-sm-12">
                <form method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="main-form" role="form" action="{!! route('demandes.store',['option'=>'create']) !!}">
                {!! csrf_field() !!}
                <div class="card-body">
                    @include('demande.fields')
                </div>

                <div class="card-footer " style="float: right;">
                    <button type="submit" class="btn btn-success">Valider</button>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@include('partials.main-modal', ['id' => 'createProg'])
@include('partials.main-modal', ['id' => 'showProg'])
@include('partials.main-modal', ['id' => 'editProg'])

@section('scripts')


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ID de l'élément à activer
        var activeId = 'non'; // Par exemple, activez l'élément "À propos"

        // Retirer la classe 'active' de tous les éléments nav-item
        // var navItems = document.querySelectorAll('.nav-item');
        // navItems.forEach(function(item) {
        //     item.classList.remove('active');
        // });

        // Ajouter la classe 'active' à l'élément souhaité
        var activeElement = document.getElementById(activeId);
        if (activeElement) {
            activeElement.classList.remove('active');
        }
    });
</script>
@endsection