<?php
   if(isset($_POST['id_user'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      echo $operations->remove_user_type1($_POST['id_user']);
      $operations->closeConnection();
   }
?>