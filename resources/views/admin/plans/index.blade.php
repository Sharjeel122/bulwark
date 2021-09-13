@extends('layouts.app')

@section('style')
    <style>
        .modal-content {
            top: 150px;
        }
    </style>
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
              <h6 class="mb-0">All Customer</h6>
           </div>
      </div>
       <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
            <!-- <button type="file"> Upload</button>   -->

             <a href="{{ route('paypal-plan.create') }}"><label class="choose-file"><i class="fa fa-user-plus"></i>Create New Plan </label></a>
        </div>
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                     <th style="width:20px;"><input type="checkbox"></th>
                     <th style="width:20px;">No.</th>
                     <th>Plan Id</th>
                     <th>Plan Name</th>
                     <th>Monthly($)</th>
                     <th>Frequency Month</th>
                     <th>Status</th>
                     <th>Action</th>
                </tr>
            </thead>
                <tbody>
                  @php
                    $i = 1;
                  @endphp
                  @foreach($plans as $plan)


                    <tr>
                        <td ><input type="checkbox"></td>
                        <td>{{ $i++ }}</td>
                        <td>{{ $plan->plan_id }}</td>
                        <td>{{ $plan->name }}</td>
                        <td>{{$plan->price}}</td>
                        <td>{{$plan->frequency_month}}</td>
                        <td>{{$plan->status}}</td>
                        <td class="text-right">
                            @if($plan->status != 'ACTIVE')
                            <a href="{{ route('plan.activate', $plan->id) }}" class="btn inline-btn tablebtn recent-user-detail-btn" title="Activate Plan"><i class="fa fa-check"></i></a>
                                <button type="button" class="btn inline-btn tablebtn bg-danger plan-id" title="Delete Plan" value="{{ $plan->id }}"><i class="fa fa-trash"></i></button>
                            @endif
                                <a href="{{ route('plan.update', $plan->id) }}" class="btn inline-btn tablebtn recent-user-detail-btn" title="Update Plan"><i class="fa fa-pencil-square-o"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
        </table>

    </div>
</div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
{{--                <div class="modal-header">--}}
{{--                    <h4 class="modal-title">Modal Heading</h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                </div>--}}

                <!-- Modal body -->
                <div class="modal-body sweet-alert text-center">
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i></p>

                    Are you sure you wan to delete this Plan?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <a href="#" class="btn  bg-danger delete-plan text-white">Delete</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('script')
        <script>
            $(document).ready(function() {
                $('.plan-id').click(function() {
                    var id = $(this).attr("value");

                    $('#myModal').modal({backdrop: 'static', keyboard: false}, 'show');


                    var url = "/plan/"+id+"/delete";
                    $('.delete-plan').attr("href", url);
                });
            });
        </script>
@endsection
