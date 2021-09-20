<!doctype html>
<html lang="en">
@include('marketer.view_layouts.header')


<body>



@include('layouts.includes.header')





<!--  Page Performance Metrics html -->


@yield('content')


</section>


<!-- offer section html start -->

<section class="offer-section">
  <div class="container">
  <h3 class="offer-title text-center"><span class="orange-clr">Eden Spell Technologies</span> offers</h3>
  <div class="security-logo-area text-center">
    <img class="security-logo" src="{{asset('extra/img/security.png')}}">
    <h3 class="logo-text">“Cyber Bulwark“ </h3>
    <h2 class="text-center offer-text"><span >a complete </span><span class="orange-clr"><strong>Security, Maintenance &amp; Support Subscription&nbsp;</strong></span><span >that make sure that:</span></h2>
  </div>

   <h1 class="page-title text-center">Your website is Always</h1>

   <div class="row">
     <div class="col-sm-4 col-12">
       <div class="offerr-item-wraper text-center">
         <img class="offer-image" src="{{asset('extra/img/security1.png')}}">
         <h3 class="offer-name">Secure</h3>
       </div>
     </div>
     <div class="col-sm-4 col-12">
          <div class="offerr-item-wraper text-center">
         <img class="offer-image" src="{{asset('extra/img/settings.png')}}">
         <h3 class="offer-name">Optimized</h3>
       </div>
     </div>
     <div class="col-sm-4 col-12">
          <div class="offerr-item-wraper text-center">
         <img class="offer-image" src="{{asset('extra/img/update-arrows.png')}}">
         <h3 class="offer-name">Updated</h3>
       </div>
     </div>
   </div>

<div class="btn-wraper text-center">
   <a href="#"><button class="btn orange-btn">Learn More</button></a>
</div>

  </div>
</section>

<!-- contact section html start -->
<!-- 
<section class="contact-section">
  <div class="container">
      <h2 class="contact-title">LET’S TALK!</h2>
      <p class="mb-0 contact-description">Not sure what plan is best for You? Tell us a bit about your website. We’ll get back to you within one day and provide the best plan for your need.</p>
  
  <form class="contact-form">
      <div class="row">
        <div class="col-sm-6 col-12">
          <input type="text" class="form-control" placeholder="Name" required="">
        </div>
        <div class="col-sm-6 col-12">
          <input type="email" class="form-control" placeholder="Email Address" required="">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-12">
          <input type="text" class="form-control" placeholder="Website" required="">
        </div>
        <div class="col-sm-6 col-12">
            <select id="inputState" class="form-control">
              <option selected>Website Technology</option>
              <option>WordPress</option>
              <option>Custom PHP</option>
              <option>Shopify</option>
              <option>HTML</option>
              <option>Not Sure</option>
            </select>
        </div>
      </div>

      <div class="row">
        <div class="col ">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col text-right">
         <button type="submit" class="btn">Submit Request</button>
        </div>
      </div>
  
  </form>
  </div>
  
</section> -->



<!-- footer section -->
@include('marketer.view_layouts.footer')
<!-- end footer -->






<!--   Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/custom.js"></script>

</body>
</html>