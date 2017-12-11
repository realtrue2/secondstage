$(document).ready(function(){
 $(".button").mouseenter(function(){
      $(this).css({"background-color": "#000000"});
       $(".button a").css({"color": "#ffffff"});
    }).mouseleave(function(){
      $(this).css({"background-color": "white"});
      $(".button a").css({"color": "#000000"});
    });
     $(".button2").mouseenter(function(){
      $(this).css({"background-color": "#000000"});
       $(".button2 a").css({"color": "#ffffff"});
    }).mouseleave(function(){
      $(this).css({"background-color": "white"});
      $(".button2 a").css({"color": "#000000"});
    });
    $(".btn").mouseenter(function(){
      $(this).css({"background-color": "#000000"});
       $(this).css({"color": "#ffffff"});
    }).mouseleave(function(){
      $(this).css({"background-color": "white"});
      $(this).css({"color": "#000000"});
    });
});