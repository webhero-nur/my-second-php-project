<?php

    class auth{
        public function user_auth($type='')
        {
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $db = 'expense_recorder';

            $headers = apache_request_headers();
            $tokenData = explode(" ", $headers['auth']);
            $credentials = explode(":", base64_decode($tokenData[1]));
            
            $con = new mysqli($host, $user, $password, $db);

            $qry = "SELECT id, full_name, recovery FROM users WHERE username='".$credentials[0]."' AND password='".strrev($credentials[1])."';";

            $res = $con->query($qry);

            if($res->num_rows===1){

                if($type=='login'){

                    header("Content-type: application/json");
                    return json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
                }
                else{
                    return true;
                }

            }
            else{
                return false;
            }
        }
    }

?>