<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name']; 
    public function Contacts()
    {

        return $this->hasMany('App\Contact');
    }
    
}
