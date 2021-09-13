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
              <h6 class="mb-0">{{$website_detail->website}} Detail</h6>
           </div>
      </div>
       <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
            <!-- <button type="file"> Upload</button>   -->

             {{-- <a href="{{ route('customer.generate.ticker') }}"><label class="choose-file"><i class="fa fa-pencil"></i> Generate Ticket </label></a> --}}
        </div>
   </div>
    <hr>
    <div class="dasboard-right-main-contetent-area">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-0">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6"><b>My Website: </b>{{$website_detail->website}}</div>
                            <div class="col-md-6"><b>Payment Status: </b>{{$website_detail->payment}}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"><b>Subscription Date: </b>{{$website_detail->subscription_date}}</div>
                            <div class="col-md-6"><b>Amount: </b>{{$website_detail->amount}} $</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"><b>Status: </b>
                                @if($website_detail->status == 0)
                                    Active
                                @else
                                    Lead
                                @endif
                            </div>
                            {{-- <div class="col-md-6"><b>Ammount: </b>${{$website_detail->amount}}</div> --}}
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12"><b>Website Data: </b><br />
                                {{$website_detail->website_data}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

@endsection
