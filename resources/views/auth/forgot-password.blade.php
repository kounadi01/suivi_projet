
{{--@extends('layouts.footer')--}}
@extends('layouts.master')
{{--@extends('layouts.header')--}}
@section('css')
<style>
    html {
        position: relative;
        min-height: 100%;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        background: #000000;
        color: #FFFFFF;
    }
</style>
    @endsection
@section('contenu')
    <div class="row justify-content-center">
        <div class="col-sm-8 ">
            <div class="shadow-lg" style="background-color:#002a40">
                <div class="my-0 py-2 mr-md-auto ml-auto font-weight-normal">
                    <h6 class="text-white text-center font-weight-bold" style="font-family: 'Adamina' ">MINISTERE DE L'ENERGIE, DES MINES ET DES CARRIERES</h6>
                    <p class="small font-weight-boldc text-center text-success" style="font-family: 'Adamina';font-size: medium">SECRETARIAT PERMANENT DU CONTENU LOCAL</p>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        {{--<div class="row justify-content-center  m-auto ">--}}
        {{--<h2  class="text-center text-center"><b>MJPEE</b>/DGESS</h2>--}}
        {{--</div>--}}
        <div class="col-sm-8 ">

            <br>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="mb-4 text-sm text-gray-600 text-center font-weight-bold">
                        {{ __('Vous avez oublié votre mot de passe ? Aucun problème. Il suffit de nous communiquer votre adresse électronique et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d\'en choisir un nouveau.') }}
                    </div>
                    <div class="card">
                        <div class="card-header text-center">{{ __('Réinitialisation du mot de passe') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Adresse E-Mail') }}</label>

                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('M\'envoyer le lien de réinitialisation') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-8 shadow-lg">
            <footer class=" footer page-footer rounded footer-light footer-shadow content mt-3 container-fluid" style="background-color:#002a40;">
                <!-- Copyright -->
                <div class="footer-copyright text-center  py-2 text-muted shadow-sm text-white rounded">© Copyright 2024 : Tous droits Réservés |
                    <a type="button" class="text-primary font-italic" data-toggle="modal" data-target="#staticBackdrop"></a>
                </div>
            </footer>

        </div>

    </div>
@endsection


