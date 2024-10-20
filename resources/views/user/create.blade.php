@extends('layouts.app')
@section('titre' , 'Ajout d\'un utilisateur')
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Utilisateurs
        </a>
    </li>
@endsection


@section('main')
    <div class="clearfix"></div>
    <div class="container-fluid  mt-0 rounded">
        <div class="row justify-content-center mb-2">
            <div class="col-sm-8">
                <br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card card-light">
                    <div class="card-header text-center font-weight-bold text-lg">Nouvel utilisateur</div>
                    <div class="card-body">
                        @include('user.fields')
                    </div>

                </div>
                <a href="javascript:history.back()" class="btn btn-primary ml-0 mb-5">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i>&nbsp; Retour
                </a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $( "#regForm" ).validate({
                errorClass: 'errors',
                rules: {
                    name: {
                        required: true
                    },
                    prenom : {
                        required : false
                    },
                    telephone : {
                        required : true
                    },

                    password : {
                        required : true,
                        password:true
                    },
                    email : {
                        required: true,
                        email: true
                    },
                    login : {
                        required : true
                    }
                },
                messages: {
                    name: {
                        required: "Veuillez fournir une dénomination"
                    },
                    prenom: {
                        required: "Veuillez fournir un sigle"
                    },
                    email: {
                        required: "Veuillez fournir une adresse électronique ",
                        mail: "Veuillez fournir une adresse électronique valide"
                    },
                    telephone: {
                        required: "Veuillez fournir un numéro de téléphone ",
                        minlength : "Le numéro doit comporter 08 chiffres"

                    },
                    login: {
                        required: "Veuillez fournir un identifiant"


                    }
                }

            });
        });


        $(function () {
            $('.select2').each(function () {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        });


    </script>
@endsection








