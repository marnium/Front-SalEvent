<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    $id = json_decode($_POST['id']);

    require_once('../../databaseOperations/operations.php');
    $operations = new OperationBD();
    $results = $operations->deleteReservation($id);
    if($results == "not-successful"){
        $id = "Fatal: error";
    }
    
    echo json_encode($id);
?>