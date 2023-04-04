<?php

include '../model/exp_model.php';

$obj = new exp_model();
    
    switch ($_GET['op']) {

        case 'add_expense':
            $obj->add_expense($_GET['payee'], $_GET['amount'], $_GET['exp_type_id'], $_GET['uid']);
            break;
        
        case 'list_all_expenses':
            $obj->list_all_expenses($_GET['uid']);
            break;

        case 'select_daterange_data':
            $obj->select_daterange_data($_GET['date_from'], $_GET['date_to'], $_GET['uid']);
            break;

        case 'update_exp':
            $obj->update_exp($_GET['payee'], $_GET['amount'], $_GET['exp_id']);
            break;

        case 'delete_exp':
            $obj->delete_exp($_GET['exp_id']);
            break;

        default:
            echo "Wrong Operation inside exp_controller.php";
            break;
    }

?>