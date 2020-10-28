<?php
  require_once('../databaseOperations/operations.php');
  $operation = new OperationBD();
  $data_footer = $operation->select_data_footer();
  $direction = 'Calle: '.htmlspecialchars($data_footer['direction']['street_direction']).
    ', Col. '.htmlspecialchars($data_footer['direction']['suburb_direction']);
?>
<footer class="d-flex flex-wrap justify-content-around bg-dark">
    <div class="logo">
      <p class="text-white text-center font-weight-bold">
      <img src="../img/home/logo.png" height="90px"> 
      SallEvent</p>
    </div>
    <div class="">
      <ul class="text-white text-center list-unstyled">
        <li class="list-unstyled font-weight-light">Direccion:</li>
        <li class="list-unstyled font-weight-light"><?php echo $direction ?></li>
        <li class="list-unstyled font-weight-light"
        ><?php echo htmlspecialchars($data_footer['direction']['municipality_direction']) ?></li>
      </ul>
    </div>
    <div class="">
      <ul class="text-white text-center list-unstyled">
        <li class="list-unstyled font-weight-light">Contactenos:</li>
        <li class="list-unstyled font-weight-light"
        ><?php echo htmlspecialchars($data_footer['contact']['email_user']) ?></li>
        <li class="list-unstyled font-weight-light"
        ><?php echo htmlspecialchars($data_footer['contact']['phone_user'])?></li>
      </ul>
    </div>
</footer>