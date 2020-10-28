<?php
session_start();
if (isset($_SESSION['data_user'])) {
   header("Location: /my/");
}
if (isset($_SESSION['data_admin'])) {
   header("Location: /admin/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/vue"></script>
   <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
   <?php
   require_once('../databaseOperations/operations.php');
   $operationsDB = new OperationBD();
   $date = explode(' ', date('Y m'));
   echo "<script>var reservations = JSON.parse('" .
      $operationsDB->select_date_reservations_for_month($date[0], $date[1]) .
      "');</script>";
   ?>
   <title>Servicios</title>
   <style>
      #date {
         background-color: #1B1C1C;
         color: #EEEEEE;
      }

      #month {
         border-bottom: 2px solid #777e7e;
      }

      .box-state {
         width: 15px;
         height: 15px;
         margin-right: 7px;
      }

      .row-cal {
         margin-bottom: 15px;
         margin-left: 12px;
      }

      .box-col-cal {
         padding-right: 12px;
         width: 14.2857%;
      }

      .col-cal {
         width: 100%;
         padding: 0;
         padding-bottom: 10px;
         background: #EEEEEE;
         color: #1B1C1C;
         border-color: #EEEEEE;
      }

      #cal .btn.disabled {
         cursor: not-allowed;
         opacity: 1;
         background: #EEEEEE;
         color: #1B1C1C;
         border-color: #EEEEEE;
      }

      #cal div.btn.selected {
         background-color: purple;
         border-color: purple;
      }

      #cal div.btn.reservated {
         background-color: #70A3ED;
         border-color: #70A3ED;
      }

      #cal div.btn.on-hold {
         background: #FCC70F;
         border-color: #FCC70F;
      }

      #cal>div.row-cal:first-child {
         justify-content: flex-end;
      }

      #price {
         background-color: #EEEEEE;
      }

      input[type="number"] {
         width: 80px;
         height: 40px;
      }
   </style>
</head>

<body class="w-100">
   <?php
   include('../partials/home/navigation.html');
   ?>
   <main class="container p-0 mt-2" id="app">
      <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
         Para fin de otorgar el mejor servicio, usted puede reservar el salón 2 días después de hoy
         <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <section id="date-price" class="row no-gutters mb-4">
         <article id="date" class="w-100 text-center pt-2 col-lg-5">
            <h5 class="mb-2 font-weight-bold">Seleccione la fecha</h5>
            <div id="month" class="d-flex justify-content-between align-items-center mb-3 pb-3">
               <button type="button" class="btn btn-dark" v-on:click="previuos_month">&LeftAngleBracket;</button>
               <h6 class="mb-0">{{months[month]}} {{year}}</h6>
               <button type="button" class="btn btn-dark" v-on:click="next_month">&RightAngleBracket;</button>
            </div>
            <div id="week" class="d-flex row-cal mb-2">
               <div class="box-col-cal" v-for="day in week">{{day}}</div>
            </div>
            <div id="state" class="row mb-2 no-gutters justify-content-around">
               <div>
                  <div class="d-flex align-items-center">
                     <div style="background: #70A3ED;" class="box-state"></div>
                     <p class="mb-0">Reservado</p>
                  </div>
               </div>
               <div>
                  <div class="d-flex align-items-center">
                     <div style="background: #FCC70F;" class="box-state"></div>
                     <p class="mb-0">En espera</p>
                  </div>
               </div>
               <div>
                  <div class="d-flex align-items-center">
                     <div style="background: purple;" class="box-state"></div>
                     <p class="mb-0">Seleccionado</p>
                  </div>
               </div>
            </div>
            <div id="cal">
               <div class="d-flex row-cal" v-for="(week, indexweek) in calendar">
                  <div class="box-col-cal" v-for="(day, indexday) in week">
                     <div class="col-cal btn" v-bind:class="get_class_date(day)" v-on:click="select_date(indexweek, indexday)">{{day}}</div>
                  </div>
               </div>
            </div>
         </article>
         <article id="price" class="w-100 pt-4 pb-4 pl-sm-3 pr-sm-3 col-lg-7">
            <h5 class="font-weight-bold">Cotización</h5>
            <div id="box-confirmpass" class="col-md-12 d-flex flex-wrap justify-content-center"></div>
            <form id="form-book" method="POST">
               <div class="d-flex flex-row flex-wrap">
                  <div class="col-md-12 input-group mb-2 mt-2" id="eventother">
                     <div class="input-group-prepend mb-3">
                        <label for="event" class="h6 mt-2 mr-2">Evento:</label>
                     </div>
                     <select id="event" class="custom-select mb-3" name="values[]" required>
                        <option value="" selected hidden>Seleccione una opción</option>
                        <option value="Graduacion">Graduacion</option>
                        <option value="Boda">Boda</option>
                        <option value="Bautizo">Bautizo</option>
                        <option value="Comunion">Comunion</option>
                        <option value="Confirmacion">Confirmacion</option>
                        <option value="Cumpleaños">Cumpleaños</option>
                        <option value="Quince años">Quince años</option>
                        <option value="Reunion">Reunion</option>
                        <option value="other">Otro</option>
                     </select>
                  </div>
                  <div class="col-md-12">
                     <div class="d-flex flex-column flex-wrap">
                        <div class="mt-2 d-flex flex-wrap justify-content-center">
                           <label for="start-time" class="mr-2 mt-1">Hr inicio:</label>
                           <input type="number" name="values[]" id="start-time" class="mb-1" min="1" max="12" required />
                           <select class="ml-2 selected mb-1" name="values[]" id="start-time-select">
                              <option value="am">AM</option>
                              <option value="pm">PM</option>
                           </select>
                        </div>
                        <div class="mt-2 d-flex flex-wrap justify-content-center">
                           <label for="final-time" class="mr-2 mt-1">Hr final:</label>
                           <input type="number" name="values[]" id="final-time" class="mb-1" min="1" max="12" required />
                           <select class="ml-2 selected mb-1" name="values[]" id="final-time-select">
                              <option value="am">AM</option>
                              <option value="pm">PM</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 mt-4">
                     <h3>Servicios:</h3>
                  </div>
                  <div class="col-md-12 mt-2">
                     <div class="d-flex flex-wrap justify-content-around" id="boxservices">
                        <?php
                        require_once('../databaseOperations/operations.php');
                        $operations = new OperationBD();
                        $services = $operations->getServices();
                        if ($services->num_rows) {
                           while ($row = $services->fetch_assoc()) {
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
                              echo '" class="mb-1" min="0" required  />
                      </div>';
                           }
                        }
                        ?>

                     </div>
                  </div>
               </div>
            </form>
            <div class="row no-gutters justify-content-end mb-3">
               <div class="col-sm-6 col-md-5">
                  <div class="input-group align-items-center justify-content-end no-gutters">
                     <label for="total" class="pr-2 mb-0">Total:</label>
                     <div class="col-8 col-sm-7">
                        <input type="text" name="total" id="total" class="form-control" v-model="total" disabled />
                     </div>
                  </div>
               </div>
            </div>
            <div class="d-flex justify-content-center">
               <button type="button" class="btn btn-dark btn-sm mr-2" onclick="quote()">Cotizar</button>
               <button type="reset" class="btn btn-dark btn-sm" form="form-book" onclick="restore()">Limpiar</button>
            </div>
         </article>
      </section>
      <section id="services" class="mb-5 pl-sm-3 pr-sm-3">
         <h4 class="font-weight-bold mb-3">Prestamos servicios para diferentes tipos de eventos</h4>
         <article class="row no-gutters mb-3">
            <div class="mb-3 pl-md-5 pr-md-5 col-lg-6 pl-lg-3 pr-lg-3">
               <img src="../img/services/boda.jpg" alt="Boda" class="img-fluid" style="border-radius: 30px;">
            </div>
            <div class="col-lg-6">
               <h5 class="font-weight-bold">Bodas</h5>
               <p class="text-justify">
                  Uno de los servicios más importantes en una boda es el de <span class="font-weight-bold">decoración</span>, ya que la misma reflejara el estilo que tendrá la misma.
                  La decoración más habitual es aquellas con flores y velas que se suele apreciar en las iglesias y en los salones de casamiento del registro civil;
                  los servicios de decoración para bodas pueden solicitarse en cualquier floristería ya que por lo general, las mismas ofertan paquetes especiales para las bodas.
               </p>
               <h6 class="font-weight-bold">Servicios adicionales</h6>
               <p class="text-justify">
                  Cada uno de los servicios que mencionamos suele tener una gran relevancia en las bodas, pero sin duda uno de los más importantes es el de <span class="font-weight-bold">fotografía</span>
                  y <span class="font-weight-bold">video</span> que suelen ofrecer los estudios, y es aquí en donde se les presenta un dilema que les resulta difícil de resolver.
                  Esto se debe a que se puede contar con amigos o con algún familiar para que se encargue de fotografiar y filmar la boda,
                  pero se debe tener en cuenta que esta opción no presentará la calidad deseada en un recuerdo tan importante. Aunque pueda resultar algo costosos, los servicios para bodas de fotografía y
                  video contratados ofrecen paquetes que pueden resultar muy originales en cuanto a la presentación del trabajo finalizado.
               </p>
            </div>
         </article>
         <article class="row no-gutters">
            <div class="col-lg-6">
               <h5 class="font-weight-bold">Graduaciones</h5>
               <p class="text-justify">
                  Nuestro salón de evento destaca entre las compañías que organizan fiestas de graduación, porque brinda los mejores servicios en una conveniente relación precio/calidad.
                  Por esto es el mejor y más solicitado.
               </p>
               <p class="font-weight-bold mb-2">
                  Brindamos:
               </p>
               <ul>
                  <li>Comida exquisita y de buen gusto.</li>
                  <li>Ambientaciones musicales en vivo, con solistas y ensambles de primer nivel.</li>
                  <li>Juegos de convivencia que animan al máximo la fiesta, en un ambiente de alegría y seguridad.</li>
               </ul>
               <p class="text-justify">
                  Contamos con paquetes de salones para graduaciones acordes a tus gustos, presupuesto y con facilidades de pago.
                  La recompensa a todo tu esfuerzo debe ser grande y para lograrlo, contamos con salones y jardines adaptados para que tu celebración sea inolvidable.
               </p>
            </div>
            <div class="pl-md-5 pr-md-5 col-lg-6 pl-lg-3 pr-lg-3">
               <img src="../img/services/luz.jpg" alt="Iluminación" class="img-fluid" style="border-radius: 30px;">
            </div>
         </article>
      </section>
   </main>
   <?php
   include('../partials/home/footer.php');
   ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   <script src="../js/servicios.js"></script>
</body>

</html>