@extends('layouts.master_login')
{{--@extends('layouts.header')--}}
@section('contenu')

<style>
    .image {
    perspective: 300px; /* Définit la perspective pour les éléments enfants */
}

.image {
    will-change: transform; /* Indique que la transformation va être appliquée */
    transform: rotateX(0deg) rotateY(0deg); /* Transformation initiale */
}

/* Exemple d'animation au survol */
.image:hover {
    transform: rotateX(20deg) rotateY(20deg); /* Rotation appliquée lors du survol */
}
</style>


<div class="row justify-content-center" style="background-color: #3c8dbc;min-height: 100vh;">
   
    <div class="col-sm-6 ">

        <div class="row justify-content-center " style="margin-top: 15%;">
            <div class="my-0 py-2 mr-md-auto ml-auto font-weight-normal" style="display: flex;flex-direction: column">
                <h6 class="text-white text-center font-weight-bold" style="font-family: 'Adamina' ">MINISTERE DE L'ENERGIE, DES MINES ET DES CARRIERES (MEMC)</h6>
                {{-- <p class="small font-weight-bold text-center text-success" style="font-family: 'Adamina';font-size: medium">DIRECTION GENERALE DES ETUDES ET DES STATISTIQUES SECTORIELLES (DGESS)</p> --}}
            </div>
            <div class="col-sm-6 " style="">
                <br>
                <div class="card card-cyan shadow-lg">
                    <!-- <div class="card-header text-center font-weight-bold">Connectez-vous pour ouvrir votre session</div> -->
                    <div class="card-body">
                        <div style="display: flex;justify-content: center;">
                            <a href="{{route('home')}}">
                                <img src="{{asset('images/armoiries-bon.png')}}" alt="IMG">
                            </a>
                        </div>

                        <div class="panel-body" style="height: 390px;">
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
                            <form method="POST" action="{{ route('login') }}" class="">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-8 offset-md-2">
                                        <label for="login" class="col col-form-label text-primary font-weight-bold">
                                            {{ __('Nom d\'utilisateur') }}
                                        </label>
                                        <input id="login" type="text" class="form-control{{ $errors->has('login') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') ?: old('email') }}" required autofocus>

                                        @if ($errors->has('login') || $errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('login') ?: $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class=" form-group col-md-8 offset-md-2">
                                        <label for="password" class="col col-form-label text-primary font-weight-bold">{{ __('Mot de passe') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row py-2">
                                    <div class="form-group col-md-8 offset-md-2">
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-checkbox">
                                                <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label text-primary font-weight-bold" for="remember">
                                                    {{ __('Se souvenir de moi') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0  justify-content-md-center">
                                    <button type="submit" class="btn-lg btn-primary align-items-center">
                                        <i class="fa fa-lock fa-fw" aria-hidden="true"></i>&nbsp;{{ __('Se connecter') }}
                                    </button>
                                </div>

                                <div class="form-group row mb-0 py-2 justify-content-md-center">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <i class="fa fa-question-circle fa-fw" aria-hidden="true"></i>&nbsp; {{ __('Avez-vous oublié votre mot de passe?') }}
                                    </a>
                                    @endif
                                </div>

                            </form>
                            {{----}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection