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
                        <h6 class="mb-0">Update Reports</h6>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
                    <!-- <button type="file"> Upload</button>   -->

                </div>
            </div>
            <hr>
            <div class="dasboard-right-main-contetent-area">
                <form  class="row " method="post" action="{{ route('employee.update_report', $report->id) }}" enctype='multipart/form-data'>
                    @csrf()
                    @method('PUT')
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                        <label class="form-labels" for="username"><strong>Report Title:</strong></label>
                        <input type="text" class="form-control form-feilds" name="report_title" placeholder="Enter Full Name" value="{{$report->report_title}}">
                        @if ($errors->has('report_title'))
                            <span role="alert">
              <strong class="text-danger">{{ $errors->first('report_title') }}</strong>
         </span>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                        <label class="form-labels" for="username"><strong>Customer:</strong></label>
                        <select name="user_id" id="user" class="form-control">

                            <option  value="">Select Customer</option>

                                @foreach($users as $user)
                                    @php
                                        $select = old('user_id', $user->id) == $report->user_id ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $user->id ?? old('user_id')}}" {{ $select }}>{{ $user->name }}</option>
                                @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                            <span role="alert">
              <strong class="text-danger">{{ $errors->first('user_id') }}</strong>
         </span>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                        <label class="form-labels" for="username"><strong>Website:</strong></label>
                        <div id="list">
                          <input type="text" class="form-control form-feilds" name="" placeholder="Enter Full Name" value="{{ $report->get_website->website }}" readonly>
                            <input type="hidden" class="form-control form-feilds" name="website_id" placeholder="Enter Full Name" value="{{ $report->get_website->id }}" >
                        </div>
                        @if ($errors->has('website'))
                            <span role="alert">
              <strong class="text-danger">{{ $errors->first('website') }}</strong>
         </span>
                        @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                        <label class="form-labels" for="username"><strong>Report:</strong></label>
                        <input type="file" class="form-control form-feilds" name="report" name="report" placeholder="Enter Full Name" value="">
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <!-- <button type="submit" class="btn btn-default-blue w-2">Cancel</button> -->
                        <button type="submit" class="btn btn-default-blue w-2">Update</button>

                    </div>
                </form>
            </div>
        </div>


        @endsection


        @section('script')
            <script>
                $(document).ready(function(){

                    $('#user').on('change', function(){
                        var user = $('#user').val();
                        $.ajax({
                            url:"{{ route('employee.user_website') }}",
                            method:'POST',
                            data:{
                                "_token": "{{ csrf_token() }}",
                                user_id: user,
                            },
                            dataType:'json',
                            success:function(data)
                            {
                                console.log(data);

                                $('#list').html(data);
                            }
                        });
                    });

                });


            </script>
@endsection
