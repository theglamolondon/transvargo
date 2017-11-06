<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 03/10/2017
 * Time: 09:45
 */

namespace App\Services\Firebase;


use App\Expedition;
use App\Firebase\FirebaseBase;
use App\Firebase\Push;
use Carbon\Carbon;

trait Linked
{
    public function sendNotificationToAndoidDriverApp(Expedition $expedition)
    {
        $push = new Push("Nouvelle expédition",sprintf("Expédition de %s à %s. Expiration le %s",
            $expedition->lieudepart,
            $expedition->lieuarrivee,
            (new Carbon($expedition->dateexpiration))->format("d/m/Y"))
        );
        $firebase = new FirebaseBase();
        return $firebase->sendNotificationToAllDevices($push);
    }
}