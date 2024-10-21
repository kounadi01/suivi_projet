<div class="row">
    <div class="form-group required col-md-12">
        <label class="control-label" for="nom">Nom du coordonateur</label>
        {!! Form::text('nom', null, ['required', 'class' => 'form-control', 'id' => 'nom']) !!}
        <small class="text-danger" id="nomSpan"></small>
    </div>
    <div class="form-group required col-md-12">
        <label class="control-label" for="prenom">Prénom du coordonateur</label>
        {!! Form::text('prenom', null, ['required', 'class' => 'form-control', 'id' => 'prenom']) !!}
        <small class="text-danger" id="prenomSpan"></small>
    </div>
    <div class="form-group required col-md-12">
        <label class="control-label" for="telephone">Téléphone</label>
        {!! Form::text('telephone', null, ['required', 'class' => 'form-control', 'id' => 'telephone']) !!}
        <small class="text-danger" id="telephoneSpan"></small>
    </div>
    <div class="form-group required col-md-12">
        <label class="control-label" for="email">Email</label>
        {!! Form::email('email', null, ['required', 'class' => 'form-control', 'id' => 'email']) !!}
        <small class="text-danger" id="emailSpan"></small>
    </div>
  </div>
  