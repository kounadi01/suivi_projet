@extends('layouts.app')
@section('titre' , 'Liste des réalisations' )
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
                    <option value="{{$annee->id}}">{{$annee->annee_exercice}}</option>

                </select>
                <small class="text-danger" id="anneeSpan"> </small>
            </div>

            <div class="row float-left" style="width: 400px;border:2px double blue;color: white;margin-left: 10px;">
                <select class="form-control" name="structure_id" id="structure_id" onChange="getFiltre(this.value);">
                    @if(\App\Models\User::authUserProfil()->nom=='Administrateur')
                    <option value="0">Selectionner une structure</option>
                    @foreach(\App\Models\Structure::where('type_struct','!=','Etat')->get() as $structure )
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
            {{--@if(!\App\Models\User::authUserProfil()->nom=='Responsable' || !\App\Models\User::authUserProfil()->nom=='Administrateur' )--}}
            <h1 class="row float-right">
                <a href="{!! route('reponses.index') !!}" class="btn btn-primary float-right ml-4"> <i class="fa fa-plus-circle"></i> Retour</a>
            </h1>
            {{--@endif--}}
        </div>
        <div class="card-body">
            <div class="form-group col-sm-12">
                <!-- <form method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="main-form" role="form" action="{!! route('reponses.envoyer',['option'=>'create']) !!}"> -->
                {!! csrf_field() !!}
                <div class="card-body">
                    @include('rapports.realisation.table_show')
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
        var reponse_id = <?php echo json_encode($reponse_id) ?>;
        var structure_id = $('#structure_id').val();
        document.location.href = "{{asset('/statistiques-realisation/')}}" + "?ae=" + annee_id + "&st=" + structure_id + "&ty=" + type + "&ca=" + categorie;
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