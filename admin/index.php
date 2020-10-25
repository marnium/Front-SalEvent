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
   // Data customers, salon and info-admin
   include_once('../databaseOperations/operations.php');
   $operationDB = new OperationBD();
   echo "<script>var data_salon = JSON.parse('" .
      $operationDB->select_room_for_id(1) . "'); var data_customers = JSON.parse('" .
      $operationDB->select_user_type1() . "'); var data_admin = JSON.parse('" .
      json_encode($_SESSION['data_admin']) . "');</script>";
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

      #customers article.table-responsive,
      #box-modify-customer div.modal-content {
         box-shadow: 0 0 7px 1px #3e9fce;
      }

      #box-modify-customer .input-no-radius-tl-bl {
         border-top-left-radius: 0;
         border-bottom-left-radius: 0;
      }

      main input.error-input,
      main input.error-input:focus {
         outline: none;
         box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
         border: 1px solid red;
      }

      main input.success-input,
      main input.success-input:focus {
         outline: none;
         box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.4);
         border: 1px solid green;
      }

      main button[type=button].disabled {
         cursor: not-allowed;
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

      .scale-when-hover {
         transition: transform 0.5s;
      }

      .scale-when-hover:hover {
         transform: scale(1.1, 1.1);
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
      <section id="customers" class="px-0 mt-3 col-lg-9 mt-lg-0" style="display: none;">
         <div class="py-4 px-lg-3" style="background: #eeeeee;">
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
            <article class="table-responsive mb-3">
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
                        <th>Eliminar</th>
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
                        <td>
                           <button v-on:click="remove_customer(index)" type="button" class="btn btn-primary">Eliminar</button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </article>
            <article class="w-100">
               <button v-on:click="fill_customer" type="button" class="btn btn-primary d-block mx-auto">Crear nuevo usuario</button>
            </article>
         </div>
      </section>
      <section id="reservations" class="px-0 mt-3 col-lg-9 mt-lg-0" style="display: none;">
         <div class="py-4 px-sm-3" style="background: #eeeeee;">
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
         </div>
      </section>
      <section id="salon" class="px-0 mt-3 col-lg-9 mt-lg-0" style="display: none">
         <div class="py-4 px-sm-3" style="background: #eeeeee;">
            <h3 class="text-center font-weight-bold mb-3">Datos del Salón de Eventos</h3>
            <article id="data-salon" class="w-100 d-flex flex-wrap">
               <div class="px-0 col-lg-6 pr-lg-3">
                  <article class="w-100 d-flex flex-wrap box-input">
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="name_salon" class="pl-0 col-sm-4">Nombre salon:</label>
                        <input v-model="data_salon.t_room.name_saloon" type="text" maxlength="45" id="name_salon" class="form-control col-sm-8" />
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
                        <input v-model="data_salon.t_direction.street_direction" type="text" maxlength="45" id="street" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="state" class="pl-0 col-sm-4">Estado:</label>
                        <input v-model="data_salon.t_direction.state_direction" type="text" maxlength="45" id="state" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="municip" class="pl-0 col-sm-4">Municipio:</label>
                        <input v-model="data_salon.t_direction.municipality_direction" type="text" maxlength="45" id="municip" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap">
                        <label for="suburb" class="pl-0 col-sm-4">Colonia:</label>
                        <input v-model="data_salon.t_direction.suburb_direction" type="text" maxlength="45" id="suburb" class="form-control col-sm-8" />
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
               <button v-on:click="update_salon" type="button" class="btn btn-primary">Actualizar</button>
            </article>
         </div>
      </section>
      <section id="personal-information" class="px-0 mt-3 col-lg-9 mt-lg-0" style="display: none;">
         <div class="py-4 px-1 px-sm-3 px-md-4 px-lg-5" style="background: #eeeeee;">
            <h3 class="text-center font-weight-bold mb-3">Administrador</h3>
            <article class="w-100 box-input">
               <div class="form-group">
                  <label for="inf-lastname" class="font-weight-bold">Nombre completo</label>
                  <input v-bind:value="data_admin.name_user+' '+data_admin.pa_lastname_user+' '+data_admin.mo_lastname_user" id="inf-lastname" type="text" readonly class="form-control" />
               </div>
               <div class="form-group">
                  <label for="inf-email" class="font-weight-bold">Email</label>
                  <input v-bind:value="data_admin.email_user" id="inf-email" type="text" readonly class="form-control" />
               </div>
               <div class="form-group">
                  <label for="inf-tel" class="font-weight-bold">Teléfono</label>
                  <input v-bind:value="data_admin.phone_user" id="inf-tel" type="text" readonly class="form-control" />
               </div>
               <div class="form-group">
                  <label for="inf-user" class="font-weight-bold">Usuario</label>
                  <input v-bind:value="data_admin.user_user" id="inf-user" type="text" readonly class="form-control" />
               </div>
               <div class="form-group">
                  <label for="inf-pass" class="font-weight-bold">Contraseña</label>
                  <div class="input-group">
                     <input v-bind:value="data_admin.password_user" id="inf-pass" type="password" readonly class="form-control" />
                     <div class="input-group-append">
                        <span class="btn btn-success" onclick="show_or_hide_password('#inf-show-pass', '#inf-pass')">
                           <i class="fas fa-eye" id="inf-show-pass"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </article>
            <article class="w-100">
               <button v-on:click="modify_admin" type="button"
                  class="btn btn-primary d-block mx-auto">Modificar información</button>
            </article>
         </div>
      </section>
      <section id="box-modify-customer" class="modal fade">
         <article class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">{{modal_data.title}}<strong>{{modal_data.strong}}</strong></h5>
                  <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group input-group" v-bind:style="modal_data.style_user">
                     <div class="input-group-prepend">
                        <label for="bxm-user" class="input-group-text"><i class="fas fa-user-circle fa-lg"></i></label>
                     </div>
                     <input v-model="modal_customer.user_user" v-on:input="is_valid_user"
                        type="text" id="bxm-user" class="form-control" placeholder="Usuario" maxlength="45" />
                  </div>
                  <div class="form-group input-group flex-nowrap">
                     <div class="input-group-prepend">
                        <label for="bxm-name" class="input-group-text"><i class="fas fa-user-alt"></i></label>
                     </div>
                     <div class="d-flex flex-grow-1 flex-column">
                        <input v-model="modal_customer.name_user" v-on:input="is_valid_input('name_user')"
                           type="text" id="bxm-name" class="form-control mb-2 input-no-radius-tl-bl" placeholder="Nombre" maxlength="45" />
                        <input v-model="modal_customer.pa_lastname_user" v-on:input="is_valid_input('pa_lastname_user')"
                           type="text" class="form-control mb-2 input-no-radius-tl-bl" placeholder="Apellido paterno" maxlength="45" />
                        <input v-model="modal_customer.mo_lastname_user" v-on:input="is_valid_input('mo_lastname_user')"
                           type="text" class="form-control input-no-radius-tl-bl" placeholder="Apellido materno" maxlength="45" />
                     </div>
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bxm-email" class="input-group-text"><i class="fas fa-envelope"></i></label>
                     </div>
                     <input v-model="modal_customer.email_user" v-on:input="is_valid_email" v-on:change="onch_is_valid_email"
                        type="email" id="bxm-email" class="form-control" placeholder="Email" maxlength="45">
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bxm-phone" class="input-group-text"><i class="fas fa-phone"></i></label>
                     </div>
                     <input v-model="modal_customer.phone_user" v-on:input="is_valid_input('phone_user')"
                        type="tel" id="bxm-phone" class="form-control" placeholder="Teléfono" maxlength="11">
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bxm-pass" class="input-group-text"><i class="fas fa-lock"></i></label>
                     </div>
                     <input v-model="modal_customer.password_user" v-on:input="is_valid_input('password_user')"
                        type="password" id="bxm-pass" class="form-control" placeholder="Contraseña" maxlength="45">
                     <div class="input-group-append">
                        <span class="btn btn-success" onclick="show_or_hide_password('#bxm-show-pass', '#bxm-pass')">
                           <i class="fas fa-eye" id="bxm-show-pass"></i>
                        </span>
                     </div>
                  </div>
                  <div class="w-100">
                     <button v-on:click="create_or_update_customer" type="button" class="btn btn-primary d-block mx-auto"
                        v-bind:class="{disabled: is_disable_btn_modal}">{{modal_data.text_btn}}</button>
                  </div>
               </div>
            </div>
         </article>
      </section>
   </main>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   <script>
      var vm = new Vue({
         el: "#app",
         data: {
            data_admin: data_admin,
            data_salon: data_salon,
            data_customers: data_customers,
            modal_customer: {
               id_user: 1,
               user_user: '',
               name_user: '',
               pa_lastname_user: '',
               mo_lastname_user: '',
               email_user: '',
               phone_user: '',
               password_user: ''
            },
            is_modal_update_admin: false,
            is_modal_create: true,
            index_modal_customer: 0,
            state_inputs_modal: {
               name_user: false,
               user_user: false,
               pa_lastname_user: false,
               mo_lastname_user: false,
               email_user: false,
               phone_user: false,
               password_user: false
            },
            user_already_exists: {
               state: false,
               value: ''
            },
            is_active_success_email: false
         },
         methods: {
            modify_admin: function() {
               this.is_modal_create = false;
               this.is_modal_update_admin = true;
               this.restart_modal();
               $('#box-modify-customer').modal({
                  backdrop: 'static',
                  keyboard: false
               });
            },
            update_admin: function() {
               $.post('../ajax/admin/updateUser.php', {
                     data_user: JSON.stringify(this.modal_customer)
                  },
                  function(data, status) {
                     if (status == 'success') {
                        if (JSON.parse(data).status) {
                           vm.data_admin = JSON.parse(JSON.stringify(vm.modal_customer));
                           create_notification('<strong>Exitoso</strong>: Se actualizo correctamente tu información',
                              'alert-success', 'personal-information');
                           $('#box-modify-customer').modal("hide");
                           return;
                        }
                     }
                     create_notification('<strong>Error</strong>: No se pudo actualizar tu información',
                        'alert-danger', 'personal-information');
                     $('#box-modify-customer').modal("hide");
                  }
               );
            },
            modify_customer: function(index_customer) {
               this.is_modal_create = false;
               this.index_modal_customer = index_customer;
               this.is_modal_update_admin = false;
               this.restart_modal();
               $('#box-modify-customer').modal({
                  backdrop: 'static',
                  keyboard: false
               });
            },
            create_or_update_customer: function() {
               if (this.is_disable_btn_modal) return;
               if (this.is_modal_create) {
                  this.create_customer();
               } else if(this.is_modal_update_admin) {
                  this.update_admin();
               } else {
                  this.update_customer();
               }
            },
            update_customer: function() {
               $.post('../ajax/admin/updateUser.php', {
                     'data_user': JSON.stringify(this.modal_customer)
                  },
                  function(data, status) {
                     if (status == 'success') {
                        if (JSON.parse(data).status) {
                           Vue.set(vm.data_customers, vm.index_modal_customer,
                              JSON.parse(JSON.stringify(vm.modal_customer)))
                           create_notification('<strong>Exitoso</strong>: Se actualizo correctamente la información de ' +
                              vm.modal_customer.user_user, 'alert-success', 'customers');
                           $('#box-modify-customer').modal("hide");
                           return;
                        }
                     }
                     create_notification('<strong>Error</strong>: No se pudo actualizar la información de ' +
                        vm.modal_customer.user_user, 'alert-danger', 'customers');
                     $('#box-modify-customer').modal("hide");
                  }
               );
            },
            remove_customer: function(index_customer) {
               $.post('../ajax/admin/deleteUser.php', {
                     id_user: this.data_customers[index_customer].id_user
                  },
                  function(data, status) {
                     if (status == 'success') {
                        let data_parse = JSON.parse(data);
                        if (data_parse.status) {
                           create_notification('<strong>Exisitoso</strong>: Se elimino correctamente al usuario ' +
                              vm.data_customers[index_customer].user_user, 'alert-success', 'customers');
                           vm.data_customers.splice(index_customer, 1);
                           return;
                        }
                     }
                     create_notification('<strong>Error</strong>: No se pudo eliminar al usuario ' +
                        vm.data_customers[index_customer], 'alert-danger', 'customers');
                  }
               );
            },
            fill_customer: function() {
               this.is_modal_create = true;
               this.restart_modal();
               $('#box-modify-customer').modal({
                  backdrop: 'static',
                  keyboard: false
               });
            },
            create_customer: function() {
               $.post('../ajax/admin/createUser.php', {
                     data_user: JSON.stringify(this.modal_customer)
                  },
                  function(data, status) {
                     if (status == 'success') {
                        let parse_data = JSON.parse(data);
                        if (parse_data.status) {
                           vm.modal_customer.id_user = parse_data.id_user;
                           vm.data_customers.unshift(JSON.parse(JSON.stringify(vm.modal_customer)));
                           $('#box-modify-customer').modal("hide");
                           create_notification('<strong>Exitoso</strong>Se registro el usuario '
                              + vm.modal_customer.user_user, 'alert-success', 'customers');
                           return;
                        } else if (parse_data.type == 'user_already_exists') {
                           vm.user_already_exists.state = true;
                           vm.user_already_exists.value = vm.modal_customer.user_user;
                           vm.state_inputs_modal.user_user = false;
                           create_error_user_modal();
                           return;
                        }
                     }
                     create_notification('<strong>Error</strong>: No se pudo registrar el usuario; conexión fallida',
                        'alert-danger', 'customers');
                  }
               );
            },
            update_salon: function() {
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
                           create_notification('<strong>Exitoso</strong> Se ' + status_msg, 'alert-success', 'salon');
                           return;
                        } else {
                           let status_msg = 'actualizar correctamente la información del salón de eventos\nError al actualizar datos en la tabla ' +
                              parse_data['in_table'];
                           if (parse_data['action'] == 'create')
                              status_msg = 'registrar correctamente el salón de eventos\nError al registrar datos en la tabla' +
                              parse_data['in_table'];
                           create_notification('<strong>Error</strong>: No se pudo ' + status_msg, 'alert-danger', 'salon');
                           return;
                        }
                        create_notification('<strong>Error</strong>: Conexión fallida');
                     }
                  }
               );
            },
            is_valid_user: function() {
               if(this.modal_customer.user_user) {
                  if(this.is_modal_create) {
                     if(this.user_already_exists.state) {
                        if(this.user_already_exists.value == this.modal_customer.user_user) {
                           this.state_inputs_modal.user_user = false;
                           create_error_user_modal();
                           return;
                        }
                        $('#bxm-error-user').remove();
                     }
                     this.state_inputs_modal.user_user = true;
                     return;
                  } else if(this.is_modal_update_admin) {
                     if(this.data_admin.user_user !=  this.modal_customer.user_user) {
                        this.is_disable_btn_modal = false;
                        return;
                     }
                  } else if(this.data_customers[this.index_modal_customer].user_user != 
                     this.modal_customer.user_user) {
                        this.is_disable_btn_modal = false;
                        return;
                  }
               }
               this.state_inputs_modal.user_user = false;
            },
            is_valid_email: function() {
               if (/^\w+(\.|-|\w)*@\w+(\.|-|\w)*$/.test(this.modal_customer.email_user)) {
                  if (this.is_modal_create) {
                     // Para modal create: pintar de verde y activar input emial
                     $('#bxm-email').removeClass('error-input').addClass('success-input');
                     this.is_active_success_email = true;
                     this.state_inputs_modal.email_user = true;
                     return;
                  } else if(this.is_modal_update_admin) {
                     if (this.data_admin.email_user != this.modal_customer.email_user) {
                        // Para modal update: pintar de verde el email, se modifico y es correcto el cambio.
                        // activar botón de actualización.
                        $('#bxm-email').removeClass('error-input').addClass('success-input');
                        this.is_disable_btn_modal = false;
                        return;
                     }
                  } else if (this.data_customers[this.index_modal_customer].email_user !=
                     this.modal_customer.email_user) {
                     // Para modal update: pintar de verde el email, se modifico y es correcto el cambio.
                     // activar botón de actualización.
                     $('#bxm-email').removeClass('error-input').addClass('success-input');
                     this.is_disable_btn_modal = false;
                     return;
                  }
                  // Para modal update: no hay cambios despintar el input y
                  // colocar el input en estado incorrecto(solo para desactivar el botón).
                  $('#bxm-email').removeClass('success-input').removeClass('error-input');
                  this.state_inputs_modal.email_user = false;
                  return;
               }
               /*Para modal create: Si, y solo sí, el input ha sido correcto una vez y esta vez es incorrecto,
               colocar input en estado incorrecto y pintar de color rojo. */
               if (this.is_modal_create) {
                  if (this.is_active_success_email) {
                     this.state_inputs_modal.email_user = false;
                        $('#bxm-email').removeClass('success-input').addClass('error-input');
                        this.is_active_success_email = false;
                  }
                  return;
               } else if(this.is_modal_update_admin) {
                  if (this.data_admin.email_user != this.modal_customer.email_user) {
                     this.state_inputs_modal.email_user = false;
                     $('#bxm-email').removeClass('success-input').addClass('error-input');
                     return;
                  }
               }
               /**
               Para modal update: Pintar de rojo si la contraseña es incorrecta y se haya modificado */
               if (this.data_customers[this.index_modal_customer].email_user !=
                  this.modal_customer.email_user) {
                  this.state_inputs_modal.email_user = false;
                  $('#bxm-email').removeClass('success-input').addClass('error-input');
               }
            },
            onch_is_valid_email: function() {
               if (!/^\w+(\.|-|\w)*@\w+(\.|-|\w)*$/.test(this.modal_customer.email_user)) {
                  $('#bxm-email').addClass('error-input');
               }
            },
            is_valid_input: function(key) {
               if(this.modal_customer[key]) {
                  if(this.is_modal_create) {
                     this.state_inputs_modal[key] = true;
                     return;
                  } else if(this.is_modal_create) {
                     if(this.data_admin != this.modal_customer[key]) {
                           this.is_disable_btn_modal = false;
                           return;
                     }
                  } else if(this.data_customers[this.index_modal_customer][key] != 
                     this.modal_customer[key]) {
                        this.is_disable_btn_modal = false;
                        return;
                  }
               }
               this.state_inputs_modal[key] = false;
            },
            restart_modal: function() {
               if (this.is_modal_create) {
                  this.modal_customer = {
                     id_user: 1,
                     user_user: '',
                     name_user: '',
                     pa_lastname_user: '',
                     mo_lastname_user: '',
                     email_user: '',
                     phone_user: '',
                     password_user: ''
                  };
               } else if (this.is_modal_update_admin) {
                  this.modal_customer = JSON.parse(JSON.stringify(this.data_admin));
               } else {
                  this.modal_customer = JSON.parse(JSON.stringify(
                     this.data_customers[this.index_modal_customer]));
               }
               this.is_disable_btn_modal = true;
               this.is_active_success_email = false;
            }
         },
         computed: {
            modal_data: function() {
               if (this.is_modal_create) {
                  return {
                     title: "Agregue los datos para el ",
                     strong: 'nuevo usuario',
                     text_btn: "Crear usuario",
                     style_user: {
                        display: 'flex'
                     }
                  }
               }
               return {
                  title: "Modificar información de ",
                  strong: this.modal_customer.user_user,
                  text_btn: "Actualizar",
                  style_user: {
                     display: 'none'
                  }
               }
            },
            is_disable_btn_modal: {
               get: function() {
                  for (const key in this.state_inputs_modal) {
                     if (!this.state_inputs_modal[key]) return true;
                  }
                  return false;
               },
               set: function(new_state) {
                  for (const key in this.state_inputs_modal) {
                     this.state_inputs_modal[key] = !new_state;
                  }
               }
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

         $('#customers > div > h4').text(c_date.getDate() + '/' + (c_date.getMonth() + 1) +
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
         $('#box-modify-customer').on('hidden.bs.modal', function() {
            if (document.getElementById('bxm-error-user')) {
               $('#bxm-error-user').remove();
            }
            $('#bxm-email').removeClass('error-input').removeClass('success-input');
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

      function create_notification(message, type_notification, section) {
         let alert = '#'+section+'>div.alert:first-child';
         $('#'+ section + '> div:last-child').before('<div class="alert ' + type_notification +
            ' alert-dismissible fade show text-center" role="alert">' + message +
            '<button type="button" class="close" data-dismiss="alert" aria-label="close">' +
            '<span aria-hidden="true">&times;</span></button>');
         setTimeout(function() {
            if(document.querySelector(alert))
               $(alert).alert('close');
         }, 6000);
      }

      function create_error_user_modal() {
         $('#box-modify-customer div.modal-body > div:first-child').after(
            '<p id="bxm-error-user" class="text-danger">Este usuario ya existe, especifique otro usuario</p>');
      }

      function show_or_hide_password(id_button, id_input) {
         $(id_button).toggleClass('fa-eye-slash fa-eye');

         if ($(id_input).attr('type') == 'password')
            $(id_input).attr('type', 'text');
         else
            $(id_input).attr('type', 'password');
      }
   </script>
</body>

</html>