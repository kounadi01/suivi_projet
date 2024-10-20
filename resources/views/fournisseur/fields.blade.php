<div class="row">
  <div class="required form-group {!! $errors->has('categorie') ? 'has-error' : '' !!} col-md-6">
    <label class="control-label" for="categorie">Catégorie</label>
    {!! Form::select('categorie',['Locale'=>'Locale','Etrangère'=>'Etrangère'], null, ['class' => 'form-control', 'placeholder' => 'Selectionner','id'=>'categorie']) !!}
    {!! $errors->first('categorie', '<small class="help-block">:message</small>') !!}
  </div>

  <div class="required form-group {!! $errors->has('ifu') ? 'has-error' : '' !!} col-md-6">
    <label class="control-label" for="ifu">IFU</label>
    {!! Form::text('ifu', null, ['class' => 'form-control', 'placeholder' => 'IFU de fournisseur','id'=>'ifu']) !!}
    {!! $errors->first('ifu', '<small class="help-block">:message</small>') !!}
  </div>
</div>
<div class="row">
  <div class="form-group required col-md-12">
    <label class="control-label" for="nom">Dénomination du fournisseur</label>
    {!! Form::text('nom',null,['required','class'=>'form-control','id'=>'nom']) !!}
    <small class="text-danger" id="nomSpan"> </small>
  </div>
</div>
<div class="row">
  <div class="form-group required col-md-6">
    <label class="control-label" for="sigle">Sigle</label>
    {!! Form::text('sigle',null,['required','class'=>'form-control','id'=>'sigle']) !!}
    <small class="text-danger" id="sigleSpan"> </small>
  </div>

  <div class="form-group required col-md-6">
    <label class="control-label" for="siege">Siège</label>
    {!! Form::text('siege',null,['required','class'=>'form-control','id'=>'siege']) !!}
    <small class="text-danger" id="siegeSpan"> </small>
  </div>
</div>
<div class="row">
  <div class="form-group required col-md-6">
    <label class="control-label" for="telephone">Téléphone</label>
    {!! Form::text('telephone',null,['required','class'=>'form-control','id'=>'telephone']) !!}
    <small class="text-danger" id="telephoneSpan"> </small>
  </div>

  <div class="form-group required col-md-6">
    <label class="control-label" for="email">Email</label>
    {!! Form::email('email',null,['required','class'=>'form-control','id'=>'email']) !!}
    <small class="text-danger" id="emailSpan"> </small>
  </div>
</div>
<div class="row">
  <div class="form-group required col-md-12">
    <label class="control-label" for="responsable">Nom & prenom du responsable</label>
    {!! Form::text('responsable',null,['required','class'=>'form-control','id'=>'responsable']) !!}
    <small class="text-danger" id="responsableSpan"> </small>
  </div>

</div>