@extends('layouts.app')
@section('titre' , 'Statistiques nationale' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Statistique nationale
    </a>
</li>
@endsection

@section('main')
    <div class="content">
            @include('statistiques.grapheNationale')
    </div>
@endsection

@section('scripts')
    <script>
         // changement d'une année exercice
         $(document).on('change','#annee_id',function(e){
            var annee_id = e.target.value;
            grapheUpdate(annee_id);
        })

        // fonction de remplissage du champ select des indicateurs
        function grapheUpdate(annee_Id) {
          //  $('#grapheAff').empty();
            $.get('{{ url('statistiques-nationale') }}/'+ annee_Id)
                    .done(function (data) {
                        $('#grapheAff').replaceWith(data);
                    })
        }

    </script>
@endsection