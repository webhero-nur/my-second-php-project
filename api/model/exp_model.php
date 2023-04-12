<?php

include '../helpers/auth.php';

class exp_model extends auth {

    function __construct(){
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $db = 'expense_recorder';
        $this->con = new mysqli($host, $user, $password, $db);
    }

    public function add_expense(){

        if($this->user_auth()){

            $qry = "INSERT INTO expenses(curdate, payee, amount, exp_type_id, uid) VALUES(CURDATE(), '".$_POST['payee']."', ".$_POST['amount'].", ".$_POST['exp_type_id'].", ".$_GET['uid'].");";

            $res = $this->con->query($qry);

            if($res){
                echo "Expense added";
            }
            else{
                echo "Contact Developer in exp_model.php --> add_expense";
            }

        }
        else{
            echo 'Auth Failed in exp_model.php --> add_expense';
        }

    }

    public function expenses_list($qry){

        if($this->user_auth()){
    
            $res = $this->con->query($qry);
    
            if($res){
    
                $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    
                header("Content-type:application/json");
    
                echo json_encode($data);
    
            }
            else{
                
                echo "User id not valid";
    
            }
    
        }
        else{
            echo 'Auth Failed in exp_model.php --> list_all_expenses';
        }
    }

    public function list_all_expenses($uid=''){
        
        $qry = "SELECT * FROM expenses WHERE uid=".$uid.";";

        $this->expenses_list($qry);

    }

    public function select_daterange_data($from='', $to='', $uid=''){
        
        $qry = "SELECT * FROM expenses WHERE curdate between '".$from."' and '".$to."' and uid=".$uid.";";

        $this->expenses_list($qry);

    }

    public function update_exp($payee, $amount, $exp_id){
        
        if($this->user_auth()){

            $qry = "UPDATE expenses SET payee='".$_POST['payee']."', amount='".$_POST['amount']."' WHERE id=".$_POST['exp_id'].";";

            $res = $this->con->query($qry);

            if(mysqli_affected_rows($this->con)==1){
                echo "Updated Successfully";
            }
            else{
                echo "Contact Developer in exp_model.php --> update_exp";
            }

        }
        else{
            echo 'Auth Failed in exp_model.php --> update_exp';
        }
        
    }

    public function delete_exp($exp_id=''){
        
        if($this->user_auth()){

            $qry = "DELETE FROM expenses WHERE id=".$exp_id.";";

            $res = $this->con->query($qry);

            if(mysqli_affected_rows($this->con)===1){
                echo "Deleted Successfully";
            }
            else{
                echo "Contact Developer in exp_model.php --> delete_exp";
            }


        }
        else{
            echo 'Auth Failed in exp_model.php --> update_exp';
        }

    }

}

?>