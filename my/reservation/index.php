<?php
session_start();
if (!isset($_SESSION['data_user'])) {
  header("Location: /home/");
}
if (isset($_SESSION['data_admin'])) {
  header("Location: /admin/");
}
if (isset($_SESSION['newReservation'])) {
  header("Location: /my/book/");
}
if (!isset($_SESSION['viewStatus'])) {
  header("Location: /my/myreservation/");
}
if (isset($_POST['returnToMyReservations'])) {
  unset($_SESSION['viewStatus']);
  header("Location: /my/myreservation/");
}
if (isset($_POST['goToModify'])) {
  $_SESSION['modifyReservation'] = $_SESSION['viewStatus'];
  unset($_SESSION['viewStatus']);
  header("Location: /my/modify/");
}
require_once('../../databaseOperations/operations.php');
$operations = new OperationBD();

$resultQuery = $operations->getInformationReservation(
  intval($_SESSION['viewStatus']),
  intval($_SESSION['data_user'][0])
);

if ($resultQuery->num_rows) {
  if ($row = $resultQuery->fetch_assoc()) {

    $startDate =
      substr((explode(" ", $row['date_reservation_start']))[1], 0, 2);
    $endDate =
      substr((explode(" ", $row['date_reservation_end']))[1], 0, 2);

    $statusReservation = $row['status_reservation'];

    $priceTotal = $row['price_total'];

    $typeEvent = $row['type_event'];
  }
} else {
  unset($_SESSION['viewStatus']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
  <title>SallEvent</title>
</head>

<body>
  <?php
  include('../../partials/my/navigation-options.php');
  ?>
  <main class="container-fluid mt-3">
    <?php
      if(intval($statusReservation == 1)){
        echo '<div class="col-md-12 mb-2">
        <p class="mb-0 mt-2 alert alert-info alert-dismissible fade show text-center" role="alert">
          Su reservacion ha sido confirmado, con el fin de ofrecer el mejor servicio, usted no podra
          modificarlo
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </p>
      </div>';
      }
    ?>
    <div class="container-fluid d-flex flex-wrap justify-content-around border border-dark">
      <section class="col-md-4">
        <div class="col-md-12">
          <h2 class="text-center">Evento:
            <?php
            echo $typeEvent;
            ?>
          </h2>
        </div>
        <div class="d-flex flex-column flex-wrap mt-4 pt-4">
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Horas contratadas</p>
            <p class="text-danger">
              <?php
              echo $endDate - $startDate;
              ?>
            </p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Hora inicio:</p>
            <p class="text-danger">
              <?php
              echo $startDate.":00:00 horas";
              ?>
            </p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Hora final:</p>
            <p class="text-danger">
              <?php
              echo $endDate.":00:00 horas";
              ?>
            </p>
          </div>
        </div>
      </section>
      <section class="col-md-4">
        <div class="col-md-12">
          <h2 class="text-center">Datos del cliente</h2>
        </div>
        <div class="d-flex flex-column flex-wrap mt-4 pt-4">
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Nombre completo:</p>
            <p>
              <?php
              echo $_SESSION["data_user"][2] . " " . $_SESSION["data_user"][3] . " " .
                $_SESSION["data_user"][4]
              ?>
            </p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Email:</p>
            <p><?php echo $_SESSION["data_user"][5];  ?></p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Telefono:</p>
            <p><?php echo $_SESSION["data_user"][6];  ?></p>
          </div>
        </div>
      </section>
      <section class="col-md-12">
        <div class="d-flex flex-column flex-wrap mt-4 pt-4">
          <div class="d-flex flex-wrap mb-3">
            <p class="mr-4">Total a pagar:</p>
            <p class="text-danger"><?php echo $priceTotal; ?></p>
          </div>
          <div class="d-flex flex-wrap mb-3">
            <p class="mr-4">Estatus:</p>
            <p class="text-danger">
              <?php
              echo ($statusReservation == 0) ? 'En espera' : 'Confirmada';
              ?>
            </p>
          </div>
        </div>
      </section>
    </div>
    <div class="container-fluid d-flex flex-wrap justify-content-around mt-3">
      <form method="POST">
        <button type="submit" name="returnToMyReservations" class="btn btn-primary bg-dark border-0">
          Regresar
        </button>
      </form>
      <form method="POST">
        <button type="submit" name="goToModify" class="btn btn-primary bg-dark border-0">
          Modificar
        </button>
      </form>
    </div>
  </main>
</body>

</html>