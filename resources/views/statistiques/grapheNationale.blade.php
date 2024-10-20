<div id="grapheAff">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Choix Année exercice</label>
            {!! Form::select('annee_id',$anneeExercices,$annee_id,['required','class'=>'form-control select2','id'=>'annee_id']) !!}
        </div>
    </div>
    <div class="row">
        @foreach ($programmes_with_previsions as $programme)
            <div class="card col-md-12">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    {{ $programme['titre_programme'] }}
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12" id="graphe{{$programme['id_programme']}}">
                    </div>
                    <div class="col-md-12" id="graphe{{$programme['id_programme']}}b">
                    </div>
                    </div>
                </div>
            </div>
            @columnchart("previsions".$programme['id_programme'], 'graphe'.$programme['id_programme'])
            
          @if($programme['is_content_realisation'] == 1)
                @columnchart("realisations".$programme['id_programme'], 'graphe'.$programme['id_programme'].'b')
          @endif
        @endforeach
    </div>
</div>