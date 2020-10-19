<?php
    require_once('operations.php');
    $user = 'user';
    $password ='password';
    $operations = new OperationBD();
    $results = $operations->consultUser($user,$password);
    if(count($results)>0){
        echo $results['user_user'];
    }else{
        echo 'No results found';
    }
?>