<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#002a40;background-image: url('images/ba.jpg')">
            <!-- Brand Logo -->
            <a href="{{route('dashboard')}}" class="brand-link">
                <img src={{asset('images/flag-round.png')}} alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SUIVI PROJET</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="{{route('dashboard')}}" class="nav-link 
                            @if(request()->route()->getName() == 'dashboard') active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Tableau de bord
                                    {{--<i class="right fas fa-angle-left"></i>--}}
                                </p>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link @if(request()->route()->getName() == 'structures.index') active @endif">
                                <i class="nav-icon  fa fa-folder-open"></i>
                                <p class="">
                                    Parametrage
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(\App\Models\User::authUserProfil()->nom=='Administrateur' )
                                <li class="nav-item">
                                    <a href="{{ route('structures.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon fa fa-university"></i>
                                        <p>Structure</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('societes.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon fa fa-university"></i>
                                        <p>Société</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('annee-exercices.index') }}" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Année exercice</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('phases.index') }}" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Nature du projet</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('composantes.index') }}" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Composantes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('bailleurs.index') }}" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Bailleurs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('coordonateurs.index') }}" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Coordonateurs</p>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('produits.index') }}" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Biens/services</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('fournisseurs.index') }}" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Entreprises</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(\App\Models\User::authUserProfil()->nom=='Administrateur' )
                        <li class="nav-item">

                            <a href="{{ route('listeProduits.index') }}" 
                            class="nav-link @if(request()->route()->getName() == 'listeProduits.index') active @endif">
                                <i class="far fa fa-cog nav-icon"></i>
                                <p class="">
                                    Liste des projets
                                    <!-- <i class="fas fa-angle-left right"></i> -->
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link @if(request()->route()->getName() == 'profils.index') active @endif">
                                <i class="nav-icon fas fa-users "></i>
                                <p class="text">Gestion des utilisateurs
                                    <i class="fas fa-angle-left right"></i>
                                </p>

                            </a>
                            <ul class="nav nav-treeview">
                                @if(\App\Models\User::authUserProfil()->nom=='Administrateur' )
                                <li class="nav-item">
                                    <a href="{{route('profils.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon fa fa-id-card"></i>
                                        <p>Profil-Utilisateurs</p>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{route('user.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon fa fa-user"></i>
                                        <p>Utilisateurs</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>