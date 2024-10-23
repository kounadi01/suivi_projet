<div class="col-sm-12">
    <div class="row">
        <div class="required form-group col-md-6 {!! $errors->has('libelle') ? 'has-error' : '' !!}">
            <label class="control-label" for="libelle">Libellé</label>
            {!! Form::text('libelle', null, ['class' => 'form-control', 'id' => 'libelle']) !!}
            {!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
        </div>
  
        <div class="required form-group col-md-6 {!! $errors->has('description') ? 'has-error' : '' !!}">
            <label class="control-label" for="description">Description</label>
            {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
            {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
        </div>
    </div>
  
    {{-- Autres champs --}}
    
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="composantes">Composantes</label>
            {!! Form::select('composantes[]', $composantes, $projet->composantes->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'composantes']) !!}
        </div>
  
        <div class="form-group col-md-6">
            <label class="control-label" for="coordonnateur">Coordonnateur</label>
            {!! Form::select('coordonnateur', $coordonnateurs, $projet->coordonnateurs->first()->id ?? null, ['class' => 'form-control select2', 'id' => 'coordonnateur']) !!}
        </div>
    </div>
  </div>
  