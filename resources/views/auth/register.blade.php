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
                <div class="card card-light">
                    <div class="card-header text-center font-weight-bold text-lg">Nouvel utilisateur</div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal panel']) !!}
                          <div class="row">
                            <div class="form-group col-sm-6 {!! $errors->has('name') ? 'has-error' : '' !!}">
                                <label for="name">Nom</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom de famille','required']) !!}
                                {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                            </div>

                            <div class="form-group col-sm-6 {!! $errors->has('prenom') ? 'has-error' : '' !!}">
                                <label for="prenom">Prenom</label>
                                {!! Form::text('prenom', null, ['class' => 'form-control', 'placeholder' => 'Prenom','required']) !!}
                                {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-6 {!! $errors->has('telephone') ? 'has-error' : '' !!}">
                                <label for="telephone">Telephoone</label>
                                {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'telephone','required']) !!}
                                {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
                            </div>
                            <div class="form-group col-sm-6 {!! $errors->has('email') ? 'has-error' : '' !!}">
                                <label for="Email">Email</label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email','required']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-6 {!! $errors->has('profil_id') ? 'has-error' : '' !!}">
                                <label for="profil_id">Profil</label>
                                {!! Form::select('profil_id',['Etat'=>'Etat','Socité civile'=>'Socité civile',], null, ['class' => 'form-control', 'placeholder' => 'Selectionner le profil','id'=>'profil','required']) !!}
                                {!! $errors->first('profil_id', '<small class="help-block">:message</small>') !!}
                            </div>
                            <div class="form-group col-sm-6 {!! $errors->has('structure_id') ? 'has-error' : '' !!}">
                                <label for="structure_id">Structure</label>
                                {!! Form::select('structure_id',['Etat'=>'Etat','Socité civile'=>'Socité civile'], null, ['class' => 'form-control', 'placeholder' => 'Selectionner la structure','id'=>'structure','required']) !!}
                                {!! $errors->first('structure_id', '<small class="help-block">:message</small>') !!}
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-6 {!! $errors->has('login') ? 'has-error' : '' !!}">
                                <label for="login">Identifiant</label>
                                {!! Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'Identifiant','required']) !!}
                                {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
                            </div>

                            <div class="form-group col-sm-6 {!! $errors->has('password') ? 'has-error' : '' !!}">
                                <label for="password">Mot de passe</label>
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe','required']) !!}
                                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                            </div>
                          </div>

                            <div class="form-group ">
                                <label for="password_confirmation">Confirmer le mot de passe</label>
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation mot de passe','required']) !!}
                            </div>
                            <div class="form-group ">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('isenable', 1, 0) !!}&nbsp; Activé le compte
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer row justify-content-center">

                                {!! Form::submit('Envoyer', ['class' => 'btn-lg btn-success mr-2 ']) !!}
                                <button type=reset aria-label="Close" class="btn-lg btn-primary ml-2" data-dismiss="modal">Annuler</button>

                                {{--{!! Form::submit('Envoyer', ['class' => 'btn btn-success ']) !!}--}}
                                {{--{!! Form::close('Anuller', ['class' => 'btn btn-primary ']) !!}--}}

                            </div>


                        </div>
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
                    sigle_struct: {
                        required: "Veuillez fournir un sigle"
                    },
                    email_struct: {
                        required: "Veuillez fournir une adresse électronique ",
                        mail: "Veuillez fournir une adresse électronique valide"
                    },
                    tel_struct: {
                        required: "Veuillez fournir un numéro de téléphone ",
                        minlength : "Le numéro doit comporter 08 chiffres"

                    },
                    responsable_struct: {
                        required: "Veuillez fournir un numéro le nom & le prenom du responsable "


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








