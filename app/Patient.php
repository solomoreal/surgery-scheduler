<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function entry(){
        return $this->hasMany('App\Entry');
    }
}
