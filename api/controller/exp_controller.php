<?php

include '../model/exp_model.php';

$obj = new exp_model();
    
    switch ($_GET['op']) {

        case 'add_expense':
            $obj->add_expense();
            break;
        
        case 'list_all_expenses':
            $obj->list_all_expenses($_GET['uid']);
            break;

        case 'select_date_range_data':
            $obj->select_date_range_data($_GET['date_from'], $_GET['date_to'], $_GET['uid']);
            break;

        case 'update_exp':
            $obj->update_exp();
            break;

        case 'delete_exp':
            $obj->delete_exp($_GET['exp_id']);
            break;
        
        case 'piechart_data':
            $obj->piechart_data($_GET['uid']);
            break;

        case 'exp_type':
            $obj->exp_type($_GET['exp_type_id']);
            break;

        default:
            echo "Wrong Operation inside exp_controller.php";
            break;
    }

?>