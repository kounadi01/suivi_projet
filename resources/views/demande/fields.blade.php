<div class="row">
  <div class="form-group required col-md-6">
    <label class="control-label" for="annee_exercice">Année exercice</label>
    {!! Form::select('annee_id', $annees, $annee_active,['class'=>'form-control select2','placeholder'=>'veuillez choisir une année','id'=>'annee_exercice']) !!}
    <small class="text-danger" id="annee_exerciceSpan"> </small>
  </div>

  <div class="form-group col-sm-6 {!! $errors->has('Type') ? 'has-error' : '' !!}">
    <label for="type">Type demande</label>
    {!! Form::select('type',['Autorisation'=>'Autorisation','Derogation'=>'Dérogation'], null, ['class' => 'form-control', 'placeholder' => 'Selectionner le type','id'=>'type','required']) !!}
    {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
  </div>
</div>
  <div class="row">
  <div class="form-group required col-md-12">
    <label for="">Structure</label>
    {!! Form::select('structure_id',$structures,$structure_id,['required','class'=>'form-control select2','id'=>'structure_id','placeholder'=>'Veuillez choisir une structure']) !!}
  </div>

  <div class="form-group required col-md-12">
    <label for="">Produit</label>
    {!! Form::select('produit_id',$produits,null,['required','class'=>'form-control select2','id'=>'produit_id','placeholder'=>'Veuillez choisir un produits']) !!}
  </div>
</div>

<div class="row" style="position: relative; border: 1px solid;margin-top:3%;">
  <h4 style="position: absolute;top:-15px;background: #fff;left:10px;font-size: large;"> Montant</h4>
  <div class="form-group required col-md-6" style="margin-top:5%;">
    <label class="control-label" for="montant_total">Montant total</label>
    {!! Form::number('montant_total',null,['class'=>'form-control','placeholder'=>'Saisir montant','id'=>'montant_total']) !!}
    <small class="text-danger" id="montant_totalSpan"> </small>
  </div>

  <div class="form-group required col-md-6" style="margin-top:5%;">
    <label class="control-label" for="montant_local">Montant local</label>
    {!! Form::number('montant_local',null,['class'=>'form-control','placeholder'=>'Saisir montant','id'=>'montant_local']) !!}
    <small class="text-danger" id="montant_localSpan"> </small>
  </div>
</div>

<div class="row" style="position: relative; border: 1px solid;margin-top:5%;">
<h4 style="position: absolute;top:-15px;background: #fff;left:10px;font-size: large;"> Fichier</h4>
  <div class="form-group required col-md-12" style="margin-top:5%;">
    <label class="control-label" for="montant_total">Fichier</label>
    {!! Form::file('fichier',null,['class'=>'form-control','placeholder'=>'Saisir montant','id'=>'montant_total']) !!}
    <small class="text-danger" id="montant_totalSpan"> </small>
  </div>
</div>