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
        <form  class="account-form-style-login text-center" method="post" action="{{ route('admin.store.employee') }}">
          @csrf()

            <div class="form-group">
                <label class="form-labels" for="username"><strong>Employee Type*:</strong></label>
                @php
                    $types = ['employee1','employee2']
                @endphp

                <select name="type" id="" class="form-control">
                    <option value="">Select Employee Type</option>
                    @foreach($types as $type)
                        @php
                            $select = old('type', $employee->type) == $type ? 'selected' : '';
                        @endphp
                        <option value="{{ $type }}" {{ $select }}>{{ $type }}</option>
                    @endforeach


                </select>
                @if ($errors->has('type'))
                    <span role="alert">
              <strong class="text-danger">{{ $errors->first('type') }}</strong>
         </span>
                @endif
            </div>

            @include('admin.employee._form')
           <div class="text-center">
            <button type="submit" class="btn btn-default-blue w-2">Add</button>

            </div>
        </form>

    </div>
</div>
@endsection

@section('script')

@endsection
