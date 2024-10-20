<div class="col-sm-12">
    <div class="row">
        <div class="form-group col-sm-6 {!! $errors->has('name') ? 'has-error' : '' !!}">
            <label for="name">Nom</label>
            {!! Form::text('name', $users->name, ['class' => 'form-control', 'placeholder' => 'Nom de famille','required','disabled']) !!}
            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form-group col-sm-6 {!! $errors->has('prenom') ? 'has-error' : '' !!}">
            <label for="prenom">Prenom</label>
            {!! Form::text('prenom', $users->prenom, ['class' => 'form-control', 'placeholder' => 'Prenom','required']) !!}
            {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6 {!! $errors->has('telephone') ? 'has-error' : '' !!}">
            <label for="telephone">Telephoone</label>
            {!! Form::text('telephone', $users->telephone, ['class' => 'form-control', 'placeholder' => 'telephone','required']) !!}
            {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
        </div>
        <div class="form-group col-sm-6 {!! $errors->has('email') ? 'has-error' : '' !!}">
            <label for="Email">Email</label>
            {!! Form::email('email', $users->email, ['class' => 'form-control', 'placeholder' => 'Email','required']) !!}
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6 {!! $errors->has('profil_id') ? 'has-error' : '' !!}">
            <label for="profil_id">Profil</label>
            {!! Form::select('profil_id',null, $users->nom, ['class' => 'form-control','id'=>'profil','required']) !!}
            {!! $errors->first('profil_id', '<small class="help-block">:message</small>') !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6 {!! $errors->has('login') ? 'has-error' : '' !!}">
            <label for="login">Identifiant</label>
            {!! Form::text('login', $users->login, ['class' => 'form-control', 'placeholder' => 'Identifiant','required']) !!}
            {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
        </div>
        <div class="form-group col-sm-6 {!! $errors->has('isenable') ? 'has-error' : '' !!}">
            <label for="isenable">Statut du compte</label>
            {!! Form::select('isenable',['1'=>'Activé','0'=>'Desactivé' ], $users->isenable, ['class' => 'form-control', 'placeholder' => 'Selectionner le statut','id'=>'isenable','required']) !!}
            {!! $errors->first('isenable', '<small class="help-block">:message</small>') !!}
        </div>
    </div>




</div>