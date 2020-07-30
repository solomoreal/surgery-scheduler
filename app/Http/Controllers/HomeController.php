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

        $entries = Entry::latest()->get();
        return view('schedules',compact('entries'));
    }

    public function postEntry(Request $request){

        //dd($request->all());

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
        $now = Carbon::now();
        $patient->save();
        $priority = $emergency ? 11 : (($severity + $urgency)/10);
        $entry = new Entry();
        $entry->patient_id = $patient->id;
        $entry->score = $priority;
        $entry->due_date = $now->addDay(1);
        $entry->save();
        return redirect(route('schedules'));



        
        
    }
}
