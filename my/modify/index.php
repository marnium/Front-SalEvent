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
if (isset($_SESSION['viewStatus'])) {
  header("Location: /my/reservation/");
}
if (!isset($_SESSION['modifyReservation'])) {
  header("Location: /my/myreservation/");
}

if (isset($_POST['returnToMyReservationsModify'])) {
  unset($_SESSION['modifyReservation']);
  header("Location: /my/myreservation/");
}

require_once('../../databaseOperations/operations.php');
$operations = new OperationBD();

$resultReservation = $operations->getInformationReservation(
  intval($_SESSION['modifyReservation']),
  intval($_SESSION['data_user'][0])
);
if ($resultReservation->num_rows) {
  if ($row = $resultReservation->fetch_assoc()) {

    $timeAcronymStart = (intval(substr((explode(" ", $row['date_reservation_start']))[1], 0, 2)) < 12) ?
      "am" : "pm";

    $startDate =
      (intval(substr((explode(" ", $row['date_reservation_start']))[1], 0, 2)) < 13) ?
      intval(substr((explode(" ", $row['date_reservation_start']))[1], 0, 2)) :
      intval(substr((explode(" ", $row['date_reservation_start']))[1], 0, 2)) - 12;
    $startDate = ($startDate == 0) ? 12 : $startDate;
    $startDateYYmmDD = (explode(" ", $row['date_reservation_start']))[0];

    $timeAcronymEnd = (intval(substr((explode(" ", $row['date_reservation_end']))[1], 0, 2)) < 12) ?
      "am" : "pm";

    $endDate =
      (intval(substr((explode(" ", $row['date_reservation_end']))[1], 0, 2)) < 13) ?
      intval(substr((explode(" ", $row['date_reservation_end']))[1], 0, 2)) :
      intval(substr((explode(" ", $row['date_reservation_end']))[1], 0, 2)) - 12;
    $endDate = ($endDate == 0) ? 12 : $endDate;
    $endDateYYmmDD = (explode(" ", $row['date_reservation_end']))[0];

    $statusReservation = $row['status_reservation'];

    $priceTotal = $row['price_total'];

    $typeEvent = $row['type_event'];

    $folioServices = $row['id_folio_services'];

    $idRervation = $row['id_reservation'];

    if($statusReservation==1){
      unset($_SESSION['modifyReservation']);
      header("Location: /my/myreservation/");
    }
  }
} else {
  unset($_SESSION['modifyReservation']);
  header("Location: /my/myreservation/");
}

if (isset($_POST['updateReservation'])) {
  require_once('../../databaseOperations/operations.php');
  $newOperations = new OperationBD();
  

  if (!empty($_POST["values"]) && is_array($_POST["values"])) {

    $typeEventToForm = ($_POST['values'][0] == "other") ? ($_POST['values'][1]) : ($_POST['values'][0]);

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
    $priceByHour = $newOperations->pricebyHour();
    
    if ($priceByHour->num_rows) {
      $priceByHour = ($finalHour - $startHour) *
        floatval(($priceByHour->fetch_assoc())['price_hour']);
      $services = $newOperations->getServicesWithoutClosingBD();
      $totalServices = 0;
      if ($services->num_rows) {

        while ($row = $services->fetch_assoc()) {
          if (intval($_POST[strval($row['id_service'])]) != 0) {
            $totalServices += $_POST[$row['id_service']] * floatval($row['price']);
          }
        }

        echo $newOperations->updateFolioServices(intval($folioServices),$totalServices);        

        $newOperations->deleteFolioServices(intval($folioServices));
        $services = $newOperations->getServicesWithoutClosingBD();
        while ($row = $services->fetch_assoc()) {
          if (intval($_POST[strval($row['id_service'])]) != 0) {
            $newOperations->addSelectedServices(
              $row['id_service'],
              intval($folioServices),
              $_POST[strval($row['id_service'])],
              (floatval($row['price'])) * intval($_POST[$row['id_service']])
            );
          }
        }

        $dateStart = $startDateYYmmDD." ".$startHour.":00:00";

        $dateEnd = $endDateYYmmDD." ".$finalHour.":00:00";
        echo $idRervation;

        echo $newOperations->updateReservations(
          $typeEventToForm,
          $priceByHour + $totalServices,
          $dateStart,
          $dateEnd,
          intval($idRervation)
        );
        $newOperations->closeConnection();
      }
    }
  }
  unset($_SESSION['modifyReservation']);
  header("Location: /my/myreservation/");
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
  <style>
    input[type="number"] {
      width: 80px;
      height: 40px;
    }

    .selected {
      width: 100px;
    }

    .icon-size {
      font-size: 40px;
    }

    .repair-size input[type="number"] {
      width: 300px;
    }
  </style>
  <title>SallEvent</title>
</head>

<body>
  <?php
  include('../../partials/my/navigation-options.php');
  ?>

  <main class="container-fluid d-flex flex-wrap justify-content-around m-auto">
    <h1 class="col-md-12">Modificar Reserva:</h1>
    <section class="col-md-7 border border-dark">
      <div id="box-confirmpass" class="col-md-12 d-flex flex-wrap justify-content-center"></div>
      <form id="form-book" method="POST">
        <div class="d-flex flex-row flex-wrap">
          <div class="col-md-12 input-group mb-2 mt-2" id="eventother">
            <div class="input-group-prepend mb-3">
              <label for="event" class="h6 mt-2 mr-2">Evento:</label>
            </div>
            <select id="event" class="custom-select mb-3" name="values[]">
              <option value="" selected hidden>Seleccione una opción</option>
              <option value="Graduacion" <?php
                                          echo ($typeEvent == "Graduacion") ? "selected" : "";
                                          ?>>Graduacion</option>
              <option value="Boda" <?php
                                    echo ($typeEvent == "Boda") ? "selected" : "";
                                    ?>>Boda</option>
              <option value="Bautizo" <?php
                                      echo ($typeEvent == "Bautizo") ? "selected" : "";
                                      ?>>Bautizo</option>
              <option value="Comunion" <?php
                                        echo ($typeEvent == "Comunion") ? "selected" : "";
                                        ?>>Comunion</option>
              <option value="Confirmacion" <?php
                                            echo ($typeEvent == "Confirmacion") ? "selected" : "";
                                            ?>>Confirmacion</option>
              <option value="Cumpleaños" <?php
                                          echo ($typeEvent == "Cumpleaños") ? "selected" : "";
                                          ?>>Cumpleaños</option>
              <option value="Quince años" <?php
                                          echo ($typeEvent == "Quince años") ? "selected" : "";
                                          ?>>Quince años</option>
              <option value="Reunion" <?php
                                      echo ($typeEvent == "Reunion") ? "selected" : "";
                                      ?>>Reunion</option>
              <option value="other" <?php
                                    if (
                                      $typeEvent != "Graduacion" && $typeEvent != "Boda" && $typeEvent != "Bautizo"
                                      && $typeEvent != "Comunion" && $typeEvent != "Confirmacion" && $typeEvent != "Cumpleaños"
                                      && $typeEvent != "Quince años" && $typeEvent != "Reunion"
                                    ) {
                                      echo 'selected';
                                    }
                                    ?>>Otro</option>
            </select>
            <?php
            if (
              $typeEvent != "Graduacion" && $typeEvent != "Boda" && $typeEvent != "Bautizo"
              && $typeEvent != "Comunion" && $typeEvent != "Confirmacion" && $typeEvent != "Cumpleaños"
              && $typeEvent != "Quince años" && $typeEvent != "Reunion"
            ) {
              echo '<div id="boxotheranother" class="col-md-8 mb-2 d-flex flex-wrap justify-content-center mb-3">
                <label for="writeanother" class="mr-2 mt-1">Mencionelo: </label>
                <input type="text" name="values[]" 
                  id="writeanother" class="mb-1" value="' . $typeEvent . '" />
              </div>';
            }
            ?>
          </div>
          <div class="col-md-12">
            <div class="d-flex flex-column flex-wrap">
              <div class="mt-2 d-flex flex-wrap justify-content-center">
                <label for="start-time" class="mr-2 mt-1">Hr inicio:</label>
                <input type="number" name="values[]" id="start-time" class="mb-1" min="1" max="12" value="<?php echo $startDate; ?>" required />
                <select class="ml-2 selected mb-1" name="values[]" id="start-time-select">
                  <option value="am" <?php
                                      echo ($timeAcronymStart == "am") ? "selected" : "";
                                      ?>>AM</option>
                  <option value="pm" <?php
                                      echo ($timeAcronymStart == "am") ? "" : "selected";
                                      ?>>PM</option>
                </select>
              </div>
              <div class="mt-2 d-flex flex-wrap justify-content-center">
                <label for="final-time" class="mr-2 mt-1">Hr final:</label>
                <input type="number" name="values[]" id="final-time" class="mb-1" min="1" max="12" value="<?php echo $endDate; ?>" required />
                <select class="ml-2 selected mb-1" name="values[]" id="final-time-select">
                  <option value="am" <?php
                                      echo ($timeAcronymEnd == "am") ? "selected" : "";
                                      ?>>AM</option>
                  <option value="pm" <?php
                                      echo ($timeAcronymEnd == "am") ? "" : "selected";
                                      ?>>PM</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-4">
            <h3>Servicios:</h3>
          </div>
          <div class="col-md-12 mt-2">
            <div class="d-flex flex-wrap justify-content-between" id="boxservices">
              <?php
              require_once('../../databaseOperations/operations.php');
              $operationsServices = new OperationBD();
              $getServices = $operationsServices->getServicesWithoutClosingBD();
              if ($getServices->num_rows) {
                while ($row = $getServices->fetch_assoc()) {
                  echo '
                      <div class="col-md-4 mb-2 d-flex flex-wrap justify-content-center">
                        <label for="';
                  echo $row['id_service'];
                  echo '" class="mr-2 mt-1">';
                  echo $row['name_service'] . ":";
                  echo '</label>
                        <input type="number" name="';
                  echo $row['id_service'];
                  echo '" id="';
                  echo $row['id_service'];
                  echo '" class="mb-1" value="';
                  $amount_service = $operationsServices->getValueService(
                    intval($row['id_service']),
                    intval($folioServices)
                  );
                  echo ($amount_service != "") ? $amount_service : '0';
                  echo '" required />
                      </div>';
                }
              }
              $operationsServices->closeConnection();
              ?>

            </div>
          </div>
        </div>
      </form>
    </section>
    <section class="col-md-4 border border-dark mt-1">
      <h3 class="text-center">Datos del cliente</h3>
      <div class="d-flex flex-column flex-wrap mt-4">
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
    <section class="col-md-12 d-flex flex-wrap justify-content-around mt-4">
      <div class="d-flex flex-wrap justify-content-around mb-2">
        <i class="bx bxs-cart-add icon-size mr-2"></i>
        <button type="submit" form="form-book" name="updateReservation" class="btn btn-primary bg-dark mr-3 mb-2 border-0">
          Actualizar
        </button>
        <button class="btn btn-primary bg-dark mr-3 mb-2 border-0" onclick="quote()">
          Cotizar
        </button>
        <button type="reset" class="btn btn-primary bg-dark mr-3 mb-2 border-0" form="form-book" onclick="restore()">
          Restaurar
        </button>
      </div>
      <div class="d-flex flex-wrap justify-content-around mb-2 repair-size">
        <form method="POST">
          <button name="returnToMyReservationsModify" class="btn btn-primary bg-dark mr-3 pl-2 pr-2 border-0">
            Regresar
          </button>
        </form>
        <div class="div">
          <label for="total" class="mt-2 mr-2">Total:</label>
          <input type="number" id="total" name="total" min="0" disabled value="<?php echo $priceTotal; ?>" />
        </div>
      </div>
    </section>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="../../js/my/modify.js"></script>
</body>

</html>