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

          <div class="col-6 mt-auto text-right">
          <div class="ml-auto">
            <button class="btn-white">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                </a>
            </button>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
        </div>
         </div>
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
                    @if (Session::has('message'))
                        <div class="account-form-style-login">
                            <h4 class="text-center intro-text">{{ Session::get('message')}}</h4>
                        </div>
                    @endif
                    <!-- <h2 class="text-center intro-text">Access Your Files In Just One Click</h2> -->

{{--                    <form method="POST" action="{{ route('create.agreement', 'P-3FJ47692J5594735KMDSV3DI') }}" class="account-form-style-login">--}}
{{--                    <form method="POST" action="{{ route('create.agreement', $get_plan->plan_id) }}" class="account-form-style-login">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="plan" value="{{ $id }}">--}}
{{--                        <input type="hidden" name="website" id="website-id" value="{{ $website->id }}">--}}
{{--                        <h4 class="text-center  intro-text-small">Payment</h4>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-labels" for="email"><strong>Selected Plan:</strong></label>--}}
{{--                            <input type="text" class="form-control"   value="{{ $get_plan->name }}" readonly>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-labels" for="username"><strong>Payable Amount:</strong></label>--}}
{{--                            <input type="text" class="form-control"  value="${{ $get_plan->price }}/month" readonly>--}}
{{--                        </div>--}}

{{--                        <div class="text-center">--}}
{{--                            <button type="submit" class="btn btn-default-blue w-2">Subscribe Now</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}

                        <div class="account-form-style-login">
                            <input type="hidden" value="{{ $id }}">
                            <input type="hidden"  id="website-id" value="{{ $website->id }}">
                            <input type="hidden"  id="get-plan" value="{{ $get_plan->plan_id }}">
                            <h4 class="text-center  intro-text-small">Payment</h4>
                            <div class="form-group">
                                <label class="form-labels" for="email"><strong>Selected Plan:</strong></label>
                                <input type="text" class="form-control"   value="{{ $get_plan->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-labels" for="username"><strong>Payable Amount:</strong></label>
                                <input type="text" class="form-control"  value="${{ $get_plan->price }}/month" readonly>
                            </div>
                        <div id="paypal-button-container"></div>
                        </div>

                </div>
            </div>
        </div>
            </div>
</section>


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
{{--<script src="https://www.paypalobjects.com/api/checkout.js"></script>--}}
{{--<script>--}}
{{--    paypal.Button.render({--}}
{{--        // Configure environment--}}
{{--        env: 'sandbox',--}}
{{--        client: {--}}
{{--            sandbox: 'AZ9MJ2g1eQYhCelv6DCMTcL1Ap7Gc2HPUN4c-8UYURFU1HhNLe1A2o9BW1VihDoZDFy3fkXXbr1RoKJZ',--}}
{{--            production: 'demo_production_client_id'--}}
{{--        },--}}
{{--        // Customize button (optional)--}}
{{--        locale: 'en_US',--}}
{{--        style: {--}}
{{--            size: 'small',--}}
{{--            color: 'gold',--}}
{{--            shape: 'pill',--}}
{{--        },--}}

{{--        // Enable Pay Now checkout flow (optional)--}}
{{--        commit: true,--}}

{{--        // Set up a payment--}}
{{--        payment: function(data, actions) {--}}
{{--            return actions.payment.create({--}}
{{--                redirect_urls:{--}}
{{--                    return_url: 'http://127.0.0.1:8000/execute-payment'--}}
{{--                },--}}

{{--                transactions: [{--}}
{{--                    amount: {--}}
{{--                        total: '20',--}}
{{--                        currency: 'USD'--}}
{{--                    }--}}
{{--                }]--}}
{{--            });--}}
{{--        },--}}
{{--        // Execute the payment--}}
{{--        onAuthorize: function(data, actions) {--}}
{{--            // return actions.payment.execute().then(function() {--}}
{{--            //     // Show a confirmation message to the buyer--}}
{{--            //     window.alert('Thank you for your purchase!');--}}
{{--            // });--}}

{{--            return actions.redirect();--}}
{{--        }--}}
{{--    }, '#paypal-button');--}}

{{--</script>--}}


<script src="https://www.paypal.com/sdk/js?client-id=AQWYhYrVOVVQy0Fuz8W1by-nw1sWzQFoltshVqi6gFoqca9cet2qspz--RvHKYlgTM26zn2_l20jsYGm&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<!--<script src="https://www.paypal.com/sdk/js?client-id=Ab9o-IPlkDrW3TwyLHxjkqUtjuduw2AhhlimIbZAEm2xAL4fHCodpyZ5ipOKnbgkEgqpMXJy36qdrJZQ&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>-->
<script>
    var website_id = $('#website-id').val();
    var plan = $('#get-plan').val();
    paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'gold',
            layout: 'vertical',
            label: 'subscribe'
        },
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                /* Creates the subscription */
                plan_id: plan
            });
            // var plan_id = 'P-3FJ47692J5594735KMDSV3DI'
            // return 'http://127.0.0.1:8000//plan/'+plan_id+'/agreement/create'
        },
        onApprove: function(data, actions) {
            var url = "https://edenspell.com/cyber-bulwark/execute-other?website_id="+website_id+'&subscription_id='+data.subscriptionID;
            window.location.replace(url);
            // alert(data.subscriptionID); // You can add optional success message for the subscriber here
        }
    }).render('#paypal-button-container'); // Renders the PayPal button
</script>

</body>
</html>
