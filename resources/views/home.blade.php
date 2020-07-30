
@extends('layouts.dashboard')
@section('content')

    <section class="container mt-20">
        <h1 class="my-10">Welcome {{Auth::user()->name}}</h1>

        <section class="my-5 py-5">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <form action="" class="w-md-80 mx-auto text-center" id="form">
                  <div class="wrap-custom-file rounded-circle">
                    <input type="file" name="cover-image" id="cover-image" accept=".gif, .jpg, .png" />
                    <label for="cover-image" class="rounded-circle">
                      <i class="fa fa-user-plus" aria-hidden="true"></i>
                      <span></span>
                    </label>
                  </div>
      
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="email" class="text-capitalize">What is your email address</label>
                      <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="nickname" class="text-capitalize">What should we call you</label>
                      <input type="text" name="nickname" class="form-control" id="nickname">
                    </div>
                  </div>
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="firstname" class="text-capitalize">First Name</label>
                      <input type="text" name="firstname" class="form-control" id="firstname">
                    </div>
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="lastname" class="text-capitalize">Last Name</label>
                      <input type="text" name="lastname" class="form-control" id="lastname">
                    </div>
                  </div>
                  <div class="row text-left">
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="oldpass" class="text-capitalize">Old Password</label>
                      <input type="password" name="oldpass" class="form-control" id="oldpass">
                    </div>
                    <div class="col-md-5 mt-4 mx-auto">
                      <label for="newpass" class="text-capitalize">New Password</label>
                      <input type="password" name="newpass" class="form-control" id="newpass">
                    </div>
                  </div>
                  <button class="btn btn-primary shadow text-uppercase mt-5" type="submit">
                    Update
                  </button>
                </form>
              </div>
            </div>
          </div>
        </section>
      
      
    </section>
        
@endsection