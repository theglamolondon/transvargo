<?php

namespace App;

use App\Services\Statut;
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
        'email', 'password','statut','ville','terms','typeidentite_id','activate_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','password', 'remember_token',
    ];

    public function getId(){
        return $this->id;
    }

    public function authenticable()
    {

        if ( $this->typeidentite_id == TypeIdentitite::TYPE_CLIENT )
            return $this->client();

        if ( $this->typeidentite_id == TypeIdentitite::TYPE_TRANSPORTEUR)
            return $this->transporteur();

        if ( $this->typeidentite_id == TypeIdentitite::TYPE_STAFF_USER )
            return $this->staff();

        //return $this->hasOne('App\Work\Authenticable');
    }

    public function client(){
        return $this->hasOne(Client::class,'identiteaccess_id');
    }

    public function transporteur(){
        return $this->hasOne(Transporteur::class,'identiteaccess_id');
    }

    public function staff(){
        return $this->hasOne(Staff::class,'identiteaccess_id');
    }

    public function setAuthenticable(Authenticable $authenticable){
        $this->authenticable = $authenticable;
    }

    public function getAuthenticable(){
        return $this->authenticable;
    }

    public function activateCheck()
    {
        if ($this->statut == Statut::create(Statut::TYPE_IDENTITE_ACCESS , Statut::ETAT_ACTIF , Statut::AUTRE_NON_CONFRIME))
            return false;
        else
            return true;
    }
}
