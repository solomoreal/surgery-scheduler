
@extends('layouts.dashboard')
@section('content')

    <section class="container mt-20">
        <h1 class="my-10">Welcome {{Auth::user()->name}}</h1>

        <section class="my-5 py-5">
          <div class="container">
            <div class="row justify-content-center">
              <h3>Patient Detail</h3>
              <div class="col-md-12">
                    {{$entry->patient->name}}
              </div>
            </div>
          </div>
        </section>
      
      
    </section>
        
@endsection