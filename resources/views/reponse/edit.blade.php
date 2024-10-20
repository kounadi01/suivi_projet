<div class="modal-header">
    <h5 class="modal-title">
        Répportage de la date
    </h5>
    <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
</div>
<div class="modal-body">
    <div class="form-group col-sm-12">
        {!! Form::model($reponse, ['route' => ['reponses.update', [$reponse->id,'option'=>$option]], 'method' => 'put','class'=>"main-form",'id'=>"edit-reponse-form"]) !!}

        {!! csrf_field() !!}
        <div class="card-body">
            @include('reponse.fields_edit')
        </div>

        <div class="card-footer " style="float: right;">
            <button type="button" id="edit-reponse-btn" class="btn btn-success">Valider</button>
            <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>