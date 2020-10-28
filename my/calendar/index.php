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
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SallEvent</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <link rel="stylesheet" href="../../css/page-my/styles-index.css" />
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
  <?php
  require_once('../../databaseOperations/operations.php');
  $operationsDB = new OperationBD();
  $date = explode(' ', date('Y m'));
  echo "<script>var reservations = JSON.parse('" .
    $operationsDB->select_date_reservations_for_month($date[0], $date[1]) .
    "');</script>";
  ?>
</head>

<body>
  <?php
  include('../../partials/my/navigation-options.php');
  ?>
  <main class="container-fluid mt-2 client">
    <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark sticky-top">
      <h4 class="list-group-item bg-dark text-white font-weight-bold" style="border: none">
        ¡Hola <?php echo $_SESSION['data_user'][2]; ?>!
      </h4>
      <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white">
        Reservaciones
      </h5>
      <a href="/my/myreservation" class="text-white text-decoration-none mb-2">
        <span class="btn btn-dark btn-block">Mis reservaciones</span>
      </a>
      <span class="btn btn-dark btn-block option-selected">Calendario</span>
      <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white">
        <a href="/my" class="text-white text-decoration-none">
          <span class="btn btn-dark btn-block">Ajustes</span>
        </a>
      </div>
    </div>
    <section id="app" class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3">
      <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
        <p><strong>Para fin de otorgar el mejor servicio, usted puede reservar el salón 2 días
            después de hoy</strong></p>
        {{messague}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="box-message" class="mt-2 mb-2"></div>
      <div class="container-fluid calendar-fixed d-flex flex-wrap m-auto">
        <div class="col-md-8">
          <article id="date" class="w-100 text-center pt-2 col-lg-12 pb-4">
            <h5 class="mb-2 font-weight-bold">Seleccione la fecha</h5>
            <div id="month" class="d-flex justify-content-between align-items-center mb-3 pb-3">
              <button type="button" class="btn btn-dark" v-on:click="previuos_month">&LeftAngleBracket;</button>
              <h6 class="mb-0">{{months[month]}} {{year}}</h6>
              <button type="button" class="btn btn-dark" v-on:click="next_month">&RightAngleBracket;</button>
            </div>
            <div id="week" class="d-flex row-cal mb-2">
              <div class="box-col-cal" v-for="day in week" style="width: 14.2857%;">
                <div>{{day}}</div>
              </div>
            </div>
            <div id="cal">
              <div class="d-flex row-cal" v-for="(week, indexweek) in calendar">
                <div class="box-col-cal" v-for="(day, indexday) in week" style="width: 14.2857%;">
                  <div class="col-cal btn" v-bind:class="get_class_date(day)" v-on:click="select_date(indexweek, indexday)">{{day}}</div>
                </div>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-4 m-auto">
          <article class="d-flex flex-wrap flex-column align-items-center">
            <div class="d-flex flex-wrap justify-content-center align-items-center mb-3">
              <div style="background: #70A3ED;" class="box-state"></div>
              <p class="mb-0">Reservado</p>
            </div>
            <div class="d-flex flex-wrap justify-content-center align-items-center mb-3">
              <div style="background: #FCC70F;" class="box-state"></div>
              <p class="mb-0">En espera</p>
            </div>
            <div class="d-flex flex-wrap justify-content-center align-items-center mb-3">
              <div style="background: purple;" class="box-state"></div>
              <p class="mb-0">Seleccionado</p>
            </div>
            <div :click="validateSelectedDate()"
              class="d-flex flex-wrap justify-content-center align-items-center mb-3" v-html="button">
            </div>
          </article>
        </div>
      </div>
    </section>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="../../js/my/calendar.js"></script>
</body>

</html>