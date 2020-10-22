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
    if (value_pass != value_confirm_pass) {
      $("#change-password, #confirm-password").addClass("error-password");
      if (!document.getElementById("msg-error-successful")) {
        $("#box-confirmpass").append(
          '<p id="msg-error-successful" class="mb-0 mt-2 text-danger"><small>¡Error! Las contraseñas no coinciden</small></p>'
        );
      }
      return false;
    }
    updatePassword();
    if (!document.getElementById("msg-error-successful")) {
      $("#box-confirmpass").append(
        `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-success alert-dismissible fade show" role="alert">
                    <small>¡Hecho! Tu contraseña ha sido actualizada</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                </p>`
      );
    }
    $("#change-password, #confirm-password").removeClass("success-password");
    value_pass = null;
    value_confirm_pass = null;
    return false;
  });
});

function updatePassword() {
  var xmlhttp = new XMLHttpRequest();
  oldpassword = JSON.stringify(
    document.getElementById("current-password").value
  );
  newpassword = JSON.stringify(
    document.getElementById("confirm-password").value
  );

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var myObj = JSON.parse(this.responseText);
      document.getElementById("current-password").value = myObj;
      document.getElementById("change-password").value = "";
      document.getElementById("confirm-password").value = "";
    }
  };

  xmlhttp.open("POST", "../ajax/my/updatePassword.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("newpassword=" + newpassword + "&oldpassword=" + oldpassword);
}
