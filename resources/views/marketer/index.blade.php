@extends('layouts.app')

@section('style')
<style>


.close:focus {
    outline: none
}

.container.justify-content-center {
    margin-top: 200px
}

.modal-header {
    border: none
}

.modal-footer {
    border: none
}

.btn-danger {
    background: #DD2750;
    border: 1px solid #C43352
}

.btn-light {
    border: 1px solid #E7E7E9
}

.btn:focus {
    box-shadow: none
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

             <a href="{{ route('marketer.add.new.report')}}"><label class="choose-file"><i class="fa fa-user-plus"></i>Add Report</label></a>
        </div>
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                     <th style="width:20px;"><input type="checkbox"></th>
                     <th>ID</th>
                    <th>User Name</th>
                    <th>Website</th>
                    <th>User Email</th>
                    <th>front_heading</th>
                    <th>actions</th>
                </tr>
            </thead>
                <tbody>
                
                </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container d-flex pl-0">
                    <h5 class="modal-title ml-2" id="exampleModalLabel">Delete the Report?</h5>
                </div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="deleteing_id">
                <p class="text-muted">If you delete the report will be gone forever. Are you sure you want to proceed?</p>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-danger delete_report">Delete</button> </div>
        </div>
    </div>
</div>
<!-- edit modal -->
<!-- edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit & Update User Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <ul id="update_msgList"></ul>
                <input type="hidden" id="stud_id" />

            <div class="modal-body">
                <div id="success_message"></div>
               <!-- message -->
            <ul id="save_msgList"></ul>
            <!-- end message -->
        <form  class="row" action="" method="">
            
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>User Name</label>
                <input type="text" id="user_name" class="form-control" value="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>website Url</label>
                <input type="text" id="website_url" class="form-control" value="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>User Email</label>
                <input type="text" id="user_email" class="form-control" >
            </div>
            <!-- again -->
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>Title Heading</label>
                <input type="text" id="front_heading" class="form-control" value="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>Future Image</label>
                <input type="file" id="future_image" class="form-control" value="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>Google Page Speed For Mobile</label>
                <input type="file" id="check_speed_mobile" class="form-control" value="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>Google Page Speed For Desktop</label>
                <input type="file" id="check_speed_pc" class="form-control" value="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>GT Matrix Summry Report</label>
                <input type="file" id="gt_matrix_summry" class="form-control" >
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>GT Matrix Highlit Issue</label>
                <input type="file" id="gt_mtrix_highlit_issue" class="form-control" value="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-12 pb-3">
                <label>Description</label>
                <input type="text" id="description" class="form-control" >
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-12 pt-3">
            </div>
        </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update_student">Update</button>
            </div>
        </div>
    </div>
</div>




@endsection
@section('script')
<script>

$(document).ready(function () {
    $('table').DataTable();
    fetchstudent();
        function fetchstudent() {
            var url = "{{route('fetchstudent')}}";
            $.ajax({
                type: "GET",
                url:url,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $('tbody').html("");
                    $.each(response.reports, function (key, item) {
                        $('tbody').append('<tr>\
                            <td ><input type="checkbox"></td>\
                            <td>' + item.id + '</td>\
                            <td>' + item.user_name + '</td>\
                            <td>' + item.website_url + '</td>\
                            <td>' + item.user_email + '</td>\
                            <td>' + item.front_heading + '</td>\
                            <td><button type="button" value="' + item.id + '" class="btn btn-sm btn-outline-info editbtn "><i class="fa fa-edit"></i></button>\
                            <button type="button" value="' + item.id + '" class="btn btn-sm btn-outline-info viewbtn "><i class="fa fa-eye"></i></button>\
                            <button type="button" value="' + item.id + '" class="btn btn-sm btn-outline-info deletebtn "><i class="fa fa-trash"></i></button></td>\
                        \</tr>');
                    });
                }
            });
        }
     //view
     $(document).on('click', '.viewbtn', function (e) {
            e.preventDefault();
            var stud_id = $(this).val();
            // alert(stud_id);
        
            var url = "{{ route('marketer.show', ":id") }}";
            url = url.replace(':id', stud_id);
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    if(response.status == 200)
                    {
                        window.location = 'result/?user_id='+stud_id;
                    }
                }
            });
        });
      // edit 
        $(document).on('click', '.editbtn', function (e) {
            e.preventDefault();
            var stud_id = $(this).val();
            // alert(stud_id);
            $('#editModal').modal('show');
            var url = "{{ route('marketer.edit', ":id") }}";
            url = url.replace(':id', stud_id);
            $.ajax({
                type: "GET",
                url: url,

                success: function (response) {
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').modal('hide');
                    } else {
                        $('#user_name').val(response.reports.user_name);
                        $('#website_url').val(response.reports.website_url);
                        $('#user_email').val(response.reports.user_email);
                        $('#front_heading').val(response.reports.front_heading);
                        $('#description').val(response.reports.description);
                        $('#stud_id').val(stud_id);
                    }
                }
            });
        });

        // update records
        $(document).on('click', '.update_student', function (e) {
            e.preventDefault();

           
            var stud_id = $('#stud_id').val();

            var user_name = $('#user_name').val();
            var website_url = $('#website_url').val();
            var user_email = $('#user_email').val();
            var front_heading = $('#front_heading').val();
            var future_image = $('#future_image')[0].files[0];
            var check_speed_mobile = $('#check_speed_mobile')[0].files[0];
            var check_speed_pc = $('#check_speed_pc')[0].files[0];
            var gt_matrix_summry = $('#gt_matrix_summry')[0].files[0];
            var gt_mtrix_highlit_issue = $('#gt_mtrix_highlit_issue')[0].files[0];
            var description = $('#description').val();
         
            var formData = new FormData();
            formData.append('user_name', user_name);
            formData.append('website_url', website_url);
            formData.append('user_email', user_email);
            formData.append('front_heading', front_heading);
            formData.append('future_image', future_image);
            formData.append('check_speed_mobile', check_speed_mobile);
            formData.append('check_speed_pc', check_speed_pc);
            formData.append('gt_matrix_summry', gt_matrix_summry);
            formData.append('gt_mtrix_highlit_issue', gt_mtrix_highlit_issue);
            formData.append('description', description);

            var url = "{{ route('update.report', ":id") }}";
            url = url.replace(':id', stud_id);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "Post",
                url: url,
                dataType: "json",
                data:formData,
                contentType : false,
                cache: false,
                processData: false, 
                success: function (response) {
                    if (response.status == 200) {
                      
                        $('#editModal').modal('hide');
                        fetchstudent();
                    }
                       
                }
            });

        });
     
        //delete report
        $(document).on('click', '.deletebtn', function () {
            var stud_id = $(this).val();
            $('#exampleModal').modal('show');
            $('#deleteing_id').val(stud_id);
        });
        $(document).on('click', '.delete_report', function (e) {
            e.preventDefault();
            var id = $('#deleteing_id').val();
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('marketer.destroy', ":id") }}";
            url = url.replace(':id', id);
        
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 404) {
                       
                        // $('#success_message').addClass('alert alert-success');
                        // $('#success_message').text(response.message);
                       
                    } else {
                       
                        // $('#success_message').html("");
                        // $('#success_message').addClass('alert alert-success');
                        // $('#success_message').text(response.message);
                        $('#exampleModal').modal('hide');
                        fetchstudent();
                    }
                }
            });
        });
});
</script>

@endsection
