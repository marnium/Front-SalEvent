function showPassword() {
  var typeinput = document.getElementById("current-password");
  if (typeinput.type == "password") {
    typeinput.type = "text";
  } else {
    typeinput.type = "password";
  }
}

$(document).ready(function () {
  // Variables para contraseñas
  value_pass = null;
  value_confirm_pass = null;

  // Comprobación entrada en input id=confirmpassword
  $("#confirm-password").on("input", function () {
    if (!value_pass) return;
    if (value_pass == $(this).val()) {
      $("#change-password, #confirm-password").removeClass("error-password");
      if (document.getElementById("msg-error-successful")) {
        $("#msg-error-successful").remove();
      }
      $("#change-password, #confirm-password").addClass("success-password");
    } else {
      $("#change-password, #confirm-password").removeClass("success-password");
    }
  });
  $("#confirm-password").change(function () {
    value_confirm_pass = $(this).val();
  });

  // Comprobación entrada en input id=password
  $("#change-password").on("input", function () {
    if (!value_confirm_pass) return;
    if (value_confirm_pass == $(this).val()) {
      $("#change-password, #confirm-password").removeClass("error-password");
      if (document.getElementById("msg-error-successful")) {
        $("#msg-error-successful").remove();
      }
      $("#change-password, #confirm-password").addClass("success-password");
    } else {
      $("#change-password, #confirm-password").removeClass("success-password");
    }
  });
  $("#change-password").change(function () {
    value_pass = $(this).val();
  });

  // Validación de contraseña antes de enviar el formulario
  $("#form-user").submit(function () {
    if (value_pass==null | value_pass=="") {
      $("#box-confirmpass").append(
        `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                Rellene los campos
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
          </p>`
      );
    } else {
      if (value_pass != value_confirm_pass) {
        $("#change-password, #confirm-password").addClass("error-password");
        if (!document.getElementById("msg-error-successful")) {
          $("#box-confirmpass").append(
            '<p id="msg-error-successful" class="mb-0 mt-2 text-danger">¡Error! Las contraseñas no coinciden</p>'
          );
        }
      } else {
        $.ajax({
          data: {
            "oldpassword": JSON.stringify($("#current-password").val()),
            "newpassword": JSON.stringify($("#confirm-password").val())
          },
          type: "post",
          dataType: "json",
          url: "../ajax/my/updatePassword.php",
        })
          .done(function (data, textStatus, jqXHR) {
            $("#current-password").val(data);
            $("#change-password").val("");
            $("#confirm-password").val("");

            if (!document.getElementById("msg-error-successful")) {
              $("#box-confirmpass").append(
                `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-success alert-dismissible fade show" role="alert">
                        ¡Hecho! Tu contraseña ha sido actualizada
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
              );
            }
            $("#change-password, #confirm-password").removeClass("success-password");
            value_pass = null;
            value_confirm_pass = null;
          })
          .fail(function (jqXHR, textStatus, errorThrown) {
            $("#change-password").val("");
            $("#confirm-password").val("");

            if (!document.getElementById("msg-error-successful")) {
              $("#box-confirmpass").append(
                `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                        ¡Upps! Tu contraseña no ha sido actualizada
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
              );
            }
            $("#change-password, #confirm-password").removeClass("success-password");
            value_pass = null;
            value_confirm_pass = null;
          });
      }
    }
    return false;
  });
});
