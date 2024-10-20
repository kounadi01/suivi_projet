
@extends('layouts.app')
@section('titre' , 'Changer le mot de passe')
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Changer le mot de passe
        </a>
    </li>
@endsection


@section('main')
    <div class="clearfix"></div>

        <div class="row justify-content-center mb-2">
            <div class="col-sm-8">
                <br>

                        <div class="container-fluid  mt-0 rounded">
                            <div class="row justify-content-center">
                                <div class="col-sm-10">
                                    <br>
                                    <div class="card card-primary">
                                        <div class="card-header">Changer le mot de passe</div>
                                        <div class="card-body">
                                            <div class="col-sm-12">
                                                <div class="panel-body">
                                                    @if (session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                                                    @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif
                                                    <form  id='regForm' class="form-horizontal" method="POST" action="{{ route('changeUserPassword') }}">
                                                        {{ csrf_field() }}

                                                        <div class="form-group{{ $errors->has('currentpassword') ? ' has-error' : '' }}">
                                                            <label for="newpassword" class="col-md control-label text-primary">Mot de passe actuel</label>

                                                            <div class="col-md">
                                                                <input id="currentpassword" type="password" class="form-control" name="currentpassword" required>

                                                                @if ($errors->has('currentpassword'))
                                                                    <span class="help-block">
                                        <strong>{{ $errors->first('currentpassword') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                                                            <label for="newpassword" class="col-md control-label text-primary">Nouveau mot de passe</label>

                                                            <div class="col-md">
                                                                <input id="newpassword" type="password" class="form-control" name="newpassword" required>

                                                                @if ($errors->has('newpassword'))
                                                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="newpasswordconfirm" class="col-md control-label text-primary">Confirm le nouveau mot de passe</label>

                                                            <div class="col-md">
                                                                <input id="newpasswordconfirm" type="password" class="form-control" name="newpassword_confirmation" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-8">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Changer le mot de passe
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                        </div>
                                    </div>
                                    <a href="javascript:history.back()" class="btn btn-primary ml-0 mt-2">
                                        <span class="glyphicon glyphicon-circle-arrow-left"></span><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i>&nbsp; Retour
                                    </a>
                                </div>
                            </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#regForm").validate({
                rules : {
                    currentpassword : {
                        required:true
                    },
                    newpassword : {
                        required:true
                    },
                    newpasswordconfirm : {
                        required:true
                    }
                }
            })
        })

    </script>


@endsection
