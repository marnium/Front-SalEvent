<?php
   if(isset($_POST['id_reservation'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      echo $operations->confirm_reservation($_POST['id_reservation']);
      $operations->closeConnection();
   }
?>