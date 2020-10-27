<?php
   if(isset($_POST['data_service'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      echo $operations->update_service(json_decode($_POST['data_service'], true));
      $operations->closeConnection();
   }
?>