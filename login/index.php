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
    </style>
  </head>
  <body>
    <?php
        include('../partials/home/navigation.html');
    ?>
    <div class="container p-4 mt-2">
      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4 img-background">
            <h2 class="text-white text-center">Accede a nuestra comunidad</h2>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <form action="" method="POST">
                <h1 class="mb-3 font-weight-normal pt-4 mt-4">Acceder</h1>
                <div class="pt-4">
                  <label for="user" class="sr-only">Usuario</label>
                  <input type="text" id="user" 
                    class="form-control form-control mt-2" name="user" 
                    placeholder="Usuario" required autofocus
                  />
                </div>
                <div class="pt-2 pb-4">
                  <label for="inputPassword" class="sr-only">Password</label>
                  <input type="password" id="inputPassword" 
                    class="form-control form-control mt-4" name="password" 
                    placeholder="Contraseña" required
                  />
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block-4 mt-4 pr-4 pl-4" 
                   name="send"
                >
                  Acceder
                </button>
                <div class="mt-4 pt-4 mb-4 pb-4">
                  <a href="#" class="mt-4">Olvido su nombre o contraseña</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
        include('../partials/home/footer.html');
    ?>
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
