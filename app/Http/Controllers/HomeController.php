<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Entry;
use App\Surgeon;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function detail(){
        return view('detail');
    }

    public function schedules(){
        //$entry = new Entry();
        //return $entry->checkDueDate(8);
        $entries = Entry::latest()->get();
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
        $surgeon =  assignSurgeon($request->surgeon_type);
        if($surgeon == false){
            return back()->with("All $request->surgeon_type Are Booked For The Period ");
        }
        $priority = $emergency ? 11 : (($severity + $urgency)/2);
        $entry = new Entry();
        $entry->patient_id = $patient->id;
        $entry->score = $priority;
        $entry->adjustDueDate($priority);

        $lower_entry  = Entry::where('status',0)->where('score', '<', $priority)->orderBy('due_date', 'desc')->first();
        $higher_entry  = Entry::where('status',0)->where('score', '>', $priority)->orderBy('due_date', 'asc')->first();
        if($lower_entry ?? false){
            $entry->due_date = Carbon::parse($lower_entry->due_date)->subDay(1);
        }
        if($higher_entry ?? false){
            $entry->due_date = Carbon::parse($higher_entry->due_date)->addDay(1);
        }
        if($higher_entry == null && $lower_entry == null){
            $entry->due_date = $today;
        }
        $surgeon =  assignSurgeon($request->surgeon_type,$entry->due_date);
        if($surgeon == false){
            return back()->with("All $request->surgeon_type Are Booked For The Period ");
        }
        $entry->surgeon_id = $surgeon->id;
        $entry->save();
        return redirect(route('schedules'));
        
    }
}
