<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Contacto</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <style>
      .bg-cont {
         background: rgba(172, 169, 169, 0.4);
      }
      #img {
         height: auto;
         border-radius: 25px 25px 0 0;
      }
      #cont-info {
         position: absolute;
         top: 0;
         left: 0;
         border-radius: 25px 25px 0 0;
      }
      #cont-form {
         width: 100%;
         position: absolute;
         top: 70%;
         left: 0;
         border-radius: 0 0 15px 15px;
      }
      #bx-form {
         border-radius: 0 0 15px 15px;
      }
      #form-contact > div.form-group > input[id] {
         border: none;
         border-bottom: 2px solid white;
         color: white;
         outline: none;
      }
      .input {
         position: relative;
      }
      .input .animation-focus {
         width: 100%;
         position: absolute;
         bottom: 2px;
      }
      .input .animation-focus > div {
         width: 0;
         height: auto;
         position: absolute;
         transition: width 0.5s linear;
      }
      .animation-focus .left {
         right: 50%;
      }
      .animation-focus .right {
         left: 50%;
      }
      .input input[name]:focus + .animation-focus > div {
         width: 50%;
         border-bottom: 2px solid #ffc107;
      }

      @media screen and (min-width: 992px) {
         #img {
            border-radius: 25px;
         }
         #cont-info {
            width: 50%;
            border-radius: 25px 0 0  25px;
         }
         #cont-form {
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 0 25px 25px 0;
         }
         #bx-form {
            border-radius: 15px;
         }
      }
   </style>
</head>
<body>
<?php
   include('../partials/home/navigation.html');
?>
   <main class="container h-auto">
      <section class="w-100" style="position: relative;">
         <article class="w-100 text-white" style="position: relative; background-color: white;">
            <img id="img" src="../img/contact/contact.png" alt="Escritorio" class="w-100" />
            <div id="cont-info" class="h-100 bg-cont px-2 pt-2 px-sm-3 pt-lg-5">
               <h3 class="text-center font-weight-bold">Contactanos</h3>
               <p class="text-justify px-lg-3" style="line-height: 1.3;">¿Tienes ganas de contactarnos? Envíenos sus consultas aquí y nos pondremos en contacto con usted lo antes posible</p>
            </div>
         </article>
         <article id="cont-form" class="bg-cont px-lg-3">
            <div id="bx-form" class="bg-dark text-white px-2 py-3 p-sm-3 pt-lg-5">
               <form action="" id="form-contact">
                  <div class="form-group input">
                     <label for="full_name">Nombre completo:</label>
                     <input type="text" name="full_name" id="full_name" class="w-100 bg-dark" required autofocus />
                     <div class="animation-focus">
                        <div class="left"></div><div class="right"></div>
                     </div>
                  </div>
                  <div class="form-group input">
                     <label for="email">E-mail:</label>
                     <input type="email" name="email" id="email" class="w-100 bg-dark" required />
                     <div class="animation-focus">
                        <div class="left"></div><div class="right"></div>
                     </div>
                  </div>
                  <div class="form-group input">
                     <label for="telphone">Teléfono/Cel:</label>
                     <input type="tel" name="telphone" id="telphone" class="w-100 bg-dark" required />
                     <div class="animation-focus">
                        <div class="left"></div><div class="right"></div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="msg">Mensaje:</label>
                     <textarea name="msg" id="msg" cols="30" rows="5" class="form-control bg-dark" style="color: white; resize: none;" required></textarea>
                  </div>
                  <input type="submit" value="Envía un mensaje" class="btn btn-warning btn-block text-white" />
               </form>
            </div>
         </article>
      </section>
   </main>
<?php
   include('../partials/home/footer.html');
?>
</body>
</html>