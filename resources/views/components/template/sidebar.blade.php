<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Idocs Mali</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- Infos utilisateur -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ Auth::user()->photo }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bienvenue,</span>
                <h2>{{ Auth::user()->nom }}</h2>
            </div>
        </div>

        <br />

        <!-- Menu latéral -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu principal</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('hopital.dashboard') }}"><i class="fa fa-home"></i> Accueil</a></li>

                    {{-- Agent Hôpital --}}
                    @if(Auth::user()->role === 'agent_hopital')
                    <li><a><i class="fa fa-users"></i> Naissances <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('naissances.index') }}">Liste complète</a></li>
                            <li><a href="{{ route('naissances.create') }}">Nouvelle déclaration</a></li>
                            <li><a href="#">Non traitées</a></li>
                        </ul>
                    </li>
                    @endif

                    {{-- Agent État civil --}}
                    @if(Auth::user()->role === 'agent_etat_civil')
                    <li><a><i class="fa fa-file-text-o"></i> Demandes <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Toutes les demandes</a></li>
                            <li><a href="#">En attente</a></li>
                            <li><a href="#">Traitées</a></li>
                            <li><a href="#">Rejetées</a></li>
                        </ul>
                    </li>
                    @endif

                    {{-- Admin --}}
                    @if(Auth::user()->role === 'admin')
                    <li><a><i class="fa fa-users"></i> Manager <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('managers.index') }}">Liste des managers</a></li>
                            <li><a href="{{ route('managers.create') }}">Ajouter un manager</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Structure <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Liste des Structures</a></li>
                            <li><a href="#">Ajouter une structure</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Pied de menu -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" title="Paramètres">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" title="Plein écran">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" title="Verrouiller">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" title="Déconnexion" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>