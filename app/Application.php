<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * @return int
     * @see Donne le nombre de minute de validatité d'un OTP
     */
    public static function getGracefulTime()
    {
        return 10;
    }
}
