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
                        <h6 class="mb-0">All Websites</h6>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
                    <!-- <button type="file"> Upload</button>   -->

                    {{-- <a href="{{ route('admin.create.customer') }}"><label class="choose-file"><i class="fa fa-user-plus"></i> Add </label></a> --}}
                </div>
            </div>
            <hr>
            <div class="dasboard-right-main-contetent-area">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th style="width:20px;"><input type="checkbox"></th>
                        <th style="width:20px;">No.</th>
                        <th>Website</th>
                        <th>Plan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($websites as $website)

                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $i++ }}</td>
                            <td>{{$website->website}}</td>
                            <td>{{$website->get_plan->name}}</td>
                            <td class="text-right">

                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-target="#edit{{ $website->id }}"><i class="fa fa-eye"></i></button>


                                <a href="{{route('employee.report.list', $website->id)}}" class="btn btn-sm btn-outline-primary" title="View Reports"><i class="fa fa-flag"></i></a>

                            </td>
                        </tr>



                        <!-- Modal -->
                        <div class="modal fade" id="edit{{ $website->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Website Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="row p-5">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                            <label for="">Website:</label>
                                            <input type="text" class="form-control" value="{{ $website->website }}"
                                                   disabled>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                            <label for="">Seleched Plan:</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $website->get_plan->name }}" disabled>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                            <label for="">Subscription Date:</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $website->subscription_date }}" disabled>
                                        </div>



                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                            <label for="">Website Credentials:</label>
                                            <textarea name="" id="" rows="3" class="form-control"
                                                      readonly>{{ $website->website_data }}</textarea>
                                        </div>
                                        <input type="hidden" name="" id="verification-id" value={{ $website->verification }}>

                                        @hasrole('employee1')

                                         <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">

                                            <label for="">Verifield Credentials:</label>
                                            <div class="row">
                                                 @if($website->verification == '1')
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="incomplete">
                                                     <input type="radio" id="incomplete" name="verified" class="verification"  value="0|{{ $website->id }}">
                                                    Incomplete Info</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="verified">
                                                    <input type="radio" id="verified" name="verified" class="verification" value="1|{{ $website->id }}" checked>
                                            Verified</label>
                                                </div>
                                                @elseif($website->verification == '0')
                                                 <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="incomplete">
                                                     <input type="radio" id="incomplete" name="verified" class="verification"  value="0|{{ $website->id }}" checked>
                                                    Incomplete Info</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="verified">
                                                    <input type="radio" id="verified" name="verified" class="verification" value="1|{{ $website->id }}" >
                                            Verified</label>
                                                </div>
                                                @else
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="incomplete">
                                                     <input type="radio" id="incomplete" name="verified" class="verification"  value="0|{{ $website->id }}">
                                                    Incomplete Info</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="verified">
                                                    <input type="radio" id="verified" name="verified" class="verification" value="1|{{ $website->id }}" >
                                            Verified</label>
                                                </div>
                                                @endif
                                            </div>

                                        </div>
                                        <form action="{{ route('employee.reminder.email') }}" method="post" >
                                            @csrf
                                            <input type="hidden" value="{{ $website->user_id }}" name="user_id">
                                            <input type="hidden" value="{{ $website->website }}" name="website">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 text-right">
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i
                                                    class="fa fa-send"></i> reminder Email
                                            </button>
                                        </div>
                                        </form>
                                            <div class='credentials d-none'>
                                        <form action="{{ route('employee.send.email') }}" method="post" >
                                        @csrf
                                            <input type="hidden" value="{{ $website->user_id }}" name="user_id">
                                            <input type="hidden" value="{{ $website->website }}" name="website">

                                        @php

                                            $message = 'Hi '.$website->get_user->name.',
                                                We received a request to start working on your website ('.$website->website.') but unfortunately we are unable to login on Client/Webite panel due to incomplete/wrong website credentials.

                                                kindly check and resend credentials so we will start work on it.
                                                Thank You,
                                                Bulwark Support Team';
                                        @endphp

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                            <label for="">Send Email(<small style="color:red">Note:Send email to
                                                    "{{ $website->get_user->name }}" if credentials is
                                                    missing/Wrong</small>)</label>
                                            <textarea id="" name="message" class="form-control" rows="10" >
Hi {{ $website->get_user->name }},
Thank you for joining the Cyber Bulwark program, we are ready to start working on your website ({{ $website->website }}) but unfortunately we are unable to login to Website's admin panel due to incomplete/wrong website credentials.

kindly check and resend credentials so that we can start working on it.

Thank You,

Cyber Bulwark Support Team
 </textarea>

                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 text-right">
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i
                                                    class="fa fa-send"></i> Send Email
                                            </button>
                                        </div>
                                        </form>
                                        </div>
                                        @endhasrole
                                    </div>
                                </div>
                            </div>
                        </div>




                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

           val = $('#verification-id').val();


           if(val == 0){
                     $('.credentials').removeClass('d-none');
                 }else{
                    $('.credentials').addClass('d-none');
                 }

    $('.verification').on('click', function(){
        var val = $(this).val();
           val = val.split("|");
           var verified = val[0];
           var id = val[1];
           if(verified == 0){
                     $('.credentials').removeClass('d-none');
                 }else{
                    $('.credentials').addClass('d-none');
                 }
         $.ajax({
            url:"{{ route('employee.verified.website') }}",
            method:'GET',
            data:{

                verified: verified,
                id: id,
            },
            dataType:'json',
            success:function(data)
            {


            }
        });
});
});

    </script>
@endsection
