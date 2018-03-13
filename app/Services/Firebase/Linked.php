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
use App\Transporteur;
use App\TypeTransporteur;
use Carbon\Carbon;

trait Linked
{
    /**
     * @param Expedition $expedition
     * @return Push
     */
    private function initializePush(Expedition $expedition, string $title = null, string $message = null)
    {
        $push = null;
        if($message == null){
            $message = sprintf("Expédition de %s à %s. Expiration le %s",
                $expedition->lieudepart,
                $expedition->lieuarrivee,
                (new Carbon($expedition->dateexpiration))->format("d/m/Y"));
        }
        if($title == null){
            $title = "Nouvelle expédition";
        }
        return new Push($title, $message);
    }

    /**
     * @param Expedition $expedition
     * @param string|null $message
     * @param string|null $titre
     * @param Carbon|null $delay
     * @return mixed
     * @throws \App\Firebase\FirebaseException
     */
    public function sendNotificationToAndoidDriverApp(Expedition $expedition, string $message = null, string $titre = null, Carbon $delay = null)
    {
        $push = $this->initializePush($expedition, $titre, $message);
        $firebase = new FirebaseBase();
        return $firebase->sendNotificationToAllDevices($push);
    }

    /**
     * @param Expedition $expedition
     * @param string|null $message
     * @param string|null $titre
     * @param Carbon|null $delay
     * @return mixed
     * @throws \App\Firebase\FirebaseException
     */
    public function sendNotificationToOneDevice(Expedition $expedition, string $message = null, string $titre = null, Carbon $delay = null)
    {
        $push = $push = $this->initializePush($expedition, $titre, $message);

        $firebaseToken = $expedition->chargement->vehicule->firebasetoken;

        $firebase = new FirebaseBase();
        return $firebase->sendNotificationToOneDevice($firebaseToken, $push);
    }

    /**
     * @param Expedition $expedition
     * @param Transporteur $transporteur
     * @throws \App\Firebase\FirebaseException
     */
    public function notifyTransporteurAccount(Expedition $expedition, Transporteur $transporteur)
    {
        $push = $push = $this->initializePush($expedition);
        $firebase = new FirebaseBase();
        $firebase->sendNotificationToSpecificTopics($push, str_replace("@",'#', $transporteur->identiteAccess->email));

        if($transporteur->typetransporteur_id == TypeTransporteur::TYPE_PROPRIETAIRE_FLOTTE)
        {
            $message = sprintf("L'expédition n°%s vous a été affectée. %s à %s. Expiration le %s",
                $expedition->reference,
                $expedition->lieudepart,
                $expedition->lieuarrivee,
                (new Carbon($expedition->dateexpiration))->format("d/m/Y"));

            $this->sendNotificationToOneDevice($expedition, $message);
        }
    }
}