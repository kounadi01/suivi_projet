@extends('layouts.app')
@section('titre' , 'Statistiques par région' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Statistique par région
    </a>
</li>
@endsection

@section('main')
    <div class="content">
            @include('statistiques.grapheRegion')
    </div>
@endsection

@section('scripts')
    <script>

        // changement d'une region
        $(document).on('change','#region_id',function(e){
            var region_id = e.target.value;
            var annee_id = $('#annee_id').val();
            var structure_id = $('#structure_id').val();
            grapheUpdate(region_id,annee_id,structure_id);
        })

         // changement d'une année exercice
         $(document).on('change','#annee_id',function(e){
            var annee_id = e.target.value;
            var region_id = $('#region_id').val();
            var structure_id = $('#structure_id').val();
            grapheUpdate(region_id,annee_id,structure_id);
        })

        // changement d'une structure
        $(document).on('change','#structure_id',function(e){
            var structure_id = e.target.value;
            var region_id = $('#region_id').val();
            var annee_id = $('#annee_id').val();
            grapheUpdate(region_id,annee_id,structure_id);
        })

        // fonction de remplissage du champ select des indicateurs
        function grapheUpdate(region_Id,annee_Id,structure_Id) {
            if (structure_Id == "") {
                structure_Id = 0;
            }
          //  $('#grapheAff').empty();
            $.get('{{ url('statistiques-par-region') }}/'+ annee_Id +'/'+structure_Id +'/'+region_Id)
                    .done(function (data) {
                        $('#grapheAff').replaceWith(data);
                    })
            }

    </script>
@endsection