@extends('layouts._site')

@section('content')
    <section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li class="">Client</li>
            <li class="active">Tableau de bord</li>
        </ol>
    </section>

    <section class="section section-inset-1">
        <div class="container">
            <ul class="nav nav-pills">
                <li role="presentation" @if($id == '000')class="active" @endif ><a href="{{ route('client.tableaubord') }}">Accueil</a></li>
                <li role="presentation" @if($id == '001')class="active" @endif ><a href="{{ route('client.tableaubord.newexpedition',['id' => '001']) }}">Nouvelle expédition</a></li>
                <li role="presentation" @if($id == '002')class="active" @endif ><a href="{{ route('client.tableaubord.myexpedition',['id' => '002']) }}">Mes expéditions</a></li>
                <li role="presentation" @if($id == '003')class="active" @endif ><a href="{{ route('client.tableaubord.myinvoice',['id' => '003'] )}}">Mes factures</a></li>
                <li role="presentation" @if($id == '004')class="active" @endif ><a href="{{ route('client.tableaubord.myaccount',['id' => '004']) }}">Mon compte</a></li>
            </ul>

            <section>
                @if($id == '000') @include('site.dashboard.index') @endif
                @if($id == '001') @include('site.dashboard.newexpedition') @endif
                @if($id == '003') @include('site.dashboard.myaccount') @endif
            </section>
        </div>
    </section>
@endsection