<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.url') }}</title>
    <link rel="stylesheet" href="{{asset('css/pdf-style.css')}}" media="all" />
    <style>
        .page{
            page-break-after: auto;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td width="50%" class="desc head">
                <div id="logo">
                    <a href="{{ config('app.url') }}"><img src="{{ asset('transvargo.png') }}"/></a>
                </div>
            </td>
            <td width="50%" class="head">
                <div id="">
                    <h2 class="name">{{ config('app.name') }}</h2>
                    <div>Cocody deux plateaux</div>
                    <div>(+225) {{ env("APP_CALL") }}</div>
                    <div><a href="mailto:contact@transvargo.com">contact@transvargo.com</a></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</header>
<main class="page">
    @yield('content')
</main>
<footer>
    {{ config('app.name') }} &copy; {{ date('Y') }}
</footer>
</body>
</html>