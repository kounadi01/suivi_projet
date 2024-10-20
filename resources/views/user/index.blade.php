
@extends('layouts.app')
@section('titre' , 'Liste des utilisateurs' )
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Utilisateurs
        </a>
    </li>
@endsection

@section('main')
    {{--<div class="col-sm-12">--}}


    {{--</div>--}}

    <div class="content">
        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
        @endif
        <div class="clearfix"></div>
        <div class="card card-primary">
            @if(session('statut'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('statut') }}
                </div>

            @endif
            <div class="card-header bg-light">
                <h1 class="row float-right">
                    <a href="{{ route('user.create')}}" class="btn btn-primary float-right ml-4"> <i class="fa fa-user-edit"></i> Ajouter un utilisateur</a>

                </h1>
            </div>
            <div class="card-body">
                @include('user.table')
            </div>
        </div>
    </div>


<a href="javascript:history.back()" class="btn btn-primary ml-2 mt-2">
    <span class="glyphicon glyphicon-circle-arrow-left"></span><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i>&nbsp; Retour
</a>
@endsection



@section('scripts')
    <script type ="text/javascript">





        //Suppression de la utilisateur
        $(document).on('click', '#supprimerUser', function (e) {
            var url = $(this).attr('data-url');
            question('Voulez-vous supprimer l\'utilisateur ?', function () {
                $.ajax({
                    url: url,
                    method: 'GET'
                }).done(function () {
                    success("Utilisateur bien supprimé");
                    actualiseTableDelete()
                })
            })
        });

        //Suppression de la structure
        $(document).on('click', '#desactiveUser', function (e) {
            var url = $(this).attr('data-url');
            question('Voulez-vous Vraiment desactiver l\'utilisateur ?', function () {
                $.ajax({
                    url: url,
                    method: 'GET'
                }).done(function () {
                    success("Desactivation reussie");
               actualiseTableDelete()
                })
            })
        });
        //Suppression de la structure
        $(document).on('click', '#reactiveUser', function (e) {
            var url = $(this).attr('data-url');
            question('Voulez-vous vraiment reactiver le compte de l\'utilisateur ?', function () {
                $.ajax({
                    url: url,
                    method: 'GET'
                }).done(function () {
                    success("Compte utilisateur bien reactivé");
                  actualiseTableDelete()
                })
            })
        });
        // actualisation du tableau des structures
        function actualiseTable(idModal){
            var url = "{!! route('user.getListe') !!}";
            $.get(url)
                .done(function (data) {
                    $(idModal).modal('toggle');
                    $('#users-table').html(data);
                    clientSideDataTable.destroy();
                    makeClientSideDataTable();
                })
        }

        function actualiseTableDelete(){
            var url = "{!! route('user.getListe') !!}";
            $.get(url)
                .done(function (data) {
                    $('#users-table').html(data);
                    clientSideDataTable.destroy();
                    makeClientSideDataTable();
                })
        }
    </script>
@endsection





