<body style="padding: 10px 0 10px 0; background-color: #eee">
<div style="width: 700px; margin-left: auto; margin-right: auto;">
    <div style="background-color: #fff">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr style="background-color: #266293;">
                <td width="100%" style="padding: 10px;" align="center">
                    <img src="{{config('app.url')}}/images/transvargo-logo.png" height="50" alt="{{ config('app.name') }}">
                </td>
            </tr>
            <tr>
                <td style="padding-top: 30px; padding-bottom: 50px; padding-left: 20px; padding-right: 20px;" width="100%">
                    <h3>Bonjour {{ $expedition->client->prenoms }} {{ $expedition->client->nom }},</h3><br>
                    Votre expédition <strong>{{ $expedition->reference }}</strong>  a été acceptée par un transporteur.<br><br>

                    Afin de regler les frais d'expédition, merci de cliquer sur le bouton ci-dessous&nbsp;:<br><br><br><br>

                    <div align="center">
                        <a href="{{ route("payment.choice",[ "reference" => $expedition->refrence ]) }}" style="text-decoration: none; color: #ffffff; background-color: #0184F2; border-color: #266293; padding-top: 12px; padding-bottom: 12px; padding-right: 18px; padding-left: 18px; font-size: 16px; font-weight: bold;">
                            PAYER LES FRAIS D'EXPEDITION
                        </a>
                        <br><br>
                        <small>Si vous ne pouvez pas cliquer sur le bouton, copier-coller le lien suivant dans votre navigateur : {{ route("payment.choice",[ "reference" => $expedition->refrence ]) }}</small>

                    </div>
                    <br><br>
                    N'hésitez pas à reprendre contact avec nous si quelque chose ne va pas ou si vous avez besoin d’informations&nbsp;: nous lisons et répondons à tous les e-mails&nbsp;!
                    <br><br>
                    Bons transports avec {{ config('app.name') }} !
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
    <div>
        <small>Vous recevez cet e-mail suite à la publication d'une expédition sur la plateforme {{ config("app.name","Transvargo") }}.</small>
    </div>
</div>
</body>