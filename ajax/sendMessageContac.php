<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    $fullName = json_decode($_POST['fullName']);
    $email = json_decode($_POST['email']);
    $telphone = json_decode($_POST['telphone']);
    $msg = json_decode($_POST['msg']);

    require_once('../databaseOperations/operations.php');
    $operations = new OperationBD();
    $operations->sendMessageContac($fullName,$email,$telphone,$msg);
    
    echo json_encode("successful");
?>