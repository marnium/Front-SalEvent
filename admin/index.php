<?php
  session_start();
  if(isset($_SESSION['data_user'])){
    header("Location: /my/");
  }
  if(!isset($_SESSION['data_admin'])){
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
   <title>Admin</title>
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
      .img-settings {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
      }
      .box-input {
         width: 100%;
         border: 2px solid green;
         border-radius: 7px;
         padding: 15px 7px;
         margin-bottom: 8px;
      }
      @media only screen and (min-width: 768px) {
         .box-input { padding: 15px; }
      }
   </style>
</head>

<body>
   <?php
   include('../partials/admin/navigation.php');
   ?>
   <main class="container-fluid mt-2">
      <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark sticky-top">
         <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white;">¡Hola Admnin!</h5>
         <span id="opt-customers" class="btn btn-dark btn-block" onclick="load_page(this, 'customers')">Clientes</span>
         <span id="opt-reservations" class="btn btn-dark btn-block" onclick="load_page(this, 'reservations')">Reservaciones</span>
         <span id="opt-salon" class="btn btn-dark btn-block" onclick="load_page(this, 'salon')">Salon</span>
         <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white;">
            <span id="opt-personal-information" class="btn btn-dark btn-block" onclick="load_page(this, 'personal-information')">Datos personales</span>
         </div>
      </div>
      <section id="customers" class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3" style="background: #eeeeee; display: none;">
         <h4 class="font-weight-bold text-right pr-3 pr-lg-0">Fecha</h4>
         <article class="d-flex flex-wrap mb-3">
            <h4 class="mb-2 font-weight-bold text-center col-lg-6">Tabla Clientes/Usuarios</h4>
            <div class="input-group col-lg-6">
               <div class="input-group-prepend">
                  <i class="fas fa-search input-group-text"></i>
               </div>
               <input type="search" class="form-control" placeholder="nombre usuario" />
            </div>
         </article>
         <article class="table-responsive">
            <table class="table table-striped table-hover">
               <thead class="thead-dark">
                  <tr>
                     <th>Id</th>
                     <th>Nombre</th>
                     <th>Apellido</th>
                     <th>Tel</th>
                     <th>Email</th>
                     <th>Usuario</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>1</td>
                     <td>Name-1</td>
                     <td>Last-1</td>
                     <td>tel-1</td>
                     <td>email-1</td>
                     <td>User-1</td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td>Name-2</td>
                     <td>Last-2</td>
                     <td>tel-2</td>
                     <td>email-2</td>
                     <td>User-2</td>
                  </tr>
                  <tr>
                     <td>3</td>
                     <td>Name-3</td>
                     <td>Last-3</td>
                     <td>tel-3</td>
                     <td>email-3</td>
                     <td>User-3</td>
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
            <div class="mb-2 col-sm-6 col-md-4">
               <button type="button" class="btn btn-primary btn-block">Modificar</button>
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
         <form>
            <article class="w-100 d-flex flex-wrap">
               <div class="px-0 col-lg-6 pr-lg-3">
                  <article class="w-100 d-flex flex-wrap box-input">
                     <label for="name_salon" class="col-sm-4">Nombre salon:</label>
                     <input type="text" name="name_salon" id="name_salon" class="form-control col-sm-8" />
                  </article>
                  <article class="box-input">
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="street" class="col-sm-4">Calle:</label>
                        <input type="text" name="street" id="street" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="state" class="col-sm-4">Estado:</label>
                        <input type="text" name="state" id="state" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="municip" class="col-sm-4">Municipio:</label>
                        <input type="text" name="municip" id="municip" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap">
                        <label for="suburb" class="col-sm-4">Colonia:</label>
                        <input type="text" name="suburb" id="suburb" class="form-control col-sm-8" />
                     </div>
                  </article>
                  <article class="box-input">
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="tel" class="col-sm-4">Teléfono:</label>
                        <input type="text" name="tel" id="tel" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap">
                        <label for="email" class="col-sm-4">Correo:</label>
                        <input type="email" name="email" id="email" class="form-control col-sm-8" />
                     </div>
                  </article>
               </div>
               <div class="px-0 col-lg-6 pl-lg-3">
                  <article class="box-input">
                     <div class="w-100 d-flex flex-wrap form-group">
                        <label for="capacity" class="col-sm-4">Capacidad:</label>
                        <input type="number" min="0" name="capacity" id="capacity" class="form-control col-sm-8" />
                     </div>
                     <div class="w-100 d-flex flex-wrap">
                        <label for="description_salon" class="col-sm-4">Descripción del salón:</label>
                        <textarea name="description_salon" cols="5" id="description_salon" class="form-control col-sm-8" style="resize: none;"></textarea>
                     </div>
                  </article>
                  <article class="box-input">
                     <h4>Días de laboración</h4>
                     <div class="form-group form-check">
                        <label for="monday" class="form-check-label">
                           <input type="checkbox" name="monday" id="monday" class="form-check-input" />
                           Lunes
                        </label>
                     </div>
                     <div class="form-group form-check">
                        <label for="tuesday" class="form-check-label">
                           <input type="checkbox" name="tuesday" id="tuesday" class="form-check-input" />
                           Martes
                        </label>
                     </div>
                     <div class="form-group form-check">
                        <label for="wednesday" class="form-check-label">
                           <input type="checkbox" name="wednesday" id="wednesday" class="form-check-input" />
                           Miércoles
                        </label>
                     </div>
                     <div class="form-group form-check">
                        <label for="thursday" class="form-check-label">
                           <input type="checkbox" name="thursday" id="thursday" class="form-check-input" />
                           Jueves
                        </label>
                     </div>
                     <div class="form-group form-check">
                        <label for="friday" class="form-check-label">
                           <input type="checkbox" name="friday" id="friday" class="form-check-input" />
                           Viernes
                        </label>
                     </div>
                     <div class="form-group form-check">
                        <label for="saturday" class="form-check-label">
                           <input type="checkbox" name="saturday" id="saturday" class="form-check-input" />
                           Sabado
                        </label>
                     </div>
                     <div class="form-group form-check">
                        <label for="sunday" class="form-check-label">
                           <input type="checkbox" name="sunday" id="sunday" class="form-check-input" />
                           Domingo
                        </label>
                     </div>
                  </article>
               </div>
            </article>
            <article class="w-100 mt-3 d-flex justify-content-center">
               <input type="submit" value="Actualizar" class="btn btn-primary" />
            </article>
         </form>
      </section>
      <section id="personal-information" class="py-4 mt-3 px-1 px-sm-3 px-md-4 col-lg-9 mt-lg-0 px-lg-5" style="background: #eeeeee; display: none;">
         <h3 class="text-center font-weight-bold">Administrador</h3>
         <div class="form-group">
            <label for="inf-lastname" class="font-weight-bold">Nombre completo</label>
            <input id="inf-lastname" type="text" value="Administrador-1 Lastname" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-email" class="font-weight-bold">Email</label>
            <input id="inf-email" type="text" value="amdin@salevent.com" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-tel" class="font-weight-bold">Teléfono</label>
            <input id="inf-tel" type="text" value="9287476" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-user" class="font-weight-bold">Usuario</label>
            <input id="inf-user" type="text" value="user-admin" readonly class="form-control" />
         </div>
         <div class="form-group">
            <label for="inf-pass" class="font-weight-bold">Contraseña</label>
            <button type="button" class="btn btn-link" onclick="show_or_hide_password(this, 'inf-pass')">Ver</button>
            <input id="inf-pass" type="password" value="pass" readonly class="form-control" />
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
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"></script>
   <script>
      $('.list-group span').on('click', function(){
         $('.navbar-toggler').click();
      });
      $(document).ready(function() {
         option_page_current = document.getElementById('opt-customers');
         page_loaded_current = document.getElementById('customers');

         page_loaded_current.style.display = 'block';
         
         let list_class = option_page_current.className.split(' ');
         list_class.push('option-selected');
         option_page_current.className = list_class.join(' ');
      });
      function load_page(element, id_page) {
         if (active_option(element)) {
            show_page(id_page);
         } else {
            console.log('Ya esta activada');
         }
      }
      function active_option(element) {
         let list_class = element.className.split(' ');
         if (list_class.lastIndexOf('option-selected') != -1) return false; //Si ya esta activo la opción se sale

         if (option_page_current) {
            console.log('Desactivando ', option_page_current.firstChild.nodeValue, '...');
            let list_class = option_page_current.className.split(' ');
            let pos_class_selected = list_class.lastIndexOf('option_selected');
            list_class.splice(pos_class_selected, 1);
            option_page_current.className = list_class.join(' ');
            console.log('Hecho.');
         }

         console.log('Activando ', element.firstChild.nodeValue, '...');
         list_class.push('option-selected');
         element.className = list_class.join(' ');
         console.log('Hecho.');

         option_page_current = element;
         return true;
      }
      function show_page(id_page) {
         if (!id_page) return;

         if (page_loaded_current) {
            console.log('Ocultando página ', page_loaded_current.id, '...');
            page_loaded_current.style.display = 'none';
            console.log('Hecho.');
         }
         
         let component = document.getElementById(id_page);
         console.log('Mostrando página ', component.id, '...');
         component.style.display = 'block';
         console.log('Hecho');

         page_loaded_current = component;
      }
      function show_or_hide_password(button, id_pass) {
         let el = document.getElementById(id_pass);
         if (el.type == 'password') {
            el.type = 'text';
            button.firstChild.nodeValue = 'Ocultar';
         }
         else {
            el.type = 'password';
            button.firstChild.nodeValue = 'Ver';
         }
      }
      function valide_equals_password(id_pass1, id_pass2) {
      }
   </script>
</body>
</html>