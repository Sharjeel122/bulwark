@extends('marketer.view_layouts.master')
@section('content')
<!-- Ask my board speecha insight html -->
<section class="screen-display">
<a href="{{route('marketer.index')}}" <button type="button" class="btn btn-primary">Button</button></a>
<div class="container">

  <div class="box-wraper text-center">
    <h1 class="top-title">{{$reports->front_heading }} <span class="orange-clr">Speed Insights</span> </h1>
    <img class="screen-image" src="{{asset('public/image/'.$reports->future_image)}} ">
  </div>
</div>


</section>

<section class="page-performance"> 
  <div class="container text-center">
    <h1 class="page-title">Page Performance Metrics</h1>

    <div class="report-screenshots text-left">
       <p class="report-title">Google Page Speed Insights <span class="orange-clr">(Mobile Version)</span></p>
       <img class="w-100 image-shadow" src="{{asset('public/image/'.$reports->check_speed_mobile)}}">

       <p class="report-title">Google Page Speed Insights <span class="orange-clr">(Desktop Version)</span></p>
       <img class="w-100 image-shadow" src="{{asset('public/image/'.$reports->check_speed_pc)}}">

        <p class="report-title">GTmerix <span class="orange-clr">(Report Summary)</span></p>
        <img class="w-100 image-shadow" src="{{asset('public/image/'.$reports->gt_matrix_summry)}}">

        <!-- <p class="report-title">GTmerix <span class="orange-clr">(Report Summary)</span></p>
        <img class="w-100 image-shadow" src="">
         -->
        <p class="report-title">GTmerix <span class="orange-clr">(Highlighted Issues)</span></p>
        <img class="w-100 image-shadow" src="{{asset('public/image/'.$reports->gt_matrix_highlit_issue)}}">
    </div>

    <div class="did-you-know text-left">
      <h1 class="page-title">Do you know?</h1>
      <ul class="point-list">
        <li>
          <strong> <span class="orange-clr">40% </span>of all people abandon a website that takes more than <span class="orange-clr"> 3 seconds </span>to load.</strong></li>
        <li>
          <strong>Your website can never make it to the top search results if it’s not optimized in terms of <span class="orange-clr"> “Content” </span>, <span class="orange-clr"> “Speed” </span> &amp; <span class="orange-clr"> “Responsiveness”</span>.</strong></li>
       
        <li class="headline" >
          <strong><span >Website Page Speed and performance has a direct effect on <span class="orange-clr">Google Ranking</span> and <span class="orange-clr">SEO.</span>&nbsp;</span></strong><span ><em><a href="https://cognitiveseo.com/blog/22865/page-speed-seo/">(Cognitive SEO)</a></em></span></li>

        <li class="headline" ><strong>In a mobile-centric world, having a <span class="orange-clr">mobile responsive</span> website is a fundamental part of a successful SEO strategy. Responsive web design means offering a smooth user experience on <span class="orange-clr">desktop, laptop, tablet,</span> and <span class="orange-clr">smartphone</span> without any inconsistencies.</strong></li>

        <li class="headline" ><strong>90 Percent of Small Businesses can’t afford in-house IT teams to <span class="orange-clr">Secure, Manage </span>and <span class="orange-clr">Update </span>their websites.<br>
        <span ></span></strong></li>
        </ul>
    </div>


  </div>
</div>

@endsection