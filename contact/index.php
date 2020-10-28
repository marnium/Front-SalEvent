<?php
session_start();
if (isset($_SESSION['data_user'])) {
   header("Location: /my/");
}
if (isset($_SESSION['data_admin'])) {
   header("Location: /admin/");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Contacto</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <link rel="shortcut icon" type="image/png" href="/img/favicon/favicon.png"/>
   <style>
      main>section {
         background: black url("../img/contact/contact.png") no-repeat scroll;
         background-size: cover;
      }

      .bg-contact {
         background: rgba(172, 169, 169, 0.4);
      }

      .border-radius-contact {
         border-radius: 25px 25px 15px 15px;
      }

      #container-form {
         border-radius: 0 0 15px 15px;
      }

      #form-contact>div.form-group>input[id] {
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

      .input .animation-focus>div {
         width: 0;
         height: auto;
         position: absolute;
         transition: width 0.4s linear;
      }

      .animation-focus .left {
         right: 50%;
      }

      .animation-focus .right {
         left: 50%;
      }

      .input input[name]:focus+.animation-focus>div {
         width: 50%;
         border-bottom: 2px solid #ffc107;
      }

      @media (min-width: 992px) {
         .border-radius-contact {
            border-radius: 25px;
         }

         #container-form {
            border-radius: 15px;
         }
      }
   </style>
</head>

<body>
   <?php
   include('../partials/home/navigation.html');
   ?>
   <main class="container py-2">
      <section class="w-100 border-radius-contact">
         <div class="w-100 d-flex flex-wrap bg-contact border-radius-contact text-white px-lg-3">
            <article class="mb-5 px-2 pt-4 px-sm-3 col-lg-6 pr-lg-5 pt-lg-5">
               <h3 class="text-center font-weight-bold">Contactanos</h3>
               <p class="text-justify px-lg-3" style="line-height: 1.3;">¿Tienes ganas de contactarnos? Envíenos sus consultas aquí y nos pondremos en contacto con usted lo antes posible</p>
            </article>
            <article id="container-form" class="bg-dark px-2 py-3 p-sm-3 col-lg-6 my-lg-5">
               <div id="box-confirmpass" class="col-md-12 pb-lg-5 w-100 d-flex flex-wrap justify-content-center"></div>
               <form method="POST" id="form-contact">
                  <div class="form-group input">
                     <label for="full_name">Nombre completo:</label>
                     <input type="text" name="full_name" id="full_name" class="w-100 bg-dark" required autofocus />
                     <div class="animation-focus">
                        <div class="left"></div>
                        <div class="right"></div>
                     </div>
                  </div>
                  <div class="form-group input">
                     <label for="email">E-mail:</label>
                     <input type="email" name="email" id="email" class="w-100 bg-dark" required />
                     <div class="animation-focus">
                        <div class="left"></div>
                        <div class="right"></div>
                     </div>
                  </div>
                  <div class="form-group input">
                     <label for="telphone">Teléfono/Cel:</label>
                     <input type="tel" name="telphone" id="telphone" class="w-100 bg-dark" required />
                     <div class="animation-focus">
                        <div class="left"></div>
                        <div class="right"></div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="msg">Mensaje:</label>
                     <textarea name="msg" id="msg" cols="30" rows="5" class="form-control bg-dark" style="color: white; resize: none;" required></textarea>
                  </div>
                  <input type="submit" value="Envía un mensaje" class="btn btn-warning btn-block text-white" />
               </form>
            </article>
         </div>
      </section>
   </main>
   <?php
   include('../partials/home/footer.php');
   ?>

   <script>
      function validateData() {
         var regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/
         if ($("#full_name").val().replace(" ", "").trim() === "" ||
            $("#email").val().replace(" ", "").trim() === "" ||
            $("#telphone").val().replace(" ", "").trim() === "" ||
            $("#msg").val().replace(" ", "").trim() === "") {
            return false;
         }
         if ((!regexEmail.test($("#email").val())) || ($("#full_name").val().length)<5) {
            return false;
         }
         if (isNaN($("#telphone").val())) {
            return false;
         } else {
            if ((($("#telphone").val().length) < 10)) {
               return false;
            }
         }
         return true;
      }

      function showMessage(messague) {
         if (!document.getElementById("msg-error-successful")) {
            $("#box-confirmpass").append(
               `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-success alert-dismissible fade show text-center" role="alert">
                        ` + messague + `
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
            );
            $('html, body').animate({
               scrollTop: $("#box-confirmpass").offset().top - 100
            }, 500);
         }
      }
      $(document).ready(function() {
         $("#form-contact").submit(function() {
            if (document.getElementById('msg-error-successful')) {
               $('#msg-error-successful').remove();
            }
            if (!validateData()) {
               showMessage("Corrija o rellene todos los campos");
            } else {
               
               $.ajax({
                     data: {
                        "fullName": JSON.stringify($("#full_name").val()),
                        "email": JSON.stringify($("#email").val()),
                        "telphone": JSON.stringify($("#telphone").val()),
                        "msg": JSON.stringify($("#msg").val())
                     },
                     type: "post",
                     dataType: "json",
                     url: "../ajax/sendMessageContac.php",
                  })
                  .done(function(data, textStatus, jqXHR) {

                     if (!document.getElementById("msg-error-successful")) {
                        $("#box-confirmpass").append(
                           `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-success alert-dismissible fade show" role="alert">
                        Se ha enviado tu mensaje
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
                        );
                        $('html, body').animate({
                           scrollTop: $("#box-confirmpass").offset().top - 100
                        }, 500);
                     }
                     $("#full_name").val("");
                     $("#email").val("");
                     $("#telphone").val("");
                     $("#msg").val("");
                  })
                  .fail(function(jqXHR, textStatus, errorThrown) {

                     if (!document.getElementById("msg-error-successful")) {
                        $("#box-confirmpass").append(
                           `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                        <small>¡Upps! No se envio tu mensaje</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
                        );
                     }
                  });
            }
            return false;
         });
      });
   </script>
</body>

</html>