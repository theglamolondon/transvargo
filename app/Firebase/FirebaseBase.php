<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 22/02/2017
 * Time: 08:08
 */

namespace App\Firebase;


class  FirebaseBase
{
    protected $error;
    const FIREBASE_API_KEY = "AAAAntaYwzY:APA91bExX0nG-nPe74n9bCuNwg1-sasxX9axlgQLslxnegBoSKsF1WvWCza7ucBNBou7lVwaI3m871k2wZcsN6ho7-3AYLBd-ePWg8xk_vZtqK-jb2lAVcPUnCMnRKL8d9xG8V13LAKw";
    //const FIREBASE_API_KEY = "AIzaSyDOy52JWZj1l7jzme4avSNTSz7qyVy6v_g";
    const URL_TO_SEND = "https://fcm.googleapis.com/fcm/send";

    protected function headers() {
        return [
            "Authorization: key=".self::FIREBASE_API_KEY,
            "Content-Type: application/json"
        ];
    }

    public function getErrorInfo() {
        return $this->error;
    }

    /**
     * @param array $fields
     * @return mixed
     * @throws FirebaseException
     */
    protected function sendPushNotification(array $fields) {

        $connexion = curl_init();

        curl_setopt($connexion,CURLOPT_URL,self::URL_TO_SEND);

        curl_setopt($connexion,CURLOPT_POST,true);
        curl_setopt($connexion,CURLOPT_POSTFIELDS,json_encode($fields));

        curl_setopt($connexion,CURLOPT_HTTPHEADER,$this->headers());
        curl_setopt($connexion,CURLOPT_RETURNTRANSFER,true);

        curl_setopt($connexion,CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($connexion);

        if($result === false){
            throw new FirebaseException(curl_error($connexion),FirebaseException::GOOGLE_API_ERROR);
        }

        return $result;
    }

    /**
     * @param Push $push
     * @return mixed
     * @throws FirebaseException
     */
    public function sendNotificationToAllDevices(Push $push)
    {
        return $this->sendPushNotification(
            [
                "to" => "/topics/drivers",
                "data" => $push->getMessagePush()
            ]
        );
    }

    /**
     * @param Push $push
     * @param string $topics
     * @return mixed
     * @throws FirebaseException
     */
    public function sendNotificationToSpecificTopics(Push $push, string $topics)
    {
        return $this->sendPushNotification(
            [
                "to" => "/topics/$topics",
                "data" => $push->getMessagePush()
            ]
        );
    }

    /**
     * @param $deviceToken
     * @param Push $push
     * @return mixed
     * @throws FirebaseException
     */
    public function sendNotificationToOneDevice($deviceToken, Push $push){
        return $this->sendPushNotification(
            [
                "to" => $deviceToken,
                "data" => $push->getMessagePush()
            ]
        );
    }
}