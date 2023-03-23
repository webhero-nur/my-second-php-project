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

        function add_user($full_name, $username, $password){

            // $qry = "INSERT INTO users(full_name, username, password) VALUES('".$_POST['full_name']."','".$_POST['username']."','".$_POST['password']."')";
            $qry = "INSERT INTO users(full_name, username, password) VALUES('".$full_name."','".$username."','".$password."')"; // my code
            
            $result = $this->con->query($qry);

            if($result){
                echo "<script>alert('User Inserted')</script>";
                echo "<script>window.location = '../../index.php';</script>";
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

        public function check_username($potential_username='')
        {
            $qry = "SELECT id FROM users WHERE username='".$potential_username."'";

            $res = $this->con->query($qry);

            if($res->num_rows>0){
                echo "username '".$potential_username."' is not available.";
            }
            else{
                echo "username available";
            }

        }

        public function login()
        {
            echo $this->user_auth("login");
        }

    }

?>