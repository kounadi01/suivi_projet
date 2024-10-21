<div class="row">
  <div class="form-group required col-md-12">
    <label class="control-label" for="lib_ind">Libelle de la composante</label>
    {!! Form::text('libelle',null,['required','class'=>'form-control','id'=>'libelle']) !!}
    <small class="text-danger" id="libelleSpan"> </small>
  </div>
  <div class="form-group required col-md-12">
    <label class="control-label" for="desc_ind">Description</label>
    {!! Form::text('description',null,['required','class'=>'form-control','id'=>'description']) !!}
    <small class="text-danger" id="descriptionSpan"> </small>
  </div>
</div>