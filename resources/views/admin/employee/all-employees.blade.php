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
              <h6 class="mb-0">All Customer</h6>
           </div>
      </div>
       <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
            <!-- <button type="file"> Upload</button>   -->

             <a href="{{ route('admin.create.employee') }}"><label class="choose-file"><i class="fa fa-user-plus"></i> Add </label></a>
        </div>
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                     <th style="width:20px;"><input type="checkbox"></th>
                     <th style="width:20px;">No.</th>
                     <th>Employee Name</th>
                     <th>Email</th>
                     <th>Contact</th>

                     <th>Action</th>
                </tr>
            </thead>
                <tbody>
                  @php
                    $i = 1;
                  @endphp
                  @foreach($employees as $employee)


                    <tr>
                        <td ><input type="checkbox"></td>
                        <td>{{ $i++ }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->contact }}</td>

                        <td class="text-right">
                            <a href="{{route('admin.edit.employee', $employee->id)}}" class="btn btn-sm btn-outline-info" title="Edit Customer Detail"><i class="fa fa-edit"></i></a>
{{--                            <a href="{{route('admin.customer.websites', $employee->id)}}" class="btn btn-sm btn-outline-primary" title="Websites Detail"><i class="fa fa-globe"></i></a>--}}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
        </table>

    </div>
</div>
@endsection


@section('script')

@endsection
