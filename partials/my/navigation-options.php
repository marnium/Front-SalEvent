<?php
  if(isset($_POST['closeSession'])){
    session_destroy();
    //header("Location: /home/");
    echo '<script>window.location.href="/home/";</script>';
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container logo">
      <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#nav-left">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/my/">
      <img src="../../img/home/logo.png" class="fas fa-link" height="50px"> SallEvent</a>

      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <form action="" method="POST">
          <button type="submit" class="nav-link bg-dark text-white border-0" name="closeSession">
            Cerrar sesion
          </button>
        </form>
      </li>
      </ul>
  </div>
</nav>
