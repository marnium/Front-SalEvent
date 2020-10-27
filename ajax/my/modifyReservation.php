<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    $id = json_decode($_POST['id']);
    $dataReturn = "";

    require_once('../../databaseOperations/operations.php');
    $operations = new OperationBD();
    $result = $operations->getInformationReservation($id,intval($_SESSION['data_user'][0]));
    if($result->num_rows){
        if($row = $result->fetch_assoc()){
            $dataReturn = $row['status_reservation'];
        }
    }
    
    $_SESSION['modifyReservation'] = $id;

    echo json_encode($dataReturn);
?>