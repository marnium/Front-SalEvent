function show_or_hide_password(id_button, id_input) {
   // Cambiar icono del button
   $(id_button).toggleClass('fa-eye-slash fa-eye');

   // Cambiar el tipo del input
   if ($(id_input).attr('type') == 'password')
      $(id_input).attr('type', 'text');
   else
      $(id_input).attr('type', 'password');
}

$(document).ready(function () {
   // Variables para contraseñas
   value_pass = null;
   value_confirm_pass = null;

   // Comprobación entrada en input id=confirmpassword
   $('#confirmpassword').on('input', function () {
      if (!value_pass) return;
      if (value_pass == $(this).val()) {
         $('#password, #confirmpassword').removeClass('error-password');
         if (document.getElementById('msg-error')) {
            $('#msg-error').remove();
         }
         $('#password, #confirmpassword').addClass('success-password');
      } else {
         $('#password, #confirmpassword').removeClass('success-password');
      }
   });
   $('#confirmpassword').change(function () {
      value_confirm_pass = $(this).val();
   });

   // Comprobación entrada en input id=password
   $('#password').on('input', function () {
      if (!value_confirm_pass) return;
      if (value_confirm_pass == $(this).val()) {
         $('#password, #confirmpassword').removeClass('error-password');
         if (document.getElementById('msg-error')) {
            $('#msg-error').remove();
         }
         $('#password, #confirmpassword').addClass('success-password');
      } else {
         $('#password, #confirmpassword').removeClass('success-password');
      }
   });
   $('#password').change(function () {
      value_pass = $(this).val();
   });

   // Validación de contraseña antes de enviar el formulario
   $('#form-register').submit(function () {
      if (value_pass != value_confirm_pass) {
         $('#password, #confirmpassword').addClass('error-password');
         if (!document.getElementById('msg-error')) {
            $('#box-confirmpass').append('<p id="msg-error" class="mb-0 mt-2 text-danger"><small>¡Error! Las contraseñas no coinciden</small></p>');
         }
         return false;
      }
      return true;
   });
});