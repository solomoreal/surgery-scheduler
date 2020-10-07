
@extends('layouts.dashboard')
@section('content')

    <section class="container mt-20">
        <h1 class="my-10">Welcome {{Auth::user()->name}}</h1>

        <section class="my-5 py-5">
          <div class="container">
            <div class="row justify-content-center">
            <h3><a class="btn btn-primary shadow text-uppercase mt-5" href="{{route('generateInput')}}">
                Click Here To Generate Random Input
              </a></h3>
              <div class="col-md-12">
                                
            
              </div>
            </div>
          </div>
        </section>
      
      
    </section>
        
@endsection