@extends('layouts.app')
@section('titre' , 'Liste des réalisations des produits' )
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Les réalisations
    </a>
</li>
@endsection

@section('main')
<div class="content col-sm-10" style="margin-left: auto;margin-right: auto;">
    <div class="card card-primary">
        <div class="card-header bg-light">
            <div class="row float-left" style="width: 100px;border:2px double blue;color: white">
                <select class="form-control" name="annee" id="annee" onChange="getFiltre(this.value);">
                    <option value="{{$annee->id}}">{{$annee->annee_exercice}}</option>

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
            <div class="row float-left" style="width: 200px;border:2px double blue;color: white;margin-left: 10px;">
                <select class="form-control" name="categorie" id="categorie" onChange="getFiltre(this.value);">
                    <option value="tout" @if ($categorie=="tout" ) selected @endif>Tout</option>
                    <option value="oui" @if ($categorie=="oui" ) selected @endif>Dans l'arreté</option>
                    <option value="non" @if ($categorie=="non" ) selected @endif>Hors arreté</option>
                </select>
                <small class="text-danger" id="typeSpan"> </small>
            </div>
            
        </div>
        <div class="card-body">
            <div class="form-group col-sm-12">
                <!-- <form method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="main-form" role="form" action="{!! route('reponses.envoyer',['option'=>'create']) !!}"> -->
                {!! csrf_field() !!}
                <div class="card-body">
                    @include('rapports.realisation.table_visio')
                </div>

                <div class="card-footer " style="float: right;">
                    <!-- <button type="submit" class="btn btn-success">Valider</button> -->
                </div>
                <!-- </form> -->
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
    function getFiltre() {
        var annee_id = $('#annee').val();
        var type = $('#type').val();
        var categorie = $('#categorie').val();
        document.location.href = "{{asset('/statistiques-realisation-visio/')}}" + "?ae=" + annee_id + "&ty=" + type + "&ca=" + categorie;
    }
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    })
</script>
@endsection