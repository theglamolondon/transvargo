<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeIdentitite extends Model
{
    const TYPE_CLIENT = 1;
    const TYPE_TRANSPORTEUR = 2;
    const TYPE_STAFF_USER= 3;

    protected $table = "typeidentite";
    public $timestamps = false;
}
