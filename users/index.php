<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Официальный сайт</title>
	 
    <link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" type="text/css" href="../styles.css">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../handler.js"></script>
</head>
    <?php
        require_once '../global.inc.php';
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
				<p class="h1-second">
					<a href="../">НАЗВАНИЕ</a>
				</p>
			</div>
	
		</div>
    </header>
    </div>

<div class="page-4">
		<form method="post" action="../login.php"  class="reg-login-form reg-login" id="auth_form" name="authform">
	       <input name="login" value="1" type="hidden">
	       <h2 class="reg-login-header">Авторизация</h2>
	       <input placeholder="username" class="input reg-login-input required" id="field_email" name="username" value="" required="" type="text">
	       <input placeholder="password" class="input reg-login-input required" name="password" type="password">
	       <span class="reg-login-line">
		      <a href="../registration/" class="pull-left">Зарегистрироваться</a>
		      <a href="/users/remind/" class="pull-right">Забыли пароль?</a>
		      <span class="clear"></span>
	       </span>
	       <span class="reg-login-btn-container">
	           <input class="btn" type="submit" value="Войти" name="submit-login" />
	       </span>
        </form>
<div class="b-form-action_result"></div>
<div class="clear"></div>
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