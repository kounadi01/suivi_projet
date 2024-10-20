@extends('layouts.app')
@section('titre' , 'Detail de d\'un utilisateur')
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Utilisateurs
        </a>
    </li>
@endsection


@section('main')
    <div class="clearfix"></div>
    {{--<div class="container-fluid  mt-0 rounded">--}}
        <div class="row justify-content-center mb-2">
            <div class="col-sm-12">
                <br>
            <div class="row">
                    <!-- left column -->
              <div class="col-md-6">
                <div class="card card-light">
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detail utilisateur</h3>
                            </div>
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td>Nom de famille</td>
                                            <td>{{ $users->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Prenom</td>
                                            <td>{{ $users->prenom }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $users->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Telephone</td>
                                            <td>{{ $users->telephone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Identifiant</td>
                                            <td>{{ $users->login }}</td>
                                        </tr>
                                        <tr>
                                            <td>Statut du compte</td>
                                            <td>
                                                @if($users->isenable==1)

                                                    <span class="text-success">&nbsp;Activé</span>
                                                @else
                                                    <span class="text-warning">&nbsp;Desactivé</span>
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td>Inscrit le</td>
                                            <td>{{ $users->created_at }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                    </div>
                </div>
              </div>


               <div class="col-md-6">
                <div class="card card-light">
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detail Structure Utilisateur</h3>
                            </div>
                                    
                                </div>
                                <!-- /.card-body -->

                            </div>
                        </div>

                </div>


            </div>
        </div>

  </div>


                <div class="card-footer row justify-content-center">

                    <a href="{{route('user.index')}}" class="btn btn-primary ml-2 mb-5">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i>&nbsp; Retour
                    </a>
                    @if($users->isenable==1)

                        <a  href="{{route('user.desactive',$users->id)}}"
                            {{--data-url="{!! route('user.desactive',$users->id) !!}"--}}
                            {{--id="desactiveUser"--}}
                            class="btn btn-primary ml-2 mb-5 data-tooltip btn-sm btn-primary" data-tooltip="Activer compte utilisateur">

                            <i class="fas fa-lock">&nbsp;Desactiver</i>
                        </a>

                    @else
                        <a  href="{{route('user.reactive',$users->id)}}"
                            {{--data-url="{!! route('user.reactive',$users->id) !!}"--}}
                            {{--id="reactiveUser"--}}
                            class="btn btn-primary ml-2 mb-5 data-tooltip btn-sm btn-primary" data-tooltip="Activer compte utilisateur">

                            <i class="fas fa-unlock ">&nbsp;Reactiver</i>
                        </a>


                    @endif
                </div>
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









