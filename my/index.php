<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>SallEvent</title>
    <style>
        @media only screen and (min-width: 992px) {
          #nav-left {
            display: flex !important;
            max-width: 232.5px;
            height: 100%;
            position: fixed;
            z-index: 1030;
          }
          main > div.col-lg-9 {
            margin-left: auto;
          }
        }
        @media only screen and (min-width: 1200px) {
          #nav-left {
            max-width: 277.5px;
          }
        }
        .img-settings{
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  </head>
  <body>
    <?php
    include('../partials/my/navigation.html');
?>
  <main class="container my-2">
    <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark">
      <h4 class="list-group-item bg-dark text-white font-weight-bold" style="border: none;">¡Hola Usuario!</h4>
      <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white;">Reservaciones</h5>
      <span class="btn btn-dark btn-block">Mis reservaciones</span>
      <span class="btn btn-dark btn-block">Calendario</span>
      <span class="btn btn-dark btn-block">Notificaciones</span>
      <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white;">
        <span class="btn btn-dark btn-block">Ajustes</span>
      </div>
    </div>
    <div class="col-lg-9 px-0 my-4 pb-4 mt-lg-0">
      <form class="form-signin">
        <div class="container-fluid">
          <div class="card mb-3 overflow-auto">
            <div class="row no-gutters">
              <div class="col-md-8">
                <div class="card-body">
                  <div class="mb-2">
                    <label for="Usuario">Nombre completo</label>
                    <input
                      type="text"
                      id="Usuario"
                      class="form-control form-control mt-1"
                      placeholder="Nombre"
                      required
                      autofocus
                    />
                  </div>
                  <div class="mb-2">
                    <label for="email">Email</label>
                    <input
                      type="email"
                      id="email"
                      class="form-control form-control mt-1"
                      placeholder="Email"
                      required
                      />
                    </div>
                    <div class="mb-2">
                      <label for="number">Telefono</label>
                      <input
                        type="number"
                        id="number"
                        class="form-control form-control mt-1"
                        placeholder="Telefono"
                        required
                      />
                    </div>
                    <div class="mb-2">
                      <label for="user">Usuario</label>
                      <input
                        type="text"
                        id="user"
                        class="form-control form-control mt-1"
                        placeholder="Usuario"
                        required
                      />
                    </div>
                  </div>
                </div>
                <div class="col-md-4 m-auto img-settings">
                  <img src="../img/my/settings/settings.png" alt="" />
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="card mb-12">
              <div class="row no-gutters">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="mt-2">
                      <label for="current-password">Contraseña actual</label>
                      <div class="mt-2 d-flex flex-wrap">
                        <input
                          type="password"
                          id="current-password"
                          class="form-control form-control mt-1 w-50"
                          placeholder="Contraseña actual"
                          required
                          autofocus
                        />
                        <i class="bx bx-show my-auto"></i>
                        <button
                          type="button"
                          class="btn btn-link"
                          onclick="showPassword()">
                          Ver
                        </button>
                      </div>
                    </div>
                    <div class="mt-2 d-flex flex-wrap justify-content-around">
                      <div class="mt-2">
                        <label for="change-password">Cambiar contraseña</label>
                        <input
                          type="password"
                          id="change-password"
                          class="form-control form-control mt-1"
                          placeholder="Cambiar contraseña"
                          required
                          autofocus
                        />
                      </div>
                      <div class="mt-2 ml-1">
                        <label for="confirm-password">Confirmar contraseña</label>
                        <input
                          type="password"
                          id="confirm-password"
                          class="form-control form-control mt-1"
                          placeholder="Confirmar contraseña"
                          required
                          autofocus
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-3 d-flex justify-content-center">
              <button type="submit" class="btn btn-primary bg-dark border-0">
                Actualizar datos
          </button>
        </div>
      </form>
    </div>
  </main>
  <script>
    function showPassword() {
      var tipo = document.getElementById("current-password");
      if (tipo.type == "password") {
        tipo.type = "text";
      } else {
        tipo.type = "password";
      }
    }
  </script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
