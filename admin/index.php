<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <title>Admin</title>
   <style>
      .option-selected {
         background-color: #eeeeee !important;
         color: black !important;
         border-left: none !important;
         border-right: none !important;
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
   include('../partials/admin/navigation.html');
   ?>
   <main class="container-fluid mt-2">
      <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark">
         <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white;">¡Hola Admnin!</h5>
         <span class="btn btn-dark btn-block" onclick="load_page(this)">Clientes</span>
         <span class="btn btn-dark btn-block" onclick="load_page(this)">Reservaciones</span>
         <span id="opt-salon" class="btn btn-dark btn-block option-selected" onclick="load_page(this, 'salon')">Salon</span>
         <span class="btn btn-dark btn-block" onclick="load_page(this)">Reportes</span>
         <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white;">
            <span id="opt-settings" class="btn btn-dark btn-block" onclick="load_page(this, 'settings')">Ajustes</span>
         </div>
      </div>
      <section id="settings" class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3" style="background: #eeeeee; display: none;">
         <article class="input-group mb-2 col-sm-7">
            <div class="input-group-prepend">
               <label for="select" class="input-group-text">Ver datos:</label>
            </div>
            <select id="select" class="custom-select">
               <option value="novalue" selected hidden>Seleccione una opción</option>
               <option value="client">Clientes</option>
               <option value="user">Usuarios</option>
            </select>
         </article>
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
      <section id="salon" class="py-4 px-0 mt-3 px-sm-3 col-lg-9 mt-lg-0 px-lg-3" style="background: #eeeeee;">
         <form>
            <div class="w-100 d-flex flex-wrap">
               <div class="px-0 col-lg-6">
                  <div class="pr-lg-3">
                     <div class="w-100 d-flex flex-wrap box-input">
                        <label for="name_salon" class="col-sm-4">Nombre salon:</label>
                        <input type="text" name="name_salon" id="name_salon" class="form-control col-sm-8" />
                     </div>
                     <div class="box-input">
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
                     </div>
                     <div class="box-input">
                        <div class="w-100 d-flex flex-wrap form-group">
                           <label for="tel" class="col-sm-4">Teléfono:</label>
                           <input type="text" name="tel" id="tel" class="form-control col-sm-8" />
                        </div>
                        <div class="w-100 d-flex flex-wrap">
                           <label for="email" class="col-sm-4">Correo:</label>
                           <input type="email" name="email" id="email" class="form-control col-sm-8" />
                        </div>
                     </div>
                     <div class="box-input">
                        <div class="w-100 d-flex flex-wrap form-group">
                           <label for="bank" class="col-sm-4">Banco:</label>
                           <input type="text" name="bank" id="bank" class="form-control col-sm-8" />
                        </div>
                        <div class="w-100 d-flex flex-wrap form-group">
                           <label for="owner" class="col-sm-4">Titular:</label>
                           <input type="text" name="owner" id="owner" class="form-control col-sm-8" />
                        </div>
                        <div class="w-100 d-flex flex-wrap form-group">
                           <label for="num_account" class="col-sm-4">No. Cuenta:</label>
                           <input type="text" name="num_account" id="num_account" class="form-control col-sm-8" />
                        </div>
                        <div class="w-100 d-flex flex-wrap">
                           <label for="key" class="col-sm-4">Clave:</label>
                           <input type="text" name="key" id="key" class="form-control col-sm-8" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="px-0 col-lg-6">
                  <div class="pl-lg-3">
                     <div class="box-input">
                        <div class="w-100 d-flex flex-wrap form-group">
                           <label for="capacity" class="col-sm-4">Capacidad:</label>
                           <input type="number" min="0" name="capacity" id="capacity" class="form-control col-sm-8" />
                        </div>
                        <div class="w-100 d-flex flex-wrap form-group">
                           <label for="open" class="col-sm-4">Hora apertura:</label>
                           <input type="text" name="opne" id="opne" class="form-control col-sm-8" />
                        </div>
                        <div class="w-100 d-flex flex-wrap form-group">
                           <label for="close" class="col-sm-4">Hora cierre:</label>
                           <input type="text" name="close" id="close" class="form-control col-sm-8" />
                        </div>
                        <div class="w-100 d-flex flex-wrap">
                           <label for="description_salon" class="col-sm-4">Descripción del salón:</label>
                           <textarea name="description_salon" cols="5" id="description_salon" class="form-control col-sm-8" style="resize: none;"></textarea>
                        </div>
                     </div>
                     <div class="box-input">
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
                     </div>
                  </div>
               </div>
            </div>
            <div class="w-100 mt-3 d-flex justify-content-center">
               <input type="submit" value="Actualizar" class="btn btn-primary" />
            </div>
         </form>
      </section>
   </main>
   <script>
      var option_page_current = document.getElementById('opt-salon');
      var page_loaded_current = document.getElementById('salon');
      
      function load_page(element, id_page) {
         if (active_option(element)) {
            show_page(id_page);
         } else {
            console.log('Ya esta activada');
         }
      }
      function active_option(element) {
         let list_class = element.className.split(' ');
         if (list_class.lastIndexOf('option-selected') != -1) return false;
         
         console.log('Activando ', element.firstChild.nodeValue, '...');

         list_class.push('option-selected');
         element.className = list_class.join(' ');

         console.log('Hecho.');

         if (option_page_current) {
            console.log('Desactivando ', option_page_current.firstChild.nodeValue, '...');
            let list_class = option_page_current.className.split(' ');
            let pos_class_selected = list_class.lastIndexOf('option_selected');
            list_class.splice(pos_class_selected, 1);
            option_page_current.className = list_class.join(' ');
            console.log('Hecho.');
         }

         option_page_current = element;
         return true;
      }
      function show_page(id_page) {
         if (!id_page) return;

         if (page_loaded_current) {
            page_loaded_current.style.display = 'none';
         }
         
         let component = document.getElementById(id_page);
         console.log('Mostrando página ', component.id, '...');
         component.style.display = 'block';

         page_loaded_current = component;
         console.log('Hecho');
      }
   </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>