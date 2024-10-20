
@extends('layouts.app')
@section('titre' , 'Ajout d\'une photo' )
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Photos
        </a>
    </li>
@endsection
@section('css')
    <style>

        .error {
            color: red;
            background-color: #acf;
        }

    </style>


@endsection

@section('main')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="clearfix"></div>
                <div class="card card-light">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header text-center"> Modifier la photo</div>
                    <form method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="main-form" role="form" action="{!! route('photos.update',$photo) !!}">
                    {!! csrf_field() !!}
                    <div class="card-body">

                        @include('photos.fields_edit')
                    </div>
                    <div class="card-footer row justify-content-center" style="float: right;">

                        {!! Form::submit('Envoyer', ['class' => 'btn-lg btn-success mr-2 ']) !!}
                        <button type=reset aria-label="Close" class="btn-lg btn-primary ml-2" data-dismiss="modal">Annuler</button>

                    </div>

                    </form>


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
                    },
                    responsable_struct : {
                        required : true
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

                    },
                    responsable_struct: {
                        required: "Veuillez fournir un numéro le nom & le prenom du responsable "


                    }
                }

            });
        });


    </script>


<script type="text/javascript">

function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img=document.getElementById("thumbnil");
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
}

</script>
@endsection
