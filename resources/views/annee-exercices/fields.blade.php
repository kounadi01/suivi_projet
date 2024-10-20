<div class="row">
  <div class="form-group required col-md-12">
    <label class="control-label" for="annee_exercice">Année exercice</label>
    {!! Form::selectRange('annee_exercice', 2000, 2150,null,['class'=>'form-control select2','placeholder'=>'veuillez choisir une année','id'=>'annee_exercice']) !!}
    <small class="text-danger" id="annee_exerciceSpan"> </small>
  </div>
</div>

<div class="row" style="position: relative; border: 1px solid;margin-top:3%;">
  <h4 style="position: absolute;top:-15px;background: #fff;left:10px;font-size: large;"> Prévision</h4>
  <div class="form-group required col-md-6" style="margin-top:5%;">
    <label class="control-label" for="date_debut_prevision">Date début</label>
    {!! Form::date('date_debut_prevision',null,['class'=>'form-control','placeholder'=>'veuillez choisir une date','id'=>'date_debut_prevision']) !!}
    <small class="text-danger" id="date_debut_previsionSpan"> </small>
  </div>

  <div class="form-group required col-md-6" style="margin-top:5%;">
    <label class="control-label" for="date_fin_prevision">Date fin</label>
    {!! Form::date('date_fin_prevision',null,['class'=>'form-control','placeholder'=>'veuillez choisir une date','id'=>'date_fin_prevision']) !!}
    <small class="text-danger" id="date_fin_previsionSpan"> </small>
  </div>
</div>

<div class="row" style="position: relative; border: 1px solid;margin-top:5%;">
  <h4 style="position: absolute;top:-15px;background: #fff;left:10px;font-size: large;"> Réalisation</h4>
  <div class="form-group required col-md-6" style="margin-top:5%;">
    <label class="control-label" for="date_debut_realisation">Date début</label>
    {!! Form::date('date_debut_realisation',null,['class'=>'form-control','placeholder'=>'veuillez choisir une date','id'=>'date_debut_realisation']) !!}
    <small class="text-danger" id="date_debut_realisationSpan"> </small>
  </div>

  <div class="form-group required col-md-6" style="margin-top:5%;">
    <label class="control-label" for="date_fin_realisation">Date fin</label>
    {!! Form::date('date_fin_realisation',null,['class'=>'form-control','placeholder'=>'veuillez choisir une date','id'=>'date_fin_realisation']) !!}
    <small class="text-danger" id="date_fin_realisationSpan"> </small>
  </div>
</div>