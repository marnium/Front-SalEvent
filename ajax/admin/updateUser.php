<?php
   if(isset($_POST['data_user'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      echo $operations->update_user_type1(json_decode($_POST['data_user'], true));
   }
?>