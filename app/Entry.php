<?php

namespace App;

use Carbon\Carbon;
use App\Surgeon;
use App\Process;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    public function surgeon(){
        return $this->belongsTo('App\Surgeon');
    }

    public function examiner(){
        return $this->belongsTo('App\User','examiner_id');
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

    public function getPoissonRandom($mean) {
        $L = (float)exp(-$mean);
        //dd($L);
         $k = 0;
         $p = 1.0;
        do {
            $p = $p * rand(1,200);
            $k++;
            $process = new Process();
            $process->arrival_time = $k - 1;
            $process->burst_time = rand(1,5);
            $process->save();
        } while ($k < 50);
        
        
        return $k - 1;
    }

    function adjustDueDate($score){
        $today = Carbon::today();
        $lower_entries  = Entry::latest()->where('status',0)->where('score', '<', $score)->whereDate('due_date','>=', $today)->get();
        $higher_entry  = Entry::where('status',0)->where('score', '>', $score)->whereDate('due_date','<=', $today)->get();
        foreach($lower_entries as $entry){
            $entry->due_date = Carbon::parse($entry->due_date)->addHours(24);
            $entry->update();  
        }

        return;
    }

    public function assignSurgeon($surgeon_type, $due_date,$score){
        $surgeonA = Surgeon::where('status',0)->where('specialization', $surgeon_type)->first();
        $surgeonB = Surgeon::where('status',1)->where('specialization', $surgeon_type)->first();
        $entry = Entry::where('due_date',$due_date)->where('score','>', $score)->first();
        if($surgeonA){
            return $surgeonA;
        }else{
            if($surgeonB && $entry && $entry->surgeon_id == $surgeonB->id){

                return false;
            }elseif($surgeonB){
                return $surgeonB;
            }else{
                return false;
            }
        }
    }
}
