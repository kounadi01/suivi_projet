<div class="col-sm-12">
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('name') ? 'has-error' : '' !!}">
      <label class="control-label" for="name">Nom</label>
      {!! Form::text('name', $users->name, ['class' => 'form-control', 'placeholder' => 'Nom de famille','required']) !!}
      {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="required form-group col-sm-6 {!! $errors->has('prenom') ? 'has-error' : '' !!}">
      <label class="control-label" for="prenom">Prenom</label>
      {!! Form::text('prenom', $users->prenom, ['class' => 'form-control', 'placeholder' => 'Prenom','required']) !!}
      {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('telephone') ? 'has-error' : '' !!}">
      <label class="control-label" for="telephone">Telephoone</label>
      {!! Form::text('telephone', $users->telephone, ['class' => 'form-control', 'placeholder' => 'telephone','required']) !!}
      {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="required form-group col-sm-6 {!! $errors->has('email') ? 'has-error' : '' !!}">
      <label class="control-label" for="Email">Email</label>
      {!! Form::email('email', $users->email, ['class' => 'form-control', 'placeholder' => 'Email','required']) !!}
      {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('login') ? 'has-error' : '' !!}">
      <label class="control-label" for="login">Identifiant</label>
      {!! Form::text('login', $users->login, ['class' => 'form-control', 'placeholder' => 'Identifiant','required']) !!}
      {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="required form-group col-sm-6 {!! $errors->has('structure_id') ? 'has-error' : '' !!}">
      <label class="control-label" for="structure_id">Structure</label>
      {!! Form::select('structure_id',$structures, null, ['class' => 'form-control', 'placeholder' => 'Selectionner la structure','id'=>'structure_id','required']) !!}
      {!! $errors->first('structure_id', '<small class="help-block">:message</small>') !!}
    </div>

  </div>
  @if(\App\Models\User::authUserProfil()->nom =='Administrateur')
  <div class="row">
    <div class="required form-group col-sm-6 {!! $errors->has('profil_id') ? 'has-error' : '' !!}">
      <label class="control-label" for="profil_id">Profil</label>
      {!! Form::select('profil_id',$profils, $users->profil_id, ['class' => 'form-control','id'=>'profil','required']) !!}
      {!! $errors->first('profil_id', '<small class="help-block">:message</small>') !!}
    </div>
    <div class="required form-group col-sm-6 {!! $errors->has('isenable') ? 'has-error' : '' !!}">
      <label class="control-label" for="isenable">Statut du compte</label>
      {!! Form::select('isenable',['1'=>'Activé','0'=>'Desactivé' ], $users->isenable, ['class' => 'form-control', 'placeholder' => 'Selectionner le statut','id'=>'isenable','']) !!}
      {!! $errors->first('isenable', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  @endif

  <div class="card-footer row justify-content-center">

    {{--{!! Form::submit('Envoyer', ['class' => 'btn-lg btn-success mr-2 ']) !!}--}}
    <button type="submit" id="" class="btn-lg btn-success mr-2">Valider</button>
    <button type=reset aria-label="Close" class="btn-lg btn-primary ml-2" data-dismiss="modal">Annuler</button>
  </div>


</div>