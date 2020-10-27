<?php
   if(isset($_POST['data-salon'])) {
      require_once('../../databaseOperations/operations.php');
      $operationDB = new OperationBD();
      $data_salon = json_decode($_POST['data-salon'], true);
      echo $operationDB->create_or_update_room($data_salon['t_room'], 
         $data_salon['t_schedule'], $data_salon['t_direction']);
      $operationDB->closeConnection();
   }
?>