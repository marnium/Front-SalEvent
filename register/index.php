<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
  <title>Registrarme</title>
  <link rel="stylesheet" href="../css/register.css" />
</head>

<body>
  <?php
  include('../partials/home/navigation.html');
  ?>
  <main class="container p-4 mt-2">
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
  include('../partials/home/footer.html');
  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="../js/register.js"></script>
</body>

</html>