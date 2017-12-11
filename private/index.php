<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Официальный сайт</title>
 
	  <link rel="stylesheet" href="../reset.css">
  <link rel="stylesheet" type="text/css" href="../styles.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

 
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script type="text/javascript" src="../handler.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jq.js"></script>
<script type='text/javascript' src="../js/proverka.js"></script>
<script type='text/javascript' src="../js/template.js"></script>
</head>
<?php 
 
    require_once '../global.inc.php';
    require_once '../DBmodels.php';
    require_once("../Database.class.php");
    if(isset($_SESSION['user'])) {
     $user = unserialize($_SESSION['user']);
    }
    $db = new Database();

    $link = $db->connect();  
                   
?>
<body id="body">
    
    <div class="containerr">
       
	<header>
		<div class="page-1">
			<div class="header-line">
                <div class="enter-lang">
                    <div class="enter">
                        <a href="../users/" class="auto-enter a">Вход</a>
                        <span>/</span>
                        <a href="../registration/" class="auto-reg a">Регистрация</a>
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
                </p><div style="clear: both;"></div>
            </div>
			<nav>
				<a class="active" href="info">Ввод операций</a>
				<a href="contact">Планирование</a>
				<a href="../template/">Шаблоны</a>
				<a href="../accumulation/">Накопления</a>
			</nav>
		</div>
    </header>

  <div class="tabs">
    <input id="tab1" type="radio" name="tabs" checked>
    <label for="tab1" title="Вкладка 1">Расходы</label>
 
    <input id="tab2" type="radio" name="tabs">
    <label for="tab2" title="Вкладка 2">Доходы</label>
 
    <input id="tab3" type="radio" name="tabs">
    <label for="tab3" title="Вкладка 3">Перемещения</label>
 
    <input id="tab4" type="radio" name="tabs">
    <label for="tab4" title="Вкладка 4">Обмен валют</label>
 
    <section id="content-tab1">
        <form  class="form" action="../main.php" method="post">
        <h2 style="margin-bottom: 30px;">Внести сумму</h2>
        <div style="margin: 0 auto;width: 465px;">
        <div style="width:  275px;display: inline-block;">
        <input style="width: 275px;" placeholder="Сумма" class="input form-input required" id="sum" onkeyup="return proverka(this);"  name="sum" value="" required="" type="text"></div>
      
        <div class="size" style="margin-left: 15px;">
          <input  type="text" id="valuta" name="valuta" value="RUB" class="field" readonly="readonly" />
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>         
              </ul>
        </div>
         <div class="size" style="width: 102px;margin-left: 15px;">
              
                <?php 
                    $bill = get_bill($link,$user->username);
                     if(isset($bill[0])){
                        $first = $bill[0]; 
                           $first =$first["name"];
                     }else $first = "Счет";
                    echo ' <input style="width: 102px;" type="text" id="bill" name="bill" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                    echo ' <div><a href="../bill">НОВЫЙ СЧЕТ</a></div>';
                    foreach($bill as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
                    echo '</u>';
                ?>
                         
             
        </div>
     
         <div class="size" style="margin-bottom:25px;width: 385px;float: left;margin-left:0px;">
            
                <?php 
                    $cat = get_cat2($link,$user->username);
                    if(isset($cat[0])){
                         $first = $cat[0]; 
                         $first =$first["name"];
                    }else $first = "Без категории";
                    
                    echo ' <input style="width: 385px;" type="text" id="cat" name="cat" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                 
                    foreach($cat as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
             echo '</u>';
                ?>
        </div>
        <div style="margin-left: 25px;margin-right: 10px;float: right;">
            <a id="foo2"><i class="fa fa-plus-square fa-2x" aria-hidden="true"></i></a>
      
        </div>
        <div id="open2" style="width: 465px;display: none">
           <input id="req" placeholder="Название" class="input form-input" name="cat2name" type="text">           
           <a id="close2"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></a>
        </div>
            <input style="margin-top: 10px;" placeholder="Тег" class="input form-input "  name="tag" type="text">
        </div>       
        <div class="templates">
             <div  class="tMini">
		          <span>Шаблоны</span>        
	         </div>
            <?php 
                $templates = get_templateminus($link,$user->username);
                if($templates){
                    echo '<div style="margin-top: 10px;max-height: 45px;overflow: hidden;">';
                    foreach($templates as $val){
                     $valuta = "'".$val['valuta']."'";
                     $bill = "'".$val['billname']."'";
                     $cat = "'".$val['catname']."'";
                       echo   '<div class="template" onclick="template('.$val["sum"].','.$valuta.','.$bill.','.$cat.');"><span>'.$val["name"].'</span></div>';
                    }
                    echo '</div>';
                }
            ?>      
        </div>    
         <span style="margin-top:15px;" class="reg-login-btn-container">
            <input class="btn" style=" border: 1px solid #1c1c1c;" type="submit" value="Зафиксировать сумму" name="submit-form-minus" />
        </span>
        </form>
    </section>  
    <section id="content-tab2">
       <form  class="form" action="../main.php" method="post">
        <h2 style="margin-bottom: 30px;">Внести доход</h2>
         
        <div style="margin: 0 auto;width: 465px;">
        <div style="width:  275px;display: inline-block;">
        <input style="width: 275px;" placeholder="Сумма" class="input form-input required" name="sum" onkeyup="return proverka(this);" id="sum2" value="" required="" type="text"></div>
      
        <div class="size" style="margin-left: 15px;">
          <input  type="text" id="valuta2" name="valuta" value="RUB" class="field" readonly="readonly" />
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>         
              </ul>
        </div>
         <div class="size" style="width: 102px;margin-left: 15px;">
              
        
                <?php 
                    $bill = get_bill($link,$user->username);
                     if(isset($bill[0])){
                        $first = $bill[0]; 
                           $first =$first["name"];
                     }else $first = "Счет";
                    echo ' <input style="width: 102px;" type="text" id="bill2" name="bill" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                    echo ' <div><a href="../bill">НОВЫЙ СЧЕТ</a></div>';
                    foreach($bill as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
                    echo '</u>';
                ?>
                         
             
        </div>
         <div class="size" style="margin-bottom:25px;width: 385px;float: left;margin-left:0px;">
            
                <?php 
                    $cat = get_cat($link,$user->username);
                    if(isset($cat[0])){
                         $first = $cat[0]; 
                         $first =$first["name"];
                    }else $first = "Источник дохода";
                    
                    echo ' <input style="width: 385px;" type="text" id="cat2" name="cat" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                    echo " <li>Источник дохода</li>";
                    foreach($cat as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
             echo '</u>';
                ?>
       
       
      
  
        </div>
        <div style="margin-left: 25px;margin-right: 10px;float: right;">
            <a id="foo"><i class="fa fa-plus-square fa-2x" aria-hidden="true"></i></a>
      
        </div>
        <div id="open" style="width: 465px;display: none">
            <input id="req2" placeholder="Название" class="input form-input" name="cat2name" type="text">   
            <a id="close"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></a>
        </div>
        <input style="margin-top: 10px;" placeholder="Тег" class="input form-input required"  name="tag"  type="text">
        </div>
           
        <div class="templates">
             <div  class="tMini">
		          <span>Шаблоны</span>
                   
	         </div>
            <?php 
                $templates = get_templateplus($link,$user->username);
                if($templates){
                    echo '<div style="margin-top: 10px;max-height: 45px;overflow: hidden;">';
                    foreach($templates as $val){
                     $valuta = "'".$val['valuta']."'";
                     $bill = "'".$val['billname']."'";
                     $cat = "'".$val['catname']."'";
                       echo   '<div class="template" onclick="template2('.$val["sum"].','.$valuta.','.$bill.','.$cat.');"><span>'.$val["name"].'</span></div>';
                    }
                    echo '</div>';
                }
            ?> 
        </div>
         <span style="margin-top:15px;" class="reg-login-btn-container">
        <input class="btn" style=" border: 1px solid #1c1c1c;" type="submit" value="Зафиксировать доход" name="submit-form-plus" /></span></form>
    </section> 
    <section id="content-tab3">
        <form  class="form" action="../main.php" method="post">
        <h2 style="margin-bottom: 30px;">Внести перевод</h2>
         
        <div style="margin: 0 auto;width: 465px;">
        <div style="width: 360px;display: inline-block;"><input style="width: 360px;" placeholder="Сумма" onkeyup="return proverka(this);" class="input form-input required" name="sum" id="sum3" value="" required="" type="text"></div>
      
        <div class="size">
          <input type="text" id="valuta3" name="valuta" value="RUB" class="field" readonly="readonly" />
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>
            
              </ul>
        </div>
        
        <div style="display: inline-block;"><p>Из</p></div>
         
          <div style="display: inline-block;width: 197px;margin-left: 10px" class="size">
        
               <?php 
                    $bill = get_bill($link,$user->username);
                     if(isset($bill[0])){
                        $first = $bill[0]; 
                           $first =$first["name"];
                     }else $first = "Счет №1";
                    echo ' <input style="width: 197px;" type="text" id = "bill3" name="bill1" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                    echo ' <div><a href="../bill">НОВЫЙ СЧЕТ</a></div>';
                    foreach($bill as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
                    echo '</u>';
                ?>
        </div>
           <div style="display: inline-block;margin-left: 10px;"><p>В</p></div>
           <div style="display: inline-block;width: 197px;margin-left: 10px" class="size">
         
               <?php 
                    $bill = get_bill($link,$user->username);
                     if(isset($bill[0])){
                        $first = $bill[0]; 
                           $first =$first["name"];
                     }else $first = "Счет №2";
                    echo ' <input style="width: 197px;" type="text" id = "bill4" name="bill2" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                    echo ' <div><a href="../bill">НОВЫЙ СЧЕТ</a></div>';
                    foreach($bill as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
                    echo '</u>';
                ?>
        </div>
      
       
        </div>
             <div class="templates">
             <div  class="tMini">
		          <span>Шаблоны</span>
                   
	         </div>
            <?php 
                $templates = get_templateswap($link,$user->username);
                if($templates){
                    echo '<div style="margin-top: 10px;max-height: 45px;overflow: hidden;">';
                    foreach($templates as $val){
                     $valuta = "'".$val['valuta']."'";
                     $bill = "'".$val['bill1name']."'";
                     $bill2 = "'".$val['bill2name']."'";
                       echo   '<div class="template" onclick="template3('.$val["sum"].','.$valuta.','.$bill.','.$bill2.');"><span>'.$val["name"].'</span></div>';
                    }
                    echo '</div>';
                }
            ?>
            
            
        </div>
    
        <span style="margin-top:15px;" class="reg-login-btn-container">
        <input class="btn" style=" border: 1px solid #1c1c1c;" type="submit" value="Зафиксировать перемещение" name="submit-form-swap" /></span></form>
    </section> 
    <section id="content-tab4">
        <form  class="form" action="../main.php" method="post">
        <h2 style="margin-bottom: 30px;">Обмен валюты</h2>
        
        <div style="margin: 0 auto;width: 465px;">
        
        <div style="display: inline-block;width: 100px;text-align: left;"><p>Купили</p></div>
        <input style="display: inline-block;width: 150px;margin-bottom: 0px;" placeholder="Сумма" id="sum4" onkeyup="return proverka(this);" class="input form-input required" required="" name="sum" type="text">
        <div style="display: inline-block;" class="size">
          <input type="text" id="valuta4"  name="valuta" value="RUB" class="field" readonly="readonly" />
              <ul class="list">
                <li>RUB</li>
                <li>EUR</li>
                <li>USD</li>
            
              </ul>
        </div>
        </div>
        <div style="margin: 0 auto;width: 465px;">
        <div style="display: inline-block;width: 100px;text-align: left;"><p>Продали</p></div>
        <input style="display: inline-block;width: 150px;margin-bottom: 0px;" placeholder="Сумма" onkeyup="return proverka(this);" id="sum5" class="input form-input required" required="" name="sum2"  type="text">
        <div style="display: inline-block;" class="size">
         
          <input type="text" id="valuta5" name="valuta2" value="RUB" class="field" readonly="readonly" />
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
                    echo ' <input style="width: 197px; type="text" id="bill5" name="bill" value="'.$first.'" class="field required" readonly="readonly" required=""/>';
                    echo ' <ul class="list">';
                    echo ' <div><a href="../bill">НОВЫЙ СЧЕТ</a></div>';
                    foreach($bill as $value){
                        echo " <li>".$value["name"]."</li>";
                    }
                    echo '</u>';
                ?>
              </div>
    
             <div class="templates">
             <div  class="tMini">
		          <span>Шаблоны</span>
                   
	         </div>
            <?php 
                $templates = get_templateval($link,$user->username);
                if($templates){
                    echo '<div style="margin-top: 10px;max-height: 45px;overflow: hidden;">';
                    foreach($templates as $val){
                     $valuta1 = "'".$val['valuta']."'";
                     $valuta2 = "'".$val['valuta2']."'";
                     $bill = "'".$val['billname']."'";
                  
                       echo   '<div class="template" onclick="template4('.$val["sum1"].','.$val["sum2"].','.$valuta1.','.$valuta2.','.$bill.');"><span>'.$val["name"].'</span></div>';
                    }
                    echo '</div>';
                }
            ?>
            
            
        </div>
    
        </div>
        <span style="margin-top:15px;" class="reg-login-btn-container">
            <input class="btn" style=" border: 1px solid #1c1c1c;" type="submit" value="Обмен" name="submit-form-val" /></span></form></section> </div>
      

 <div class="opertable">
    <div style="padding-top: 15px;width:100%;" class="reg-login-form reg-login" >
	   <input name="registration" value="1" type="hidden">
	   <h2 class="reg-login-header">Журнал операций</h2>
            <form method="get">
                <div style="width:320px;margin:0 auto;">
                    <div class="size" style="margin-left:0px;margin-bottom:5px;display:inline-block; width:120px;">
                        <?php 
                            if(isset($_GET['sort'])) {
                                $sort = $_GET['sort'];
                                echo '<input style="width:120px;"  type="text" id="sort" name="sort" value="'.$sort.'" class="field" readonly="readonly" />';
                            }else echo '<input style="width:120px;"  type="text" id="sort" name="sort" value="За все время" class="field" readonly="readonly" />'; 
                        ?>
         
                        <ul class="list">
                            <li>По категории</li>
                            <li>По счету</li>
                            <li>За год</li>
                            <li>За месяц</li>  
                            <li>За неделю</li>
                             <li>За все время</li>
                        </ul>
                    </div>
                    <div class="size" style="margin-bottom:5px;display:inline-block; width:120px;">
                        <input style="width:120px;"  type="submit" value="Сортировать" class="field" />
                    </div>
                </div>
         
            </form>
      
    <table class="report">
    <?php 
        if(isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        switch ($sort) {
        case "За все время":
            $oper = all_operation($link,$user->username);
            break;
        case "За год":
            $oper = array();
            $op = sort_oper_bydate($link,$user->username);
            $first_day_of_year = date("Y.m.d",strtotime('first day of January'));
            $last_day_of_year = date("Y.m.d",strtotime('last day of December'));
            foreach($op as $val){
                $d = date("Y.m.d", $val["date"]);
                if($d<=$last_day_of_year && $d>=$first_day_of_year){
                    $oper[] = $val;
                }
            }
            break;
        case "За месяц":
            $oper = array();
            $op = sort_oper_bydate($link,$user->username);
            $first_day_of_month = date("Y.m.d",strtotime('first day of this month'));
            $last_day_of_month = date("Y.m.d",strtotime('last day of this month'));
            foreach($op as $val){
                $d = date("Y.m.d", $val["date"]);
                if($d<=$last_day_of_month && $d>=$first_day_of_month){
                    $oper[] = $val;
                }
            }
            break;
        case "За неделю":
            $oper = array();
            $op = sort_oper_bydate($link,$user->username);
            $current_week_start = date("Y.m.d", strtotime("last Monday"));
            $current_week_end = date("Y.m.d", strtotime("Sunday"));
            foreach($op as $val){
                 $d = date("Y.m.d", $val["date"]);
                if($d<=$current_week_end && $d>=$current_week_start){
                    $oper[] = $val;
                }
            }
            
            break;    
        case "По категории":
            $oper = sort_oper_byname($link,$user->username);
            break;
        case "По счету":
            $oper = sort_oper_bybill($link,$user->username);
            break;
        }
    }else{
        $oper = all_operation($link,$user->username);
         }
         if($oper){
             echo  '<tr><th>Название</th><th>Сумма</th><th>Счет</th><th>Дата</th></tr>';
             foreach($oper as $val){
                 $d = date("Y.m.d H:i", $val["date"]);
                 if($val["bool"]==0){
                    echo  '<tr style="color:#7c1301;"><td><a style="color:#7c1301;" href="../change/index.php?id='.$val["id"].'">'.$val["name"].'</a> <div style="text-align: center;"><a class="tMini" href="../report/index.php?name='.$val["tag"].'">'.$val["tag"].'</a></div></td><td>'.$val["sum"].' '.$val["valuta"].'</td><td>'.$val["bill"].'</td><td>'.$d.'</td></tr>';
                 }else {
                     echo  '<tr style="color:#006010;"><td><div><a style="color:#006010;" href="../change/index.php?id='.$val["id"].'">'.$val["name"].'</a></div> <div style="text-align: center;"><a class="tMini" href="../report/index.php?name='.$val["tag"].'">'.$val["tag"].'</a></div></td><td>'.$val["sum"].' '.$val["valuta"].'</td><td>'.$val["bill"].'</td><td>'.$d.'</td></tr>';
                    
                 }
             }
         }
        ?>
    </table>
          
	
</div>
</div>
<div style="float:right;width: 400px;">
 <div class="righttable">
         	<div style="padding-top: 15px;width:100%;" class="reg-login-form reg-login" >
	           <input name="registration" value="1" type="hidden">
	           <h2 class="reg-login-header">Остатки средств</h2>
                <table class="report">
                    <?php 
                    $bill = get_bill($link,$user->username);
                    echo  '<tr><th>Счет</th><th>USD</th><th>EUR</th><th>RUB</th></tr>';
                    if($bill){
             
                    foreach($bill as $val){
                        echo '<tr><td><a href="../changebill?id='.$val["id"].'">'.$val["name"].'</td>';
                        if($val["USD"]>0){
                            echo '<td style="color:#006010;">'.$val["USD"].'</td>';
                        }else echo '<td style="color:#7c1301;">'.$val["USD"].'</td>';
                        if($val["EUR"]>0){
                            echo '<td style="color:#006010;">'.$val["EUR"].'</td>';
                        }else echo '<td style="color:#7c1301;">'.$val["EUR"].'</td>';
                        if($val["RUB"]>0){
                            echo '<td style="color:#006010;">'.$val["RUB"].'</td></tr>';
                        }else  echo '<td style="color:#7c1301;">'.$val["RUB"].'</td></tr>';
             
                    }
                    }
                    ?>
                </table>
          
	
</div>
</div>
    
    <div class="righttable">
         	<div style="padding-top: 15px;width:100%;" class="reg-login-form reg-login" >
	           <input name="registration" value="1" type="hidden">
	           <h2 class="reg-login-header">Контроль расходов</h2>
                <table class="report">
                    
                    <?php 
                        echo  '<tr><th>Категория</th><th>USD</th><th>EUR</th><th>RUB</th></tr>';
                        $catt = get_cat2($link,$user->username);
        
                    $oper = get_oper($link,"Без категории");
                    if($oper){
                        $sumrub = 0;
                        $sumusd = 0;
                        $sumeur = 0;
                       foreach($oper as $value){
                                $valuta = $value["valuta"];
                                if(strcasecmp ($valuta,"RUB")==0)
                                {
                                    $sumrub = (int)$sumrub + (int)$value["sum"];
                                }
                                if(strcasecmp ($valuta,"EUR")==0)
                                {
                                     $sumeur = (int)$sumeur + (int)$value["sum"];
                                }
                                if(strcasecmp ($valuta,"USD")==0)
                                {
                                    $sumusd = (int)$sumusd + (int)$value["sum"];
                                }
                            }
                            echo '<tr style="color:#7c1301;"><td>Без категории</td><td>'.$sumusd.'</td><td>'.$sumeur.'</td><td>'.$sumrub.'</td></tr>';
                     
                    }
                            
                    if($catt){
                
                        foreach($catt as $val){
                            $oper = get_oper($link,$val["name"]);
                            $sumrub = 0;
                            $sumusd = 0;
                            $sumeur = 0;
                            foreach($oper as $value){
                                $valuta = $value["valuta"];
                                if(strcasecmp ($valuta,"RUB")==0)
                                {
                                    $sumrub = (int)$sumrub + (int)$value["sum"];
                                }
                                if(strcasecmp ($valuta,"EUR")==0)
                                {
                                     $sumeur = (int)$sumeur + (int)$value["sum"];
                                }
                                if(strcasecmp ($valuta,"USD")==0)
                                {
                                    $sumusd = (int)$sumusd + (int)$value["sum"];
                                }
                                
                               
                            }
                            echo '<tr style="color:#7c1301;"><td>'.$val["name"].'</td><td>'.$sumusd.'</td><td>'.$sumeur.'</td><td>'.$sumrub.'</td></tr>';
                        }
                         
                    }
                    ?>
                </table>
          
	
            </div>
    </div>
    
    <div style="margin-bottom:50px;" class="righttable">
        <div style="padding-top: 15px;width:100%;" class="reg-login-form reg-login" >
	    <input name="registration" value="1" type="hidden">
	    <h2 class="reg-login-header">Курсы валют</h2>
        <table class="report2">
       <?php
        $date = date("d/m/Y"); // Сегодняшняя дата в необходимом формате
        $date2 = date("d.m.Y"); // Сегодняшняя дата в необходимом формате
        $linkk = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date"; // Ссылка на XML-файл с курсами валют
        $content = file_get_contents($linkk); // Скачиваем содержимое страницы
        $dom = new domDocument("1.0", "cp1251"); // Создаём DOM
        $dom->loadXML($content); // Загружаем в DOM XML-документ
        $root = $dom->documentElement; // Берём корневой элемент
        $childs = $root->childNodes; // Получаем список дочерних элементов
        $data = array(); // Набор данных
        for ($i = 0; $i < $childs->length; $i++) {
            $childs_new = $childs->item($i)->childNodes; 
            if(isset($childs_new)){// Берём дочерние узлы
                for ($j = 0; $j < $childs_new->length; $j++) {
      /* Ищем интересующие нас валюты */
                    $el = $childs_new->item($j);
                    $code = $el->nodeValue;
                    if (($code == "GBP") ||($code == "USD") || ($code == "EUR")) $data[] = $childs_new; // Добавляем необходимые валюты в массив
                    }
            }
        }
  /* Перебор массива с данными о валютах */
        echo '<tr><th>Курсы валют на</th><th>'.$date2.'</th></tr>';
        for ($i = 0; $i < count($data); $i++) {
            $list = $data[$i];
            for ($j = 0; $j < $list->length; $j++) {
                $el = $list->item($j);
                /* Выводим курсы валют */
            if ($el->nodeName == "Name") { 
                if($el->nodeValue =="Доллар США")
                    echo '<tr><td>'.$el->nodeValue.'</td>';
                else if($el->nodeValue =="Евро")
                    echo '<tr><td>'.$el->nodeValue.'</td>';
                else if($el->nodeValue =="Фунт стерлингов Соединенного королевства")
                    echo '<tr><td>Фунт</td>';
          
            }
     
                if ($el->nodeName == "Value") echo '<td>'.$el->nodeValue.'</td></tr>';
            }
        }
        ?>
    </table>
          
	
</div>
</div>
</div>
<div style="clear:both;"></div>
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