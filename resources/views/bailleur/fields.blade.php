<div class="row">
  <div class="form-group required col-md-12">
      <label class="control-label" for="nom">Nom du bailleur</label>
      {!! Form::text('nom', null, ['required', 'class' => 'form-control', 'id' => 'nom']) !!}
      <small class="text-danger" id="nomSpan"></small>
  </div>
  <div class="form-group required col-md-12">
      <label class="control-label" for="sigle">Sigle</label>
      {!! Form::text('sigle', null, ['required', 'class' => 'form-control', 'id' => 'sigle']) !!}
      <small class="text-danger" id="sigleSpan"></small>
  </div>
  <div class="form-group required col-md-12">
      <label class="control-label" for="telephone">Téléphone</label>
      {!! Form::text('telephone', null, ['required', 'class' => 'form-control', 'id' => 'telephone']) !!}
      <small class="text-danger" id="telephoneSpan"></small>
  </div>
</div>
