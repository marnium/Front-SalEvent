<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Servicios</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
   <style>
      .row {
         margin: 0;
      }
      .container {
         padding: 0;
      }
      [class*=col] {
         padding: 0;
      }
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
      div.col-cal {
         width: 100%;
         background: #EEEEEE;
         color: #1B1C1C;
         padding-bottom: 10px;
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
   <main class="container" id="app">
      <section id="date-price" class="row mb-3">
         <article id="date" class="w-100 text-center pt-2 col-lg-5">
            <h5 class="mb-2 font-weight-bold">Seleccione la fecha</h5>
            <div id="month" class="d-flex justify-content-between align-items-center mb-3 pb-3">
               <button type="button" class="btn btn-dark" v-on:click="previuosMonth">&LeftAngleBracket;</button>
               <h6 class="mb-0">{{months[month]}} {{year}}</h6>
               <button type="button" class="btn btn-dark" v-on:click="nextMonth">&RightAngleBracket;</button>
            </div>
            <div id="week" class="d-flex row-cal mb-2">
               <div class="box-col-cal" v-for="day in week" style="width: 14.2857%;">
                  <div>{{day}}</div>
               </div>
            </div>
            <div id="state" class="row mb-2">
               <div class="col-6">
                  <div class="d-flex align-items-center justify-content-center">
                     <div style="background: #70A3ED;" class="box-state"></div>
                     <p class="mb-0">Reservado</p>
                  </div>
               </div>
               <div class="col-6">
                  <div class="d-flex align-items-center justify-content-center">
                     <div style="background: #FCC70F;" class="box-state"></div>
                     <p class="mb-0">Arreservar</p>
                  </div>
               </div>
            </div>
            <div id="cal">
               <div class="d-flex row-cal" v-for="(week, kw) in calendar">
                  <div class="box-col-cal" v-for="(day, kd) in week" style="width: 14.2857%;">
                     <div class="col-cal btn btn-success" v-on:click="reservedDay(kw, kd)">{{day}}</div>
                  </div>
               </div>
            </div>
         </article>
         <article id="price" class="w-100 pt-4 pb-4 pl-sm-3 pr-sm-3 col-lg-7">
            <h5 class="font-weight-bold">Cotización</h5>
            <form method="post">
               <div class="row mb-2 justify-content-end">
                  <div class="mb-2 col-md-7">
                     <div class="input-group align-items-center justify-content-end">
                        <label for="type_reserv" class="pr-2 mb-0">Reservar por:</label>
                        <div class="col-8 col-lg-7">
                           <select name="type_reserv" id="type_reserv" class="form-control" v-model="type_reserv">
                              <option value="novalue" hidden="hidden">Seleccione una opción</option>
                              <option value="days">Dias</option>
                              <option value="hours">Horas</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="mb-2 col-sm-6 col-md-5">
                     <div class="input-group align-items-center justify-content-end">
                        <label for="count_time" class="pr-2 mb-0">Cantidad:</label>
                        <div class="col-8 col-sm-7">
                           <input type="number" name="count_time" id="count_time" class="form-control" min="0" v-model="count_time" />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-5">
                     <div class="input-group align-items-center justify-content-end">
                        <label for="count_people" class="pr-2 mb-0">Personas:</label>
                        <div class="col-8 col-sm-7">
                           <input type="number" name="count_people" id="count_people" class="form-control" min="0" v-model="count_people" />
                        </div>
                     </div>
                  </div>
               </div>
               <p class="p-0 font-weight-bold">Mobiliario:</p>
               <div class="row mb-2">
                  <div class="mb-2 col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end">
                        <label for="chairs" class="pr-2 mb-0">Sillas:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="chairs" id="chairs" class="form-control" min="0" v-model="chairs" />
                        </div>
                     </div>
                  </div>
                  <div class="mb-2 col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end">
                        <label for="tables" class="pr-2 mb-0">Mesas:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="tables" id="tables" class="form-control" min="0" v-model="tables" />
                        </div>
                     </div>
                  </div>
                  <div class="mb-2 col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end">
                        <label for="tablecloths" class="pr-2 mb-0">Manteles:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="tablecloths" id="tablecloths" class="form-control" min="0" v-model="tablecloths" />
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-4">
                     <div class="input-group align-items-center justify-content-end">
                        <label for="assistants" class="pr-2 mb-0">Asistentes:</label>
                        <div class="col-8 col-sm-7 col-lg-6">
                           <input type="number" name="assistants" id="assistants" class="form-control" min="0" v-model="assistants" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row justify-content-end mb-3">
                  <div class="col-sm-6 col-md-5">
                     <div class="input-group align-items-center justify-content-end">
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
               <button type="button" class="btn btn-dark btn-sm" v-on:click="clearFields">Limpiar</button>
            </div>
         </article>
      </section>
      <section id="services" class="mb-5 pl-sm-3 pr-sm-3">
         <h4 class="font-weight-bold">Contamos con los diferentes servicios</h4>
         <article class="row mb-3">
            <div class="mb-3 pl-md-5 pr-md-5 col-lg-6 pl-lg-3 pr-lg-3">
               <img src="../img/img-services/boda.jpg" alt="Boda" class="img-fluid" style="border-radius: 30px;">
            </div>
            <div class="col-lg-6">
               <h5 class="font-weight-bold">Bodas</h5>
               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam ex veritatis hic, expedita autem soluta perferendis blanditiis, voluptate non illum maxime? Tempore, quod rerum saepe sequi non quo quae vitae?</p>
            </div>
         </article>
         <article class="row">
            <div class="col-lg-6">
               <h5 class="font-weight-bold">Graduaciones</h5>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet sapiente saepe perspiciatis officia, sit quibusdam placeat beatae est eos eligendi nisi adipisci exercitationem deserunt quos. Inventore quasi atque at itaque.</p>
            </div>
            <div class="pl-md-5 pr-md-5 col-lg-6 pl-lg-3 pr-lg-3">
               <img src="../img/img-services/luz.jpg" alt="Iluminación" class="img-fluid" style="border-radius: 30px;">
            </div>
         </article>
      </section>
   </main>
   <?php
      include('../partials/home/footer.html');
   ?>
   <script src="../js/servicios.js"></script>
</body>
</html>