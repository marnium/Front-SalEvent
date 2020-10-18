<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <title>Registro</title>
    <link rel="stylesheet" href="../css/register.css" />
  </head>
  <body>
    <?php
        include('../partials/home/navigation.html');
    ?>
    <main class="container p-4 mt-2">
      <section class="card mb-3">
        <article class="row no-gutters">
          <div class="col-md-4 img-background">
            <h2 class="text-white text-center">Unete a nuestra comunidad</h2>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <form action="" method="post" class="form-signin" id="form-register">
                <h1 class="mb-3 font-weight-normal pt-4 mt-4">Registrarme</h1>
                <div class="pt-4">
                  <label for="user" class="sr-only">Usuario</label>
                  <input type="text" name="user" id="user" class="form-control mt-2" placeholder="Usuario" required autofocus/>
                </div>
                <div>
                  <label for="email" class="sr-only">Email</label>
                  <input type="email" name="email" id="email" class="form-control mt-4" placeholder="Email" required/>
                </div>
                <div>
                  <label for="password" class="sr-only">Contraseña</label>
                  <div class="d-flex flex-column flex-sm-row mt-4">
                    <input id="password" type="password" name="password" class="form-control mr-sm-1 mr-md-2" placeholder="Contraseña" required/>
                    <i id="b-pass" class="fas fa-eye fa-lg icon-password" onclick="show_or_hide_password('#b-pass', '#password')"></i>
                  </div>
                </div>
                <div id="box-confirmpass" class="pb-4">
                  <label for="confirmpassword" class="sr-only">Confirmar constraseña</label>
                  <div class="d-flex flex-column mt-4 flex-sm-row">
                    <input type="password" id="confirmpassword" class="form-control mr-sm-1 mr-md-2" placeholder="Confirmar contraseña" required/>
                    <i id="b-conf-pass" class="fas fa-eye fa-lg icon-password" onclick="show_or_hide_password('#b-conf-pass', '#confirmpassword')"></i>
                  </div>
                </div>
                <input type="submit" class="btn btn-lg btn-primary btn-block-4 mt-4 px-4" value="Registrarme" />
              </form>
            </div>
          </div>
        </article>
      </section>
    </main>
    <?php
      include('../partials/home/footer.html');
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"></script>
    <script src="../js/register.js"></script>
  </body>
</html>