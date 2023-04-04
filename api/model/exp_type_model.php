<?php

include '../helpers/auth.php';

class exp_type_model extends auth{

    function __construct(){
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $db = 'expense_recorder';
        $this->con = new mysqli($host, $user, $password, $db);
    }

    public function add_exp_type($title, $uid){

        // if($this->user_auth()){
        if(true){
            
            // $qry = "INSERT INTO exp_type(curdate, title, uid) VALUES(CURDATE(), '".$_POST['title']."', ".$_POST['uid'].")";
            $qry = "INSERT INTO exp_type(curdate, title, uid) VALUES(CURDATE(),'".$title."',".$uid.")";

            $res = $this->con->query($qry);

            if($res){
                echo 'exp type added';
            }
            else{
                echo 'contact developer';
            }

        }
        else{
            echo 'Auth Failed';
        }
    }

    public function list_exp_type($uid=''){
        // if($this->user_auth()){
        if(true){

            $qry = "SELECT * FROM exp_type WHERE uid=".$uid.";";

            $res = $this->con->query($qry);

            if($res->num_rows>0){

                $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    
                header("Content-type:application/json");
                echo json_encode($data);

            }

            else{
                echo 'No data found';
            }

        }
        else{
            echo 'Auth Failed in list_exp_type';
        }
    }

    public function edit_exp_type_title($title, $exp_type_id=''){
        
        // if(this->user_auth()){
        if(true){

            // $qry = "UPDATE exp_type SET title='".$_POST['title']."' WHERE id=".$_POST['exp_type_id'].";";
            $qry = "UPDATE exp_type SET title='".$title."' WHERE id=".$exp_type_id.";";

            $res = $this->con->query($qry);

            if(mysqli_affected_rows($this->con)==1){
                echo "Updated Successfully";
            }
            else{
                echo "Contact Developer in exp_type_model.php --> edit_exp_type_title";
            }

        }
        else{
            echo 'Auth Failed in exp_type_model.php --> edit_exp_type_title';
        }

    }

}
?>