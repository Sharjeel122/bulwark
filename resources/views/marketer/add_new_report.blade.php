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
              <h6 class="mb-0">Generate Report User Site</h6>
           </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">

      </div>
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">
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
            <button type="submit" id="submit" class="btn btn-default-blue w-2">Add</button>
        </div>
        </form>


    </div>
</div>

@endsection


@section('script')
<script>
$(document).ready(function () {
    $(document).on('click', '#submit', function (e) {
        e.preventDefault();
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

            var url = "{{route('marketer.store')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data:formData,
                contentType : false,
              cache: false,
              processData: false,     
                success: function (response) {
                    if (response.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#save_msgList').append('<li>' + err_value + '</li>');
                        });
                       
                    } else {
                        
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        setTimeout(function() {
                            $('#success_message').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        $('#AddStudentModal').find('input').val('');
                        $('.add_student').text('Save');
                        $('#save_msgList').hide();
                        $('#AddStudentModal').modal('hide');
                    }
                }
            });
    });
});

</script>

@endsection
