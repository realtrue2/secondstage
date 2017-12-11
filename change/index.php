<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Официальный сайт</title>
	 
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" type="text/css" href="../styles.css">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script type="text/javascript" src="../handler.js"></script>
<script type='text/javascript' src="../js/proverka.js"></script>

</head>
<?php 
    require_once '../global.inc.php';
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
		<form  class="reg-login-form reg-login" action="../main.php" method="post">
	<input name="registration" value="1" type="hidden">
	<h2 class="reg-login-header">Новый счет</h2>
	<input placeholder="Название" class="input reg-login-input required" name="name" id="field_name" value="" required="" type="text">
	<input placeholder="USD" class="input reg-login-input " name="USD" onkeyup="return proverka(this);" value=""  type="text">
	<input placeholder="EUR" class="input reg-login-input " name="EUR" onkeyup="return proverka(this);" value=""  type="text">
	<input placeholder="РУБ" class="input reg-login-input " name="RUB" onkeyup="return proverka(this);" value=""  type="text">

	
	<span class="reg-login-btn-container">
	<input class="btn" type="submit" value="Создать счет" name="submit-form-bill" />
		
	</span>
</form>
<div class="b-form-action_result"></div>		<div class="clear"></div>
	</div>
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