<?php
    
    include "../helpers/auth.php";

    class user_model extends auth{
        
        function __construct(){
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $db = 'expense_recorder';
            $this->con = new mysqli($host, $user, $password, $db);
        }

        public function check_username($potential_username=''){
            $qry = "SELECT id FROM users WHERE username='".$potential_username."'";

            $res = $this->con->query($qry);

            if($res->num_rows>0){
                echo "username not available.";
            }
            else{
                echo "username available";
            }
        }

        function add_user(){

            $qry = "INSERT INTO users(full_name, username, password) VALUES('".$_POST['full_name']."','".$_POST['username']."','".$_POST['password']."')";
            
            $result = $this->con->query($qry);

            if($result){
                echo "SignUp Successful";
            }
            else{
                echo "Contact Developer user_model.php --> add_user";
            }
        }

        public function login(){
            echo $this->user_auth("login");
        }

    }

?>