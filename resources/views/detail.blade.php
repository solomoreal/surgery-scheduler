
@extends('layouts.dashboard')
@section('content')

    <section class="container mt-5">
      

        <section class="my-3 py-3">
          <div class="container">
            <div class="row justify-content-center">
              <h3>Patient Detail</h3>
              <div class="col-md-12">
                <section class="py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-8">
                        <ul class="list-group bg-transparent">
                          <li class="list-group-item bg-light border-bottom-0">
                            <span class="font-weight-bold"> Name:</span>
                          <span class="text-secondary">{{$entry->patient->name}}</span>
                          </li>
                          <li class="list-group-item bg-light">
                            <span class="font-weight-bold">Condition:</span>
                          <span class="text-secondary">{{$entry->patient->condition}}</span>
                          </li>
                          <li class="list-group-item bg-light">
                            <span class="font-weight-bold">Due Date: </span>
                            <span class="text-secondary">{{date('d M, Y',strtotime($entry->due_date))}}</span>
                          </li>
                          <li class="list-group-item bg-light">
                            <span class="font-weight-bold">Waiting Time: </span>
                            <span class="text-secondary">{{$entry->waiting_time > 0 ? $entry->waiting_time + 1 : $entry->waiting_time }} Days</span>
                          </li>
                          <li class="list-group-item bg-light">
                            <span class="font-weight-bold">Assigned Surgeon: </span>
                            <span class="text-secondary">{{$entry->surgeon->name ?? ''}}</span>
                          </li>
                          <li class="list-group-item bg-light">
                            <span class="font-weight-bold">Arrival Time: </span>
                            <span class="text-secondary">{{$entry->created_at}}</span>
                          </li>
                          <li class="list-group-item bg-light">
                            <span class="font-weight-bold">Medical Examiner: </span>
                            <span class="text-secondary">{{$entry->examiner->name}}</span>
                          </li>
                          <li class="list-group-item bg-light">
                            <span class="font-weight-bold">Status: </span>
                          <span class="text-secondary">{{$entry->status()}}</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
            
                    </section>
                
              </div>
            </div>
          </div>
        </section>
      
      
    </section>
        
@endsection