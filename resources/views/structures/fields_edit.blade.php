<div class="col-sm-12">
  {!! Form::open(['route' => 'structures.store', 'class' => 'form-horizontal panel','id'=>'regForm']) !!}
  <div class="row">
    <div class="required form-group {!! $errors->has('categorie_struct') ? 'has-error' : '' !!} col-md-6">
      <label class="control-label" for="categorie_struct">Catégorie</label>
      {!! Form::select('categorie_struct',['Locale'=>'Locale','Etrangère'=>'Etrangère'], null, ['class' => 'form-control', 'placeholder' => 'Selectionner','id'=>'categorie_struct']) !!}
      {!! $errors->first('categorie_struct', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="required form-group {!! $errors->has('ifu_struct') ? 'has-error' : '' !!} col-md-6">
      <label class="control-label" for="ifu_struct">IFU</label>
      {!! Form::text('ifu_struct', $structure->nom_ifu, ['class' => 'form-control', 'placeholder' => 'IFU de la structure','id'=>'ifu_struct']) !!}
      {!! $errors->first('ifu_struct', '<small class="help-block">:message</small>') !!}
    </div>
  </div>

  <div class="required form-group{!! $errors->has('nom_struct') ? 'has-error' : '' !!}">
    <label class="control-label" for="nom_struct">Dénomination</label>
    {!! Form::text('nom_struct', $structure->nom_struct, ['class' => 'form-control', 'placeholder' => 'Dénomination de la structure','id'=>'nom_struct']) !!}
    {!! $errors->first('nom_struct', '<small class="help-block">:message</small>') !!}
  </div>
  <div class="form-group {!! $errors->has('sigle_struct') ? 'has-error' : '' !!}">
    <label class="control-label" for="sigle_struct">Sigle</label>
    {!! Form::text('sigle_struct', $structure->sigle_struct, ['class' => 'form-control', 'placeholder' => 'Sigle de la structure ','id'=>'sigle_struct']) !!}
    {!! $errors->first('sigle_struct', '<small class="help-block">:message</small>') !!}
  </div>

  <div class="row">
    <div class="required form-group {!! $errors->has('type_struct') ? 'has-error' : '' !!} col-md-6">
      <label class="control-label" for="type_struct">Type</label>
      {!! Form::select('type_struct',['Etat'=>'Etat','Societé minière'=>'Societé minière','Sous-traitant'=>'Sous-traitant'], null, ['class' => 'form-control', 'placeholder' => 'Selectionner','id'=>'type_struct']) !!}
      {!! $errors->first('type_struct', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group {!! $errors->has('phase_struct') ? 'has-error' : '' !!} col-md-6">
      <label class="control-label" for="phase_struct">Phase</label>
      {!! Form::select('phase_struct',['exploration'=>'Exploration','developpement'=>'Développement/Construction','exploitation'=>'Exploitation/Production','rehabilitation'=>'Réhabilitation/Fermeture'], null, ['class' => 'form-control', 'placeholder' => 'Selectionner','id'=>'phase_struct']) !!}
      {!! $errors->first('phase_struct', '<small class="help-block">:message</small>') !!}
    </div>
  </div>

  <div class="row">
    <div class="required form-group {!! $errors->has('tel_struct') ? 'has-error' : '' !!} col-md-6">
      <label class="control-label" for="tel_struct">Télephone</label>
      {!! Form::text('tel_struct', $structure->tel_struct, ['class' => 'form-control', 'placeholder' => 'Numero de telephone ','id'=>'tel_struct']) !!}
      {!! $errors->first('tel_struct', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="required form-group {!! $errors->has('email_struct') ? 'has-error' : '' !!} col-md-6">
      <label class="control-label" for="email_struct">Email</label>
      {!! Form::email('email_struct', $structure->email_struct, ['class' => 'form-control', 'placeholder' => 'Email ','id'=>'email_struct']) !!}
      {!! $errors->first('email_struct', '<small class="help-block">:message</small>') !!}
    </div>
  </div>
  <div class="required form-group {!! $errors->has('responsable_struct') ? 'has-error' : '' !!}">
    <label class="control-label" for="responsable_struct">Nom & prenom du responsable</label>
    {!! Form::text('responsable_struct', $structure->responsable_struct, ['class' => 'form-control', 'placeholder' => 'Nom & prenom du rsponsable de la structure','id'=>'responsable_struct']) !!}
    {!! $errors->first('responsable_struct', '<small class="help-block">:message</small>') !!}
  </div>
</div>