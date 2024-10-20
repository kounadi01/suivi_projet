<div id="homeStatistique">
  <div class="row">
    <div class="form-group col-md-4">
      <label for="">Statistique de l'année</label>
      {!! Form::select('annee_id',$anneeExercices,$annee_id,['required','class'=>'form-control select2','id'=>'annee_id']) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>15</h3>
          <p>Nombre de prévisions</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>1</h3>
          <p>Nombre de réalisations</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>5</h3>
          <p>Nombre de sous-traitants</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>12</h3>
          <p>Nombre de Mines</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">voir plus <i class="fas fa-arrow-circle-right"></i></a>
      </div>
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
          <div class="col-md-6" id="graphe{{$programme['id_programme']}}">
          </div>
          <div class="col-md-6" id="graphe{{$programme['id_programme']}}b">
          </div>
        </div>
      </div>
    </div>
    @piechart("previsions".$programme['id_programme'], 'graphe'.$programme['id_programme'])

    @if($programme['is_content_realisation'] == 1)
    @piechart("realisations".$programme['id_programme'], 'graphe'.$programme['id_programme'].'b')
    @endif
    @endforeach

  </div>
  <div>
    <!-- BAR CHART -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Bar Chart</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="barchart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</div>