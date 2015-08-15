 var program = function() {
   var done = false;
   var text = 'TINO';

   $(this).scrollTop(0);
   $("#about").css("width", $(window).width());
   $("#home").css("width", $(window).width());
   $("#clubinfo").css("width", $(window).width());
   $("#contactinfo").css("width", $(window).width());
   $("#forms").css("width", $(window).width());
   $("#events").css("width", $(window).width());
   $("#infoAccordion").accordion();

   //text is split up to letters
   $(window).load(function() {
     /*window.onscroll = function(e) {
         $(".navbar").css("opacity", "0.3");
     }*/

     $(window).scroll(function() {
       //$('.navbar').hide().fadeIn(100);
       $(".navbar").css("opacity", "0.1");
     });

     $(".navbar").hover(function() {
       $(this).css("opacity", "0.9");
     });

     $.each(text.split(''), function(i, letter) {

       //we add 100*i ms delay to each letter
       setTimeout(function() {

         //we add the letter to the container
         $('.title').html($('.title').html() + letter);

       }, 400 * i);

     });

     var text2 = 'OCTAGON';

     //text is split up to letters
     $.each(text2.split(''), function(i, letter) {

       //we add 100*i ms delay to each letter
       setTimeout(function() {

         //we add the letter to the container
         $('.title2').html($('.title2').html() + letter);

       }, 400 * i);
     });

     $('#officer1').mouseenter(function() {
       $(this).animate({
         width: '+=5px',
         height: '+=5px'
       });
       $(this).css("background-image", "url('images/vallab.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer1').mouseleave(function() {
       $(this).animate({
         height: '-=5px',
         width: '-=5px',
       });
       $(this).css("background-image", "url('images/vallab.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer2').mouseenter(function() {
       $(this).animate({
         width: '+=5px',
         height: '+=5px'
       });
       $(this).css("background-image", "url('images/sujit.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer2').mouseleave(function() {
       $(this).animate({
         height: '-=5px',
         width: '-=5px',
       });
       $(this).css("background-image", "url('images/sujit.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer3').mouseenter(function() {
       $(this).animate({
         width: '+=5px',
         height: '+=5px'
       });
       $(this).css("background-image", "url('images/chaitanya.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer3').mouseleave(function() {
       $(this).animate({
         height: '-=5px',
         width: '-=5px',
       });
       $(this).css("background-image", "url('images/chaitanya.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer4').mouseenter(function() {
       $(this).animate({
         width: '+=5px',
         height: '+=5px'
       });
       $(this).css("background-image", "url('images/yaswanth.jpg')");
       $(this).css("background-size", "cover");
     });

     $('#officer4').mouseleave(function() {
       $(this).animate({
         height: '-=5px',
         width: '-=5px',
       });
       $(this).css("background-image", "url('images/yaswanth.jpg')");
       $(this).css("background-size", "cover");
     });

     $('#officer5').mouseenter(function() {
       $(this).animate({
         width: '+=5px',
         height: '+=5px'
       });
       $(this).css("background-image", "url('images/tejas.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer5').mouseleave(function() {
       $(this).animate({
         height: '-=5px',
         width: '-=5px',
       });
       $(this).css("background-image", "url('images/tejas.png')");
       $(this).css("background-size", "cover");
     });

     $('#officer6').mouseenter(function() {
       $(this).animate({
         width: '+=5px',
         height: '+=5px'
       });
       $(this).css("background-image", "url('images/eric.jpg')");
       $(this).css("background-size", "cover");
     });

     $('#officer6').mouseleave(function() {
       $(this).animate({
         height: '-=5px',
         width: '-=5px',
       });
       $(this).css("background-image", "url('images/eric.jpg')");
       $(this).css("background-size", "cover");
     });

     $('.title').mouseenter(function() {
       $(this).animate({
         fontSize: '+=3px'
       });
     });

     $('.title').mouseleave(function() {
       $(this).animate({
         fontSize: '-=3px',
       });
     });

     $('.title2').mouseenter(function() {
       $(this).animate({
         fontSize: '+=3px'
       });
     });

     $('.title2').mouseleave(function() {
       $(this).animate({
         fontSize: '-=3px',
       });
     });



   });
 };
