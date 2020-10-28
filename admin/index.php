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
   <script src="https://cdn.jsdelivr.net/npm/vue"></script>
   <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
   <title>Admin</title>
   <link rel="stylesheet" href="../css/admin/style.css">
</head>

<body>
   <?php
   include('../partials/admin/navigation.php');
   ?>
   <main id="app" class="container-fluid mt-2 px-0">
      <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark sticky-top">
         <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white;">¡Hola {{data_admin.name_user}}!</h5>
         <span id="opt-customers" class="btn btn-dark btn-block" onclick="load_page('customers')">Clientes</span>
         <span id="opt-reservations" class="btn btn-dark btn-block" onclick="load_page('reservations')">Reservaciones</span>
         <span id="opt-services" class="btn btn-dark btn-block" onclick="load_page('services')">Servicios</span>
         <span id="opt-salon" class="btn btn-dark btn-block" onclick="load_page('salon')">Salón</span>
         <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white;">
            <span id="opt-personal-information" class="btn btn-dark btn-block" onclick="load_page('personal-information')">Datos personales</span>
         </div>
      </div>
      <section id="customers" class="px-0 mt-3 col-lg-9 mt-lg-0" style="display: none;">
         <div class="px-1 py-4 px-sm-2 px-md-3" style="background: #eeeeee;">
            <h4 class="font-weight-bold text-right"></h4>
            <article class="d-flex flex-wrap mb-3">
               <h4 class="px-0 mb-2 font-weight-bold text-center col-lg-6 pr-lg-2">Tabla Clientes</h4>
               <div class="px-0 input-group col-lg-6 pl-lg-2">
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
                        <td>{{ customer.email_user }}</td>
                        <td>{{ customer.phone_user }}</td>
                        <td>
                           <button v-on:click="modify_customer(index)" type="button" class="btn btn-success">Modificar</button>
                        </td>
                        <td>
                           <button v-on:click="remove_customer(index)" type="button" class="btn btn-danger">Eliminar</button>
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
         <div class="py-4 px-2 px-sm-3" style="background: #eeeeee;">
            <h3 class="text-center font-weight-bold mb-3">Reservaciones</h3>
            <article class="mb-3">
               <div class="bg-light text-center py-3 mb-3 rounded-lg shadow border border-info">
                  <h5 class="font-weight-bold">{{total_reservations.confirmed}}</h5>
                  <div class="d-flex align-items-center justify-content-center">
                     <div class="box-state bg-info"></div>
                     <p class="mb-0">Reservaciones confirmadas</p>
                  </div>
               </div>
               <div class="bg-light text-center py-3 mb-4 rounded-lg shadow border border-warning">
                  <h5 class="font-weight-bold">{{total_reservations.unconfirmed}}</h5>
                  <div class="d-flex align-items-center justify-content-center">
                     <div class="box-state bg-warning"></div>
                     <p class="mb-0">Reservaciones por confirmar</p>
                  </div>
               </div>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text">Buscar reservación</span>
                  </div>
                  <select v-model="type_select_reservations" class="custom-select">
                     <option value="all">Todos</option>
                     <option value="confirmed">Confirmado</option>
                     <option value="unconfirmed">Por confirmar</option>
                  </select>
                  <div class="input-group-append">
                     <button v-on:click="get_reservations" class="btn btn-success">Buscar</button>
                  </div>
               </div>
            </article>
            <article class="py-3">
               <div v-for="(reserv,index_res) in data_reservations.unconfirmed" class="p-2 bg-light rounded-lg shadow-sm mb-3 border border-warning">
                  <div class="d-flex flex-column mb-2 flex-md-row">
                     <div class="col-md-6">
                        <p>
                           <span class="font-weight-bold">Fecha reservada:</span>
                           <span>{{reserv.date_reservation_start}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">Salon:</span>
                           <span>{{reserv.name_saloon}}</span>
                        </p>
                        <p class="font-weight-bold">
                           <span>Estado:</span>
                           <span class="text-warning">Por confirmar</span>
                        </p>
                     </div>
                     <div class="col-md-6">
                        <p>
                           <span class="font-weight-bold">Usuario:</span>
                           <span>{{reserv.user_user}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">Nombre del cliente:</span>
                           <span>{{reserv.name_user}} {{reserv.pa_lastname_user}} {{reserv.mo_lastname_user}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">No. Teléfonico:</span>
                           <span>{{reserv.phone_user}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">Email:</span>
                           <span>{{reserv.email_user}}</span>
                        </p>
                     </div>
                  </div>
                  <div>
                     <button v-on:click="confirm_reservation(index_res)" type="button" class="btn btn-warning d-block mx-auto">Confirmar reservación</button>
                  </div>
               </div>
               <div v-for="reserv in data_reservations.confirmed" class="p-2 bg-light rounded-lg shadow-sm mb-3 border border-info">
                  <div class="d-flex flex-column mb-2 flex-md-row">
                     <div class="col-md-6">
                        <p>
                           <span class="font-weight-bold">Fecha reservada:</span>
                           <span>{{reserv.date_reservation_start}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">Salon:</span>
                           <span>{{reserv.name_saloon}}</span>
                        </p>
                        <p class="font-weight-bold">
                           <span>Estado:</span>
                           <span class="text-info">Confirmado</span>
                        </p>
                     </div>
                     <div class="col-md-6">
                        <p>
                           <span class="font-weight-bold">Usuario:</span>
                           <span>{{reserv.user_user}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">Nombre del cliente:</span>
                           <span>{{reserv.name_user}} {{reserv.pa_lastname_user}} {{reserv.mo_lastname_user}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">No. Teléfonico:</span>
                           <span>{{reserv.phone_user}}</span>
                        </p>
                        <p>
                           <span class="font-weight-bold">Email:</span>
                           <span>{{reserv.email_user}}</span>
                        </p>
                     </div>
                  </div>
               </div>
            </article>
         </div>
      </section>
      <section id="services" class="px-0 mt-3 col-lg-9 mt-lg-0" style="display: none">
         <div class="px-1 py-4 px-sm-2 px-md-3" style="background: #eeeeee;">
            <h4 class="font-weight-bold text-center">Servicios</h4>
            <article class="d-flex flex-wrap mb-3">
               <h4 class="px-0 mb-2 font-weight-bold text-center col-lg-6 pr-lg-2">Tabla Servicios</h4>
               <div class="px-0 input-group col-lg-6 pl-lg-2">
                  <div class="input-group-prepend">
                     <i class="fas fa-search input-group-text"></i>
                  </div>
                  <input id="search-services" type="search" class="form-control" placeholder="nombre servicio" />
               </div>
            </article>
            <article class="table-responsive mb-3">
               <table class="table m-0 table-striped table-hover">
                  <thead class="w-100 thead-dark">
                     <tr>
                        <th>Nombre servicio</th>
                        <th>Precio</th>
                        <th>Detalle</th>
                        <th>Modificar</th>
                     </tr>
                  </thead>
                  <tbody class="w-100">
                     <tr v-for="(service, index) in data_services">
                        <td>{{service.name_service}}</td>
                        <td>{{service.price}}</td>
                        <td>{{service.detail}}</td>
                        <td>
                           <button v-on:click="modify_service(index)" type="button" class="btn btn-success">Modificar</button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </article>
            <article class="w-100">
               <button v-on:click="fill_service" type="button"
                  class="btn btn-primary d-block mx-auto">Crear nuevo servicio</button>
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
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="price_hour" class="pl-0 col-sm-4">Precio por hora:</label>
                        <input v-model="data_salon.t_room.price_hour" type="number" min="0" id="price_hour" class="form-control col-sm-8" />
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
               <button v-on:click="modify_admin" type="button" class="btn btn-primary d-block mx-auto">Modificar información</button>
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
                     <input v-model="modal_customer.user_user" v-on:input="is_valid_user" type="text" id="bxm-user" class="form-control" placeholder="Usuario" maxlength="45" />
                  </div>
                  <div class="form-group input-group flex-nowrap">
                     <div class="input-group-prepend">
                        <label for="bxm-name" class="input-group-text"><i class="fas fa-user-alt"></i></label>
                     </div>
                     <div class="d-flex flex-grow-1 flex-column">
                        <input v-model="modal_customer.name_user" v-on:input="is_valid_input('name_user')" type="text" id="bxm-name" class="form-control mb-2 input-no-radius-tl-bl" placeholder="Nombre" maxlength="45" />
                        <input v-model="modal_customer.pa_lastname_user" v-on:input="is_valid_input('pa_lastname_user')" type="text" class="form-control mb-2 input-no-radius-tl-bl" placeholder="Apellido paterno" maxlength="45" />
                        <input v-model="modal_customer.mo_lastname_user" v-on:input="is_valid_input('mo_lastname_user')" type="text" class="form-control input-no-radius-tl-bl" placeholder="Apellido materno" maxlength="45" />
                     </div>
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bxm-email" class="input-group-text"><i class="fas fa-envelope"></i></label>
                     </div>
                     <input v-model="modal_customer.email_user" v-on:input="is_valid_email" v-on:change="onch_is_valid_email" type="email" id="bxm-email" class="form-control" placeholder="Email" maxlength="45">
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bxm-phone" class="input-group-text"><i class="fas fa-phone"></i></label>
                     </div>
                     <input v-model="modal_customer.phone_user" v-on:input="is_valid_input('phone_user')" type="tel" id="bxm-phone" class="form-control" placeholder="Teléfono" maxlength="11">
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bxm-pass" class="input-group-text"><i class="fas fa-lock"></i></label>
                     </div>
                     <input v-model="modal_customer.password_user" v-on:input="is_valid_input('password_user')" type="password" id="bxm-pass" class="form-control" placeholder="Contraseña" maxlength="45">
                     <div class="input-group-append">
                        <span class="btn btn-success" onclick="show_or_hide_password('#bxm-show-pass', '#bxm-pass')">
                           <i class="fas fa-eye" id="bxm-show-pass"></i>
                        </span>
                     </div>
                  </div>
                  <div class="w-100">
                     <button v-on:click="create_or_update_customer" type="button" class="btn btn-primary d-block mx-auto" v-bind:class="{disabled: is_disable_btn_modal}">{{modal_data.text_btn}}</button>
                  </div>
               </div>
            </div>
         </article>
      </section>
      <section id="box-services" class="modal fade">
         <article class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">{{modal_data_service.title}}<strong>{{modal_data_service.strong}}</strong></h5>
                  <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bx-service-name" class="input-group-text"><i class="fas fa-concierge-bell"></i></label>
                     </div>
                     <input v-model="modal_service.name_service" type="text" id="bx-service-name" class="form-control" placeholder="Nombre servicio" maxlength="45" />
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bx-service-price" class="input-group-text"><i class="fas fa-dollar-sign"></i></label>
                     </div>
                     <input v-model="modal_service.price" type="number" id="bx-service-price" class="form-control" placeholder="Precio" min="0" step="0.01">
                  </div>
                  <div class="form-group input-group">
                     <div class="input-group-prepend">
                        <label for="bx-service-detail" class="input-group-text"><i class="fas fa-info-circle"></i></label>
                     </div>
                     <textarea v-model="modal_service.detail" id="bx-service-detail" cols="15" rows="5" maxlength="45" placeholder="Detalles" class="form-control"></textarea>
                  </div>
                  <div class="w-100">
                     <button v-on:click="create_or_update_service" type="button"
                        class="btn btn-primary d-block mx-auto">{{modal_data_service.text_btn}}</button>
                  </div>
               </div>
            </div>
         </article>
      </section>
   </main>
   <?php
   // Data customers, salon and info-admin
   include_once('../databaseOperations/operations.php');
   $operationDB = new OperationBD();
   echo "<script>var total_reservations = JSON.parse('".
      addslashes($operationDB->get_total_reservations())."'); var data_salon = JSON.parse('".
      addslashes($operationDB->select_room_for_id(1))."'); var data_customers = JSON.parse('".
      addslashes($operationDB->select_user_type1())."'); var data_admin = JSON.parse('".
      addslashes($operationDB->select_data_admin($_SESSION['data_admin']['id_user'])).
      "'); var data_services = JSON.parse('".
      addslashes($operationDB->select_services())."');</script>";
   $operationDB->closeConnection();
   ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   <script src="../js/admin/admin.js"></script>
</body>

</html>