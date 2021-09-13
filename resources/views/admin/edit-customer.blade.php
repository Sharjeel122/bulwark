@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
     <div class="dashboard-right-scroll-contetn container-fluid">
         @if(session()->has('alert-success'))
            <div class="alert alert-success">
                {{ session()->get('alert-success') }}
            </div>
        @endif
    <div class="row">
      <div class="col-lg-6 col-md-6  col-sm-6 col-8 my-auto">
          <div class="dashboard-right-title-tag">
              <h6 class="mb-0">Update Customer</h6>         
           </div>
      </div>
       <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
        </div>    
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">
        <form  class="account-form-style-login text-center" method="get" action="{{ route('admin.edit', $user_data->id) }}">
          @csrf()
          <div class="form-group">
              <label class="form-labels" for="username"><strong>Full Name:</strong></label> 
            <input type="text" class="form-control form-feilds" name="name" placeholder="Enter Full Name" value="{{$user_data->name}}">
          </div>

          <div class="form-group">
              <label class="form-labels" for="username"><strong>Email:</strong></label> 
            <input type="text" class="form-control form-feilds" name="email" placeholder="Enter Email" value="{{$user_data->email}}">
          </div>

          <div class="form-group">
              <label class="form-labels" for="username"><strong>Password:</strong></label>
            <input type="text" class="form-control form-feilds" name="password" placeholder="Enter Password">
          </div>
        
           <div class="text-center">
            <!-- <button type="submit" class="btn btn-default-blue w-2">Cancel</button> -->
            <button type="submit" class="btn btn-default-blue w-2">Add</button>

            </div>
        </form>

    </div>
</div>
@endsection

@section('script')

@endsection