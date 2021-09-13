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

                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#uploadreport"><i class="fa fa-upload"></i> Upload Report</button>
                </div>
            </div>
            <hr>
            <div class="dasboard-right-main-contetent-area">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th style="width:20px;"><input type="checkbox"></th>
                        <th style="width:20px;">No.</th>
                        <th>User</th>
                        <th>Uploaded Date</th>
                        <th>Website</th>
                        <th>Report Title</th>
                        <th>Uploaded By</th>
{{--                        <th>File</th>--}}
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
                            <td>{{ $report->get_user->name }}</td>
                            <td>{{ $report->created_at }}</td>
                            <td>{{$report->website}}</td>
                            <td>{{$report->report_title}}</td>
                            @php
                                $uploaded_by = \App\Models\User::findOrFail($report->staff_id);
                            @endphp
                            <td>{{$uploaded_by->name}}</td>
{{--                            <td><a href="{{ asset('assets/reports/'.$report->report) }}" DOWNLOAD>{{$report->report}}</a></td>--}}
                            <td>
                                <a href="{{ asset('assets/reports/'.$report->report) }}" class="btn btn-sm btn-outline-info" title="Download Report" DOWNLOAD><i class="fa fa-download"></i></a>
                                <a href="{{ route('employee.edit_report', $report->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Report"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <!-- upload report modal -->
        <div class="modal fade" id="uploadreport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload New Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('employee.upload_report')}}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="report_title" value="" placeholder="Report Title" class="form-control" required>
                            <input type="hidden" name="staff_id" value="{{Auth::user()->id}}">
                            <select name="user_id" id="user" class="form-control mt-4 mb-4" required>
                                <option  value="" disabled selected>Select User</option>
                                @php
                                    foreach($users as $user){
                                        echo "<option value='$user->id'>$user->name</option>";
                                    }
                                @endphp
                            </select>

                            <div id="list">
                                <select name="website" id="user" class="form-control mt-4" required>
                                    <option value="" id="list">Select User First</option>
                                </select>
                            </div>
                            <input type="file" name="report" class="form-control mt-4" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-outline-warning">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection


        @section('script')
            <script>
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


            </script>
@endsection
