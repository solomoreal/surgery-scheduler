
@extends('layouts.dashboard')
@section('content')

    <section class="container mt-20">
        <h1 class="my-10">Welcome {{Auth::user()->name}}</h1>

        <section class="my-5 py-5">
          <div class="container">
            <div class="row justify-content-center">
              <h3>Add Surgeon</h3>
              <div class="col-md-12">
              <form action="{{route('addSurgeon')}}" method="POST" class="w-md-80 mx-auto text-center" id="form">
                  
                @csrf
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="email" class="text-capitalize">email</label>
                      <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="nickname" class="text-capitalize">name</label>
                      <input type="text" name="name" class="form-control" id="nickname">
                    </div>
                  </div>
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="firstname" class="text-capitalize">Position</label>
                      <input type="text" name="position" class="form-control" id="firstname">
                    </div>
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="lastname" class="text-capitalize">specialization</label>
                      <input type="text" name="specialization" class="form-control" id="lastname">
                    </div>
                  </div>
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="oldpass" class="text-capitalize">password</label>
                      <input type="password" name="password" class="form-control" id="oldpass">
                    </div>
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="newpass" class="text-capitalize">comfirm Password</label>
                      <input type="password" name="comfirm_password" class="form-control" id="newpass">
                    </div>
                  </div>
                  <button class="btn btn-primary shadow text-uppercase mt-5" type="submit">
                    Add
                  </button>
                </form>
              </div>
            </div>
          </div>
        </section>
      
      
    </section>
        
@endsection