<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 13/10/2017
 * Time: 11:30
 */

namespace App\Services\Sms;


class FreeSmsSender
{
    public static function sendSMS($contact, $message)
    {
        $sPhoneNum = sprintf('+225%s', $contact); // Le numéro de téléphone qui recevra l'SMS (avec le préfixe, ex: +33)
        //$sPhoneNum = '+22547631443'; // Le numéro de téléphone qui recevra l'SMS (avec le préfixe, ex: +33)
        $aProviders = array('vtext.com', 'tmomail.net', 'txt.att.net', 'mobile.pinger.com', 'page.nextel.com');
        foreach ($aProviders as $sProvider)
        {
            if(mail($sPhoneNum . '@' . $sProvider . '.com', '', $message))
            {
                // C'est bon, l'SMS a correctement été envoyé avec le fournissuer
                break;
            }
            else
            {
                // L'envoi de l'SMS a échoué avec le fournisseur, nous en essayons un autre dans la liste $aProviders
                continue;
            }
        }
    }
}