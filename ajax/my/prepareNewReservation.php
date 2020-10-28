<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    
    $year = json_decode($_POST['year']);
    $month = json_decode($_POST['month']);
    $date = json_decode($_POST['date']);
    $day = json_decode($_POST['day']);

    $dayLetter = array("sunday","monday","tuesday","wednesday","thursday","friday","saturday");

    $messageReturn = "";

    require_once('../../databaseOperations/operations.php');
    $operations = new OperationBD();
    $results = $operations->businessDays();
    if($results->num_rows){
        if($row = $results->fetch_assoc()){
            if($row[$dayLetter[$day]]=="Y"){
                $_SESSION['newReservation'] = array($year,$month,$date);
            }else{
                $messageReturn = "N";
            }
        }
    }

    
    echo json_encode($messageReturn);
?>