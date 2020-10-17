<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Registro</title>
    <style>
      body {
        background: url("../img/login/background.png");
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        object-fit: contain;
      }
      .img-background {
        background: url("../img/login/login.png");
        background-size: cover;
        background-repeat: no-repeat;
        object-fit: contain;
      }
      @media screen and (max-width: 700px){
        .card-body{ padding-top: 0; }
      }
      .error-password {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
        border: 1px solid red;
      }
      .error-password:focus {
        outline: none;
        border: 1px solid red;
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
      }
      .success-password {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.4);
        border: 1px solid green;
      }
      .success-password:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.4);
        border: 1px solid green;
      }
      .icon-password {
        line-height: 1.5;
        cursor: pointer;
      }
    </style>
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
                  <input type="text" name="user" id="user" class="form-control mt-2"
                    placeholder="Usuario" required autofocus
                  />
                </div>
                <div>
                  <label for="email" class="sr-only">Email</label>
                  <input type="email" name="email" id="email" class="form-control mt-4"
                    placeholder="Email" required
                  />
                </div>
                <div>
                  <label for="password" class="sr-only">Contraseña</label>
                  <div class="d-flex flex-column flex-sm-row mt-4">
                    <input type="password" name="password" id="password" class="form-control mr-sm-1 mr-md-2"
                      placeholder="Contraseña" required
                    />
                    <i class="fas fa-eye fa-lg icon-password" id="b-pass" onclick="show_or_hide_password('#b-pass', '#password')"></i>
                  </div>
                </div>
                <div class="pb-4">
                  <label for="confirmpassword" class="sr-only">Confirmar constraseña</label>
                  <div class="d-flex flex-column mt-4 flex-sm-row">
                    <input type="password" id="confirmpassword" class="form-control mr-sm-1 mr-md-2"
                      placeholder="Confirmar contraseña" required
                    />
                    <i class="fas fa-eye fa-lg icon-password" id="b-conf-pass" onclick="show_or_hide_password('#b-conf-pass', '#confirmpassword')"></i>
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
    <script>
      function show_or_hide_password(id_button, id_input) {
        //Cambiar icono en button
        $(id_button).toggleClass('fa-eye-slash fa-eye');

        if ($(id_input).attr('type') == 'password')
          $(id_input).attr('type', 'text');
        else
          $(id_input).attr('type', 'password');
      }
      $(document).ready(function() {
        // Comprobación de las contraseñas
        $('#confirmpassword').on('input', function(){
          if(RegExp('^'+$(this).val()).test($('#password').val())) {
            $('#password, #confirmpassword').removeClass('error-password');
            $('#password, #confirmpassword').addClass('success-password');
          } else {
            $('#password, #confirmpassword').removeClass('success-password');
            $('#password, #confirmpassword').addClass('error-password');
          }
        });
        $('#confirmpassword').change(function(){
          if($(this).val() != $('#password').val()) {
            $('#password, #confirmpassword').removeClass('success-password');
            $('#password, #confirmpassword').addClass('error-password');
          }
        });

        // Validación de la contraseña del formulario
        $('#form-register').submit(function(){
          if($('#password').val() != $('#confirmpassword').val()) {
            $('main.container').prepend('<article id="error-pass" class="alert alert-danger alert-dismissible fade show">'+
              '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
              '<strong>¡Error!</strong> Las constraseñas no coinciden</article>');
            return false;
          }
          return true;
        });
      });
    </script>
  </body>
</html>
