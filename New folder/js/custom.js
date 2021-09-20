$(document).ready(function(){

// on scrool header shrink js

    $(window).scroll(function () {
        if ($(document).scrollTop() == 0) {
            $('.header-top').removeClass('tiny');
             $(".logo").attr("src","img/logo-light.png");
        } else {
            $('.header-top').addClass('tiny');
              $(".logo").attr("src","img/logo--dark.png");
              $(".navbar").css("box-shadow","0 0 7px #0000001a"); 
            
        }
    });


});
// $('.enter-survey').on('click', function(){

//     $('.box-1').addClass('d-none');  
//     $('.box-2').removeClass('d-none');  
//     $('.box-2').addClass('animated zoomIn');  

//   });
// $('.color-continue').on('click', function(){

//     $('.box-2').addClass('d-none');  
//     $('.box-3').removeClass('d-none');  
//     $('.box-3').addClass('animated zoomIn');  

//   });
// $('.smart-phone-continue').on('click', function(){

//     $('.box-3').addClass('d-none');  
//     $('.box-4').removeClass('d-none');  
//     $('.box-4').addClass('animated zoomIn');  

//   });
// $('.keep-iphone-continue').on('click', function(){

//     $('.box-4').addClass('d-none');  
//     $('.box-loading').removeClass('d-none');  
//     $('.box-loading').addClass('animated fadeIn');
//     setTimeout(function(){
//                      $('.loading-para-2').removeClass('d-none');
//                 },1500);   
//     setTimeout(function(){
//                      $('.loading-para-3').removeClass('d-none');
//                 },3000);   
//   setTimeout(function(){
//              $('.box-loading').addClass('d-none');  
//               $('.box-5').removeClass('d-none');  
//               $('.box-5').addClass('animated zoomIn');  
//             setTimeout(function(){
//                      $('.tick').addClass('animated bounceIn');
//                 },1500); 
    
//       },5000); 
    

//   });


// // remove add circle to number 
// $(".circle").click(function () {
//     $(".circle").removeClass("circle-border");
//     $(this).addClass("circle-border");   
// });

// // remove add circle to number 
// $(".phone-varity").click(function () {
//     $(".phone-varity").removeClass("border-bottom-phone");
//     $(this).addClass("border-bottom-phone");   
// });


// // remove add circle to number 
// $(".number-circle").click(function () {
//     $(".number-circle").removeClass("number-circle-border");
//     $(this).addClass("number-circle-border");   
// });


// // change phone image on color change 
// $(".circle-black").click(function () {
//    $(".color-iphone").attr("src","img/iphone-12-pg-header-black.png");
//    $(".phone-color").html('Jet Black');
// });


// $(".circle-grey").click(function () {
//    $(".color-iphone").attr("src","img/iphone-12-stell-grey.png");
//      $(".phone-color").html('Steel Grey');
// });

// $(".circle-blue").click(function () {
//    $(".color-iphone").attr("src","img/iphone-12-pg-header.png");
//     $(".phone-color").html('Navy Blue');
// });


// $(".circle-gold").click(function () {
//    $(".color-iphone").attr("src","img/iphone-12-pggold.png");
//     $(".phone-color").html('Rose Gold');
// });






//   });
  
  
  
  
// //  $('.ACCESS').on('click', function(){
     
 
// //      $('.Count').each(function () {
// //   var $this = $(this);
// //   jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
// //     duration: 3000,
// //     easing: 'swing',
// //     step: function () {
// //       $this.text(Math.ceil(this.Counter));
// //     }
// //   });
// // });
// //                                                         // calculation visdible
// // setTimeout(function(){
// //           $('.a').addClass('animated  jackInTheBox ');  
// //           $(".a").css("visibility","visible"); 
// //       },4000); 
// //       setTimeout(function(){
// //           $('.b').addClass('animated  jackInTheBox ');  
// //           $(".b").css("visibility","visible"); 
// //       },5000); 
      
      
// //       setTimeout(function(){
// //           $('.c').addClass('animated  jackInTheBox ');  
// //           $(".c").css("visibility","visible"); 
// //       },6000);   
      
// //       setTimeout(function(){
// //           $('.d').addClass('animated  jackInTheBox ');  
// //           $(".d").css("visibility","visible"); 
// //       },7000);  
      
// //       setTimeout(function(){
// //           $('.buy').addClass('animated  pulse infinite');  
      
// //       },8000); 
      
    
// //                                             //   page show
// //        $('#page-1').hide();
// //         $('#page-2').show(); 
// //         $(".footer").css("background-color","transparent"); 
// //         $(".footer-line").css("border-color","#ebebeb"); 
// //         $(".right").css("color","#474747");  
// //         $('.data-card').addClass('animated  zoomIn ');  
// // setTimeout(function(){
// //          $('.main-notification').addClass('animated  lightSpeedIn ');  
// //         $('.main-notification').removeClass('d-none');   
// //       },3000);  
          

// //  });   
 
// //     $('.buy').on('click', function(){
// //          $(window).scrollTop(0);
// //         $('.data-card-2').addClass('animated  zoomIn ');  
// //         $('#page-2').hide();
// //         $('#page-3').show(); 
        
// //   });   


// //   }); 
