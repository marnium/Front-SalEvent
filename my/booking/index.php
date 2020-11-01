<?php
session_start();
if (!isset($_SESSION['data_user'])) {
  header("Location: /home/");
}
if (isset($_SESSION['data_admin'])) {
  header("Location: /admin/");
}
if (!isset($_SESSION['newReservation'])) {
  header("Location: /my/");
}
if (isset($_POST['returnToCalendar'])) {
  unset($_SESSION['newReservation']);
  header("Location: /my/calendar/");
}

$messague = "";

if (isset($_POST['reserveDay'])) {
  require_once('../../databaseOperations/operations.php');
  $operations = new OperationBD();

  $validateReservation = $operations->validateReservation($_SESSION['newReservation'][0] . "-" .
    $_SESSION['newReservation'][1] . "-" . $_SESSION['newReservation'][2]);

  if ($validateReservation->num_rows) {
    $messague = 'Mientras usted rellenaba los datos alguien mas ya reservo el dia';
  } else {
    if (!empty($_POST["values"]) && is_array($_POST["values"])) {

      $typeEvent = ($_POST['values'][0] == "other") ? ($_POST['values'][1]) : ($_POST['values'][0]);

      $startHour = ($_POST['values'][0] == "other") ?
        (($_POST['values'][3] == "am") ? $_POST['values'][2] : intval($_POST['values'][2]) + 12) : (($_POST['values'][2] == "am") ? $_POST['values'][1] : intval($_POST['values'][1]) + 12);
      switch ($startHour) {
        case 12:
        case 24:
          $startHour = $startHour - 12;
          break;
      }

      $finalHour = ($_POST['values'][0] == "other") ?
        (($_POST['values'][5] == "am") ? $_POST['values'][4] : intval($_POST['values'][4]) + 12) : (($_POST['values'][4] == "am") ? $_POST['values'][3] : intval($_POST['values'][3]) + 12);
      switch ($finalHour) {
        case 12:
        case 24:
          $finalHour = $finalHour - 12;
          break;
      }

      $priceByHour = $operations->pricebyHour();

      if ($priceByHour->num_rows) {
        $priceByHour = ($finalHour - $startHour) *
          floatval(($priceByHour->fetch_assoc())['price_hour']);

        $services = $operations->getServicesWithoutClosingBD();
        $totalServices = 0;
        if ($services->num_rows) {

          while ($row = $services->fetch_assoc()) {
            if (intval($_POST[strval($row['id_service'])]) != 0) {
              $totalServices += $_POST[$row['id_service']] * floatval($row['price']);
            }
          }

          $resultsCreateFolio = $operations->createFolioServices($totalServices);

          $services = $operations->getServicesWithoutClosingBD();
          while ($row = $services->fetch_assoc()) {
            if (intval($_POST[strval($row['id_service'])]) != 0) {
              $operations->addSelectedServices(
                $row['id_service'],
                $resultsCreateFolio,
                $_POST[strval($row['id_service'])],
                (floatval($row['price'])) * intval($_POST[$row['id_service']])
              );
            }
          }

          $dateStart = $_SESSION['newReservation'][0] . "-" . $_SESSION['newReservation'][1] . "-" .
            $_SESSION['newReservation'][2] . " " . $startHour . ":00:00";

          $dateEnd = $_SESSION['newReservation'][0] . "-" . $_SESSION['newReservation'][1] . "-" .
            $_SESSION['newReservation'][2] . " " . $finalHour . ":00:00";

          $operations->addReservation(
            $typeEvent,
            $priceByHour + $totalServices,
            $dateStart,
            $dateEnd,
            intval($_SESSION['data_user'][0]),
            $resultsCreateFolio
          );
          $operations->closeConnection();
        }
      }
    }
  }
  unset($_SESSION['newReservation']);
} else {
  header("Location: /my/book/");
}
if(isset($_POST['modify'])){
  header("Location: /my/myreservation/");
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
    <div class="container-fluid d-flex flex-wrap justify-content-around border border-dark">
      <div class="col-md-12">
        <?php
        if ($messague != "") {
          echo '<p id="msg-error-successful" class="mb-0 mt-2 d-flex flex-wrap justify-content-center
                alert alert-warning">
                Vaya! ' . $messague . '
                </p>';
        }
        ?>
      </div>
      <section class="col-md-4">
        <div class="col-md-12">
          <h2 class="text-center">Evento: <?php echo (isset($typeEvent)) ? $typeEvent : ""; ?></h2>
        </div>
        <div class="d-flex flex-column flex-wrap mt-4 pt-4">
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Horas contratadas</p>
            <p class="text-danger">
              <?php 
                echo ((isset($finalHour) && isset($startHour)))? $finalHour-$startHour : "";
              ?></p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Hora inicio:</p>
            <p class="text-danger">
              <?php
                echo (isset($startHour)) ? $startHour.":00:00 horas": "";
              ?>
            </p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Hora final:</p>
            <p class="text-danger">
              <?php
                echo (isset($finalHour)) ? $finalHour.":00:00 horas": "";
              ?></p>
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
                echo $_SESSION["data_user"][2]." ".$_SESSION["data_user"][3]." ".
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
            <p class="text-danger"><?php echo (isset($priceByHour) && isset($totalServices))?$priceByHour + $totalServices:""; ?></p>
          </div>
          <div class="d-flex flex-wrap mb-3">
            <p class="mr-4">Estatus:</p>
            <p class="text-danger"><?php echo (isset($priceByHour) && isset($totalServices))?"En espera":""?></p>
          </div>
        </div>
      </section>
    </div>
    <div class="container-fluid d-flex flex-wrap justify-content-around mt-3">
      <form method="POST">
        <button type="submit" class="btn btn-primary bg-dark mr-3 pl-2 pr-2 border-0" name="returnToCalendar">
          Aceptar y salir
        </button>
      </form>
      <form method="POST">
        <button type="submit" class="btn btn-primary bg-dark border-0" name="modify">
          Ver la lista
        </button>
      </form>
    </div>
  </main>
</body>

</html>