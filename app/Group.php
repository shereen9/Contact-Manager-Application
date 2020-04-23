<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function Contacts()
    {

        return $this->hasMany('App\Contact');
    }
    
}
