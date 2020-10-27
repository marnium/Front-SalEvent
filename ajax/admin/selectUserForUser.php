<?php
   if(isset($_POST['user'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      echo $operations->select_user_for_user($_POST['user']);
      $operations->closeConnection();
   }
?>