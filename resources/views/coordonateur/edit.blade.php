<div class="modal-header">
    <h5 class="modal-title">
        Modifier le coordonateur
    </h5>
    <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
</div>
<div class="modal-body">
    <div class="form-group col-sm-12">
        {!! Form::model($coordonateur, ['route' => ['coordonateurs.update', $coordonateur->id], 'method' => 'put', 'class' => "main-form", 'id' => "edit-coordonateur-form"]) !!}
        {!! csrf_field() !!}
        <div class="card-body">
            @include('coordonateur.fields')
        </div>
        <div class="card-footer" style="float: right;">
            <button type="button" id="edit-coordonateur-btn" class="btn btn-success">Valider</button>
            <button type="button" aria-label="Close" class="btn btn-primary" data-dismiss="modal">Annuler</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
