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
        <div class="card card-primary">
            @include('statistiques.graphe')
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        // changement d'un programme
        $(document).on('change','#commune_id',function(e){
            var commune_id = e.target.value;
            grapheUpdate(commune_id);
        })

        // fonction de remplissage du champ select des indicateurs
        function grapheUpdate(commune_Id) {

            $.get('{{ url('statistiques-par-commune') }}/'+ commune_Id)
                    .done(function (data) {
                        $('#editSousInd .modal-content').html(data);
                        $('#editSousInd').modal('show');
                    })
        }

    </script>
@endsection