<div class="row">
    <div class="form-group required col-md-12">
        <label class="control-label" for="date_reouverture">Dernier délai</label>
        {!! Form::date('date_reouverture',null,['class'=>'form-control','placeholder'=>'veuillez choisir une date','id'=>'date_reouverture','min'=>$reponse->date_fin]) !!}
        <small class="text-danger" id="date_reouverture_previsionSpan"> </small>
    </div>
    <div class="form-group required col-md-12" hidden>
        <label class="control-label" for="ouvert">Dernier délai</label>
        <input type="radio" name="ouvert" checked="checked" />
        <small class="text-danger" id="ouvertSpan"> </small>
    </div>
</div>