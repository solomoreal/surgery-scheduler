<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Entry;
use App\Surgeon;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function entry(){
        return view('entry');
    }

    public function detail($id){
        $entry = Entry::findOrFail($id);
        return view('detail',compact('entry'));
    }

    public function schedules(){
        //$entry = new Entry();
        //return $entry->checkDueDate(8);
        $entries = Entry::orderBy('due_date','asc')->get();
        $entries->transform(function($entry, $key){
           $entry->due_date = new Carbon($entry->due_date);
           $entry->waiting_time = $entry->due_date->diffInDays($entry->created_at);
           
        return $entry;
        });
        return view('schedules',compact('entries'));
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
}
