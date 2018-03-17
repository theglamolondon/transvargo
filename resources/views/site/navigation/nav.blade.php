<div class="rd-navbar-nav-wrap">
    <div class="rd-navbar-search">
        <ul class="rd-navbar-nav">
            <li class=""><a href="{{ route('accueil') }}">Accueil</a></li>
            <li class=""><a href="{{ route('services') }}">Services</a></li>
            <li class=""><a href="{{ route('apropos') }}">A Propos</a></li>

            @if(\Illuminate\Support\Facades\Auth::guest())
            <li class=""><a href="{{ route('login') }}" class=""> <i></i> Espace membre </a></li>
            <li class=""><a href="{{ route('register') }}" class=""> <i></i> Inscription </a></li>
            @else
            <li class="">
                <a href="#">Bonjour {{ request()->user()->authenticable->raisonsociale ? request()->user()->authenticable->raisonsociale : request()->user()->authenticable->prenoms }}</a>
                <ul class="rd-navbar-dropdown">
                    <li role="presentation"><a href="{{ route('client.newexpedition') }}">Nouvelle expédition</a></li>
                    <li role="presentation">
                        <a href="{{ route('client.expeditions') }}">Mes expéditions</a>
                        <ul class="rd-navbar-dropdown">
                            <li role="presentation"><a href="{{ route("client.expeditions.encours") }}">En cours</a></li>
                            <li role="presentation"><a href="{{ route("client.expeditions.programmees") }}">Programmés</a></li>
                            <li role="presentation"><a href="{{ route("client.expeditions.livrees") }}">Livrées</a></li>
                            <li role="presentation"><a href="{{ route("client.expeditions.annulees") }}">Annulées</a></li>
                        </ul>
                    </li>
                    <li role="presentation"><a href="{{ route('client.myinvoice' )}}">Mes factures</a></li>
                    <li role="presentation"><a href="{{ route('client.myaccount') }}">Mon compte</a></li>
                    <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>