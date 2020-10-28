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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles-home.css">
    <title>SallEvent</title>
    <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
</head>
<body>
<?php
    include('../partials/home/navigation.html');
?>
<section id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../img/home/content-carousel/img-1.jpg" 
        class="img-responsive d-block w-100" alt="..." height="500px">
      <div class="carousel-caption d-none d-md-block">
        <h5>Espacioso y cómodo</h5>
        <p>¡Nuestro lobby extremadamente versátil es muy útil para cualquier fiesta!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../img/home/content-carousel/img-2.jpg" 
        class="d-block w-100" alt="..." height="500px">
      <div class="carousel-caption d-none d-md-block">
        <h5>Agrega nuestro lobby a cualquier evento</h5>
        <p>¡Cree una atmósfera profesional en el instante en que lleguen sus invitados!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../img/home/content-carousel/img-3.jpg" 
        class="d-block w-100" alt="..." height="500px">
      <div class="carousel-caption d-none d-md-block">
        <h5>¡Somos el lugar perfecto para tu fiesta!</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../img/home/content-carousel/img-4.jpg" 
        class="d-block w-100" alt="..." height="500px">
      <div class="carousel-caption d-none d-md-block">
        <h5>¡Alquile nuestro hermoso lugar para su ocasión especial!</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../img/home/content-carousel/img-5.jpg" 
        class="d-block w-100" alt="..." height="500px">
      <div class="carousel-caption d-none d-md-block">
        <h5>¡Impresione a sus clientes con una presentación profesional!</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../img/home/content-carousel/img-6.jpg" 
        class="d-block w-100" alt="..." height="500px">
      <div class="carousel-caption d-none d-md-block">
        <h5>¡Contamos con salas grandes y salas de reuniones pequeñas para reuniones de cualquier tamaño, reuniones corporativas, talleres, conferencias y eventos comunitarios!</h5>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</section>
<section class="container-fluid p-4">

  <div class="row p-2 d-flex justify-content-between">
    <div class="col-md-4">
      <img src="../img/home/content-down/img-webiste.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-6">
        <p class="border-top border-left border-bottom p-2 text-justify">
          Preparamos banquetes y ofrecemos nuestros servicios para encantar a todos los comensales y clientes.
          Siempre compartiendo juntos grandes experiencias, Pará cualquier ocasión; desde una boda, aniversario, fiesta de cumpleaños... hasta una reunión corporativa,
          taller, conferencia, evento comunitario o reunión de clase, ¡nuestro espacio para eventos y lugar para fiestas seguramente lo complacerá!
        </p>
    </div>
  </div>

  <div class="row p-2 d-flex justify-content-between">
    
    <div class="col-md-6">
        <p class="border-top border-left border-bottom p-2 text-justify">
          Festeja navidad y Año Nuevo con un menú que te va a encantar.
          Tenemos contacto con los mejores chef o cocineros de la región los cuales te ofrecen un extenso menú con distintos platillos para tus momentos especiales.
          Todos los platillos incluyen entradas, plato fuerte y un extenso menú de postres para que puedas disfrutar no solo de un ambiente rico sino de un sabor que hará tus eventos aún más deliciosos.
        </p>
    </div>
    <div class="col-md-4">
      <img src="../img/home/content-down/img-event-catering.jpg" class="card-img" alt="...">
    </div>
  </div>
  
  <div class="row p-2 d-flex justify-content-between">
    <div class="col-md-4">
      <img src="../img/home/content-down/img-wedding-guests.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-6">
        <p class="border-top border-left border-bottom p-2 text-justify">
          Celebra con nosotros esa ocasión especial, contamos con meseros y un extenso menú de cubiertos y
          accesorios para que te sientas lo más cómodo y pases un rato muy agradable.
          El personal estará pendiente y a la orden en todo momento para que no descuides a tus invitados y
          captures esos momentos especiales.
        </p>
    </div>
  </div>

  <div class="row p-2 d-flex justify-content-between">
    
    <div class="col-md-6">
        <p class="border-top border-left border-bottom p-2 text-justify">¿Te gustaría animar tu evento?, tenemos contacto cercano con grupos de la región,
          así como dj profesionales y cronistas de eventos de todo tipo, que garantizan un servicio 100% confiable y amigable. Los precios son muy accesibles
          ya que tenemos un convenio con ellos y puedas tener una diversión garantizada. El servicio incluye equipo profesional de sonido, iluminación profesional
          hasta por 5 horas o lo que dure tu evento si tú lo deseas que harán esos momentos inolvidables.
        </p>
    </div>
    <div class="col-md-4">
      <img src="../img/home/content-down/img-event-live-band.jpeg" class="card-img" alt="...">
    </div>
  </div>

</section>
<?php
    include('../partials/home/footer.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>   
</body>
</html>