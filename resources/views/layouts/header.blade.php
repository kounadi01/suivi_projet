<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom shadow-sm " style="background-color:#007bff; display:flex;flex-direction: row">
    <div class="my-0 font-weight-normal">
        <a href="{{route('dashboard')}}" class="brand-link">
            <img src={{asset('images/flag-round.png')}} alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light" style="color:white">BURKINA FASO</span>
        </a>
    </div>
    <div class="my-0 py-2 mr-md-auto ml-auto font-weight-normal" style="display: flex;flex-direction: column">
        <h6 class="text-white text-center font-weight-bold" style="font-family: 'Adamina' "><strong class="font-size-lg">MINISTERE DE L'ENERGIE, DES MINES ET DES CARRIERES</strong></h6>
    </div>

    <div class="d-flex flex-column">
        <ul class="navbar-nav  my-md-0 mr-md-3" style="display: flex;flex-direction: row">
            <!-- Authentication Links -->
            <li class="nav-item mr-2 d-flex  flex-row">
                <a class="nav-link  btn btn-primary p-2 btn-sm d-flex flex-row" href="{{ route('home') }}">
                <img src={{asset('images/icons/welcome.png')}} alt="Logo" class="img-circle" width="30px" style="opacity: .8">Acceuil
                </a>
            </li>
            <li class="nav-item mr-2 d-flex  flex-row">
                <a class="nav-link  btn btn-primary p-2 btn-sm d-flex flex-row" href="{{ route('public-approvisionement') }}">
                <img src={{asset('images/icons/approvision.png')}} alt="Logo" class="img-circle" width="30px" style="opacity: .8">Approvisionnement
                </a>
            </li>
            <li class="nav-item mr-2 d-flex  flex-row">
                <a class="nav-link  btn btn-primary p-2 btn-sm d-flex flex-row" href="{{ route('public-societes') }}">
                <img src={{asset('images/icons/company.png')}} alt="Logo" class="img-circle" width="30px" style="opacity: .8">Sociétés
                </a>
            </li>
            @guest
            <li class="nav-item mr-2 d-flex  flex-row">
                <a class="nav-link  btn btn-primary p-2 btn-sm d-flex flex-row" href="{{ route('login') }}">
                    <svg class="bi bi-box-arrow-in-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.146 11.354a.5.5 0 010-.708L10.793 8 8.146 5.354a.5.5 0 11.708-.708l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9A.5.5 0 011 8z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M13.5 14.5A1.5 1.5 0 0015 13V3a1.5 1.5 0 00-1.5-1.5h-8A1.5 1.5 0 004 3v1.5a.5.5 0 001 0V3a.5.5 0 01.5-.5h8a.5.5 0 01.5.5v10a.5.5 0 01-.5.5h-8A.5.5 0 015 13v-1.5a.5.5 0 00-1 0V13a1.5 1.5 0 001.5 1.5h8z" clip-rule="evenodd" />
                    </svg> &nbsp;{{ __('Se connecter') }}</a>
            </li>
            @else
            <li class="nav-item mr-2 d-flex  flex-row">
                <a  class="nav-link  btn btn-primary p-2 btn-sm d-flex flex-row" href="{{route('dashboard')}}" role="button" >
                <img src={{asset('images/icons/user.png')}} alt="Logo" class="img-circle" width="30px" style="opacity: .8">{{ Auth::user()->name }}
                </a>

            </li>
            @endguest

        </ul>

    </div>

</div>