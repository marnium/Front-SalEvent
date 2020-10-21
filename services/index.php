<?php
  session_start();
  if(isset($_SESSION['data_user'])){
    header("Location: /my/");
  }
  if(isset($_SESSION['data_admin'])){
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
   <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
   <?php
      require_once('../databaseOperations/operations.php');
      $operationsDB = new OperationBD();
      $date = explode(' ', date('Y m'));
      echo "<script>var reservations = JSON.parse('".
         $operationsDB->select_date_reservations_for_month($date[0], $date[1]).
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
         margin-left: 15px;
      }
      .box-col-cal {
         padding-right: 15px;
      }
      .col-cal {
         width: 100%;
         padding: 0;
         padding-bottom: 10px;
         background: #EEEEEE;
         color: #1B1C1C;
         border-color: #EEEEEE;
      }
      #cal div.btn.disabled {
         background-color: purple;
         border-color: purple;
         opacity: 1;
         cursor: not-allowed;
      }
      #cal div.btn.reservated {
         background-color: #70A3ED;
         border-color: #70A3ED;
         opacity: 1;
      }
      #cal div.btn.on-hold {
         background: #FCC70F;
         border-color: #FCC70F;
         opacity: 1;
      }
      #cal > div.row-cal:first-child {
         justify-content: flex-end;
      }
      #price {
         background-color: #EEEEEE;
      }
   </style>
</head>
<body class="w-100">
   <?php
      include('../partials/home/navigation.html');
   ?>
   <main class="container p-0 mt-2" id="app">
      <section id="date-price" class="row m-0 no-gutters mb-3">
         <article id="date" class="w-100 text-center pt-2 col-lg-5">
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
            <div id="state" class="row m-0 mb-2 no-gutters justify-content-around">
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
                  <div class="box-col-cal" v-for="(day, indexday) in week" style="width: 14.2857%;">
                     <div class="col-cal btn" v-bind:class="get_class_date(day)"
                        v-on:click="select_date(indexweek, indexday)">{{day}}</div>
                  </div>
               </div>
            </div>
         </article>
         <article id="price" class="w-100 pt-4 pb-4 pl-sm-3 pr-sm-3 col-lg-7">
            <h5 class="font-weight-bold">Cotización</h5>
            <form method="post">
               <div class="row m-0 no-gutters mb-2 justify-content-end">
                  <div class="mb-2 col-md-7">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="type_reserv" class="pr-2 mb-0">Reservar por:</label>
                        <div class="col-8 col-lg-7">
                           <select name="reservation_type" id="reservation_type" class="form-control" v-model="reservation_type">
                              <option value="novalue" hidden="hidden">Seleccione una opción</option>
                              <option value="days">Dias</option>
                              <option value="hours">Horas</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="mb-2 col-sm-6 col-md-5">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="count_time" class="pr-2 mb-0">Cantidad:</label>
                        <div class="col-8 col-sm-7">
                           <input type="number" name="count_time" id="count_time" class="form-control" min="0" v-model="count_time" />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-5">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="count_people" class="pr-2 mb-0">Personas:</label>
                        <div class="col-8 col-sm-7">
                           <input type="number" name="count_people" id="count_people" class="form-control" min="0" v-model="count_people" />
                        </div>
                     </div>
                  </div>
               </div>
               <p class="p-0 font-weight-bold">Mobiliario:</p>
               <div class="row m-0 no-gutters mb-2">
                  <div class="mb-2 col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="chairs" class="pr-2 mb-0">Sillas:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="chairs" id="chairs" class="form-control" min="0" v-model="chairs" />
                        </div>
                     </div>
                  </div>
                  <div class="mb-2 col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="tables" class="pr-2 mb-0">Mesas:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="tables" id="tables" class="form-control" min="0" v-model="tables" />
                        </div>
                     </div>
                  </div>
                  <div class="mb-2 col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="tablecloths" class="pr-2 mb-0">Manteles:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="tablecloths" id="tablecloths" class="form-control" min="0" v-model="tablecloths" />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="assistants" class="pr-2 mb-0">Asistentes:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="assistants" id="assistants" class="form-control" min="0" v-model="assistants" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row m-0 no-gutters justify-content-end mb-3">
                  <div class="col-sm-6 col-md-5">
                     <div class="input-group align-items-center justify-content-end no-gutters">
                        <label for="total" class="pr-2 mb-0">Total:</label>
                        <div class="col-8 col-sm-7">
                           <input type="text" name="total" id="total" class="form-control" v-model="total" />
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <div class="d-flex justify-content-end">
               <i class="fas fa-cart-plus fa-2x mr-2"></i>
               <button type="button" class="btn btn-dark btn-sm mr-2">Agregar al carrito</button>
               <button type="button" class="btn btn-dark btn-sm mr-2">Cotizar</button>
               <button type="button" class="btn btn-dark btn-sm" v-on:click="clear_fields">Limpiar</button>
            </div>
         </article>
      </section>
      <section id="services" class="mb-5 pl-sm-3 pr-sm-3">
         <h4 class="font-weight-bold">Contamos con los diferentes servicios</h4>
         <article class="row m-0 no-gutters mb-3">
            <div class="mb-3 pl-md-5 pr-md-5 col-lg-6 pl-lg-3 pr-lg-3">
               <img src="../img/services/boda.jpg" alt="Boda" class="img-fluid" style="border-radius: 30px;">
            </div>
            <div class="col-lg-6">
               <h5 class="font-weight-bold">Bodas</h5>
               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam ex veritatis hic, expedita autem soluta perferendis blanditiis, voluptate non illum maxime? Tempore, quod rerum saepe sequi non quo quae vitae?</p>
            </div>
         </article>
         <article class="row m-0 no-gutters">
            <div class="col-lg-6">
               <h5 class="font-weight-bold">Graduaciones</h5>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet sapiente saepe perspiciatis officia, sit quibusdam placeat beatae est eos eligendi nisi adipisci exercitationem deserunt quos. Inventore quasi atque at itaque.</p>
            </div>
            <div class="pl-md-5 pr-md-5 col-lg-6 pl-lg-3 pr-lg-3">
               <img src="../img/services/luz.jpg" alt="Iluminación" class="img-fluid" style="border-radius: 30px;">
            </div>
         </article>
      </section>
   </main>
   <?php
      include('../partials/home/footer.html');
   ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"></script>
   <script src="../js/servicios.js"></script>
</body>
</html>