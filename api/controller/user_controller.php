<?php

    include '../model/user_model.php';

    $obj = new user_model();
    
    switch ($_GET['op']) {
        case 'insert':
            // $obj->add_user();
            $obj->add_user($_GET['full_name'], $_GET['username'], $_GET['password']); // my code
            break;
        
        case 'list':
            $obj->list_all_user();
            break;

        case 'login':
            $obj->login();
            break;
        
        case 'check_username':
            $obj->check_username($_GET['potential_name']);
            break;
        
        default:
            echo "<script>alert('wrong operation')</script>";
            break;
    }


?>