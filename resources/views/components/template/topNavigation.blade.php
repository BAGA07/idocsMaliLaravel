<!-- Top Navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">

                <!-- Profil utilisateur -->
                <li class="nav-item dropdown" style="padding-left: 15px;">
                    <a href="#" class="nav-link dropdown-toggle user-profile" id="navbarDropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('gentelella/assets/images/img.jpg') }}" alt="Avatar utilisateur">
                        {{ Auth::user()->name ?? 'Utilisateur' }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="">Profil</a>
                        <a class="dropdown-item" href="#">
                            <span class="badge bg-danger float-right">50%</span>
                            <span>Paramètres</span>
                        </a>
                        <a class="dropdown-item" href="#">Aide</a>
                        <a class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out float-right"></i> Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-success">6</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                        @for($i = 0; $i < 4; $i++) <a class="dropdown-item d-flex align-items-start" href="#">
                            <span class="image mr-2">
                                <img src="{{ asset('assets/images/img.jpg') }}" alt="Image Profil" />
                            </span>
                            <div class="message">
                                <strong>John Smith</strong>
                                <span class="time d-block">il y a 3 min</span>
                                <span>Film festivals used to be do-or-die moments...</span>
                            </div>
                            </a>
                            @endfor
                            <div class="text-center mt-2">
                                <a class="dropdown-item" href="#"><strong>Voir toutes les alertes</strong> <i
                                        class="fa fa-angle-right"></i></a>
                            </div>
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</div>
<!-- /Top Navigation -->