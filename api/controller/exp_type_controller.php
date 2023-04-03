<?php

include '../model/exp_type_model.php';


$obj = new exp_type_model();
    
    switch ($_GET['op']) {

        case 'add_exp_type':
            $obj->add_exp_type($_GET['title'], $_GET['uid']);
            break;
        
        case 'list_exp_type':
            $obj->list_exp_type($_GET['uid']);
            break;
        
        default:
            echo "Wrong Operation inside exp_type_controller.php";
            break;
    }

?>