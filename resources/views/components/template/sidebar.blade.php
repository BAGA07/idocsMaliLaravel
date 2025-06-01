<!-- Sidebar -->
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span>iDocs Mali</span></a>
        </div>

        <div class="clearfix"></div>



        <br />

        <!-- Menu dynamique -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    {{-- @if (session('user')['role'] === 'citoyen') --}}
                    <li><a href="{{ url('index.php?action=new_demande') }}"><i class="fa fa-plus"></i> Nouvelle
                            demande</a></li>
                    <li><a href="#"><i class="fa fa-folder"></i> Mes demandes</a></li>
                    <li><a href="#"><i class="fa fa-users"></i> Ma famille</a></li>
                    {{-- @elseif (session('user')['role'] === 'admin') --}}
                    <li><a href="#"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
                    <li><a href="#"><i class="fa fa-user"></i> Gestion des utilisateurs</a></li>
                    <li><a href="#"><i class="fa fa-folder-open"></i> Toutes les demandes</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Paramètres</a></li>
                    {{-- @endif --}}
                </ul>
            </div>
        </div>

        <!-- Footer sidebar -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Paramètres">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Verrouiller">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Déconnexion" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>