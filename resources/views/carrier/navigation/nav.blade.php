<div class="rd-navbar-nav-wrap">
    <!-- RD Navbar Nav-->
    <ul class="rd-navbar-nav">
        <li class=""><a href="{{ route('transporteur.tableaubord') }}">Tableau de bord</a></li>
        <li role="presentation" class="">
            <a href="javascript:void(0);">Offres de fret</a>
            <ul class="rd-navbar-dropdown">
                <li role="presentation"><a href="{{ route('transporteur.offres.map') }}">Cartographie</a></li>
                <li role="presentation"><a href="{{ route('transporteur.offres.liste') }}">Liste</a></li>
            </ul>
        </li>
        <li class=""><a href="#">Mes chargements</a></li>
        <li class=""><a href="#">Factures</a></li>
        <li class=""><a href="#">Mon profil</a></li>
        <li class=""><a href="{{ route('logout') }}">Deconnexion</a></li>
    </ul>
</div>