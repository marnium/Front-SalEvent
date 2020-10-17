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
    <style>
      input[type="number"] {
        width: 80px;
        height: 40px;
      }
      .selected {
        width: 100px;
      }
      .icon-size {
        font-size: 40px;
      }
      .repair-size input[type="number"] {
        width: 300px;
      }
    </style>
    <title>SallEvent</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container logo">
        <a class="navbar-brand" href="/my/">
          <img
            src="../../img/home/logo.png"
            class="fas fa-link"
            height="50px"
          />
          SallEvent
        </a>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/home/">Cerrar Sesion</a>
          </li>
        </ul>
      </div>
    </nav>

    <main
      class="container-fluid d-flex flex-wrap justify-content-around m-auto"
    >
      <h1 class="col-md-12">Modificar Reserva:</h1>
      <section class="col-md-7 border border-dark">
        <form action="/my/myreservation/" id="form-book" method="POST">
          <div class="d-flex flex-row flex-wrap">
            <div class="col-md-6 input-group mb-2 mt-2">
              <div class="input-group-prepend">
                <label for="event" class="h6 mt-2 mr-2">Evento:</label>
              </div>
              <select id="event" class="custom-select" name="event" required>
                <option value="" selected hidden>Seleccione una opción</option>
                <option value="graduation">Graduacion</option>
                <option value="wedding">Boda</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="d-flex flex-column flex-wrap">
                <div class="mt-2 d-flex flex-wrap justify-content-center">
                  <label for="start-time" class="mr-2 mt-1">Hr inicio:</label>
                  <input
                    type="number"
                    name="start-time"
                    id="start-time"
                    class="mb-1"
                    min="0"
                    max="24"
                    required
                  />
                  <select class="ml-2 selected mb-1" name="start-time-select">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                  </select>
                </div>
                <div class="mt-2 d-flex flex-wrap justify-content-center">
                  <label for="final-time" class="mr-2 mt-1">Hr final:</label>
                  <input
                    type="number"
                    name="final-time"
                    id="final-time"
                    class="mb-1"
                    min="0"
                    max="24"
                    required
                  />
                  <select class="ml-2 selected mb-1" name="final-time-select">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12 input-group mb-2 mt-4">
              <div class="input-group-prepend">
                <label for="book" class="h6 mt-2 mr-2">Reservar por:</label>
              </div>
              <select id="book" class="custom-select" name="book" required>
                <option value="" selected hidden>Seleccione una opción</option>
                <option value="graduation">Graduacion</option>
                <option value="wedding">Boda</option>
              </select>
            </div>
            <div class="col-md-12 mt-4">
              <h3>Mobiliario:</h3>
            </div>
            <div class="col-md-12 mt-2">
              <div class="d-flex flex-wrap justify-content-between">
                <div
                  class="col-md-4 mb-2 d-flex flex-wrap justify-content-center"
                >
                  <label for="final-time" class="mr-2 mt-1">Sillas:</label>
                  <input
                    type="number"
                    name="final-time"
                    id="final-time"
                    class="mb-1"
                    min="0"
                    required
                  />
                </div>
                <div
                  class="col-md-4 mb-2 d-flex flex-wrap justify-content-center"
                >
                  <label for="final-time" class="mr-2 mt-1">Mesas:</label>
                  <input
                    type="number"
                    name="final-time"
                    id="final-time"
                    class="mb-1"
                    min="0"
                    required
                  />
                </div>
                <div
                  class="col-md-4 mb-2 d-flex flex-wrap justify-content-center"
                >
                  <label for="final-time" class="mr-2 mt-1">Manteles:</label>
                  <input
                    type="number"
                    name="final-time"
                    id="final-time"
                    class="mb-1"
                    min="0"
                    required
                  />
                </div>
                <div
                  class="col-md-4 mb-2 d-flex flex-wrap justify-content-center"
                >
                  <label for="final-time" class="mr-2 mt-1">
                    Asistentes:
                  </label>
                  <input
                    type="number"
                    name="final-time"
                    id="final-time"
                    class="mb-1"
                    min="0"
                    required
                  />
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
      <section class="col-md-4 border border-dark mt-1">
        <h3 class="text-center">Datos del cliente</h3>
        <div class="d-flex flex-column flex-wrap mt-4">
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Nombre completo:</p>
            <p>Mikel</p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Email:</p>
            <p>example@example.com</p>
          </div>
          <div class="d-flex flex-wrap justify-content-between mb-3">
            <p>Telefono:</p>
            <p>123 123 1212</p>
          </div>
        </div>
        <div class="mb-3 d-flex flex-wrap justify-content-center">
          <a href="/my/" class="text-white text-decoration-none">
            <button type="submit" class="btn btn-primary bg-dark border-0">
              Configurar datos
            </button>
          </a>
        </div>
      </section>
      <section class="col-md-12 d-flex flex-wrap justify-content-around mt-4">
        <div class="d-flex flex-wrap justify-content-around mb-2">
          <i class="bx bxs-cart-add icon-size mr-2"></i>
          <button
            type="submit"
            class="btn btn-primary bg-dark mr-3 mb-2 border-0"
            form="form-book"
          >
            Actualizar
          </button>
          <button class="btn btn-primary bg-dark mr-3 mb-2 border-0">
            Cotizar
          </button>
          <button
            type="reset"
            class="btn btn-primary bg-dark mr-3 mb-2 border-0"
            form="form-book"
          >
            Limpiar
          </button>
        </div>
        <div class="d-flex flex-wrap justify-content-around mb-2 repair-size">
          <a
            type="reset"
            href="/my/myreservation"
            class="text-white text-decoration-none"
          >
            <button class="btn btn-primary bg-dark mr-3 pl-2 pr-2 border-0">
              Regresar
            </button>
          </a>
          <div class="div">
            <label for="total" class="mt-2 mr-2">Total:</label>
            <input type="number" id="total" name="total" value="0" min="0" />
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
  </body>
</html>
