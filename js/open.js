  $('#foo').click(function(){
  $('#open').css({
         display:"block",
  
         });
        $('#req2').attr({'required':''});
});
  $('#close').click(function(){
  $('#open').css({
         display:"none",
  
         });
      $('#req2').removeAttr('required');
});
   $('#foo2').click(function(){
  $('#open2').css({
         display:"block",
  
         });
        $('#req').attr({'required':''});
});
  $('#close2').click(function(){
  $('#open2').css({
         display:"none",
  
         });
  $('#req').removeAttr('required');
});