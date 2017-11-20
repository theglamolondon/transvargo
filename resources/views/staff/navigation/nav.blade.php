<div class="rd-navbar-nav-wrap">
    <div class="rd-navbar-search">
        <ul class="rd-navbar-nav">
            <li class="">
                <a href="{{route('admin.tableaubord')}}">Tableau de bord</a>
                <ul class="rd-navbar-dropdown">
                    <li role="presentation"><a href="{{ route('staff.offres') }}">Liste des offres</a></li>
                    <li role="presentation"><a href="{{ route('staff.map.expedition') }}">Géolocalisation des expéditions</a></li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:void(0);">Clients</a>
                <ul class="rd-navbar-dropdown">
                    <li role="presentation"><a href="{{ route('admin.expediteur.all') }}">Expéditeurs</a></li>
                    <li role="presentation"><a href="{{ route('staff.gc.liste') }}">Grands comptes</a></li>
                    <li role="presentation"><a href="{{ route('staff.gc.search') }}">Recherche</a></li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:void(0);">Transporteurs</a>
                <ul class="rd-navbar-dropdown">
                    <li role="presentation"><a href="{{ route('admin.transporteur.recents') }}">Inscrits récemment</a></li>
                    <li role="presentation"><a href="{{ route('admin.transporteur.all') }}">Tous</a></li>
                </ul>
            </li>
            <li class=""><a href="javascript:void(0);">Administration</a>
                <ul class="rd-navbar-dropdown">
                    <li class="presentation"><a href="javascript:void(0);">Utilisateurs</a>
                        <ul class="rd-navbar-dropdown">
                            <li class="presentation"><a href="{{ route("staff.user.ajout") }}">Ajouter</a></li>
                            <li class="presentation"><a href="{{ route("staff.user.liste") }}">Liste</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">Bonjour {{ request()->user()->authenticable->prenoms ? request()->user()->authenticable->prenoms : request()->user()->authenticable->nom }}</a>
                <ul class="rd-navbar-dropdown">
                    <li role="presentation"><a href="#">Mon profil</a></li>
                    <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>