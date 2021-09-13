<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Bulwark</title>
    <!-- Bootstrap CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">

    <!-- Custom Style CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }} ">
     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>




<!-- dashbaord right  content  -->
<section id="header">
 <div class="dashoard-right-content-frontpages">
    <!-- nvabar for mobile  -->
    <div class="dashoard-navbar-area-frontpages container-fluid bg-success">
      <div class="row">
         <div class="col-6  mt-auto">
             <div class="mobile-toggle-fixed">

                  <div class="d-none d-lg-block d-sm-block d-md-block">
                      <h3 class="logo-text">Cyber Bulwark</h3>
                  </div>
                  <div class="d-block d-lg-none d-sm-none d-md-none">
                    <h3 class="logo-text">Cyber Bulwark</h3>
                </div>
                  </div>
           </div>

         <!-- <div class="col-6 mt-auto text-right">
          <div class="ml-auto">
            <button class="btn-white">Login</button>
        </div>
         </div> -->
     </div>

    </div>
       <!-- nvabar for mobile end -->

       <!---Page Intro-->
    </div>
</section>


<!-----intro Section-->
<section class="intro-section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="welocme-area-main">
            <div class="welcome-text-area text-center">
                <!-- <h2 class="text-center intro-text">Access Your Files In Just One Click</h2> -->


                     <form method="POST" action="{{ route('custom.register') }}" class="account-form-style-login">
                        @csrf
                         <input type="hidden" name="plan" value="{{ $id }}">
                        <h4 class="text-center  intro-text-small">Sign Up</h4>

                         <div class="form-group">
                             <label class="form-labels" for="email"><strong>Name:</strong></label>
                             <input type="text" class="form-control form-feilds @error('name') is-invalid @enderror"  name="name" placeholder="Enter Name" value="{{ old('name') }}">
                             @error('name')
                             <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                         </div>

                         <div class="form-group">
                             <label class="form-labels" for="email"><strong>Email:</strong></label>
                             <input type="email" class="form-control form-feilds @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                             @error('email')
                             <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                         </div>

                         <div class="form-group">
                             <label class="form-labels" for="email"><strong>Contact:</strong></label>
                             <input type="tel" class="form-control form-feilds @error('contact') is-invalid @enderror" name="contact" placeholder="Enter Contact" value="{{ old('contact') }}">
                             @error('contact')
                             <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                         </div>

{{--                         <div class="form-group">--}}
{{--                             <label class="form-labels" for="username"><strong>Password:</strong></label>--}}
{{--                             <input type="password" class="form-control form-feilds @error('password') is-invalid @enderror" name="password"  placeholder="Enter Password">--}}
{{--                             @error('password')--}}
{{--                             <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                             @enderror--}}
{{--                         </div>--}}

{{--                         <div class="form-group">--}}
{{--                             <label class="form-labels" for="username"><strong>Confirm password:</strong></label>--}}
{{--                             <input type="password" class="form-control form-feilds @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">--}}
{{--                             @error('password_confirmation')--}}
{{--                             <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                             @enderror--}}
{{--                         </div>--}}

                        <div class="form-group">
                        <label class="form-labels" for="email"><strong>Website URL:</strong></label>
                      <input type="url" class="form-control form-feilds @error('website') is-invalid @enderror" name="website" placeholder="Enter Website URL" value="{{ old('website') }}">
                       @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                     <div class="text-center">
                      <button type="submit" class="btn btn-default-blue w-2">Continue</button>
{{--                      <a href="{{ route('register') }}" type="submit" class="btn btn-default-blue w-2">Login</a>--}}
                      </div>
                  </form>


            </div>
            </div>
        </div>
            </div>
</section>

<!--footer -->
<!-- <section class="footer">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
            <p> Created by </p>

        </div>
            </div>
</section> -->






    <!-- Bootstrap JS Files -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascrip"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets/js/custom.js') }}" type="text/javascrip"></script>
<script>
    $(document).ready(function(){
    // home page expert modal open
     $(".recent-user-detail-btn").on("click", function () {
        $('#recent-user-detail').modal({backdrop: 'static', keyboard: false}, 'show');
      });
    // table responsive js
        $('#example').DataTable();

    // navbar  toggle buttion

    // $('.sidbar-open-btnn').on('click', function(){
    //     $('.dashboard-sidebar').css('display' , 'block');
    // });



    });
</script>
</body>
</html>
