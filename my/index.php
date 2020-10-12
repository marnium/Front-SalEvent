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
      .sticky-bottom {
        position: fixed;
        height: 100%;
        left: 0;
      }
      @media screen and (max-width: 992px){
        .sticky-bottom{
          padding-left: 0;
          text-align: center;
        }
        .list-group-item{
          padding-left: 10px;
          text-align: center;
        }
      }
      @media screen and (max-width: 767px) {
        .sticky-bottom {
          position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          height: auto;
          background-color: red;
          color: white;
          text-align: center;
        }
        .img-settings{
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
        }
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  </head>
  <body>
    <?php
    include('../partials/my/navigation.html');
?>

    <div class="container-fluid mt-4" id="app-change">
      <div class="d-flex flex-md-row-reverse flex-wrap">
        <div class="col-md-9 mb-4 pb-4">
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
                            onclick="showPassword()"
                          >
                            Ver
                          </button>
                        </div>
                      </div>

                      <div class="mt-2 d-flex flex-wrap justify-content-around">
                        <div class="mt-2">
                          <label for="change-password"
                            >Cambiar contraseña</label
                          >
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
                          <label for="confirm-password"
                            >Confirmar contraseña</label
                          >
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
        <div
          class="col-md-3 navbar-expand-lg navbar-dark bg-dark sticky-bottom"
        >
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNavBottom"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavBottom">
            <div class="list-group m-auto overflow-hidden" id="list-tab">
              <div class="text-white border-bottom">
                <p class="mt-3 h3 text-center">Hola Eleomar</p>
                <p class="mt-3 h5 text-center">Reservaciones</p>
              </div>

              <a
                class="list-group-item list-group-item-action list-group-item-dark h5 text-center mt-2"
                id="revervations"
                data-toggle="list"
                href="#"
                aria-controls="home"
              >
                Mis reservaciones
              </a>
              <a
                class="list-group-item list-group-item-action list-group-item-dark h5 text-center border-bottom-0"
                id="calendar"
                data-toggle="list"
                href="#"
                role="tab"
              >
                Calendario
              </a>
              <a
                class="list-group-item list-group-item-action list-group-item-dark h5 text-center border-0"
                id="notifications"
                data-toggle="list"
                href="#"
                role="tab"
              >
                Notificaciones
              </a>
              <div class="text-white text-center border-top mt-4"></div>
              <a
                class="list-group-item list-group-item-action list-group-item-dark h4 text-center mt-2 active"
                id="settings"
                data-toggle="list"
                href="#"
                role="tab"
              >
                Ajustes
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
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
