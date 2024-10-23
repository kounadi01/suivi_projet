<div class="col-sm-12">
  {!! Form::open(['route' => 'societes.store', 'class' => 'form-horizontal panel', 'id' => 'regForm']) !!}
  <div class="row">
      <div class="required form-group col-md-6 {!! $errors->has('libelle') ? 'has-error' : '' !!}">
          <label class="control-label" for="libelle">Dénomination</label>
          {!! Form::text('libelle', null, ['class' => 'form-control', 'placeholder' => 'Dénomination de la société', 'id' => 'libelle']) !!}
          {!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
      </div>

      <div class="required form-group col-md-6 {!! $errors->has('type') ? 'has-error' : '' !!}">
          <label class="control-label" for="type">Type</label>
          {!! Form::select('type', ['Societé énergétique' => 'Societé énergétique'], 'Societé énergétique', ['class' => 'form-control', 'placeholder' => 'Sélectionner', 'id' => 'type']) !!}
          {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
      </div>
  </div>

  <div class="row">
      <div class="required form-group col-md-6 {!! $errors->has('siege') ? 'has-error' : '' !!}">
          <label class="control-label" for="siege">Siège</label>
          {!! Form::text('siege', null, ['class' => 'form-control', 'placeholder' => 'Siège de la société', 'id' => 'siege']) !!}
          {!! $errors->first('siege', '<small class="help-block">:message</small>') !!}
      </div>

      <div class="required form-group col-md-6 {!! $errors->has('adresse') ? 'has-error' : '' !!}">
          <label class="control-label" for="adresse">Adresse</label>
          {!! Form::text('adresse', null, ['class' => 'form-control', 'placeholder' => 'Adresse de la société', 'id' => 'adresse']) !!}
          {!! $errors->first('adresse', '<small class="help-block">:message</small>') !!}
      </div>
  </div>
</div>
