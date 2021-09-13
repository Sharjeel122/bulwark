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
                        <h6 class="mb-0">Create Plan</h6>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">

                </div>
            </div>
            <hr>
            <div class="dasboard-right-main-contetent-area">
                <form  class=" text-center" method="get" action="{{ route('plan.create') }}">
                    @csrf()
                    <div class="form-group">
                        <label class="form-labels" for="username"><strong>Plan Name:</strong></label>
                        <input type="text" class="form-control form-feilds" name="plan_name" placeholder="Enter Plan name">
                    </div>

                    <div class="form-group">
                        <label class="form-labels" for="username"><strong>Plan Description:</strong></label>
                        <textarea name="description" id="" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-labels" for="username"><strong>Plan Price:</strong></label>
                        <input type="number" class="form-control form-feilds" step="any" name="price" placeholder="Enter Plan Price">
                    </div>


                    <div class="form-group">
                        <label class="form-labels" for="username"><strong>Frequency Month:</strong></label>
                        <input type="number" class="form-control form-feilds" name="frequency" placeholder="Number of Months for plan">
                    </div>

                    <div class="text-center">
                        <!-- <button type="submit" class="btn btn-default-blue w-2">Cancel</button> -->
                        <button type="submit" class="btn btn-default-blue w-2">Create Plan</button>

                    </div>
                </form>

            </div>
        </div>
@endsection

@section('script')

@endsection
