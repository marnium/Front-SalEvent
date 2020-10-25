<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    
    $year = json_decode($_POST['year']);
    $month = json_decode($_POST['month']);
    $date = json_decode($_POST['date']);

    $_SESSION['newReservation'] = array($year,$month,$date);
    echo json_encode('finish');
?>