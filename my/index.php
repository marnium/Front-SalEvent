<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <link rel="stylesheet" href="../css/page-my/styles-index.css" />
    <title>SallEvent</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  </head>
  <body>
    <?php
      include('../partials/my/navigation.html');
    ?>
    <main class="container-fluid mt-2 client">
      <div
        id="nav-left"
        class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark sticky-top"
      >
        <h4
          class="list-group-item bg-dark text-white font-weight-bold"
          style="border: none"
        >
          ¡Hola Usuario!
        </h4>
        <h5
          class="list-group-item bg-dark text-white font-weight-bold mb-2"
          style="border-bottom-color: white"
        >
          Reservaciones
        </h5>
        <span
          class="btn btn-dark btn-block"
          onclick="load_page(this,'myreservation')"
          >Mis reservaciones</span
        >
        <span
          class="btn btn-dark btn-block"
          onclick="load_page(this,'calendar')"
          >Calendario</span
        >
        <div
          class="list-group-item bg-dark text-white mt-2 px-0"
          style="border: none; border-top: 1px solid white"
        >
          <span
            id="opt-salon"
            class="btn btn-dark btn-block option-selected"
            onclick="load_page(this,'settings')"
            >Ajustes</span
          >
        </div>
      </div>
      <section id="settings" class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3">
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
                      value="Mike ... ..."
                      readonly
                    />
                  </div>
                  <div class="mb-2">
                    <label for="email">Email</label>
                    <input
                      type="email"
                      id="email"
                      class="form-control form-control mt-1"
                      placeholder="Email"
                      value="example@example.com"
                      readonly
                    />
                  </div>
                  <div class="mb-2">
                    <label for="number">Telefono</label>
                    <input
                      type="number"
                      id="number"
                      class="form-control form-control mt-1"
                      placeholder="Telefono"
                      value="123 123 1234"
                      readonly
                    />
                  </div>
                  <div class="mb-2">
                    <label for="user">Usuario</label>
                    <input
                      type="text"
                      id="user"
                      class="form-control form-control mt-1"
                      placeholder="Usuario"
                      value="Usuario"
                      readonly
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
                        value="password"
                        readonly
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
                  <form class="form-signin" id="form-user">
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
                        <label for="confirm-password"
                          >Confirmar contraseña</label
                        >
                        <input
                          type="password"
                          id="confirm-password"
                          class="form-control form-control mt-1"
                          placeholder="Confirmar contraseña"
                          required
                        />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 d-flex justify-content-center">
          <button
            type="submit"
            class="btn btn-primary bg-dark border-0"
            form="form-user"
          >
            Actualizar datos
          </button>
        </div>
      </section>

      <section
        id="calendar"
        class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3"
        style="display: none"
      >
        <div
          id="app"
          class="container-fluid calendar-fixed d-flex flex-wrap m-auto"
        >
          <div class="col-md-8">
            <article id="date" class="w-100 text-center pt-2 pb-2 date-fixed">
              <h5 class="mb-2 font-weight-bold">Seleccione la fecha</h5>
              <div
                id="month"
                class="d-flex justify-content-between align-items-center mb-3 pb-3"
              >
                <button
                  type="button"
                  class="btn btn-dark"
                  v-on:click="previuosMonth"
                >
                  &LeftAngleBracket;
                </button>
                <h6 class="mb-0">{{months[month]}} {{year}}</h6>
                <button
                  type="button"
                  class="btn btn-dark"
                  v-on:click="nextMonth"
                >
                  &RightAngleBracket;
                </button>
              </div>
              <div id="week" class="d-flex row-cal mb-2">
                <div
                  class="box-col-cal"
                  v-for="day in week"
                  style="width: 14.2857%"
                >
                  <div>{{day}}</div>
                </div>
              </div>
              <div id="state" class="row mb-2">
                <div class="col-6">
                  <div class="d-flex align-items-center justify-content-center">
                    <div style="background: #70a3ed" class="box-state"></div>
                    <p class="mb-0">Reservado</p>
                  </div>
                </div>
                <div class="col-6">
                  <div class="d-flex align-items-center justify-content-center">
                    <div style="background: #fcc70f" class="box-state"></div>
                    <p class="mb-0">Arreservar</p>
                  </div>
                </div>
              </div>
              <div id="cal">
                <div class="d-flex row-cal" v-for="(week, kw) in calendar">
                  <div
                    class="box-col-cal"
                    v-for="(day, kd) in week"
                    style="width: 14.2857%"
                  >
                    <div
                      class="col-cal btn btn-success"
                      v-on:click="reservedDay(kw, kd)"
                    >
                      {{day}}
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
          <div class="col-md-4">
            <article class="d-flex flex-column justify-content-center">
              <div
                class="mb-4 pb-1 d-flex align-items-center justify-content-center"
              >
                <div style="background: #70a3ed" class="box-state"></div>
                <p class="mb-0">Reservado</p>
              </div>
              <div
                class="mb-4 d-flex align-items-center justify-content-center"
              >
                <div style="background: #fcc70f" class="box-state"></div>
                <p class="mb-0">A reservar</p>
              </div>
              <div class="d-flex justify-content-center">
                <button
                  type="submit"
                  class="mt-4 btn btn-primary bg-dark border-0"
                >
                  Reservar este dia
                </button>
              </div>
            </article>
          </div>
        </div>
      </section>

      <section
        id="myreservation"
        class="repair-page py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3"
        style="display: none"
      >
        <div class="container-fluid">
          <div class="col-md-12">
            <div class="d-flex justify-content-center mt-4">
              <div
                class="pt-2 w-50 d-flex flex-wrap justify-content-around border border-primary text-center"
              >
                <h5>12</h5>
                <h6 class="pt-1">Confirmadas</h6>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-1">
              <div class="w-50 d-flex justify-content-end">
                <a href="#">Modificar</a>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
              <div
                class="pt-2 w-50 d-flex flex-wrap justify-content-around border border-warning text-center"
              >
                <h5>12</h5>
                <h6 class="pt-1">En espera de confirmacion</h6>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-1">
              <div class="w-50 d-flex justify-content-end">
                <a href="#">Modificar</a>
              </div>
            </div>
          </div>
          <div class="mt-4 pt-4 d-flex justify-content-center">
            <button type="submit" class="mt-4 btn btn-primary bg-dark border-0">
              Actualizar
            </button>
          </div>
        </div>
      </section>
    </main>
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
    <script>
      $(".list-group span").on("click", function () {
        $(".navbar-toggler").click();
      });
      function showPassword() {
        var tipo = document.getElementById("current-password");
        if (tipo.type == "password") {
          tipo.type = "text";
        } else {
          tipo.type = "password";
        }
      }
      var option_page_current = document.getElementById("opt-salon");
      var page_loaded_current = document.getElementById("settings");

      function load_page(element, id_page) {
        if (active_option(element)) {
          show_page(id_page);
        } else {
          console.log("Ya esta activada");
        }
      }
      function active_option(element) {
        let list_class = element.className.split(" ");
        if (list_class.lastIndexOf("option-selected") != -1) return false;

        console.log("Activando ", element.firstChild.nodeValue, "...");

        list_class.push("option-selected");
        element.className = list_class.join(" ");

        console.log("Hecho.");

        if (option_page_current) {
          console.log(
            "Desactivando ",
            option_page_current.firstChild.nodeValue,
            "..."
          );
          let list_class = option_page_current.className.split(" ");
          let pos_class_selected = list_class.lastIndexOf("option_selected");
          list_class.splice(pos_class_selected, 1);
          option_page_current.className = list_class.join(" ");
          console.log("Hecho.");
        }

        option_page_current = element;
        return true;
      }
      function show_page(id_page) {
        if (!id_page) return;

        if (page_loaded_current) {
          page_loaded_current.style.display = "none";
        }

        let component = document.getElementById(id_page);
        console.log("Mostrando página ", component.id, "...");
        component.style.display = "block";

        page_loaded_current = component;
        console.log("Hecho");
      }
    </script>
    <script src="../js/servicios.js"></script>
  </body>
</html>
