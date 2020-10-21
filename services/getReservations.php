<?php
   if(isset($_POST['year']) and isset($_POST['month'])) {
      require_once('../databaseOperations/operations.php');
      $operationDB = new OperationBD();
      echo $operationDB->select_date_reservations_for_month($_POST['year'], $_POST['month']);
   }
?>