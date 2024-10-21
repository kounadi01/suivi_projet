@extends('layouts.app')
@section('titre' , 'Ajout d\'une structure' )
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Structures
    </a>
</li>
@endsection

@section('main')
    <div class="content">
  <div class="row justify-content-center">
      <div class="col-sm-10">
        <div class="clearfix"></div>
        <div class="card card-light">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header text-center">Enregistrement d'une structure</div>
            <div class="card-body">
                @include('structures.fields')
            </div>
            <div class="card-footer row justify-content-center" style="float: right;">

                    {!! Form::submit('Envoyer', ['class' => 'btn-lg btn-success mr-2 ']) !!}
                    <button type=reset aria-label="Close" class="btn-lg btn-primary ml-2" data-dismiss="modal">Annuler</button>

                {{--{!! Form::submit('Envoyer', ['class' => 'btn btn-success ']) !!}--}}
                {{--{!! Form::close('Anuller', ['class' => 'btn btn-primary ']) !!}--}}

            </div>


        </div>
      </div>

     </div>

    </div>
    <a href="javascript:history.back()" class="btn btn-primary ml-0 mb-5">
        <span class="glyphicon glyphicon-circle-arrow-left"></span><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i>&nbsp; Retour
    </a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $( "#regForm" ).validate({
                errorClass: 'errors',
                rules: {
                    nom_struct: {
                        required: true
                    },
                    sigle_struct : {
                        required : false
                    },
                    type_struct : {
                        required : true
                    },

                    tel_struct : {
                        required : true,
                        number:true,
                        minlength : 8
                    },
                    email_struct : {
                        required: true,
                        email: true
                    }
                    
                },
                messages: {
                    nom_struct: {
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

                    }
                }

            });
        });


    </script>



@endsection


