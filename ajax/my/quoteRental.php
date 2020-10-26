<?php
    header("Content-Type: application/json; charset=UTF-8");

    require_once('../../databaseOperations/operations.php');
    $operations = new OperationBD();
    $pricebyhour = $operations->pricebyHour();

    $totalQuote = "";
    if($pricebyhour->num_rows){
        $totalQuote = (json_decode($_POST['datesForm'][1])-
            json_decode($_POST['datesForm'][0])) * 
            floatval(($pricebyhour->fetch_assoc())['price_hour']);  
    }

    for($i=2 ; $i<count($_POST['datesForm']); $i+=2){
        $totalService = $operations->getPriceServices(
            intval( json_decode($_POST['datesForm'][$i]) ));
        if($totalService->num_rows){
            $totalQuote += ( floatval(($totalService->fetch_assoc())['price'])*
                intval(json_decode($_POST['datesForm'][$i+1])) );
        }
    }

    $operations->closeConnection();
    
    echo json_encode($totalQuote);
?>