<?php
  session_start();
  if(isset($_SESSION['data_user'])){
    header("Location: /my/");
  }
  if(isset($_SESSION['data_admin'])){
    header("Location: /admin/");
  }
if (isset($_POST['send'])) {
  require_once('../databaseOperations/operations.php');
  $user = $_POST['user'];
  $password = $_POST['password'];
  $operations = new OperationBD();
  $results = $operations->consultUser($user, $password);
  if (count($results > 0)) {
    switch ($results['type_user']) {
      case '0':
        $_SESSION['data_admin'] = array('id_user' => $results['id_user'], 'name_user' => $results['name_user']);
        //header('Location: /admin/');
        echo '<!DOCTYPE html><html><head><script>window.location.href="/admin/";</script></head><body></body></html>';
        exit();
        break;
      case '1':
        $_SESSION['data_user'] = array(
          $results['id_user'], $results['type_user'],
          $results['name_user'], $results['pa_lastname_user'], $results['mo_lastname_user'],
          $results['email_user'], $results['phone_user'], $results['user_user'],
          $results['password_user']
        );
        //header('Location: /my/');
        echo '<!DOCTYPE html><html><head><script>window.location.href="/my/";</script></head><body></body></html>';
        exit();
        break;
    }
  }
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
    <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
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
  <?php
    if(isset($_SESSION['message-register'])) {
      echo '<div class="alert alert-success alert-dismissible fade show">'.
        '<button type="button" class="close" data-dismiss="alert">&times;</button>'
        .$_SESSION['message-register'].'</div>';
      $_SESSION['message-register'] = null;
    }
  ?>
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
                <button type="submit" class="btn btn-lg btn-primary btn-block-4 mt-4 pr-4 pl-4 mb-4" 
                   name="send"
                >
                  Acceder
                </button>
                <div class="mt-4 pt-4 mb-4 pb-4"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
        include('../partials/home/footer.php');
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
