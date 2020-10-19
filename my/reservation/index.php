<?php
  session_start();
  if(!isset($_SESSION['dates_user'])){
    header("Location: /home/");
  }
?>
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
    <main class="container-fluid mt-3">
      <div
        class="container-fluid d-flex flex-wrap justify-content-around border border-dark"
      >
        <section class="col-md-4">
          <div class="col-md-12">
            <h2 class="text-center">Evento: boda</h2>
          </div>
          <div class="d-flex flex-column flex-wrap mt-4 pt-4">
            <div class="d-flex flex-wrap justify-content-around mb-3">
              <p>Horas contratadas</p>
              <p class="text-danger">8</p>
            </div>
            <div class="d-flex flex-wrap justify-content-around mb-3">
              <p>Hora inicio:</p>
              <p class="text-danger">10:00 AM</p>
            </div>
            <div class="d-flex flex-wrap justify-content-around mb-3">
              <p>Hora final:</p>
              <p class="text-danger">18:00 PM</p>
            </div>
          </div>
        </section>
        <section class="col-md-4">
          <div class="col-md-12">
            <h2 class="text-center">Datos del cliente</h2>
          </div>
          <div class="d-flex flex-column flex-wrap mt-4 pt-4">
            <div class="d-flex flex-wrap justify-content-around mb-3">
              <p>Nombre completo:</p>
              <p>Mikel</p>
            </div>
            <div class="d-flex flex-wrap justify-content-around mb-3">
              <p>Email:</p>
              <p>example@example.com</p>
            </div>
            <div class="d-flex flex-wrap justify-content-around mb-3">
              <p>Telefono:</p>
              <p>123 123 1212</p>
            </div>
          </div>
        </section>
        <section class="col-md-12">
          <div class="d-flex flex-column flex-wrap mt-4 pt-4">
            <div class="d-flex flex-wrap mb-3">
              <p class="mr-4">Total a pagar:</p>
              <p class="text-danger">10, 000</p>
            </div>
            <div class="d-flex flex-wrap mb-3">
              <p class="mr-4">Estatus:</p>
              <p class="text-danger">En espera</p>
            </div>
          </div>
        </section>
      </div>
      <div class="container-fluid d-flex flex-wrap justify-content-around mt-3">
        <a href="/my/myreservation" class="text-white text-decoration-none mb-2">
          <button class="btn btn-primary bg-dark border-0">Regresar</button>
        </a>
        <a href="/my/myreservation/" class="text-white text-decoration-none mb-2">
          <button class="btn btn-primary bg-dark border-0">
            Ver estado del evento
          </button>
        </a>
        <a href="/my/modify" class="text-white text-decoration-none mb-2">
          <button class="btn btn-primary bg-dark border-0">
            Modificar
          </button>
        </a>
      </div>
    </main>
  </body>
</html>
