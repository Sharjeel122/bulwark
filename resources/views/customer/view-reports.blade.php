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
                    <h6 class="mb-0">All Reports</h6>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
                <!-- <button type="file"> Upload</button>   -->

                <!-- <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#uploadreport"><i class="fa fa-upload"></i> Upload Report</button> -->
            </div>
        </div>
        <hr>
        <div class="dasboard-right-main-contetent-area">
            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:20px;"><input type="checkbox"></th>
                        <th style="width:20px;">No.</th>
                        <th>Uploaded Date</th>
                        <th>Website</th>
                        <th>Report Title</th>
                        <th>Uploaded By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($reports as $report)


                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $i++ }}</td>
                        <td>{{ $report->created_at }}</td>
                        <td>{{$report->get_website->website}}</td>
                        <td>{{$report->report_title}}</td>
                        @php
                            $uploaded_by = \App\Models\User::findOrFail($report->staff_id);
                        @endphp
                        <td>{{$uploaded_by->name}}</td>
                        <td><a href="{{ asset('assets/reports/'.$report->report) }}" class="btn btn-sm btn-outline-info" title="Download Report" DOWNLOAD><i class="fa fa-download"></i></a></td>

                    </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
    @endsection


    @section('script')

    @endsection
