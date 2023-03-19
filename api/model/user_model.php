<?php
    
    include "../helpers/auth.php";

    class user_model extends auth{
        
        function __construct(){
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $db = 'expense_recorder';
            $this->con = new mysqli($host, $user, $password, $db);
            // db connection check
            // if($con->connect_errno==0){
            //     echo "Connection Successful<br>";
            // }
            // else{
            //     echo "<h2>".$con->connect_error."</h2>";
            // }
        }

        function add_user(){

            $qry = "INSERT INTO users(full_name, username, password) VALUES('".$_POST['full_name']."','".$_POST['username']."','".$_POST['password']."')";

            $result = $this->con->query($qry);

            if($result){
                echo "User added";
            }
            else{
                echo "Contact Developer";
            }
        }

        function list_all_user(){

            if($this->user_auth()){
                $qry = "SELECT * FROM users";
    
                $result = $this->con->query($qry);
                // fetch from db
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                // converting to json
                header("Content-type: application/json");
                echo json_encode($data);
            }
            else{
                echo "Auth Fail";
            }
            
        }

        public function login()
        {
            echo $this->user_auth("login");
        }

    }

?>