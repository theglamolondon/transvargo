<body style="padding: 10px 0 10px 0; background-color: #eee">
<div style="width: 700px; margin-left: auto; margin-right: auto;">
    <div style="background-color: #fff">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr style="background-color: #266293;">
                <td width="100%" style="padding: 10px;" align="center">
                    <img src="{{asset('/transvargo.png')}}" height="50" alt="{{ config('app.name') }}">
                </td>
            </tr>
            <tr>
                <td style="padding-top: 30px; padding-bottom: 50px; padding-left: 20px; padding-right: 20px;" width="100%">
                    <h3>Bonjour {{ $expedition->client->prenoms }} {{ $expedition->client->nom }},</h3><br>
                    Votre expédition <strong>{{ $expedition->reference }}</strong>  a été livrée avec succès.<br><br>
                    N'hésitez pas à reprendre contact avec nous si quelque chose ne va pas ou si vous avez besoin d’informations&nbsp;: nous lisons et répondons à tous les e-mails&nbsp;!
                    <br><br>
                    Merci d'avoir utilisé {{ config('app.name') }} !
                    <br><br>
                    L'équipe {{ config('app.name') }}<br>
                </td>
            </tr>
            <tr style="background-color: #266293; color: #fff">
                <td width="100%" align="center" style="padding-top: 3px; padding-bottom: 3px;">
                    <p>&copy; {{ strtoupper(config('app.name')) }}</p>
                </td>
            </tr>
        </table>
    </div>
    <br><br>
    <div style="padding: 0 9px;">
        <small>Vous recevez cet e-mail suite à la livraison d'expédition sur la plateforme {{ config("app.name","Transvargo") }}.</small>
    </div>
</div>
</body>