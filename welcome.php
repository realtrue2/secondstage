<!DOCTYPE html>
<html lang="en">
     <?php
    require_once 'global.inc.php';
    if(!isset($_SESSION['logged_in'])) {
                    header("Location: login.php");
                    }
                //взять объект user из сессии
             
                    $user = unserialize($_SESSION['user']);

    ?>
<head>
	<meta charset="UTF-8">
	<title>Официальный сайт</title>
	 
  <link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
 <script type="text/javascript" src="handler.js"></script>
</head>
<body id="body">
    <div class="containerr">

		<div style="margin-top: 100px;" class="page-1">
			<div class="header-line">

				

           <p style="width: 500px;" class='h1-second'>Привет, <?php echo $user->username; ?>. Добро пожаловать. </p>
      
			</div>
           
      <div class="btncont">
      <div class="button">
          <a  href="logout.php">Выйти</a>
      </div>
      <div class="button2">
           <a  href="index.php">На главную</a>
      </div>
                
            </div>
    

            
		</div>
	
      
        </div>


</body>
</html>