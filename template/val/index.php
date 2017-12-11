<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Официальный сайт</title>
<link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../../reset.css">
<link rel="stylesheet" type="text/css" href="../../styles.css">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script type="text/javascript" src="../../handler.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/jq.js"></script>

<script type='text/javascript' src="../../js/proverka.js"></script>
</head>
<?php 
       require_once '../../global.inc.php';
    require_once '../../DBmodels.php';
    require_once("../../Database.class.php");
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
		<nav>
        <a  href="../">Расход</a>
        <a href="../plus">Доход</a>
        <a  href="../swap">Перемещение</a>
        <a  class="active" href="">Обмен</a>
      </nav>
		</div>
		</header>
        </div>

<div class="page-4">
	<div class="reg-login-form reg-login" >
	<input name="registration" value="1" type="hidden">
	<h2 class="reg-login-header">Шаблон обмена</h2>
    <form  class="form" action="../../main.php" method="post">
        
        <div style="margin: 0 auto;width: 465px;">
        <input id="req" placeholder="Название" class="input form-input" name="name" required="required" type="text">
        <div style="display: inline-block;width: 100px;text-align: left;"><p>Купили</p></div>
        <input style="display: inline-block;width: 150px;margin-bottom: 0px;" placeholder="Сумма" onkeyup="return proverka(this);" class="input form-input required" required="" name="sum1" type="text">
        <div style="display: inline-block;" class="size">
          <input type="text" name="valuta" value="RUB" class="field" readonly="readonly" />
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>
            
              </ul>
        </div>
        </div>
          <div style="margin: 0 auto;width: 465px;">
           <div style="display: inline-block;width: 100px;text-align: left;"><p>Продали</p></div>
               <input style="display: inline-block;width: 150px;margin-bottom: 0px;" placeholder="Сумма" class="input form-input required" required="" name="sum2" onkeyup="return proverka(this);"  type="text">
             <div style="display: inline-block;" class="size">
         
          <input type="text" name="valuta2" value="RUB" class="field" readonly="readonly" />
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>
            
              </ul>
        </div>
         <div style="width: 197px;margin-left: 10px" class="size">
            <?php 
                    $bill = get_bill($link,$user->username);
                     if(isset($bill[0])){
                        $first = $bill[0]; 
                           $first =$first["name"];
                     }else $first = "Счет";
                    echo ' <input style="width: 197px; type="text" name="bill" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                    echo ' <div><a href="../../bill">НОВЫЙ СЧЕТ</a></div>';
                    foreach($bill as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
                    echo '</u>';
                ?>
              </div>
        
         </div>
          <span style="margin:0px;" class="reg-login-btn-container">
        <input class="btn" style="margin-bottom: 15px; border: 1px solid #1c1c1c;" type="submit" value="Обмен" name="template-form-val" /></span></form>
	
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
    <?php
       
        if(isset($_SESSION['error'])){
            if(strcasecmp ($_SESSION['error'],"")!=0){
                $err = $_SESSION['error'];
                echo "<script> alert(\"$err.\");</script>";
                $_SESSION['error']="";
            }
        }
        ?>
</body>
</html>