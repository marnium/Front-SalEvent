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
if (isset($_SESSION['modifyReservation'])) {
  header("Location: /my/modify/");
}
require_once('../../databaseOperations/operations.php');
$operations = new OperationBD();
$dataRoom = $operations->getDataRoom();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
  <title>SallEvent</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <style>
    .option-selected {
      background-color: #eeeeee !important;
      color: black !important;
      border-left: none !important;
      border-right: none !important;
    }

    section {
      background: #eeeeee;
    }

    .client>.sticky-top {
      top: 90px;
    }

    .repair-page {
      height: 86vh;
    }

    @media only screen and (min-width: 992px) {
      #nav-left {
        display: flex !important;
        max-width: calc((100% - 30px) * 0.25);
        max-width: -webkit-calc((100% - 30px) * 0.25);
        max-width: -moz-calc((100% - 30px) * 0.25);
        height: 100%;
        position: fixed;
        z-index: 1030;
      }

      main>section.col-lg-9 {
        margin-left: auto;
      }
    }
  </style>
</head>

<body>
  <?php
  include('../../partials/my/navigation-options.php');
  ?>
  <main class="container-fluid mt-2 client">
    <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark sticky-top">
      <h4 class="list-group-item bg-dark text-white font-weight-bold" style="border: none">
        ¡Hola Usuario!
      </h4>
      <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white">
        Reservaciones
      </h5>
      <span class="btn btn-dark btn-block option-selected">Mis reservaciones</span>

      <a href="/my/calendar" class="text-white text-decoration-none mt-2">
        <span class="btn btn-dark btn-block">Calendario</span>
      </a>
      <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white">
        <a href="/my" class="text-white text-decoration-none">
          <span class="btn btn-dark btn-block">Ajustes</span>
        </a>
      </div>
    </div>
    <section class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3 d-flex flex-wrap box-col-cal justify-content-around">
      <div class="col-md-12 border border-dark mt-3">
        <div class="d-flex flex-wrap justify-content-between mb-3 mt-3">
          <div class="col-md-12 d-flex flex-wrap flex-row-reverse justify-content-around mb-3">
            <p class="h5" id="showDate">12/07/2020</p>
            <div class="d-flex flex-wrap justify-content-between">
              <p class="mr-3 h5">Salon de eventos:</p>
              <p class="h5">
                <?php
                echo $dataRoom['name_saloon'];
                ?>
              </p>
            </div>
          </div>
          <div class="col-md-12 d-flex flex-wrap justify-content-around">
            <div class="d-flex flex-wrap justify-content-between">
              <p class="mr-3 h5">Descripcion:</p>
              <p class="h5">
                <?php
                echo $dataRoom['description_saloon'];
                ?>
              </p>
            </div>
          </div>
          <div id="box-confirmpass" class="col-md-12 w-100 d-flex flex-wrap justify-content-center"></div>
          <div class="col-md-12 d-flex flex-wrap overflow-auto">
            <table class="table table-striped" id="tableReservations">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre del evento</th>
                  <th>Fecha</th>
                  <th>Precio</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
                  <th>Ver estado</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once('../../databaseOperations/operations.php');
                $operations = new OperationBD();
                $totalReservations = 0;
                $results = $operations->getReservations(intval($_SESSION['data_user'][0]));
                if ($results->num_rows) {
                  while ($row = $results->fetch_assoc()) {
                    $totalReservations += $row['price_total'];
                    echo '<tr>';
                    echo '<td>';
                    echo $row['id_reservation'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['type_event'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['date_reservation_start'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['price_total'];
                    echo '</td>';
                    echo '<td>';
                    echo '<button class="btn btn-primary bg-dark border-0" onclick="modidyReservation(this)">
                        Modificar
                      </button>
                    </a>';
                    echo '</td>';
                    echo '<td>';
                    echo '<button class="btn btn-primary bg-dark border-0" onclick="deleteReservation(this)">
                      Eliminar
                    </button>';
                    echo '</td>';
                    echo '<td>';
                    echo '<button class="btn btn-primary bg-dark border-0" onclick="viewStatus(this)">
                        Estado
                      </button>';
                    echo '</td>';
                    echo '</tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="col-md-10 d-flex flex-wrap justify-content-end">
            <p class="mr-3 h4">Total:</p>
            <p class="text-danger h4" id="total"><?php echo $totalReservations ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-12 d-flex flex-column flex-wrap">
        <div class="d-flex flex-wrap justify-content-center mb-4 mt-4">
          <a href="/my/calendar" class="text-white text-decoration-none">
            <button class="btn btn-primary bg-dark border-0 pr-4 pl-4">
              Nueva reserva
            </button>
          </a>
        </div>
      </div>
    </section>
  </main>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="../../js/my/myreservation.js"></script>
</body>

</html>