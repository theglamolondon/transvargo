<div class="rd-navbar-nav-wrap">
    <!-- RD Navbar Nav-->
    <ul class="rd-navbar-nav">
        <li class=""><a href="{{ route('transporteur.tableaubord') }}">Tableau de bord</a></li>
        <!--
        <li role="presentation" class="">
            <a href="javascript:void(0);">Offres de fret</a>
            <ul class="rd-navbar-dropdown">
                <li role="presentation"><a href="{{ route('transporteur.offres.map') }}">Cartographie</a></li>
                <li role="presentation"><a href="{{ route('transporteur.offres.liste') }}">Liste</a></li>
            </ul>
        </li>
        -->
        <li class=""><a href="{{ route('transporteur.chargement') }}">Mes chargements</a></li>
        <li class="">
            <a href="javascript:void(0)">{{ request()->user()->authenticable->raisonsociale ? request()->user()->authenticable->raisonsociale : request()->user()->authenticable->prenoms }}</a>
            <ul class="rd-navbar-dropdown">
                <li class=""><a href="{{ route("update.transporteur") }}">Mon profil</a></li>
                <li><a href="{{ route('logout') }}">Deconnexion</a></li>
            </ul>
        </li>

    </ul>
</div>