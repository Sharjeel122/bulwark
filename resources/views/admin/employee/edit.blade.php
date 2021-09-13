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
                        <h6 class="mb-0">Create Employee</h6>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
                </div>
            </div>
            <hr>
            <div class="dasboard-right-main-contetent-area">
                <form  class="account-form-style-login text-center" method="post" action="{{ route('admin.update.employee', $employee->id) }}">
                    @csrf()
                    @method('PUT')
                    @include('admin.employee._form')


                    <div class="form-group">
                        <label class="form-labels" for="username"><strong>Change Password:</strong></label>
                        <input type="text" class="form-control form-feilds" name="password" placeholder="Enter New Password" value="">
                    </div>

                    <div class="text-center">
                        <!-- <button type="submit" class="btn btn-default-blue w-2">Cancel</button> -->
                        <button type="submit" class="btn btn-default-blue w-2">Edit</button>

                    </div>
                </form>

            </div>
        </div>
@endsection

@section('script')

@endsection
