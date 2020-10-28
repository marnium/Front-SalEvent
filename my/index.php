<?php
session_start();
if (!isset($_SESSION['data_user'])) {
  header("Location: /home/");
}
if (isset($_SESSION['data_admin'])) {
  header("Location: /admin/");
}
if (isset($_SESSION['newReservation'])) {
  header("Location: /my/book/");
}
if (isset($_SESSION['viewStatus'])) {
  header("Location: /my/reservation/");
}
if (isset($_SESSION['modifyReservation'])) {
  header("Location: /my/modify/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/page-my/styles-index.css" />
  <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
  <title>SallEvent</title>
</head>

<body>
  <?php
  include('../partials/my/navigation.php');
  ?>
  <main class="container-fluid mt-2 client">
    <div id="nav-left" class="w-100 collapse text-center p-0 list-group list-group-flush bg-dark sticky-top">
      <h4 class="list-group-item bg-dark text-white font-weight-bold" style="border: none">
        ¡Hola <?php echo $_SESSION['data_user'][2]; ?>!
      </h4>
      <h5 class="list-group-item bg-dark text-white font-weight-bold mb-2" style="border-bottom-color: white">
        Reservaciones
      </h5>
      <a href="/my/myreservation" class="text-white text-decoration-none mb-2">
        <span class="btn btn-dark btn-block">Mis reservaciones</span>
      </a>
      <a href="/my/calendar" class="text-white text-decoration-none">
        <span class="btn btn-dark btn-block">Calendario</span>
      </a>
      <div class="list-group-item bg-dark text-white mt-2 px-0" style="border: none; border-top: 1px solid white">
        <span class="btn btn-dark btn-block option-selected">Ajustes</span>
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
                  <input type="text" id="Usuario" class="form-control
                    form-control mt-1" placeholder="Nombre" value="<?php echo $_SESSION["data_user"][2] . " " .
                                                                      $_SESSION["data_user"][3] . " " . $_SESSION["data_user"][4];  ?>" readonly />
                </div>
                <div class="mb-2">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control
                    form-control mt-1" placeholder="Email" value="<?php echo $_SESSION["data_user"][5];  ?>" readonly />
                </div>
                <div class="mb-2">
                  <label for="number">Telefono</label>
                  <input type="number" id="number" class="form-control
                    form-control mt-1" placeholder="Telefono" value="<?php echo $_SESSION["data_user"][6];  ?>" readonly />
                </div>
                <div class="mb-2">
                  <label for="user">Usuario</label>
                  <input type="text" id="user" class="form-control
                    form-control mt-1" placeholder="Usuario" value="<?php echo $_SESSION["data_user"][7];  ?>" readonly />
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
                    <input type="password" id="current-password" class="form-control form-control mt-1 w-50" placeholder="Contraseña actual" value="<?php echo $_SESSION["data_user"][8]; ?>" readonly />
                    <i class="bx bx-show my-auto"></i>
                    <button type="button" class="btn btn-link" onclick="showPassword()">
                      Ver
                    </button>
                  </div>
                </div>
                <form id="form-user">
                  <div class="mt-2 d-flex flex-wrap justify-content-around">
                    <div class="mt-2">
                      <label for="change-password">Cambiar contraseña</label>
                      <input type="password" name="change-password" id="change-password" class="form-control form-control mt-1" placeholder="Cambiar contraseña" required autofocus />
                    </div>
                    <div class="mt-2 ml-1">
                      <label for="confirm-password">Confirmar contraseña</label>
                      <input type="password" name="confirm-password" id="confirm-password" class="form-control form-control mt-1" placeholder="Confirmar contraseña" required />
                    </div>
                  </div>
                </form>
                <div id="box-confirmpass" class="col-md-12 w-100 d-flex flex-wrap justify-content-center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-3 d-flex justify-content-center">
        <button class="btn btn-primary bg-dark border-0" type="submit" form="form-user" id="submit">
          Actualizar datos
        </button>
      </div>
    </section>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="../js/my/index.js"></script>
</body>

</html>