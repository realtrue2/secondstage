<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Официальный сайт</title>	 
    <link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<?php 
    require_once 'global.inc.php';
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
                            <span>/</span>  <a href='logout.php' class='auto-reg a'>Выход</a>";
                        }
                    ?>

                    </div>                        
                </div>
                <p class="h1-second">
                    НАЗВАНИЕ
                </p>
                <div style="clear: both;"></div>
			</div>
			<nav>
				<a href="info">Новости</a>
				<a href="contact">Цены</a>
				<a href="portfolio">Контакты</a>
                <?php 
                    if(isset($_SESSION['user'])) {
                        echo '<a href="private/">Личный кабинет</a>';
                    }else echo '<a href="users/">Вход</a>';
                ?>
				
			</nav>
		</div>
		</header>
        </div>


</body>
</html>