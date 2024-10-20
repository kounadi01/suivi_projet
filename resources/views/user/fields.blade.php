<div class="col-sm-12">
  {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal panel']) !!}
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('name') ? 'has-error' : '' !!}">
      <label class="control-label" for="name">Nom</label>
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom de famille','required']) !!}
      {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="required form-group col-sm-6 {!! $errors->has('prenom') ? 'has-error' : '' !!}">
      <label class="control-label" for="prenom">Prenom</label>
      {!! Form::text('prenom', null, ['class' => 'form-control', 'placeholder' => 'Prenom','required']) !!}
      {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('telephone') ? 'has-error' : '' !!}">
      <label class="control-label" for="telephone">Telephoone</label>
      {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'telephone','required']) !!}
      {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="required form-group col-sm-6 {!! $errors->has('email') ? 'has-error' : '' !!}">
      <label class="control-label" for="Email">Email</label>
      {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email','required']) !!}
      {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('profil_id') ? 'has-error' : '' !!}">
      <label class="control-label" for="profil_id">Profil</label>
      {!! Form::select('profil_id',$profils, null, ['class' => 'form-control', 'placeholder' => 'Selectionner le profil','id'=>'profil_id','required']) !!}
      {!! $errors->first('profil_id', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="required form-group col-sm-6 {!! $errors->has('structure_id') ? 'has-error' : '' !!}">
      <label class="control-label" for="structure_id">Structure</label>
      {!! Form::select('structure_id',$structures, null, ['class' => 'form-control', 'placeholder' => 'Selectionner la structure','id'=>'structure_id','required']) !!}
      {!! $errors->first('structure_id', '<small class="help-block">:message</small>') !!}
    </div>

  </div>
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('login') ? 'has-error' : '' !!}">
      <label class="control-label" for="login">Identifiant</label>
      {!! Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'Identifiant','required']) !!}
      {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="required form-group col-sm-6 {!! $errors->has('password') ? 'has-error' : '' !!}">
      <label class="control-label" for="password">Mot de passe</label>
      {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe','required']) !!}
      {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  <div class="row">
    <div class="required form-group col-sm-6">
      <label class="control-label" for="password_confirmation">Confirmer le mot de passe</label>
      {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation mot de passe','required']) !!}
    </div>
    <div class="required form-group col-sm-6 {!! $errors->has('isenable') ? 'has-error' : '' !!}">
      <label class="control-label" for="isenable">Statut du compte</label>
      {!! Form::select('isenable',['1'=>'Activé','0'=>'Desactivé' ], '1', ['class' => 'form-control', 'placeholder' => 'Selectionner le statut','id'=>'isenable','required']) !!}
      {!! $errors->first('isenable', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  <div class="card-footer row justify-content-center">

    {!! Form::submit('Envoyer', ['class' => 'btn-lg btn-success mr-2 ']) !!}
    <button type=reset aria-label="Close" class="btn-lg btn-primary ml-2" data-dismiss="modal">Annuler</button>
  </div>


</div>