<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 22/02/2017
 * Time: 08:13
 */

namespace App\Firebase;


class Push
{
    private $titre;
    private $message;
    private $image;

    public function __construct($titre,$message,$image=null) {
        $this->titre = $titre;
        $this->message = $message;
        $this->image = $image;
    }

    public function setPush($titre,$message,$image=null) {
        $this->__construct($titre,$message,$image);
        return $this;
    }

    public function getMessagePush() {
        return ['data' =>
            [
                "title" => $this->titre,
                "message" => $this->message,
                "image" => $this->image,
            ]
        ];
    }
}