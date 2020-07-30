<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    public function surgeon(){
        return $this->belongsTo('App\Surgeon');
    }

    public function status(){
        if($this->status == 0){
            return 'Pending';
        }

        if($this->status == 1){
            return 'Complete';
        }

        if($this->status == 2){
            return 'Cancelled';
        }
    }
}
