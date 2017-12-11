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
<script type="text/javascript" src="../js/jq.js"></script>


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
	<div style="padding-top: 15px;" class="reg-login-form reg-login" >
	<input name="registration" value="1" type="hidden">
      <?php 
          $name = $_GET["name"];
          echo '<h2 class="reg-login-header">'.$name.'</h2>';
      ?>

    <table class="report">
     <tr><th>Название</th><th>Сумма</th><th>Счет</th><th>Дата</th></tr>
    <?php 
        if (isset($name)) {
          $oper = get_oper_bytag($link,$name);
            foreach ($oper as $value) {
                $d = date("Y.m.d H:i", $value["date"]);
                if($value["bool"]==0){
                  echo '<tr style="color:#7c1301;"><td><div>'.$value["name"].'</div> <div style="text-align: center;" class="tMini"><span>'.$value["tag"].'</span></div></td><td>'.$value["sum"].'</td><td>'.$value["bill"].'</td><td>'.$d.'</td></tr>';
                }else {
               echo '<tr style="color:#006010;"><td><div>'.$value["name"].'</div> <div style="text-align: center;" class="tMini"><span>'.$value["tag"].'</span></div></td><td>'.$value["sum"].'</td><td>'.$value["bill"].'</td><td>'.$d.'</td></tr>';
             }
            }
        
      }
       
    ?>
     
      
    </table>
          
	
</div>
<div class="b-form-action_result"></div>		<div class="clear"></div>
</div>
 
   

		
<script type="text/javascript">
    
$(function(){
  $('.size').styleddropdown();
});

</script>
<script type="text/javascript">
	  $('#foo').click(function(){
  $('#open').css({
         display:"block",
  
         });
        $('#req').attr({'required':''});
});
  $('#close').click(function(){
  $('#open').css({
         display:"none",
  
         });
      $('#req').removeAttr('required');
});  
</script>
</body>
</html>