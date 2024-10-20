<div class="row">
    <div class="form-group required col-md-12">
        <label class="control-label" for="annee_id_id">Année</label>
        {!! Form::select('annee_id',$annees,null,['required','class'=>'form-control select2','id'=>'annee_id','placeholder'=>'Veuillez choisir l\'année']) !!}
        @error("annee_id_id")
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group required col-md-12" hidden>
        <label class="control-label" for="anne_old">Année Old</label>
        {!! Form::number('annee_old',$annee,['required','class'=>'form-control','id'=>'annee_old']) !!}
        @error("annee_old")
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>