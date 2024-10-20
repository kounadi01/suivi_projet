@extends('layouts.app')
@section('titre' , 'Statistiques par province' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Statistique par province
    </a>
</li>
@endsection

@section('main')
    <div class="content">
            @include('statistiques.grapheProvince')
    </div>
@endsection

@section('scripts')
    <script>

        // changement d'une province
        $(document).on('change','#province_id',function(e){
            var province_id = e.target.value;
            var annee_id = $('#annee_id').val();
            var structure_id = $('#structure_id').val();
            grapheUpdate(province_id,annee_id,structure_id);
        })

         // changement d'une année exercice
         $(document).on('change','#annee_id',function(e){
            var annee_id = e.target.value;
            var province_id = $('#province_id').val();
            var structure_id = $('#structure_id').val();
            grapheUpdate(province_id,annee_id,structure_id);
        })

         // changement d'une structure
         $(document).on('change','#structure_id',function(e){
            var structure_id = e.target.value;
            var province_id = $('#province_id').val();
            var annee_id = $('#annee_id').val();
            grapheUpdate(province_id,annee_id,structure_id);
        })

        // fonction de remplissage du champ select des indicateurs
        function grapheUpdate(province_Id,annee_Id,structure_Id) {
            if (structure_Id == "") {
                structure_Id = 0;
            }
          //  $('#grapheAff').empty();
            $.get('{{ url('statistiques-par-province') }}/'+ annee_Id+'/'+structure_Id+'/'+province_Id)
                    .done(function (data) {
                        $('#grapheAff').replaceWith(data);
                    })
        }

    </script>
@endsection