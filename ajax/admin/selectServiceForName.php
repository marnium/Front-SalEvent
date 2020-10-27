<?php
   if(isset($_POST['name_service'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      echo $operations->select_services_for_name($_POST['name_service']);
      $operations->closeConnection();
   }
?>