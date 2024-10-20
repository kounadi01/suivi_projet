<div class="card card-primary" id="grapheAff">
    <div class="card-header bg-light" >
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <label for="">Choix Année exercice</label>
                {!! Form::select('annee_id',$anneeExercices,$annee_id,['required','class'=>'form-control select2','id'=>'annee_id']) !!}
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card">
            <div id="ca_graph_realisation" class="mt-5" >
            </div>
        </div>
        @columnchart('Realisations', 'ca_graph_realisation')
    </div>
</div>