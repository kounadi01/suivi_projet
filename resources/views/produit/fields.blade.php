<div class="row">
  <div class="form-group required col-md-12">
    <label class="control-label" for="libelle">Nom du produit</label>
    {!! Form::text('libelle',null,['required','class'=>'form-control','id'=>'libelle']) !!}
    <small class="text-danger" id="libelleSpan"> </small>
  </div>

  <div class="form-group col-md-12">
    <label class="control-label" for="type">Type</label>
    {!! Form::select('type',array('Bien' => 'Bien','Service' => 'Service'),null,['class'=>'form-control select3','id'=>'type','placeholder'=>'Veuillez choisir le type']) !!}
    <small class="text-danger" id="typeSpan"> </small>
  </div>
  @if(\App\Models\User::authUserProfil()->nom == 'Administrateur')
  <div class="form-group col-md-12">
    <label class="control-label" for="type">Est dans l'arrete</label>
    {!! Form::select('decret',array(0 => 'Non',1 => 'Oui'),null,['class'=>'form-control select3','id'=>'decret','placeholder'=>'Veuillez choisir l\'option']) !!}
    <small class="text-danger" id="typeSpan"> </small>
  </div>
  @endif


</div>