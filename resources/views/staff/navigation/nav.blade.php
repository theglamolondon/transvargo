<div class="rd-navbar-nav-wrap">
    <div class="rd-navbar-search">
        <ul class="rd-navbar-nav">
            <li class=""><a href="{{route('admin.tableaubord')}}">Tableau de bord</a></li>
            <li class=""><a href="{{ '#' }}">Grand compte</a></li>
            <li class="">
                <a href="{{ route('accueil') }}">Transporteurs</a>
                <ul class="rd-navbar-dropdown">
                    <li role="presentation"><a href="{{ route('admin.transporteur.recents') }}">Inscrits récemment</a></li>
                    <li role="presentation"><a href="{{ route('admin.transporteur.all') }}">Tous</a></li>
                </ul>
            </li>
            <li class=""><a href="{{ route('contact') }}">Contact</a></li>
            <li>
                <a href="#">Bonjour {{ request()->user()->authenticable->prenoms ? request()->user()->authenticable->prenoms : request()->user()->authenticable->nom }}</a>
                <ul class="rd-navbar-dropdown">
                    <li role="presentation"><a href="#">Mon profil</a></li>
                    <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>