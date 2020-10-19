<?php
    require_once('operations.php');
    $user = 'leo';
    $password ='leo';
    $operaciones = new OperationBD();
    $resultados = $operaciones->consultUser($user,$password);
    echo $resultados;
?>