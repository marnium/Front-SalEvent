<?php
session_start();
  if(isset($_SESSION['data_user'])){
    header("Location: /my/");
  }
  if(isset($_SESSION['data_admin'])){
    header("Location: /admin/");
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
  <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
  <title>Registrarme</title>
  <link rel="stylesheet" href="../css/register.css" />
</head>

<body>
  <?php
  include('../partials/home/navigation.html');
  ?>
  <main class="container p-4 mt-2">
  <?php
    if(isset($_POST['user'], $_POST['password'], $_POST['name'], $_POST['pa_lastname'],
      $_POST['mo_lastname'], $_POST['email'], $_POST['phone'])) {
      require_once('../databaseOperations/operations.php');
      $operationDB = new OperationBD();
      $response = $operationDB->create_user($_POST['name'],$_POST['pa_lastname'],$_POST['mo_lastname'],
      $_POST['email'],$_POST['phone'],$_POST['user'],$_POST['password']);

      if(!$response['status']) {
        $message_error = 'El usuario '.htmlspecialchars($_POST['user']).' ya existe, especifique otro usuario';
        if($response['type'] == 'error') {
          $message_error = 'Ocurrió un error al registrarte '.htmlspecialchars($_POST['name']).'. Por favor vuelve a intentarlo.';
        }
        echo '<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">'.
          "<strong>Error</strong>: $message_error".
          '<button type="button" class="close" data-dismiss="alert" aria-label="close">'.
          '<span aria-hidden="true">&times;</span></button></div>';
      } else {
        $_SESSION['message-register'] = "¡Felicidades! ".htmlspecialchars($_POST['name']).
          ", has sido registrado exitosamente. Por favor inicia sesión";
        header('Location: /login/');
      }
    }
  ?>
    <section class="mb-3 card no-gutters flex-md-row">
      <article class="col-md-4 img-background">
        <h2 class="text-white text-center">Unete a nuestra comunidad</h2>
      </article>
      <article class="col-md-8">
        <div class="card-body">
          <form action="" method="post" id="form-register">
            <h1 class="mb-3 font-weight-normal text-center pt-4 mt-4">Registrarme</h1>
            <div class="pt-4">
              <label for="name" class="sr-only">Nombre</label>
              <input type="text" name="name" id="name" class="form-control mt-2" placeholder="Nombre" required autofocus />
            </div>
            <div class="w-100 d-flex flex-wrap">
              <div class="mt-4 px-0 col-lg-6 pr-lg-1">
                <label for="pa_lastname" class="sr-only">Apellido paterno</label>
                <input type="text" name="pa_lastname" id="pa_lastname" class="form-control" placeholder="Apellido paterno" required />
              </div>
              <div class="mt-4 px-0 col-lg-6 pl-lg-1">
                <label for="mo_lastname" class="sr-only">Apellidoo materno</label>
                <input type="text" name="mo_lastname" id="mo_lastname" class="form-control" placeholder="Apellido materno" required />
              </div>
            </div>
            <div class="mt-4">
              <label for="user" class="sr-only">Usuario</label>
              <input type="text" name="user" id="user" class="form-control" placeholder="Usuario" required />
            </div>
            <div class="w-100 d-flex flex-wrap">
              <div class="mt-4 px-0 col-lg-6 pr-lg-1">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
              </div>
              <div class="mt-4 px-0 col-lg-6 pl-lg-1">
                <label for="phone" class="sr-only">Teléfono</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Teléfono" required />
              </div>
            </div>
            <div class="mt-4">
              <label for="password" class="sr-only">Contraseña</label>
              <div class="d-flex flex-column flex-sm-row">
                <input id="password" type="password" name="password" class="form-control mr-sm-1 mr-md-2" placeholder="Contraseña" required />
                <i id="b-pass" class="fas fa-eye fa-lg icon-password" onclick="show_or_hide_password('#b-pass', '#password')"></i>
              </div>
            </div>
            <div id="box-confirmpass" class="pb-4 mt-4">
              <label for="confirmpassword" class="sr-only">Confirmar constraseña</label>
              <div class="d-flex flex-column flex-sm-row">
                <input type="password" id="confirmpassword" class="form-control mr-sm-1 mr-md-2" placeholder="Confirmar contraseña" required />
                <i id="b-conf-pass" class="fas fa-eye fa-lg icon-password" onclick="show_or_hide_password('#b-conf-pass', '#confirmpassword')"></i>
              </div>
            </div>
            <div class="w-100 mt-4">
              <input type="submit" class="btn btn-lg btn-primary d-block px-4 mx-auto" value="Registrarme" />
            </div>
          </form>
        </div>
      </article>
    </section>
  </main>
  <?php
  include('../partials/home/footer.php');
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="../js/register.js"></script>
  <?php
    if(isset($response) && !$response['status']) {
      echo '<script>$(document).ready(function(){$("#name").val("'.addslashes($_POST['name']).'");'.
        '$("#pa_lastname").val("'.addslashes($_POST['pa_lastname']).'");'.
        '$("#mo_lastname").val("'.addslashes($_POST['mo_lastname']).'");'.
        '$("#user").val("'.addslashes($_POST['user']).'");'.
        '$("#email").val("'.addslashes($_POST['email']).'");'.
        '$("#phone").val("'.addslashes($_POST['phone']).'");});</script>';
    }
  ?>
</body>

</html>