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
              <h6 class="mb-0">Profile Information</h6>         
           </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
       
      </div>      
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">
        <form  class="row" action="{{ route('admin.update', Auth::user()->id ) }}" method="post">
            @csrf
            @method('PUT')
            <div class="col-md-4 col-lg-4 col-sm-4 col-12 pb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-12 pb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-12 pb-3">
                <label>Password</label>
                <input type="text" name="password" class="form-control" >
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-12 pt-3">
            <button type="submit" class="btn btn-default-blue w-2">Add</button>
        </div>
        </form>
             

    </div>
</div>
@endsection


@section('script')

@endsection