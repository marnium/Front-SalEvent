<?php
if(isset($_POST['select_reservations'])) {
      require_once('../../databaseOperations/operations.php');
      $operations = new OperationBD();
      if($_POST['select_reservations'] == 'all') {
         $data_reser['confirmed'] = $operations->select_reservations_conf();
         $data_reser['unconfirmed'] = $operations->select_reservations_unconf();
         $data_reser['type'] = 'all';
         echo json_encode($data_reser);
      } elseif($_POST['select_reservations'] == 'confirmed') {
         $data_reser['type'] = 'confirmed';
         $data_reser['confirmed'] = $operations->select_reservations_conf();
         echo json_encode($data_reser);
      } else {
         $data_reser['type'] = 'unconfirmed';
         $data_reser['unconfirmed'] = $operations->select_reservations_unconf();
         echo json_encode($data_reser);
      }
      $operations->closeConnection();
   }
?>