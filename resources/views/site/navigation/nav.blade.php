<div class="rd-navbar-nav-wrap">
    <!-- Navbar Search and Customer-->
    <div class="rd-navbar-search">
        <form action="" method="POST" class="rd-navbar-search-form">
            <label class="rd-navbar-search-form-input">
                <input type="text" name="s" placeholder="Recherche..." autocomplete="off">
            </label>
            <button type="submit" class="rd-navbar-search-form-submit fa-shopping-cart"></button>
        </form>
        <span class="rd-navbar-live-search-results"></span>
        <button data-rd-navbar-toggle=".rd-navbar-search, .rd-navbar-live-search-results" type="submit" class="rd-navbar-search-toggle"></button>
    </div>

    <!-- RD Navbar Nav-->
    <ul class="rd-navbar-nav">
        <li class="active"><a href="{{ route('accueil') }}">Accueil</a></li>
        <li class=""><a href="./">Qui sommes-nous</a></li>
        <li><a href="#">Nos services</a></li>
        <li class=""><a href="{{ route('contact') }}">Contact</a></li>

        <li class="active">
            @if(\Illuminate\Support\Facades\Auth::guest())
                <a href="{{ route('login') }}" class=""> <i></i> Connexion </a>
            @else
                <li>
                    <a href="#">Salut {{ request()->user()->authenticable->prenoms }}</a>
                    <ul class="rd-navbar-dropdown">
                        <li><a href="{{ route('client.tableaubord') }}">Tableau de bord</a></li>
                        <li role="presentation"><a href="{{ route('client.newexpedition') }}">Nouvelle expédition</a></li>
                        <li role="presentation"><a href="{{ route('client.myexpedition') }}">Mes expéditions</a></li>
                        <li role="presentation"><a href="{{ route('client.myinvoice' )}}">Mes factures</a></li>
                        <li role="presentation"><a href="{{ route('client.myaccount') }}">Mon compte</a></li>
                        <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                    </ul>
                </li>
                <a href="#" class="fa-shopping-cart"><span>10</span></a>
            @endif
        </li>
    </ul>
</div>