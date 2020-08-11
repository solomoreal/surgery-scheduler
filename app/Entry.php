<?php

namespace App;

use Carbon\Carbon;
use App\Surgeon;
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

    function adjustDueDate($score){
        $today = Carbon::today();
        $lower_entries  = Entry::latest()->where('status',0)->where('score', '<', $score)->whereDate('due_date','<=', $today)->get();
        $higher_entry  = Entry::where('status',0)->where('score', '>', $score)->whereDate('due_date','<=', $today)->get();
        foreach($lower_entries as $entry){
            $entry->due_date = Carbon::parse($entry->due_date)->addDay(1);
            $entry->update();  
        }

        // foreach($higher_entry as $hentry){

        // }

        return;
    }

    public function assignSurgeon($surgeon_type, $due_date){
        $surgeonA = Surgeon::where('status',0)->where('type', $surgeon_type)->first();
        $surgeonB = Surgeon::where('status',1)->where('type', $surgeon_type)->first();
        $entry = Entry::where('due_date',$due_date)->first();
        if($surgeonA){
            return $surgeonA;
        }else{
            if($entry->surgeon_id == $surgeonB->id){
                return false;
            }else{
                return $surgeonB;
            }
        }
    }
}
