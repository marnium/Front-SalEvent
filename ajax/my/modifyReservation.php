<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    
    $id = json_decode($_POST['id']);
    
    $_SESSION['modifyReservation'] = $id;

    echo json_encode('finish');
?>