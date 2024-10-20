@extends('layouts.app')
@section('titre' , 'Statistiques par commune' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Statistique par commune
    </a>
</li>
@endsection

@section('main')
    <div class="content">
            @include('statistiques.grapheCommune')
    </div>
@endsection

@section('scripts')
    <script>

        // changement d'une commune
        $(document).on('change','#commune_id',function(e){
            var commune_id = e.target.value;
            var annee_id = $('#annee_id').val();
            var structure_id = $('#structure_id').val();
            grapheUpdate(commune_id,annee_id,structure_id);
        })

         // changement d'une année exercice
         $(document).on('change','#annee_id',function(e){
            var annee_id = e.target.value;
            var commune_id = $('#commune_id').val();
            var structure_id = $('#structure_id').val();
            grapheUpdate(commune_id,annee_id,structure_id);
        })
         // changement d'une année exercice
         $(document).on('change','#structure_id',function(e){
            var structure_id = e.target.value;
            var commune_id = $('#commune_id').val();
            var annee_id = $('#annee_id').val();
            grapheUpdate(commune_id,annee_id,structure_id);
        })

        // fonction de remplissage du champ select des indicateurs
        function grapheUpdate(commune_Id,annee_Id,structure_Id) {
            if (structure_Id == "") {
                structure_Id = 0;
            }
          //  $('#grapheAff').empty();
            $.get('{{ url('statistiques-par-commune') }}/'+ annee_Id+'/'+structure_Id+'/'+commune_Id)
                    .done(function (data) {
                        $('#grapheAff').replaceWith(data);
                    })
        }

    </script>
@endsection