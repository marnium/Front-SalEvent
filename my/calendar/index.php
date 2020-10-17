<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SallEvent</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="../../css/page-my/styles-index.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />

  </head>
  <body>
    <?php
      include('../../partials/my/navigation-options.html');
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
        <a href="/my/myreservation" class="text-white text-decoration-none mb-2">
          <span
            class="btn btn-dark btn-block"
            >Mis reservaciones</span
          >
        </a>
        <span
          class="btn btn-dark btn-block option-selected"
          >Calendario</span
        >
        <div
          class="list-group-item bg-dark text-white mt-2 px-0"
          style="border: none; border-top: 1px solid white"
        >
        <a href="/my" class="text-white text-decoration-none">
          <span
            class="btn btn-dark btn-block"
            >Ajustes</span
          >
        </a>
        </div>
      </div>
      <section
        id="calendar"
        class="py-4 mt-3 px-0 col-lg-9 mt-lg-0 px-lg-3"
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
                <a href="/my/book/" class="text-white text-decoration-none">
                  <button
                    type="submit"
                    class="mt-4 btn btn-primary bg-dark border-0"
                  >
                    Reservar este dia
                  </button>
                </a>
              </div>
            </article>
          </div>
        </div>
      </section>
    </main>
    <script src="../../js/servicios.js"></script>
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
