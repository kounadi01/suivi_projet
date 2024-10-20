
{{--@extends('layouts.footer')--}}
@extends('layouts.master')
{{--@extends('layouts.header')--}}
@section('contenu')

    <div class="row justify-content-center py-5">
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

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">{{ __('Réinitialisation du mot de passe') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf


                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse E-Mail') }}</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ $request->email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le mot de passe') }}</label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Réinitialiser le mot de passe') }}
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
            <footer class="page-footer rounded footer-light footer-shadow content mt-3 container-fluid" style="background-color:#002a40">
                <!-- Copyright -->
                <div class="footer-copyright text-center  py-2 text-muted shadow-sm text-white rounded">© Copyright 2021 : Tous droits Réservés |
                    <a type="button" class="text-primary font-italic" data-toggle="modal" data-target="#staticBackdrop"></a>
                </div>
            </footer>

        </div>

    </div>
@endsection

