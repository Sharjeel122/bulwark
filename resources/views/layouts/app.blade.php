<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Bulwark</title>
    @include('layouts.includes.head')
    @yield('style')
</head>
<body>


  <section class="dashboard-content clearfix" >

    <!-- dashbaord sidebar  starts -->
        @include('layouts.includes.sidebar')
    <!-- dashbaord sidebar  ends -->

<!-- dashbaord right  content  -->

 <div class="dashoard-right-content">
  <!-- dashbaord header  starts -->
        @include('layouts.includes.header')
    <!-- dashbaord header  ends -->
        
       @yield('content')


    </div>
  </div>
</section>



  <!-- Modal -->
<!--   <div  id="recent-user-detail" class="modal dashboard-modal-design" tabindex="-1" role="dialog">
    <div class="modal-dialog  " role="document">
      <div class="modal-content">
        <div class="modal-head text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
            <div class="modal-body">
             <h5 class="dashboard-modal-heading-tag text-center">Expert Name Details</h5>
            <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-12">
                        <img class="modal-img-top" src="images/dp 8.jpeg" alt="">

                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-12 my-auto">
                        <p class="modal-expert-name mb-0">Expert Name</p>
                        <p class="modal-expert-mail modal-gray-text">@joesmith</p>
                        <p class="modal-expert-name mb-0">*************</p>
                        <p class="modal-expert-name mb-0">+923400000000</p>
                    </div>
                <hr class="modal-line">
            </div>
                <div class="row  expert-text-detail">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <p class="mb-0 about-expert">About Me:</p>
                        <p class="mb-0 about-expert-description modal-gray-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>
                <div class="text-right">
                  <button class="btn btn-small modale-btn try-modal btn-primary">Edit</button>
                  <button class="btn btn-small modale-btn try-modal btn-danger">Remove</button>
                </div>
        </div>
      </div>
    </div>
  </div> -->
    <!-- Bootstrap JS Files -->
  @include('layouts.includes.script')
  @yield('script')
</body>
</html>