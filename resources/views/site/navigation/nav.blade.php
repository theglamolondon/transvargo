<div class="rd-navbar-nav-wrap">
    <!-- Navbar Search and Customer-->
    <div class="rd-navbar-search">
        <ul class="rd-navbar-nav">
            <li class=""><a href="{{ route('accueil') }}">Accueil</a></li>
            <li class=""><a href="./">Qui sommes-nous</a></li>
            <li class=""><a href="{{ route('contact') }}">Contact</a></li>

            @if(\Illuminate\Support\Facades\Auth::guest())
            <li class=""><a href="{{ route('login') }}" class=""> <i></i> Espace membre </a></li>
            <li class=""><a href="{{ route('register') }}" class=""> <i></i> Inscription </a></li>
            @else
            <li class="">
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
            </li>
            @endif
        </ul>
    </div>

    <!-- RD Navbar Nav-->

</div>