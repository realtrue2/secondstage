<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Официальный сайт</title>
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../reset.css">
<link rel="stylesheet" type="text/css" href="../styles.css">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script type="text/javascript" src="../handler.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>

</head>
<?php 
       require_once '../global.inc.php';
    require_once '../DBmodels.php';
    require_once("../Database.class.php");
   if(isset($_SESSION['user'])) {
     $user = unserialize($_SESSION['user']);
   }
                   
?>
<body id="body">
    <div class="containerr">
	<header>
		<div class="page-1">
			<div class="header-line">
                <div class="enter-lang">
                  <div class="enter">
                      <a href="/users/" class="auto-enter a">Вход</a>
                      <span>/</span>
                      <a href="/registration/" class="auto-reg a">Регистрация</a>
                  </div>                        
                </div>
                <div style="float: right;" class="enter-lang">
              <div  class="enter">
                      <?php 
                        if(isset($user)){
                            echo "<a href='/users/' class='auto-enter a'>".$user->username."</a>
                            <span>/</span>  <a href='../logout.php' class='auto-reg a'>Выход</a>";
                        }
                      ?>
 
  
                </div>                        
                </div>
				<p class="h1-second">
					<a href="../">НАЗВАНИЕ</a>
				</p>
			</div>
		
		</div>
		</header>
        </div>

<div class="page-4">
	<div class="reg-login-form reg-login" >
	<input name="registration" value="1" type="hidden">
	<h2 class="reg-login-header">Крупные покупки</h2>
	 
           <?php 
       
                    $acc = get_acc($link,$user->username);
                     if(isset($acc)){
                         echo '<ul class="purshase">';
                         foreach($acc as $val){
                             if(strcasecmp ($val["size"],"big")==0){
                                    $cash = get_cash($link,$val["name"]);
                                    $valuta = $val["valuta"];
                                    $c = $cash[$valuta];
                                    $proc = (int)$val["cashneed"]/100;
                                    $sum = (int)$c/(int)$proc;
                                    echo '<li> <div style="width: 300px;display: inline-block;">';
                             
                                    echo '	<p style="float:left;display:inline-block;text-align: left;padding: 5px 0px 5px 0px;font-size: 1.3em ">'.$val["name"].' </p>';
                                    $sum = round($sum, 2);
                                    echo '	<p style="text-align: right;padding: 5px 0px 5px 0px;font-size: 1.3em ">'.$val["cashneed"].' '.$valuta.'</p>';
                                    echo '<div class="meter">';
                                    echo '<p>'.$sum.'%</p>';
                             
                                    echo '<span style="width: '.$sum.'%"></span>';
                             
                                    echo '</div> </div></li>';
                             }
                       
                         }
                        echo '</ul>';
                     }
        ?>
  
	
	<div style="margin-top: 15px;" class="reg-login-btn-container"> 
		<div id="foo" style="width: 100%;border-left: none;margin: 0px;border-right: none;border-bottom:0px;" class="button">
      Добавить покупку    
    </div>
     <div id="open" style="width: 465px;display: none; margin: 0 auto;">
        <form method="post" action="../main.php">
        	<input id="req" placeholder="Название" class="input form-input" name="name" type="text">   
              <div style="width: 360px;display: inline-block;"><input style="width: 360px;" placeholder="Сумма" class="input form-input required" name="sum" id="field_name" value="" required="" type="text"></div>   
          <div class="size">
          <input name="valuta" value="RUB" class="field" readonly="readonly" type="text">
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>
            
              </ul>
        </div>
        <input  placeholder="Уже накоплено" class="input form-input" name="sum2" type="text"> 
        <input class="btn" style=" border: 1px solid #1c1c1c; " type="submit" value="Добавить" name="form-acc-big" /></span>
            <a id="close"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></a>
     
        </form>
           
			
	</div> 

		
	
</div>
<div class="b-form-action_result"></div>		<div class="clear"></div>
	</div>
    	<div style="margin-top:40px;" class="reg-login-form reg-login" >
	<input name="registration" value="1" type="hidden">
	<h2 class="reg-login-header">Средние покупки</h2>
	 
           <?php 
       
                    $acc = get_acc($link,$user->username);
                     if(isset($acc)){
                         echo '<ul class="purshase">';
                         foreach($acc as $val){
                                 if(strcasecmp ($val["size"],"mid")==0){
                                    $cash = get_cash($link,$val["name"]);
                                    $valuta = $val["valuta"];
                                    $c = $cash[$valuta];
                                    $proc = (int)$val["cashneed"]/100;
                                    $sum = (int)$c/(int)$proc;
                                    echo '<li> <div style="width: 300px;display: inline-block;">';
                             
                                    echo '	<p style="float:left;display:inline-block;text-align: left;padding: 5px 0px 5px 0px;font-size: 1.3em ">'.$val["name"].' </p>';
                                    $sum = round($sum, 2);
                                    echo '	<p style="text-align: right;padding: 5px 0px 5px 0px;font-size: 1.3em ">'.$val["cashneed"].' '.$valuta.'</p>';
                                    echo '<div class="meter">';
                                    echo '<p>'.$sum.'%</p>';
                             
                                    echo '<span style="width: '.$sum.'%"></span>';
                             
                                    echo '</div> </div></li>';
                             }
                         }
                        echo '</ul>';
                     }
        ?>
  
	
	<div style="margin-top: 15px;" class="reg-login-btn-container"> 
		<div id="foo2" style="width: 100%;border-left: none;margin: 0px;border-right: none;border-bottom:0px;" class="button">
      Добавить покупку    
    </div>
     <div id="open2" style="width: 465px;display: none; margin: 0 auto;">
        <form method="post" action="../main.php">
        	<input id="req2" placeholder="Название" class="input form-input" name="name" type="text">   
              <div style="width: 360px;display: inline-block;"><input style="width: 360px;" placeholder="Сумма" class="input form-input required" name="sum" id="field_name" value="" required="" type="text"></div>   
          <div class="size">
          <input name="valuta" value="RUB" class="field" readonly="readonly" type="text">
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>
            
              </ul>
        </div>
        <input  placeholder="Уже накоплено" class="input form-input" name="sum2" type="text"> 
        <input class="btn" style=" border: 1px solid #1c1c1c; " type="submit" value="Добавить" name="form-acc-mid" /></span>
            <a id="close2"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></a>
     
        </form>
           
			
	</div> 

		
	
</div>
<div class="b-form-action_result"></div>		<div class="clear"></div>
	</div>
    <div style="margin-top:40px;" class="reg-login-form reg-login" >
	<input name="registration" value="1" type="hidden">
	<h2 class="reg-login-header">Мелкие покупки</h2>
	 
           <?php 
       
                    $acc = get_acc($link,$user->username);
                     if(isset($acc)){
                         echo '<ul class="purshase">';
                         foreach($acc as $val){
                                 if(strcasecmp ($val["size"],"lil")==0){
                                    $cash = get_cash($link,$val["name"]);
                                    $valuta = $val["valuta"];
                                    $c = $cash[$valuta];
                                    $proc = (int)$val["cashneed"]/100;
                                    $sum = (int)$c/(int)$proc;
                                    echo '<li> <div style="width: 300px;display: inline-block;">';
                             
                                    echo '	<p style="float:left;display:inline-block;text-align: left;padding: 5px 0px 5px 0px;font-size: 1.3em ">'.$val["name"].' </p>';
                                    $sum = round($sum, 2);
                                    echo '	<p style="text-align: right;padding: 5px 0px 5px 0px;font-size: 1.3em ">'.$val["cashneed"].' '.$valuta.'</p>';
                                    echo '<div class="meter">';
                                    echo '<p>'.$sum.'%</p>';
                             
                                    echo '<span style="width: '.$sum.'%"></span>';
                             
                                    echo '</div> </div></li>';
                             }
                         }
                        echo '</ul>';
                     }
        ?>
  
	
	<div style="margin-top: 15px;" class="reg-login-btn-container"> 
		<div id="foo3" style="width: 100%;border-left: none;margin: 0px;border-right: none;border-bottom:0px;" class="button">
      Добавить покупку    
    </div>
     <div id="open3" style="width: 465px;display: none; margin: 0 auto;">
        <form method="post" action="../main.php">
        	<input id="req3" placeholder="Название" class="input form-input" name="name" type="text">   
              <div style="width: 360px;display: inline-block;"><input style="width: 360px;" placeholder="Сумма" class="input form-input required" name="sum" id="field_name" value="" required="" type="text"></div>   
          <div class="size">
          <input name="valuta" value="RUB" class="field" readonly="readonly" type="text">
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>
            
              </ul>
        </div>
        <input  placeholder="Уже накоплено" class="input form-input" name="sum2" type="text"> 
        <input class="btn" style=" border: 1px solid #1c1c1c; " type="submit" value="Добавить" name="form-acc-lil" /></span>
            <a id="close3"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></a>
     
        </form>
           
			
	</div> 

		
	
</div>
<div class="b-form-action_result"></div>		<div class="clear"></div>
	</div>
<script type="text/javascript">
	  $('#foo').click(function(){
  $('#open').css({
         display:"block",
  
         });
   $('#foo').css({
         display:"none",
  
         });
        $('#req').attr({'required':''});
});
  $('#close').click(function(){
  $('#open').css({
         display:"none",
  
         });
   $('#foo').css({
         display:"block",
  
         });
      $('#req').removeAttr('required');
});
 	  $('#foo2').click(function(){
  $('#open2').css({
         display:"block",
  
         });
   $('#foo2').css({
         display:"none",
  
         });
        $('#req2').attr({'required':''});
});
  $('#close2').click(function(){
  $('#open2').css({
         display:"none",
  
         });
   $('#foo2').css({
         display:"block",
  
         });
      $('#req2').removeAttr('required');
});
    $('#foo3').click(function(){
  $('#open3').css({
         display:"block",
  
         });
   $('#foo3').css({
         display:"none",
  
         });
        $('#req3').attr({'required':''});
});
  $('#close3').click(function(){
  $('#open3').css({
         display:"none",
  
         });
   $('#foo3').css({
         display:"block",
  
         });
      $('#req3').removeAttr('required');
});
</script>
</body>
</html>