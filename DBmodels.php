<?php 
   function all_operation($link,$username){
    $username = trim($username);
    $sql = "SELECT * FROM oper  WHERE user_name = '%s' ORDER BY id DESC";
    $query = sprintf($sql,mysqli_real_escape_string($link,$username));
    $result = mysqli_query($link,$query);
    
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $operations = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
         $operations[] = $row;
        
    }
    return   $operations;
}
function oper_delete($link,$id){
    
     $id = (int)$id;
     if($id==0) 
        return false;
    
     $query = sprintf("DELETE FROM oper  WHERE id = '%d'",(int)$id);
     $result = mysqli_query($link,$query);
    if(!$result)
        die(mysqli_error($link));
    
    return mysqli_affected_rows($link);
}
function update_oper($link,$sum,$id,$bill){
    $$sum= trim($sum);
    $$bill= trim($bill);
    $sqll = "UPDATE oper  SET sum='%s',bill='%s' WHERE id = '%d'";
    $query = sprintf($sqll,mysqli_real_escape_string($link,$sum),mysqli_real_escape_string($link,$bill),(int)$id);
    $result = mysqli_query($link,$query);
    
   
    
     if(!$result)
        die(mysqli_error($link));
    
    return true;
}
function add_operation($link,$user_name,$name,$cat_id,$cat2_id,$bill,$tag,$valuta,$sum,$date,$bool){
    $name = trim($name);
    $user_name = trim($user_name);
    $tag = trim($tag);
    $valuta= trim($valuta);
    $sum= trim($sum);
    $t = "INSERT INTO oper (user_name,cat_id,cat2_id,bill,name,tag,valuta,sum,date,bool) VALUES ('%s','%d','%d','%s','%s','%s','%s','%s','%d','%d')";
    
     $query=sprintf($t,mysqli_real_escape_string($link,$user_name),(int)$cat_id,(int)$cat2_id,mysqli_real_escape_string($link,$bill),mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$tag),mysqli_real_escape_string($link,$valuta),mysqli_real_escape_string($link,$sum),(int)$date,(int)$bool);
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
    
    return true;
}
function add_cat($link,$name,$username){
    $name = trim($name);
    $cash= trim($cash);
    $username = trim($username);
    $t = "INSERT INTO cat (name,user_name) VALUES ('%s','%s')";
    
     $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
    
     return mysqli_insert_id($link);
}
function get_oper($link,$name){
    $name = trim($name);
      $sql = "SELECT * FROM oper WHERE name = '%s'";
     $query = sprintf($sql,mysqli_real_escape_string($link,$name));
     $result = mysqli_query($link,$query);
  if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $res = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
        
    }
    return   $res;
}
function sort_oper_byname($link,$username){
    $username = trim($username);
      $sql = "SELECT * FROM oper WHERE user_name = '%s' ORDER BY name DESC";
     $query = sprintf($sql,mysqli_real_escape_string($link,$username));
     $result = mysqli_query($link,$query);
  if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $res = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
        
    }
    return   $res;
}
function sort_oper_bydate($link,$username){
    $username = trim($username);
      $sql = "SELECT * FROM oper WHERE user_name = '%s' ORDER BY date DESC";
     $query = sprintf($sql,mysqli_real_escape_string($link,$username));
     $result = mysqli_query($link,$query);
  if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $res = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
        
    }
    return   $res;
}
function sort_oper_bybill($link,$username){
    $username = trim($username);
      $sql = "SELECT * FROM oper WHERE user_name = '%s' ORDER BY bill DESC";
     $query = sprintf($sql,mysqli_real_escape_string($link,$username));
     $result = mysqli_query($link,$query);
  if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $res = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
        
    }
    return   $res;
}
function get_oper_bytag($link,$tag){
    $tag = trim($tag);
      $sql = "SELECT * FROM oper WHERE tag = '%s'";
     $query = sprintf($sql,mysqli_real_escape_string($link,$tag));
     $result = mysqli_query($link,$query);
  if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $res = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
        
    }
    return   $res;
}

function get_oper_byid($link,$id){
     $sql = "SELECT * FROM oper WHERE id = '%d'";
     $query = sprintf($sql,(int)$id);
     $result = mysqli_query($link,$query);
  if(!$result)
        die(mysqli_error($link));
    

        $row = mysqli_fetch_assoc($result);

        
    
    return   $row;
}
function get_cat($link,$name_user){
    $name_user = trim($name_user);
    $sql = "SELECT * FROM cat WHERE user_name = '%s'";
     $query = sprintf($sql,mysqli_real_escape_string($link,$name_user));
     $result = mysqli_query($link,$query);
  if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $cat = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $cat[] = $row;
        
    }
    return   $cat;
}
function get_n_cat($link,$name){
    $name = trim($name);
    $sql = "SELECT * FROM cat WHERE name = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$name));
    $result = mysqli_query($link,$query);
 if(!$result)
        die(mysqli_error($link));
    
    return mysqli_affected_rows($link);
        
    
  
}

function add_cat2($link,$name,$username){
    $name = trim($name);
   
    $username = trim($username);
    $t = "INSERT INTO cat2 (name,user_name) VALUES ('%s','%s')";
    
     $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
    
    return mysqli_insert_id($link);
}
function get_cat2($link,$name_user){
   $name_user = trim($name_user);
    $sql = "SELECT * FROM cat2 WHERE user_name = '%s'";
     $query = sprintf($sql,mysqli_real_escape_string($link,$name_user));
     $result = mysqli_query($link,$query);
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $cat = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $cat[] = $row;
        
    }
    return   $cat;
}
function get_n_cat2($link,$name){
    $name = trim($name);
    $sql = "SELECT * FROM cat2 WHERE name = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$name));
    $result = mysqli_query($link,$query);
 if(!$result)
        die(mysqli_error($link));
    
    return mysqli_affected_rows($link);
        
    
  
}
function get_cat2_id($link,$name_user,$name){
    $name_user = trim($name_user);
    $name = trim($name);
    $sql = "SELECT * FROM cat2 WHERE user_name = '%s' and name = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$name_user),mysqli_real_escape_string($link,$name));
     $result = mysqli_query($link,$query);
    if(!$result)
        die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    return    $row["id"];
}
function get_cat_id($link,$name_user,$name){
    $name_user = trim($name_user);
    $name = trim($name);
    $sql = "SELECT * FROM cat WHERE user_name = '%s' and name = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$name_user),mysqli_real_escape_string($link,$name));
     $result = mysqli_query($link,$query);
    if(!$result)
        die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    return    $row["id"];
}
function add_bill($link,$name,$username,$usd,$eur,$rub){
   
    $name = trim($name);
   
    $username = trim($username);
    
        $t = "INSERT INTO bill (name,user_name,USD,EUR,RUB) VALUES ('%s','%s','%d','%d','%d')";
        $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username),(int)$usd,(int)$eur,(int)$rub);
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
         return true;

    }
    
    
     
    

function update_bill($link,$w,$name,$cash){
  
    $w = trim($w);
    $name = trim($name);
  
    if(strcasecmp ($w,"RUB")==0){
        $sql = "UPDATE bill  SET RUB='%d' WHERE name = '%s'";
        $query=sprintf($sql,(int)$cash,mysqli_real_escape_string($link,$name));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
    }else if(strcasecmp ($w,"USD")==0){
        $sql = "UPDATE bill  SET USD='%s' WHERE name = '%s'";
        $query=sprintf($sql,(int)$cash,mysqli_real_escape_string($link,$name));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
    }else if(strcasecmp ($w,"USD")==0){
        $sql = "UPDATE bill  SET USD='%s' WHERE name = '%s'";
        $query=sprintf($sql,(int)$cash,mysqli_real_escape_string($link,$name));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
    }

    
   
    
    return true;
}
function get_cash($link,$name){
    
          $sql = "SELECT * from bill WHERE name = '%s'";
          $query = sprintf($sql,mysqli_real_escape_string($link,$name));
          $result = mysqli_query($link,$query);
          if(!$result)
            die(mysqli_error($link));
          $cash = mysqli_fetch_assoc($result);
          return $cash;
   
}
function get_bill($link,$username){
   
    $sql = "SELECT * FROM bill  WHERE user_name = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$username));
    $result = mysqli_query($link,$query);
    
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $bill = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $bill[] = $row;
        
    }
    return   $bill;
}
function get_bill_id($link,$id){
   
    $sql = "SELECT * FROM bill  WHERE id = '%d'";
    $query = sprintf($sql,($id));
    $result = mysqli_query($link,$query);
if(!$result)
        die(mysqli_error($link));
    

        $row = mysqli_fetch_assoc($result);

        
    
    return   $row;;
}
function bill_delete($link,$id){
    
     $id = (int)$id;
     if($id==0) 
        return false;
    
     $query = sprintf("DELETE FROM bill WHERE id = '%d'",(int)$id);
     $result = mysqli_query($link,$query);
    if(!$result)
        die(mysqli_error($link));
    
    return mysqli_affected_rows($link);
}
function update_bill_ch($link,$usd,$eur,$rub,$id){
    $usd= trim($usd);
     $eur= trim($eur);
     $rub= trim($rub);
    $bill= trim($bill);
    $sqll = "UPDATE bill  SET USD='%d',EUR='%d',RUB='%d' WHERE id = '%d'";
    $query = sprintf($sqll,(int)$usd,(int)$eur,(int)$rub,(int)$id);
    $result = mysqli_query($link,$query);
    
   
    
     if(!$result)
        die(mysqli_error($link));
    
    return true;
}
function add_acc($link,$name,$username,$size,$cashneed,$valuta){
    $size = trim($size);
    $name = trim($name);
    $valuta = trim($valuta);
    $username = trim($username);
    
        $t = "INSERT INTO purchases (name,user_name,size,cashneed,valuta) VALUES ('%s','%s','%s','%d','%s')";
        $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username),mysqli_real_escape_string($link,$size),(int)$cashneed,mysqli_real_escape_string($link,$valuta));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
         return true;

    }

function get_acc($link,$username){
    $username = trim($username);
    $sql = "SELECT * FROM purchases  WHERE user_name = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$username));
    $result = mysqli_query($link,$query);
    
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $acc = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $acc[] = $row;
        
    }
    return   $acc;
}
function add_templateminus($link,$name,$username,$sum,$valuta,$comment,$billname,$catname){
     $name = trim($name);
     $valuta = trim($valuta);
     $username = trim($username);
     $catname = trim($catname);
     $comment = trim($comment);
     $billname = trim($billname);
    
        $t = "INSERT INTO templateminus (name,username,sum,valuta,comment,billname,catname) VALUES ('%s','%s','%d','%s','%s','%s','%s')";
        $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username),(int)$sum,mysqli_real_escape_string($link,$valuta),mysqli_real_escape_string($link,$comment),mysqli_real_escape_string($link,$billname),mysqli_real_escape_string($link,$catname));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
         return true;

    }
function get_templateminus($link,$username){
    $username = trim($username);
    $sql = "SELECT * FROM templateminus  WHERE username = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$username));
    $result = mysqli_query($link,$query);
    
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $acc = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $acc[] = $row;
        
    }
    return   $acc;
}
function add_templateplus($link,$name,$username,$sum,$valuta,$comment,$billname,$catname){
     $name = trim($name);
     $valuta = trim($valuta);
     $username = trim($username);
     $catname = trim($catname);
     $comment = trim($comment);
     $billname = trim($billname);
    
        $t = "INSERT INTO templateplus (name,username,sum,valuta,comment,billname,catname) VALUES ('%s','%s','%d','%s','%s','%s','%s')";
        $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username),(int)$sum,mysqli_real_escape_string($link,$valuta),mysqli_real_escape_string($link,$comment),mysqli_real_escape_string($link,$billname),mysqli_real_escape_string($link,$catname));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
         return true;

    }
function get_templateplus($link,$username){
    $username = trim($username);
    $sql = "SELECT * FROM templateplus  WHERE username = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$username));
    $result = mysqli_query($link,$query);
    
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $acc = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $acc[] = $row;
        
    }
    return   $acc;
}
function add_templateswap($link,$name,$username,$sum,$valuta,$bill1name,$bill2name){
     $name = trim($name);
     $valuta = trim($valuta);
     $username = trim($username);
     $bill1name = trim($bill1name);
      $bill2name = trim($bill2name);
        $t = "INSERT INTO templateswap (name,username,sum,valuta,bill1name,bill2name) VALUES ('%s','%s','%d','%s','%s','%s')";
        $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username),(int)$sum,mysqli_real_escape_string($link,$valuta),mysqli_real_escape_string($link,$bill1name),mysqli_real_escape_string($link,$bill2name));
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
         return true;

    }
function get_templateswap($link,$username){
    $username = trim($username);
    $sql = "SELECT * FROM templateswap  WHERE username = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$username));
    $result = mysqli_query($link,$query);
    
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $acc = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $acc[] = $row;
        
    }
    return   $acc;
}
function add_templateval($link,$name,$username,$valuta,$valuta2,$billname,$sum1,$sum2){
     $name = trim($name);
     $valuta = trim($valuta);
     $username = trim($username);
     $billname = trim($billname);
     $valuta2= trim($valuta2);
        $t = "INSERT INTO templateval (name,username,valuta,valuta2,billname,sum1,sum2) VALUES ('%s','%s','%s','%s','%s','%d','%d')";
        $query=sprintf($t,mysqli_real_escape_string($link,$name),mysqli_real_escape_string($link,$username),mysqli_real_escape_string($link,$valuta),mysqli_real_escape_string($link,$valuta2),mysqli_real_escape_string($link,$billname),(int)$sum1,(int)$sum2);
   
     $result = mysqli_query($link,$query);
    
     if(!$result)
        die(mysqli_error($link));
         return true;

    }
function get_templateval($link,$username){
    $username = trim($username);
    $sql = "SELECT * FROM templateval  WHERE username = '%s'";
    $query = sprintf($sql,mysqli_real_escape_string($link,$username));
    $result = mysqli_query($link,$query);
    
    if(!$result)
        die(mysqli_error($link));
    
    $n = mysqli_num_rows($result);
    $acc = array();
    
    for($i = 0;  $i<$n;$i++)
    {
        $row = mysqli_fetch_assoc($result);
        $acc[] = $row;
        
    }
    return   $acc;
}
?>