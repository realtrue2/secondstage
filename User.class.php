<?php 

    require_once 'Database.class.php';

class User{
        public $id;
        public $username;
        public $hashedPassword;
        public $email;
       
        function __construct($data) {
            $this->id = (isset($data['id'])) ? $data['id'] : "";
            $this->username = (isset($data['name'])) ? $data['name'] : "";
            $this->hashedPassword = (isset($data['password'])) ? $data['password'] : "";
            $this->email = (isset($data['mail'])) ? $data['mail'] : "";
            
            
        }
        
        public function save($isNewUser = false) {

            $db = new Database();
            $link = $db->connect();

            if(!$isNewUser) {
                //set the data array
                $data = array(
                    "name" => "'$this->username'",
                    "password" => "'$this->hashedPassword'",
                    "mail" => "'$this->email'"
                );


                $db->update($data, 'users', 'name = '.$this->username,$link);
                }else {

                $data = array(
                    "name" => "'$this->username'",
                    "password" => "'$this->hashedPassword'",
                    "mail" => "'$this->email'",
                    
                );
                $this->id = $db->insert($data,'users',$link);
              
            }
            return true;
        }
    }

?>