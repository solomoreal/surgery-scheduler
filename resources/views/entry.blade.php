
@extends('layouts.dashboard')
@section('content')
    
    <section class="container mt-20">
        <h1 class="my-10">Welcome {{Auth::user()->name}}</h1>

        <section class="my-5 py-5">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
              <form action="{{route('postEntry')}}" class="w-md-80 mx-auto text-center" method="POST">
                 @csrf
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="email" class="text-capitalize">patient name</label>
                      <input type="text" name="name" class="form-control" id="email">
                    </div>
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="nickname" class="text-capitalize">is this an emergency situation?</label>
                      <select type="text" name="emergency" class="form-control" id="nickname">
                          <option value="1" class="text-capitalize">yes</option>
                          <option value="0" class="text-capitalize">no</option>
                      </select>
                    </div>
                  </div>
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="firstname" class="text-capitalize">What Is the Condition name?</label>
                      <input type="text" name="condition" class="form-control" id="firstname">
                    </div>

                    <div class="col-md-5 mt-4 mx-auto">
                        <label for="firstname" class="text-capitalize">what type of surgeon is best suited for the condition?</label>
                        <small class="text-capitalize text-success">this will be used to assign the patient to the proper surgeon</small>
                        <select type="text" name="surgeon_type" placeholder="surgeon type" required class="form-control" id="firstname">
                        @if(count($surgeons) > 0)
                        <option value="" selected disabled>Select Surgeon</option>
                        @foreach($surgeons as $surgeon)
                      
                        <option value="{{$surgeon->specialization}}">{{$surgeon->specialization}}</option>
                        
                        @endforeach
                        @endif
                        </select>
                      </div>
                    
                  </div>
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="oldpass" class="text-capitalize">how urgently does this patient need surgery?</label>
                      <select type="text" name="urgency" class="form-control" id="oldpass">
                        <option value="1" class="text-capitalize">not urgent</option>
                        <option value="4" class="text-capitalize">quite urgent</option>
                        <option value="5" class="text-capitalize">urgent</option> 
                        <option value="8" class="text-capitalize">very urgent</option>
                        <option value="10" class="text-capitalize">extremely urgent</option>
                      </select>
                    </div>

                    <div class="col-md-5 mt-4 mx-auto">
                        <label for="lastname" class="text-capitalize">how severe is the condition?</label>
                        <select type="text" name="severity" class="form-control" id="lastname">
                          <option value="1" class="text-capitalize">normal</option>
                          <option value="4" class="text-capitalize">mildly severe</option>
                          <option value="5" class="text-capitalize">severe</option>
                          <option value="8" class="text-capitalize">very severe</option>
                          <option value="10" class="text-capitalize">dangerously severe</option>
                        </select>
                      </div>
                    
                  </div>
                  <button class="btn btn-primary shadow text-uppercase mt-5" type="submit">
                    Create
                  </button>
                </form>
              </div>
            </div>
          </div>
        </section>
      
    </section>
        
    @endsection 

  

  <!-- ======= Footer ======= -->
  