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
      <section class="col-md-9 border border-dark mt-3">
        <div class="d-flex flex-wrap justify-content-between mb-3 mt-3">
          <div
            class="col-md-12 d-flex flex-wrap flex-row-reverse justify-content-around mb-3"
          >
            <p class="h5">12/07/2020</p>
            <div class="d-flex flex-wrap justify-content-between">
              <p class="mr-3 h5">Salon de eventos:</p>
              <p class="h5">Los mangales</p>
            </div>
          </div>
          <div class="col-md-12 d-flex flex-wrap justify-content-around">
            <div class="d-flex flex-wrap justify-content-between">
              <p class="mr-3 h5">Descripcion:</p>
              <p class="h5">Grande</p>
            </div>
          </div>
          <div class="col-md-12 d-flex flex-wrap justify-content-around">
            <div class="d-flex flex-wrap justify-content-between">
              <p class="mr-3 h5">Tipo de evento:</p>
              <p class="h5">Boda</p>
            </div>
          </div>
          <div
            class="col-md-12 d-flex flex-wrap justify-content-around overflow-auto"
          >
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Servicios</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>2</td>
                  <td>Mesa</td>
                  <td>Mesas blancas</td>
                  <td>150</td>
                  <td>100</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Mesa</td>
                  <td>Mesas blancas</td>
                  <td>150</td>
                  <td>100</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Mesa</td>
                  <td>Mesas blancas</td>
                  <td>150</td>
                  <td>100</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-10 d-flex flex-wrap justify-content-end">
            <p class="mr-3 h4">Total:</p>
            <p class="text-danger h4">100.00</p>
          </div>
          <div class="col-md-12 d-flex flex-wrap justify-content-center mt-4">
            <a href="/my/reservation/" class="text-white text-decoration-none">
              <button class="btn btn-primary bg-dark border-0">Regresar</button>
            </a>
          </div>
        </div>
      </section>
      <section class="col-md-2 border border-dark mt-3 mb-1">
        <div class="d-flex flex-column flex-wrap">
          <div class="d-flex flex-wrap justify-content-center mb-4 mt-4 w-100">
            <a href="#" class="text-white text-decoration-none btn-block">
              <button class="btn btn-primary bg-dark border-0 btn-block">
                Modificar
              </button>
            </a>
          </div>
          <div class="d-flex flex-wrap justify-content-center mb-4">
            <a href="#" class="text-white text-decoration-none btn-block">
              <button class="btn btn-primary bg-dark border-0 btn-block">
                Pagar
              </button>
            </a>
          </div>
          <div class="d-flex flex-wrap justify-content-center mb-4">
            <a href="#" class="text-white text-decoration-none btn-block">
              <button class="btn btn-primary bg-dark border-0 btn-block">
                Eliminar reserva
              </button>
            </a>
          </div>
          <div class="d-flex flex-wrap justify-content-center mb-4">
            <a href="#" class="text-white text-decoration-none btn-block">
              <button class="btn btn-primary bg-dark border-0 btn-block">
                Nueva reserva
              </button>
            </a>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
