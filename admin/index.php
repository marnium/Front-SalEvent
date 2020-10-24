<?php
session_start();
if (isset($_SESSION['data_user'])) {
   header("Location: /my/");
}
if (!isset($_SESSION['data_admin'])) {
   header("Location: /home/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
   <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
   <title>Admin</title>
   <?php
   // Data customers and salon
   include_once('../databaseOperations/operations.php');
   $operationDB = new OperationBD();
   echo "<script>var data_salon = JSON.parse('" .
      $operationDB->select_room_for_id(1) . "'); var data_customers = JSON.parse('".
      $operationDB->select_user_type1()."');</script>";
   ?>
   <style>
      .option-selected {
         background-color: #eeeeee !important;
         color: black !important;
         border-left: none !important;
         border-right: none !important;
      }

      #nav-left {
         top: 84px;
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

      #customers > article.table-responsive,
         #box-modified-customer div.modal-content {
         box-shadow: 0 0 7px 1px #3e9fce;
      }
      #customers .input-no-radius-tl-bl {
         border-top-left-radius: 0;
         border-bottom-left-radius: 0;
      }

      .img-settings {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
      }

      .box-input {
         width: 100%;
         border-radius: 7px;
         padding: 15px 7px;
         margin-bottom: 15px;
         box-shadow: 0 0 5px 1px #3e9fce;
      }

      @media only screen and (min-width: 768px) {
         .box-input {
            padding: 15px;
         }
      }
   </style>
</head>

<body>
   <?php
   include('../partials/admin/navigation.php');
   ?>
   <main id="app" class="container-fluid mt-2">
      <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark sticky-top">
         <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white;">¡Hola Admnin!</h5>
         <span id="opt-customers" class="btn btn-dark btn-block" onclick="load_page('customers')">Clientes</span>
         <span id="opt-reservations" class="btn btn-dark btn-block" onclick="load_page('reservations')">Reservaciones</span>
         <span id="opt-salon" class="btn btn-dark btn-block" onclick="load_page('salon')">Salón</span>
         <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white;">
            <span id="opt-personal-information" class="btn btn-dark btn-block" onclick="load_page('personal-information')">Datos personales</span>
         </div>
      </div>
      <section id="customers" class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3" style="background: #eeeeee; display: none;">
         <h4 class="font-weight-bold text-right pr-3 pr-lg-0"></h4>
         <article class="d-flex flex-wrap mb-3">
            <h4 class="mb-2 font-weight-bold text-center col-lg-6">Tabla Clientes</h4>
            <div class="input-group col-lg-6">
               <div class="input-group-prepend">
                  <i class="fas fa-search input-group-text"></i>
               </div>
               <input id="search-customers" type="search" class="form-control" placeholder="nombre usuario" />
            </div>
         </article>
         <article class="table-responsive">
            <table class="table m-0 table-striped table-hover">
               <thead class="w-100 thead-dark">
                  <tr>
                     <th>Usuario</th>
                     <th>Nombre</th>
                     <th>Apellido paterno</th>
                     <th>Apellido materno</th>
                     <th>Email</th>
                     <th>Teléfono</th>
                     <th>Modificar</th>
                  </tr>
               </thead>
               <tbody class="w-100">
                  <tr v-for="(customer, index) in data_customers">
                     <td>{{ customer.user_user }}</td>
                     <td>{{ customer.name_user }}</td>
                     <td>{{ customer.pa_lastname_user }}</td>
                     <td>{{ customer.mo_lastname_user }}</td>
                     <td>{{ customer.phone_user }}</td>
                     <td>{{ customer.email_user }}</td>
                     <td>
                        <button v-on:click="modify_customer(index)" type="button" class="btn btn-primary">Modificar</button>
                     </td>
                  </tr>
               </tbody>
            </table>
         </article>
         <article class="d-flex flex-wrap mx-auto mt-3 col-11 col-sm-10 col-md-11">
            <div class="mb-2 col-sm-6 col-md-4">
               <button type="button" class="btn btn-primary btn-block">Nuevo</button>
            </div>
            <div class="mb-2 col-sm-6 col-md-4">
               <button type="button" class="btn btn-primary btn-block">Eliminar</button>
            </div>
         </article>
         <article id="box-modify-customer" class="modal fade">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Modificar información de <strong>{{data_customer_update.user_user}}</strong></h5>
                     <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                     <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <label for="bxm-user" class="input-group-text"><i class="fas fa-user-circle fa-lg"></i></label>
                        </div>
                        <input v-bind:value="data_customer_update.user_user" readonly
                           type="text" id="bxm-user" class="form-control" placeholder="Usuario" />
                     </div>
                     <div class="form-group input-group flex-nowrap">
                        <div class="input-group-prepend">
                           <label for="bxm-name" class="input-group-text"><i class="fas fa-user-alt"></i></label>
                        </div>
                        <div class="d-flex flex-grow-1 flex-column">
                           <input v-model="data_customer_update.name_user" v-on:change="active_update_customer"
                              type="text" id="bxm-name" class="form-control mb-2 input-no-radius-tl-bl" placeholder="Nombre" />
                           <input v-model="data_customer_update.pa_lastname_user" v-on:change="active_update_customer"
                              type="text" class="form-control mb-2 input-no-radius-tl-bl" placeholder="Apellido paterno" />
                           <input v-model="data_customer_update.mo_lastname_user" v-on:change="active_update_customer"
                              type="text" class="form-control input-no-radius-tl-bl" placeholder="Apellido materno" />
                        </div>
                     </div>
                     <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <label for="bxm-email" class="input-group-text"><i class="fas fa-envelope"></i></label>
                        </div>
                        <input v-model="data_customer_update.email_user" v-on:change="active_update_customer"
                           type="email" id="bxm-email" class="form-control" placeholder="Email">
                     </div>
                     <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <label for="bxm-phone" class="input-group-text"><i class="fas fa-phone"></i></label>
                        </div>
                        <input v-model="data_customer_update.phone_user" v-on:change="active_update_customer"
                           type="tel" id="bxm-phone" class="form-control" placeholder="Teléfono">
                     </div>
                     <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <label for="bxm-pass" class="input-group-text"><i class="fas fa-lock"></i></label>
                        </div>
                        <input v-model="data_customer_update.password_user" v-on:change="active_update_customer"
                           type="password" id="bxm-pass" class="form-control" placeholder="Contraseña">
                     </div>
                     <div class="w-100">
                        <button id="btn-update-customer" type="button" class="btn btn-primary d-block mx-auto"
                           v-bind:class="{disabled: is_disable_update_customer}">Actualizar</button>
                     </div>
                  </div>
               </div>
            </div>
         </article>
      </section>
      <section id="reservations" class="py-4 px-0 mt-3 px-sm-3 col-lg-9 mt-lg-0 px-lg-3" style="background: #eeeeee; display: none;">
         <article class="w-100 d-flex flex-wrap px-2 mb-3 text-center px-sm-0 px-lg-4 px-xl-5">
            <div class="w-100 border border-dark bg-success">
               <h2 class="font-weight-bold">2</h2>
               <h5>Reserv</h5>
            </div>
            <div class="bg-success border border-top-0 border-dark col-sm-6">
               <h2 class="font-weight-bold">10</h2>
               <h5>Octubre</h5>
            </div>
            <div class="bg-success border border-top-0 border-dark col-sm-6">
               <h2 class="font-weight-bold">38</h2>
               <h5>Semana</h5>
            </div>
         </article>
         <article class="py-3 mb-3">
            <h4 class="font-wieght-bold pl-2">Buscar Reservaciones:</h4>
            <div class="py-3 px-1 px-sm-2 px-md-3 px-lg-4 px-xl-5">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="res-today" class="input-group-text">
                        <input type="radio" name="res-filter" id="res-today" class="mr-1" />Hoy</label>
                     <label for="res-day" class="input-group-text">
                        <input type="radio" name="res-filter" id="res-day" class="mr-1" />Seleccionar fecha</label>
                  </div>
                  <input type="date" class="form-control" style="width: auto;" />
               </div>
            </div>
            <div class="border border-primary">
               Calendario
            </div>
         </article>
         <article class="pt-3 px-1 mb-3 px-md-3 px-lg-4 px-xl-5" style="font-size: 1.3rem;">
            <div class="bg-warning mb-3 p-2 shadow rounded">
               <div class="w-100 d-flex flex-wrap justify-content-around">
                  <span>Cliente</span>
                  <span>Teléfono</span>
               </div>
               <div class="w-100 d-flex flex-wrap justify-content-around">
                  <span>Fecha</span>
                  <span>Correo</span>
               </div>
               <div class="w-100 d-flex flex-wrap justify-content-around mb-3">
                  <span class="font-weight-bold">Confirmar reservación</span>
               </div>
               <div class="w-100 d-flex justify-content-center">
                  <button type="button" class="btn btn-primary">Confirmar</button>
               </div>
            </div>
            <div class="bg-primary mb-3 p-2 shadow rounded">
               <div class="w-100 d-flex flex-wrap justify-content-around">
                  <span>Cliente</span>
                  <span>Teléfono</span>
               </div>
               <div class="w-100 d-flex flex-wrap justify-content-around">
                  <span>Fecha</span>
                  <span>Correo</span>
               </div>
               <div class="w-100 d-flex flex-wrap justify-content-around">
                  <span class="font-weight-bold">Reservación confirmada</span>
               </div>
            </div>
         </article>
      </section>
      <section id="salon" class="py-4 px-0 mt-3 px-sm-3 col-lg-9 mt-lg-0 px-lg-3" style="background: #eeeeee; display: none">
         <h2 class="text-center mb-3">Datos del Salón de Eventos</h2>
         <article id="data-salon" class="w-100 d-flex flex-wrap">
            <div class="px-0 col-lg-6 pr-lg-3">
               <article class="w-100 d-flex flex-wrap box-input">
                  <div class="w-100 d-flex flex-wrap form-group">
                     <label for="name_salon" class="pl-0 col-sm-4">Nombre salon:</label>
                     <input v-model="data_salon.t_room.name_saloon" type="text" id="name_salon" class="form-control col-sm-8" />
                  </div>
                  <div class="w-100 d-flex flex-wrap form-group">
                     <label for="capacity" class="pl-0 col-sm-4">Capacidad:</label>
                     <input v-model="data_salon.t_room.capacity_saloon" type="number" min="0" id="capacity" class="form-control col-sm-8" />
                  </div>
                  <div class="w-100 d-flex flex-wrap">
                     <label for="description_salon" class="pl-0 col-sm-4">Descripción del salón:</label>
                     <textarea v-model="data_salon.t_room.description_saloon" cols="20" rows="5" id="description_salon" class="form-control col-sm-8" style="resize: none;"></textarea>
                  </div>
               </article>
               <article class="box-input">
                  <div class="w-100 d-flex flex-wrap form-group">
                     <label for="street" class="pl-0 col-sm-4">Calle:</label>
                     <input v-model="data_salon.t_direction.street_direction" type="text" id="street" class="form-control col-sm-8" />
                  </div>
                  <div class="w-100 d-flex flex-wrap form-group">
                     <label for="state" class="pl-0 col-sm-4">Estado:</label>
                     <input v-model="data_salon.t_direction.state_direction" type="text" id="state" class="form-control col-sm-8" />
                  </div>
                  <div class="w-100 d-flex flex-wrap form-group">
                     <label for="municip" class="pl-0 col-sm-4">Municipio:</label>
                     <input v-model="data_salon.t_direction.municipality_direction" type="text" id="municip" class="form-control col-sm-8" />
                  </div>
                  <div class="w-100 d-flex flex-wrap">
                     <label for="suburb" class="pl-0 col-sm-4">Colonia:</label>
                     <input v-model="data_salon.t_direction.suburb_direction" type="text" id="suburb" class="form-control col-sm-8" />
                  </div>
               </article>
            </div>
            <div class="px-0 col-lg-6 pl-lg-3">
               <article class="box-input">
                  <h4 class="text-center">Días de laboración</h4>
                  <div class="form-group form-check">
                     <label for="monday" class="form-check-label">
                        <input v-model="data_salon.t_schedule.monday" true-value="Y" false-value="N" type="checkbox" id="monday" class="form-check-input" />Lunes</label>
                  </div>
                  <div class="form-group form-check">
                     <label for="tuesday" class="form-check-label">
                        <input v-model="data_salon.t_schedule.tuesday" true-value="Y" false-value="N" type="checkbox" id="tuesday" class="form-check-input" />Martes</label>
                  </div>
                  <div class="form-group form-check">
                     <label for="wednesday" class="form-check-label">
                        <input v-model="data_salon.t_schedule.wednesday" true-value="Y" false-value="N" type="checkbox" id="wednesday" class="form-check-input" />Miércoles</label>
                  </div>
                  <div class="form-group form-check">
                     <label for="thursday" class="form-check-label">
                        <input v-model="data_salon.t_schedule.thursday" true-value="Y" false-value="N" type="checkbox" id="thursday" class="form-check-input" />Jueves</label>
                  </div>
                  <div class="form-group form-check">
                     <label for="friday" class="form-check-label">
                        <input v-model="data_salon.t_schedule.friday" true-value="Y" false-value="N" type="checkbox" id="friday" class="form-check-input" />Viernes</label>
                  </div>
                  <div class="form-group form-check">
                     <label for="saturday" class="form-check-label">
                        <input v-model="data_salon.t_schedule.saturday" true-value="Y" false-value="N" type="checkbox" id="saturday" class="form-check-input" />Sabado</label>
                  </div>
                  <div class="form-group form-check">
                     <label for="sunday" class="form-check-label">
                        <input v-model="data_salon.t_schedule.sunday" true-value="Y" false-value="N" type="checkbox" id="sunday" class="form-check-input" />Domingo</label>
                  </div>
               </article>
            </div>
         </article>
         <article class="w-100 mt-3 d-flex justify-content-center">
            <button id="update-salon" type="button" class="btn btn-primary">Actualizar</button>
         </article>
      </section>
      <section id="personal-information" class="py-4 mt-3 px-1 px-sm-3 px-md-4 col-lg-9 mt-lg-0 px-lg-5" style="background: #eeeeee; display: none;">
         <h3 class="text-center font-weight-bold">Administrador</h3>
         <div class="form-group">
            <label for="inf-lastname" class="font-weight-bold">Nombre completo</label>
            <input id="inf-lastname" type="text" value="<?php echo $_SESSION['data_admin'][2] . " "
                                                            . $_SESSION['data_admin'][3] . " " . $_SESSION['data_admin'][4]; ?>" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-email" class="font-weight-bold">Email</label>
            <input id="inf-email" type="text" value="<?php echo $_SESSION['data_admin'][5]; ?>" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-tel" class="font-weight-bold">Teléfono</label>
            <input id="inf-tel" type="text" value="<?php echo $_SESSION['data_admin'][6]; ?>" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-user" class="font-weight-bold">Usuario</label>
            <input id="inf-user" type="text" value="<?php echo $_SESSION['data_admin'][7]; ?>" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-pass" class="font-weight-bold">Contraseña</label>
            <button type="button" class="btn btn-link" onclick="show_or_hide_password(this, 'inf-pass')">Ver</button>
            <input id="inf-pass" type="password" value="<?php echo $_SESSION['data_admin'][8]; ?>" readonly class="form-control" />
         </div>
         <form action="">
            <div class="form-group">
               <label for="inf-new-pass" class="font-weight-bold">Cambiar contraseña</label>
               <input id="inf-new-pass" type="password" name="new_pass" placeholder="contraseña nueva" required class="form-control" />
            </div>
            <div class="form-group">
               <label for="inf-retry-pass" class="font-weight-bold">Repetir contraseña</label>
               <input id="inf-retry-pass" type="password" placeholder="contraseña nueva" required class="form-control" />
            </div>
            <div class="w-100 d-flex justify-content-center">
               <input type="submit" value="Actualizar" class="btn btn-success" />
            </div>
         </form>
      </section>
   </main>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   <script>
      var index_customer_update = 0;
      var vm = new Vue({
         el: "#app",
         data: {
            data_salon: data_salon,
            data_customers: data_customers,
            data_customer_update: {},
            is_disable_update_customer: true
         },
         methods: {
            modify_customer: function(index_customer) {
               this.is_disable_update_customer = true;
               index_customer_update = index_customer;
               this.data_customer_update = JSON.parse(JSON.stringify(this.data_customers[index_customer]));
               $('#box-modify-customer').modal({backdrop: 'static', keyboard: false});
            },
            active_update_customer: function() {
               this.is_disable_update_customer = false;
            }
         }
      });

      var id_page_current = '#customers';
      var id_option_current = '#opt-customers';
      var c_date = new Date();

      $(document).ready(function() {
         $('.list-group span').on('click', function() {
            $('.navbar-toggler').click();
         });

         $(id_page_current).css('display', 'block');
         $(id_option_current).addClass('option-selected');

         $('#customers > h4').text(c_date.getDate() + '/' + (c_date.getMonth() + 1) +
            '/' + c_date.getFullYear());
         $('#search-customers').on('input', function() {
            if ($(this).val()) {
               $.post('../ajax/admin/selectUserForUser.php', {
                     user: $(this).val()
                  },
                  function(data, status) {
                     if (status == 'success') {
                        let parse_data = JSON.parse(data);
                        if (parse_data.value) {
                           vm.data_customers = parse_data.data_customers;
                        } else {
                           vm.data_customers = [];
                        }
                     }
                  }
               );
            }
         });
         $('#btn-update-customer').click(function(){
            if($(this).attr('class').indexOf('disabled') != -1) return;
            $.post('../ajax/admin/updateUser.php', {
                  'data_user': JSON.stringify(vm.data_customer_update)
               },
               function(data, status){
                  if(status == 'success') {
                     let data_parse = JSON.parse(data);
                     if(data_parse.status) {
                        vm.data_customers[index_customer_update] = JSON.parse(JSON.stringify(vm.data_customer_update));
                        $('#customers').before('<div class="alert alert-success alert-dismissible fade show text-center"' +
                           'role="alert"><strong>Exitoso</strong>: Se actualizo correctamente la información de '+
                           vm.data_customer_update.user_user +'<button type="button" class="close" data-dismiss="alert"'+
                           ' aria-label="close"><span aria-hidden="true">&times;</span></button>');
                     }
                  } else {
                     $('#customers').before('<div class="alert alert-danger alert-dismissible fade show text-center"' +
                     'role="alert"><strong>Error</strong>: No se pudo actualizar la información de '+
                     vm.data_customer_update.user_user +'<button type="button" class="close" data-dismiss="alert"'+
                     ' aria-label="close"><span aria-hidden="true">&times;</span></button>');
                  }
                  $('#box-modify-customer').modal("hide");
               }
            );
         });

         $('#update-salon').click(function() {
            $.post('../ajax/admin/createOrUpdateRoom.php', {
                  "data-salon": JSON.stringify(vm.data_salon)
               },
               function(data, status) {
                  if (status == 'success') {
                     let parse_data = JSON.parse(data);
                     if (parse_data['status']) {
                        let status_msg = 'actualizó correctamente la información del salón de eventos';
                        if (parse_data['action'] == 'create') {
                           vm.data_salon.t_room.id_saloon = parse_data.t_room;
                           vm.data_salon.t_room.id_info = parse_data.t_info;
                           vm.data_salon.t_direction.id_direction = parse_data.t_direction;
                           vm.data_salon.t_schedule.id_schedule = parse_data.t_schedule;
                           status_msg = 'registro correctamente el salón de eventos';
                        }
                        $('main.container-fluid').prepend(
                           '<div class="alert alert-success alert-dismissible fade show text-center"' +
                           'role="alert"><strong>Exitoso</strong>: Se ' + status_msg +
                           '<button type="button" class="close" data-dismiss="alert" aria-label="close">' +
                           '<span aria-hidden="true">&times;</span></button>');
                     } else {
                        let status_msg = 'actualizar correctamente la información del salón de eventos\nError al actualizar datos en la tabla' +
                           parse_data['in_table'];
                        if (parse_data['action'] == 'create')
                           status_msg = 'registrar correctamente el salón de eventos\nError al registrar datos en la tabla' +
                           parse_data['in_table'];
                        $('main.container-fluid').prepend(
                           '<div class="alert alert-error alert-dismissible fade show text-center"' +
                           'role="alert"><strong>Error</strong>: No se pudo' + status_msg +
                           '<button type="button" class="close" data-dismiss="alert" aria-label="close">' +
                           '<span aria-hidden="true">&times;</span></button>');
                     }
                  }
               }
            );
         });
      });

      function load_page(id_page) {
         if (active_option(id_page)) {
            show_page(id_page);
         }
      }

      function active_option(id_page) {
         if ($('#opt-' + id_page).attr('class').lastIndexOf('option-selected') != -1) return false;

         if (id_option_current) {
            $(id_option_current).removeClass('option-selected');
         }

         id_option_current = '#opt-' + id_page;
         $(id_option_current).addClass('option-selected');

         return true;
      }

      function show_page(id_page) {
         if (id_page_current) {
            $(id_page_current).css('display', 'none');
         }

         id_page_current = '#' + id_page;
         $(id_page_current).css('display', 'block');
      }

      function show_or_hide_password(button, id_pass) {
         let el = document.getElementById(id_pass);
         if (el.type == 'password') {
            el.type = 'text';
            button.firstChild.nodeValue = 'Ocultar';
         } else {
            el.type = 'password';
            button.firstChild.nodeValue = 'Ver';
         }
      }

      function valide_equals_password(id_pass1, id_pass2) {}
   </script>
</body>

</html>