<?php

namespace App\Http\Controllers;

use App\Patient;
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

    public function postDetail(Request $request){

        $condition = $request->condition;
        $severity = $request->severity;
        $urgency = $request->urgency;

        $patient = new Patient();
        $patient->name = $request->name;
        $patient->condition = $request->condition;
        $patient->severity = $request->severity;
        $patient->urgency = $request->urgency;
        
        
        $patient->save();
        $priority = ($condition + $severity + $urgency)/10;
        
        // name
        //     $table->string('condition')->nullable();
        //     $table->smallInteger('severity')->nullable();
        //     $table->smallInteger('urgency')->nullable();
    }
}
