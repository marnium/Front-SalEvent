<?php
   if(isset($_POST['data_user'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      echo $operations->update_user(json_decode($_POST['data_user'], true));
   }
?>