var vm = new Vue({
   el: "#app",
   data: {
      data_salon: data_salon,
      data_customers: data_customers,
      modal_customer: {
         id_user: 1,
         user_user: '',
         name_user: '',
         pa_lastname_user: '',
         mo_lastname_user: '',
         email_user: '',
         phone_user: '',
         password_user: ''
      },
      is_disable_btn_modal: true,
      is_modal_create: true,
      index_modal_customer: 0
   },
   methods: {
      modify_customer: function(index_customer) {
         this.is_disable_btn_modal = true;
         this.is_modal_create = false;
         this.index_modal_customer = index_customer;
         $('#box-modify-customer').modal({backdrop: 'static', keyboard: false});
      },
      active_btn_modal: function() {
         for (const key in this.modal_customer) {
            if(!this.modal_customer[key]) {
               console.log(key, ' esta vacío');
               return false;
            }
         }
         this.is_disable_btn_modal = false;
      },
      create_or_update_customer: function() {
         if(this.is_disable_btn_modal) return;
         if(!this.index_modal_customer) {
            this.create_customer();
         } else {
            this.update_customer();
         }
      },
      update_customer: function() {
         $.post('../ajax/admin/updateUser.php', {
            'data_user': JSON.stringify(this.modal_customer)
         },
         function(data, status){
            if(status == 'success') {
               if(JSON.parse(data).status) {
                  Vue.set(vm.data_customers, vm.index_customer,
                     JSON.parse(JSON.stringify(vm.modal_customer)))
                  create_notification('<strong>Exitoso</strong>: Se actualizo correctamente la información de '
                     + vm.modal_customer.user_user, 'alert-sucess');
               }
            } else {
               create_notification('<strong>Error</strong>: No se pudo actualizar la información de '
               + vm.modal_customer.user_user, 'alert-danger');
            }
            $('#box-modify-customer').modal("hide");
         }
      );
      },
      remove_customer: function(index_customer) {
         $.post('../ajax/admin/deleteUser.php',
            {id_user: this.data_customers[index_customer].id_user},
            function(data, status){
               if(status == 'success') {
                  let data_parse = JSON.parse(data);
                  if(data_parse.status) {
                     create_notification('<strong>Exisitoso</strong>: Se elimino correctamente al usuario '+
                     vm.data_customers[index_customer].user_user, 'alert-success');
                     vm.data_customers.splice(index_customer, 1);
                     return;
                  }
               }
               create_notification('<strong>Error</strong>: No se pudo eliminar al usuario '+
                  vm.data_customers[index_customer], 'alert-danger');
            }
         );
      },
      fill_customer: function() {
         this.is_disable_btn_modal = true;
         this.is_modal_create = true;
         $('#box-modify-customer').modal({backdrop: 'static', keyboard: false});
      },
      create_customer: function() {
         $.post('../ajax/admin/createUser.php', {
               data_user: JSON.stringify(this.modal_customer)
            },
            function(data, status){
               if(status == 'success') {
                  let parse_data = JSON.parse(data);
                  if(parse_data.status) {
                     $('#box-modify-customer').modal("hide");
                     create_notification('Se registro el usuario ' + vm.modal_customer.user_user,
                     'alert-success');
                     return;
                  } else if(parse_data.type == 'user_already_exists') {
                     $('#box-modify-customer div.modal-body > div:first-child').after(
                     '<p class="text-danger">Este usuario ya existe, especifique otro usuario</p>');
                     return
                  }
               }
               $('#box-modify-customer div.modal-body > div:first-child').after(
                  '<p class="text-danger">Error yo se pudo registrar el usuario, vuelva a intentarlo</p>');
            }
         );
      },
      update_salon: function() {
         $.post('../ajax/admin/createOrUpdateRoom.php', {
            "data-salon": JSON.stringify(vm.data_salon)
         },
         function(data, status) {
            if (status == 'success') {
               let parse_data = JSON.parse(data);
               if (parse_data['status']) {
                  let status_msg = 'actualizó correctamente la información del salón de eventos';
                  if (parse_data['action'] == 'create') {
                     vm.data_salon.t_room.id_saloon = parse_data.t_room;
                     vm.data_salon.t_room.id_info = parse_data.t_info;
                     vm.data_salon.t_direction.id_direction = parse_data.t_direction;
                     vm.data_salon.t_schedule.id_schedule = parse_data.t_schedule;
                     status_msg = 'registro correctamente el salón de eventos';
                  }
                  create_notification('<strong>Exitoso</strong> Se ' + status_msg, 'alert-success');
               } else {
                  let status_msg = 'actualizar correctamente la información del salón de eventos\nError al actualizar datos en la tabla ' +
                     parse_data['in_table'];
                  if (parse_data['action'] == 'create')
                     status_msg = 'registrar correctamente el salón de eventos\nError al registrar datos en la tabla' +
                     parse_data['in_table'];
                  create_notification('<strong>Error</strong>: No se pudo ' + status_msg, 'alert-danger');
               }
            }
         }
         );
      },
   },
   computed: {
      modal_data: function() {
         if(this.is_modal_create) {
            this.modal_customer = {
               id_user: 0,
               user_user: '',
               name_user: '',
               pa_lastname_user: '',
               mo_lastname_user: '',
               email_user: '',
               phone_user: '',
               password_user: ''
            };
            return {
               title: "Agregue los datos para el ",
               strong: 'nuevo usuario',
               text_btn: "Crear usuario",
               style_user: {display: 'flex'}
            }
         }
         this.modal_customer = JSON.parse(JSON.stringify(
            this.data_customers[this.index_modal_customer]));
         return {
            title: "Modificar información de ",
            strong: this.modal_customer.user_user,
            text_btn: "Actualizar",
            style_user: {display: 'none'}
         }
      }
   }
});

var id_page_current = '#customers';
var id_option_current = '#opt-customers';
var c_date = new Date();

$(document).ready(function() {
   $('.list-group span').on('click', function() {
      $('.navbar-toggler').click();
   });

   $(id_page_current).css('display', 'block');
   $(id_option_current).addClass('option-selected');

   $('#customers > h4').text(c_date.getDate() + '/' + (c_date.getMonth() + 1) +
      '/' + c_date.getFullYear());
   $('#search-customers').on('input', function() {
      if ($(this).val()) {
         $.post('../ajax/admin/selectUserForUser.php', {
               user: $(this).val()
            },
            function(data, status) {
               if (status == 'success') {
                  let parse_data = JSON.parse(data);
                  if (parse_data.value) {
                     vm.data_customers = parse_data.data_customers;
                  } else {
                     vm.data_customers = [];
                  }
               }
            }
         );
      }
   });
});

function load_page(id_page) {
   if (active_option(id_page)) {
      show_page(id_page);
   }
}

function active_option(id_page) {
   if ($('#opt-' + id_page).attr('class').lastIndexOf('option-selected') != -1) return false;

   if (id_option_current) {
      $(id_option_current).removeClass('option-selected');
   }

   id_option_current = '#opt-' + id_page;
   $(id_option_current).addClass('option-selected');

   return true;
}

function show_page(id_page) {
   if (id_page_current) {
      $(id_page_current).css('display', 'none');
   }

   id_page_current = '#' + id_page;
   $(id_page_current).css('display', 'block');
}

function create_notification(message, type_notification) {
   $('#customers').before('<div class="alert '+ type_notification +
      ' alert-dismissible fade show text-center" role="alert">'+ message +
      '<button type="button" class="close" data-dismiss="alert" aria-label="close">'+
      '<span aria-hidden="true">&times;</span></button>');
}

function show_or_hide_password(id_button, id_input) {
   $(id_button).toggleClass('fa-eye-slash fa-eye');

   if ($(id_input).attr('type') == 'password')
      $(id_input).attr('type', 'text');
   else
      $(id_input).attr('type', 'password');
}