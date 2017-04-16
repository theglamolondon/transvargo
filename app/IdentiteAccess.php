<?php

namespace App;

use App\Work\Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class IdentiteAccess extends Authenticatable
{
    use Notifiable;

    protected $table = 'identiteaccess';
    public $timestamps = false;

    protected $authenticable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','statut','ville_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','password', 'remember_token',
    ];

    public function authenticable(){

        if ($this->client())
            return $this->client();

        if ($this->transporteur())
            return $this->transporteur();

        if ($this->administrateur())
            return $this->administrateur();

        //return $this->hasOne('App\Work\Authenticable');
    }

    public function client(){
        return $this->hasOne('App\Client','identiteaccess_id');
    }

    public function transporteur(){
        return $this->hasOne('App\Transporteur','identiteaccess_id');
    }

    public function administrateur(){
        return $this->hasOne('App\Transporteur','identiteaccess_id');
    }

    public function setAuthenticable(Authenticable $authenticable){
        $this->authenticable = $authenticable;
    }

    public function getAuthenticable(){
        return $this->authenticable;
    }
}
