<?php 
    require_once("Database.class.php");
    require_once("DBmodels.php");
    require_once("global.inc.php");
    

    $db = new Database();

    $link = $db->connect();
    $user = unserialize($_SESSION['user']);
    $username = $user->username;

if(isset($_POST['submit-form-bill'])) { 
      if(isset($_POST['name'])) {
          $name= $_POST['name'];
         
          if(isset($_POST['USD'])) {
              $usd = $_POST['USD'];
              
          }if(isset($_POST['EUR'])) {
              $eur = $_POST['EUR'];
             
          }if(isset($_POST['RUB'])) {
              $rub = $_POST['RUB'];
              
          }
          $bill = get_cash($link,$name);
          if(!$bill){
              add_bill($link,$name,$username,$usd,$eur,$rub);
               header("Location: private/index.php");
          }else {
               $_SESSION['error'] = "Такой счет уже есть";                              
               header("Location: bill/");
          }
          
      }
   
}
if(isset($_POST['form-acc-big'])) {
    $size = "big";
    acc($size,$link,$username);
}if(isset($_POST['form-acc-mid'])) {
    $size = "mid";
    acc($size,$link,$username);
}if(isset($_POST['form-acc-lil'])) {
    $size = "lil";
    acc($size,$link,$username);
}
function acc($size,$link,$username){
   if(isset($_POST['name'])) {
          $name= $_POST['name'];
         
              if(isset($_POST['sum'])){
                 $cashneed  =  $_POST['sum'];
                  if(isset($_POST['sum'])){
                      $cash =  $_POST['sum2'];
                        if(isset($_POST['valuta'])) {
                            $valuta = $_POST['valuta'];
                            if(strcasecmp ($valuta,"RUB")==0){
                                $usd=$eur="";
                                add_bill($link,$name,$username,$usd,$eur, $cash);
                            }else if(strcasecmp ($valuta,"EUR")==0){
                               
                                $usd=$rub="";
                                add_bill($link,$name,$username,$usd, $cash,$rub);
                            }
                            else  if(strcasecmp ($valuta,"USD")==0){
                                
                                $eur=$rub="";
                                add_bill($link,$name,$username,$cash,$eur,$rub);
                                }
                  
                            
                        }
                  }
              }
         
         add_acc($link,$name,$username,$size,$cashneed,$valuta);
      } 
     header("Location: accumulation/index.php");
}
      
  


    
if(isset($_POST['submit-form-minus'])) {
   if(isset($_POST['cat'])) {
        if(isset($_POST['cat2name']) && strcasecmp ($_POST['cat2name'],"")==0) {
            $name= $_POST['cat'];
            if(strcasecmp ($name,"Без категории")==0){
                $id = "";
            }else  {
                $cats = get_n_cat2($link,$name);
                if(!$cats){
                $id = add_cat2($link,$name,$username);
            }else {
                    $id = get_cat2_id($link,$username,$name);
                }      
               

            }   
        }else {
            $name = $_POST['cat2name'];
            $cats = get_n_cat2($link,$name);
            if(!$cats){
                $id = add_cat2($link,$name,$username);
            }     
            else{
               $id = get_cat2_id($link,$username,$name);   
            }   
        }
         if(isset($_POST['sum'])) {
            
             $sum = $_POST['sum'];
             if(isset($_POST['valuta'])) {
               
               $w=$_POST['valuta'];
                if(isset($_POST['bill'])) {
                    $bill = $_POST['bill'];
                    if(strcasecmp ($bill,"Счет")!=0){
                     $cash = get_cash($link,$bill);
                   
                     $cash = (int)$cash[$w] - (int)$sum;
                     update_bill($link,$w,$bill,$cash);
                    }else {
                              $_SESSION['error'] = "Создайте или выберите счет";                              
                              header("Location: private/");
                    }
                  
                }
               
               $date = time ();
                if(isset($_POST['tag'])) {
                    $tag = $_POST['tag'];
                }
                $cat_id = "";
                $bool = 0;
                add_operation($link,$username,$name,$cat_id,$id,$bill,$tag,$w,$sum,$date,$bool);
            }
             
         }
    
     header("Location: private/");
}
}
if(isset($_POST['submit-form-plus'])) {
   if(isset($_POST['cat'])) {
        if(isset($_POST['cat2name']) && strcasecmp ($_POST['cat2name'],"")==0) {
            $name= $_POST['cat'];
            if(strcasecmp ($name,"Источник дохода")==0){
                $id = "";
                $name = "Неизвестный источник";
            }else {
                $cats = get_n_cat($link,$name);
                if(!$cats){
                $id = add_cat($link,$name,$username);
            }else {
                    $id = get_cat_id($link,$username,$name);
                }
            }
               
       
        }else {
            $name = $_POST['cat2name'];
            $cats = get_n_cat($link,$name);
            if(!$cats){
                $id = add_cat($link,$name,$username);
            }     
            else{
               $id = get_cat_id($link,$username,$name);   
            }   
        }
        
    
     
         if(isset($_POST['sum'])) {
            
             $sum = $_POST['sum'];
             if(isset($_POST['valuta'])) {
               
               $w=$_POST['valuta'];
                if(isset($_POST['bill'])) {
                    $bill = $_POST['bill'];
                    if(strcasecmp ( $bill,"Счет")!=0){
                        
                        $cash = get_cash($link,$bill);
                   
                        $cash = (int)$cash[$w] + (int)$sum;
                        update_bill($link,$w,$bill,$cash);
                    }else {
                         $_SESSION['error'] = "Создайте или выберите счет";
                         header("Location: private/");
                    }
                    
                }
               
               $date = time ();
                if(isset($_POST['tag'])) {
                    $tag = $_POST['tag'];
                }
                $cat_id = "";
                $bool = 1;
                add_operation($link,$username,$name,$cat_id,$id,$bill,$tag,$w,$sum,$date,$bool);
            }
             
         }
    
     header("Location: private/");
}
}
if(isset($_POST['submit-form-swap'])) {
      if(isset($_POST['sum'])) {
             $sum = $_POST['sum'];
          
              if(isset($_POST['valuta'])) {
                    $w=$_POST['valuta'];
                   if(isset($_POST['bill1'])) {
                        $bill = $_POST['bill1'];
                        if(strcasecmp ( $bill,"Счет №1")!=0){
                            $cash = get_cash($link,$bill);
                            $cash = (int)$cash[$w] - (int)$sum;
                            update_bill($link,$w,$bill,$cash);
                        }else {
                            $_SESSION['error'] = "Создайте или выберите счет №1";
                            header("Location: private/");
                        }
                   }
                  if(isset($_POST['bill2'])) {
                        $bill = $_POST['bill2'];
                        if(strcasecmp ( $bill,"Счет №2")!=0){
                            $cash = get_cash($link,$bill);
                            $cash = (int)$cash[$w] + (int)$sum;
                            update_bill($link,$w,$bill,$cash);
                        }else {
                         $_SESSION['error'] = "Создайте или выберите счет №2";
                         header("Location: private/");
                    }
                   }
              }
      }
    
     header("Location: private/");
}
if(isset($_POST['submit-form-val'])) {
    
    if(isset($_POST['sum'])) {
             $sum = $_POST['sum'];
             if(isset($_POST['sum2'])) {
                $sum2 = $_POST['sum2'];
                 if(isset($_POST['valuta'])) {
                    $w=$_POST['valuta'];
                 }
                 if(isset($_POST['valuta2'])) {
                    $w2=$_POST['valuta2'];
                 }
                 if(strcasecmp ($w, $w2)!=0){
                      if(isset($_POST['bill'])) {
                        $bill = $_POST['bill'];
                        if(strcasecmp ( $bill,"Счет")!=0){
                            $cash = get_cash($link,$bill);
                            $cash = (int)$cash[$w] + (int)$sum;
                            update_bill($link,$w,$bill,$cash);
                            $cash = get_cash($link,$bill);
                            $cash = (int)$cash[$w2] - (int)$sum2;
                            update_bill($link,$w2,$bill,$cash);
                        }else {
                              $_SESSION['error'] = "Создайте или выберите счет";
                              
                              header("Location: private/");
                    }
                        
                        
                      }
                 }else {
                              $_SESSION['error'] = "Валюты должны отличаться";
                              header("Location: private/");
                 }
             }
       
    }
     header("Location: private/");
   
}
if(isset($_POST['template-form-minus'])) {
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        if(isset($_POST["sum"])){
            $sum = $_POST["sum"];
            
            if(isset($_POST["valuta"])){
                $valuta = $_POST["valuta"];
                if(isset($_POST["cat"])){
                         if(strcasecmp ($_POST['cat2name'],"")==0) {
                              $catname = $_POST["cat"]; 
                         }else{
                             $catname = $_POST['cat2name'];
                         }
                        
                     } 
                     if(isset($_POST['bill'])) {
                        $bill = $_POST['bill'];
                         
                        if(strcasecmp ($bill,"Счет")!=0){
                            $billname = $bill;
                            add_templateminus($link,$name,$username,$sum,$valuta,$comment,$billname,$catname);
                        }else {          
                                $_SESSION['error'] = "Создайте или выберите счет";
                                    
                                header("Location: template/");
                    }
                     
                  
                }
            }
         
        }
    } header("Location: template/");
}
if(isset($_POST['template-form-plus'])) {
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        if(isset($_POST["sum"])){
            $sum = $_POST["sum"];
            
            if(isset($_POST["valuta"])){
                $valuta = $_POST["valuta"];
                     if(isset($_POST['bill'])) {
                        $bill = $_POST['bill'];
                        if(strcasecmp ($bill,"Счет")!=0){
                            $billname = $bill;
                        }else {
                                $_SESSION['error'] = "Создайте или выберите счет";
                                header("Location: template/plus/");
                    }
                     if(isset($_POST["cat"])){
                        
                         if(strcasecmp ($_POST['cat2name'],"")==0) {
                              $catname = $_POST["cat"]; 
                         }else{
                             $catname = $_POST['cat2name'];
                         }
                                                         
                         
                      
                             add_templateplus($link,$name,$username,$sum,$valuta,$comment,$billname,$catname);
                         
                     } 
                  
                }
            }
        
        }
    } header("Location: template/plus/");
}
if(isset($_POST['template-form-swap'])) {
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        if(isset($_POST["sum"])){
            $sum = $_POST["sum"];
            
            if(isset($_POST["valuta"])){
                $valuta = $_POST["valuta"];
                     if(isset($_POST['bill1'])) {
                        $bill = $_POST['bill1'];
                        if(strcasecmp ($bill,"Cчет №1")!=0){
                            $bill1name = $bill;
                        }else {
                                $_SESSION['error'] = "Создайте или выберите счет №1";
                                header("Location: template/swap/");
                        }
                     if(isset($_POST['bill2'])) {
                           $bill = $_POST['bill2'];
                        if(strcasecmp ($bill,"Счет №2")!=0){
                            $bill2name = $bill;
                            add_templateswap($link,$name,$username,$sum,$valuta,$bill1name,$bill2name);
                        }else {
                                $_SESSION['error'] = "Создайте или выберите счет №2";
                                header("Location: template/swap/");
                        }
                         
                     }
                
                  
                }
            }
        
        }
    } header("Location: template/swap/");
}
if(isset($_POST['template-form-val'])) {
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        if(isset($_POST["sum1"])){
            $sum1 = $_POST["sum1"];
            if(isset($_POST["sum2"])){
                $sum2 = $_POST["sum2"];
                 if(isset($_POST["valuta"])){
                    $valuta = $_POST["valuta"];
                      if(isset($_POST["valuta2"])){
                        $valuta2 = $_POST["valuta2"];
                      }
                      if(strcasecmp ($valuta,$valuta2)!=0){
                            if(isset($_POST['bill'])) {
                                $bill = $_POST['bill'];
                                if(strcasecmp ($bill,"Счет")!=0){
                                    $billname = $bill;
                                }else {                  
                                        $_SESSION['error'] = "Создайте или выберите счет";
                                        header("Location: template/val/");
                                }
                               
                            }
                      add_templateval($link,$name,$username,$valuta,$valuta2,$billname,$sum1,$sum2);
                 }else {
                          $_SESSION['error'] = "Валюты должны различаться";
                          header("Location: template/val/");
                      }
                 }
            }
        }
    }
    header("Location: template/val/");
}
if(isset($_POST['change-form-change'])) {
    if(isset($_POST['sum'])) {
        $sum = $_POST['sum'];
        if(isset($_POST['bill'])) {
            $bill = $_POST['bill'];
            $id = $_GET['id'];
            update_oper($link,$sum,$id,$bill);
            header("Location: change/index.php?id=$id");
        }
    }
}
if(isset($_POST['change-form-del'])) {
     $id = $_GET['id'];
     oper_delete($link,$id);
    header("Location: private/");
}    
if(isset($_POST['changebill-form-change'])) {
    if(isset($_POST['USD'])) {
        $usd = $_POST['USD'];
        if(isset($_POST['EUR'])) {
            $eur= $_POST['EUR'];
            if(isset($_POST['RUB'])) {
                $rub= $_POST['RUB'];
                $id = $_GET['id'];
                update_bill_ch($link,$usd,$eur,$rub,$id);
                 header("Location: changebill/index.php?id=$id");
            }
        
          
        }
    }
}
if(isset($_POST['changebill-form-del'])) {
     $id = $_GET['id'];
    bill_delete($link,$id);
    header("Location: private/");
} 

?>