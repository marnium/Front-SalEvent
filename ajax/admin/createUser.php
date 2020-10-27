<?php
   if(isset($_POST['data_user'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      $data_user = json_decode($_POST['data_user'], true);
      echo json_encode($operations->create_user($data_user['name_user'],
         $data_user['pa_lastname_user'], $data_user['mo_lastname_user'],
         $data_user['email_user'], $data_user['phone_user'],
         $data_user['user_user'], $data_user['password_user']));
      $operations->closeConnection();
   }
?>