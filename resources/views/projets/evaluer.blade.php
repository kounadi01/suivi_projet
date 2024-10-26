<div class="modal-header">
    <h5 class="modal-title">
        Evaluation du projet : <strong>{{$projet->libelle}}</strong>
    </h5>
    <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
</div>
<div class="modal-body">
    <div class="form-group col-sm-12">
        {!! Form::model($projet, ['route' => ['projets.evaluer', ['id'=>$projet->id]], 'method' => 'put','class'=>"main-form",'id'=>"access-projet-form"]) !!}

        {!! csrf_field() !!}
        <div class="card-body">
            @include('projets.field_evaluer')
        </div>

        <div class="card-footer " style="float: right;">
            <button type="button" id="edit-projet-btn" class="btn btn-success">Valider</button>
            <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>