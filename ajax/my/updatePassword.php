<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    $newpassword = json_decode($_POST['newpassword']);
    $oldpassword = json_decode($_POST['oldpassword']);

    require_once('../../databaseOperations/operations.php');
    $operations = new OperationBD();
    $results = $operations->updatePasswordUser((int) ($_SESSION['data_user'][0]),$newpassword);
    if(count($results)>1){
        $_SESSION['data_user'][8] = $newpassword;
    }else{
        $newpassword=$oldpassword;
    }
    
    echo json_encode($newpassword);
?>