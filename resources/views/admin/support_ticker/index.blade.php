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
              <h6 class="mb-0">Support Ticket</h6>         
           </div>
      </div>
       <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
            <!-- <button type="file"> Upload</button>   -->
            
            <!--  <a href="{{ route('customer.generate.ticker') }}"><label class="choose-file"><i class="fa fa-pencil"></i> Generate Ticker </label></a> -->
        </div>    
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                     <th style="width:20px;"><input type="checkbox"></th>
                     <th style="width:20px;">No.</th>
                    <th>Customer</th>
                    <th>Customer Email</th>
                     <th>Website</th>
                     <th>Status</th>
                     <th>Priority</th>
                     <th>Action</th>
                </tr>
            </thead>
                <tbody>
                  @php
                    $i = 1;
                  @endphp
                  @foreach($tickers as $ticker)


                    <tr>
                        <td ><input type="checkbox"></td>
                        <td>{{ $i++ }}</td>
                        <td>{{ $ticker->user->name }}</td>
                        <td>{{ $ticker->user->email }}</td>
                        <td>{{ $ticker->get_ticker_website->website }}</td>
                        <td>{{ $ticker->priority }}</td>
                        @if($ticker->status == 1)
                        <td>Open</td>
                        @else
                        <td>close</td>
                        @endif
                        
                        <td class="text-right">
                            <a href="{{ route('admin.view.ticker', $ticker->id) }}"><button class="btn inline-btn tablebtn recent-user-detail-btn"><i class="fa fa-eye"></i></button></a>
                            <!-- <button class="btn inline-btn tablebtn bg-danger recent-user-detail-btn"><i class="fa fa-trash"></i></button> -->
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