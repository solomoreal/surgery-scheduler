<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Entry;
use App\Priority;
use App\Process;
use App\Surgeon;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entry = new Entry();
        return view('home');
    }

    public function generateInput(){
        
        //dd($randi);
        $processes = Process::latest()->get();
        if(count($processes) < 200){
            $entry = new Entry();
            $mean = 0.000034;
            $randi = $entry->getPoissonRandom($mean);
        }
        $processes = Process::orderBy('id', 'asc')->take(50)->get();
        return view('process_data',compact('processes'));
    }

    public function schedules(){

        $processes = Process::orderBy('id', 'asc')->take(50)->get();
        
        //$last_completion_time = count($prios) > 0 ? $prios->first()->completion_time : 0;
        $prioss = Priority::orderBy('id','desc')->get();
        if(count($prioss) < 1){
            foreach($processes as $process){
                $prios = Priority::orderBy('id','desc')->get();
                $last_completion_time = count($prios) > 0 ? $prios->first()->completion_time : 0;
                $priority = new Priority();
                $priority->arrival_time = $process->arrival_time;
                $priority->burst_time = $process->burst_time;
                $priority->completion_time = $priority->burst_time + $last_completion_time;
                $priority->turnaround_time = $priority->completion_time - $priority->arrival_time;
                $priority->waiting_time = $priority->turnaround_time - $priority->burst_time;
                $priority->save(); 
            }
        }
        
        $entries = Priority::orderBy('id','asc')->take(50)->get();
        $total_waiting_time = Priority::orderBy('id','asc')->take(50)->sum('waiting_time');
        $average_waiting_time = $total_waiting_time/count($entries);
        $total_turnaround_time = Priority::orderBy('id','asc')->take(50)->sum('turnaround_time');
        $average_turnaround_time = $total_turnaround_time/count($entries);
        //dd($average_waiting_time);
        return view('priority',compact('entries','average_waiting_time','average_turnaround_time'));
    }

    public function allSchedules(){
        $entries = Entry::orderBy('due_date','asc')->get();
        $entries->transform(function($entry, $key){
           $entry->due_date = new Carbon($entry->due_date);
           $entry->waiting_time = $entry->due_date->diffInDays($entry->created_at);
           return $entry;
        });
        return view('all_schedule',compact('entries'));
    }

    public function entry(){
        $surgeons = Surgeon::latest()->get()->unique('specialization');
        return view('entry',compact('surgeons'));
    }

    public function detail($id){
        $entry = Entry::findOrFail($id);
        $entry->due_date = new Carbon($entry->due_date);
        $entry->waiting_time = $entry->due_date->diffInDays($entry->created_at);
        return view('detail',compact('entry'));
    }

    public function postEntry(Request $request){
        $condition = $request->condition;
        $severity = $request->severity;
        $urgency = $request->urgency;
        $emergency = $request->emergency;

        $patient = new Patient();
        $patient->name = $request->name;
        $patient->condition = $request->condition;
        $patient->severity = $request->severity;
        $patient->urgency = $request->urgency;
        $patient->emergency = $request->emergency;
        $today = Carbon::today();
        $patient->save();
        
        $priority = $emergency ? 11 : (($severity + $urgency)/2);
        $entry = new Entry();
        $entry->patient_id = $patient->id;
        $entry->score = $priority;
        $entry->examiner_id = auth()->user()->id;
        $entry->adjustDueDate($priority);

        $lower_entry  = Entry::where('status',0)->where('score', '<', $priority)->orderBy('due_date', 'asc')->first();
        $higher_entry  = Entry::where('status',0)->where('score', '>', $priority)->orderBy('due_date', 'desc')->first();
        if($lower_entry ?? false){
            $entry->due_date = Carbon::parse($lower_entry->due_date)->subDay(1);
        }
        if($higher_entry ?? false){
            $entry->due_date = Carbon::parse($higher_entry->due_date)->addDay(1);
        }
        if($higher_entry == null && $lower_entry == null){
            $entry->due_date = $today;
        }
        $surgeon =  $entry->assignSurgeon($request->surgeon_type,$entry->due_date,$priority);
        if($surgeon == false){
            //dd($surgeon);
            return back()->with('error',"All $request->surgeon_type Are Booked For The Period ");
        }
        $entry->surgeon_id = $surgeon->id;
        $surgeon->status = 1;
        $surgeon->update();
        $entry->save();
        return redirect(route('schedules'));        
    }

    public function addSurgeon(Request $request){
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        $surgeon = new Surgeon();
        $surgeon->name = $request->name;
        $surgeon->user_id = $user->id;
        $surgeon->position = $request->position;
        $surgeon->role = 2;
        $surgeon->specialization = $request->specialization;
        $surgeon->status = 0;
        $surgeon->save();
        return back();
    }

    public function complete($id){
        $entry = Entry::findOrFail($id);
        $entry->status = 1;
        $entry->update();
        return back()->with('message','The Process Is Now Marked Completed');
    }

    public function cancel($id){
        $entry = Entry::findOrFail($id);
        $entry->status = 2;
        $entry->update();
        return back()->with('message','The Process Is Now Marked Cancelled');
    }

   public function getrandom(){
    //
   }
}
