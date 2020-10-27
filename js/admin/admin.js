var vm = new Vue({
   el: "#app",
   data: {
      data_admin: data_admin,
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
      is_modal_update_admin: false,
      is_modal_create: true,
      index_modal_customer: 0,
      state_inputs_modal: {
         name_user: false,
         user_user: false,
         pa_lastname_user: false,
         mo_lastname_user: false,
         email_user: false,
         phone_user: false,
         password_user: false
      },
      user_already_exists: {
         state: false,
         value: ''
      },
      is_active_success_email: false,
      type_select_reservations: 'all',
      data_reservations: {
         confirmed: [],
         unconfirmed: []
      },
      total_reservations: total_reservations,
      data_services: data_services,
      modal_service: {
         id_service: 1,
         name_service: '',
         price: 0,
         detail: ''
      },
      is_modal_service_create: true,
      index_service: 0
   },
   methods: {
      modify_admin: function() {
         this.is_modal_create = false;
         this.is_modal_update_admin = true;
         this.restart_modal();
         $('#box-modify-customer').modal({
            backdrop: 'static',
            keyboard: false
         });
      },
      update_admin: function() {
         $.post('../ajax/admin/updateUser.php', {
               data_user: JSON.stringify(this.modal_customer)
            },
            function(data, status) {
               if (status == 'success') {
                  if (JSON.parse(data).status) {
                     vm.data_admin = JSON.parse(JSON.stringify(vm.modal_customer));
                     create_notification('<strong>Exitoso</strong>: Se actualizo correctamente tu información',
                        'alert-success', 'personal-information');
                     return;
                  }
               }
               create_notification('<strong>Error</strong>: No se pudo actualizar tu información',
                  'alert-danger', 'personal-information');
            }
         );
         $('#box-modify-customer').modal("hide");
      },
      modify_customer: function(index_customer) {
         this.is_modal_create = false;
         this.index_modal_customer = index_customer;
         this.is_modal_update_admin = false;
         this.restart_modal();
         $('#box-modify-customer').modal({
            backdrop: 'static',
            keyboard: false
         });
      },
      create_or_update_customer: function() {
         if (this.is_disable_btn_modal) return;
         if (this.is_modal_create) {
            this.create_customer();
         } else if(this.is_modal_update_admin) {
            this.update_admin();
         } else {
            this.update_customer();
         }
      },
      update_customer: function() {
         $.post('../ajax/admin/updateUser.php', {
               'data_user': JSON.stringify(this.modal_customer)
            },
            function(data, status) {
               if (status == 'success') {
                  if (JSON.parse(data).status) {
                     Vue.set(vm.data_customers, vm.index_modal_customer,
                        JSON.parse(JSON.stringify(vm.modal_customer)))
                     create_notification('<strong>Exitoso</strong>: Se actualizo correctamente la información de ' +
                        vm.modal_customer.user_user, 'alert-success', 'customers');
                     return;
                  }
               }
               create_notification('<strong>Error</strong>: No se pudo actualizar la información de ' +
                  vm.modal_customer.user_user, 'alert-danger', 'customers');
            }
         );
         $('#box-modify-customer').modal("hide");
      },
      remove_customer: function(index_customer) {
         $.post('../ajax/admin/deleteUser.php', {
               id_user: this.data_customers[index_customer].id_user
            },
            function(data, status) {
               if (status == 'success') {
                  let data_parse = JSON.parse(data);
                  if (data_parse.status) {
                     create_notification('<strong>Exisitoso</strong>: Se elimino correctamente al usuario ' +
                        vm.data_customers[index_customer].user_user, 'alert-success', 'customers');
                     vm.data_customers.splice(index_customer, 1);
                     return;
                  } else if(data_parse.type = 'exists_reservations') {
                     create_notification('<strong>Warning</strong>: ' + vm.data_customers[index_customer].user_user
                     + ' tiene reservaciones sin concluir. No se puede eliminado', 'alert-warning', 'customers');
                     return;
                  }
               }
               create_notification('<strong>Error</strong>: No se pudo eliminar al usuario ' +
                  vm.data_customers[index_customer].user_user, 'alert-danger', 'customers');
            }
         );
      },
      fill_customer: function() {
         this.is_modal_create = true;
         this.restart_modal();
         $('#box-modify-customer').modal({
            backdrop: 'static',
            keyboard: false
         });
      },
      create_customer: function() {
         $.post('../ajax/admin/createUser.php', {
               data_user: JSON.stringify(this.modal_customer)
            },
            function(data, status) {
               if (status == 'success') {
                  let parse_data = JSON.parse(data);
                  if (parse_data.status) {
                     vm.modal_customer.id_user = parse_data.id_user;
                     vm.data_customers.unshift(JSON.parse(JSON.stringify(vm.modal_customer)));
                     $('#box-modify-customer').modal("hide");
                     create_notification('<strong>Exitoso</strong>: Se registro el usuario '
                        + vm.modal_customer.user_user, 'alert-success', 'customers');
                     return;
                  } else if (parse_data.type == 'user_already_exists') {
                     vm.user_already_exists.state = true;
                     vm.user_already_exists.value = vm.modal_customer.user_user;
                     vm.state_inputs_modal.user_user = false;
                     create_error_user_modal();
                     return;
                  }
               }
               $('#box-modify-customer').modal("hide");
               create_notification('<strong>Error</strong>: No se pudo registrar el usuario; conexión fallida',
                  'alert-danger', 'customers');
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
                     create_notification('<strong>Exitoso</strong> Se ' + status_msg, 'alert-success', 'salon');
                     return;
                  } else {
                     let status_msg = 'actualizar correctamente la información del salón de eventos\nError al actualizar datos en la tabla ' +
                        parse_data['in_table'];
                     if (parse_data['action'] == 'create')
                        status_msg = 'registrar correctamente el salón de eventos\nError al registrar datos en la tabla' +
                        parse_data['in_table'];
                     create_notification('<strong>Error</strong>: No se pudo ' + status_msg, 'alert-danger', 'salon');
                     return;
                  }
               }
               create_notification('<strong>Error</strong>: Conexión fallida');
            }
         );
      },
      is_valid_user: function() {
         if(this.modal_customer.user_user) {
            if(this.user_already_exists.state) {
               if(this.user_already_exists.value == this.modal_customer.user_user) {
                  this.state_inputs_modal.user_user = false;
                  create_error_user_modal();
                  return;
               }
               $('#bxm-error-user').remove();
            }
            this.state_inputs_modal.user_user = true;
         } else {
            this.state_inputs_modal.user_user = false;
         }
      },
      is_valid_email: function() {
         if (/^\w+(\.|-|\w)*@\w+(\.|-|\w)*$/.test(this.modal_customer.email_user)) {
            if (this.is_modal_create) {
               $('#bxm-email').removeClass('error-input').addClass('success-input');
               this.is_active_success_email = true;
               this.state_inputs_modal.email_user = true;
            } else if(this.is_modal_update_admin) {
               if (this.data_admin.email_user != this.modal_customer.email_user) {
                  $('#bxm-email').removeClass('error-input').addClass('success-input');
               } else {
                  $('#bxm-email').removeClass('success-input').removeClass('error-input');
               }
               if (this.is_valid_for_update(this.modal_customer, this.data_admin)) {
                  this.is_disable_btn_modal = false;
               } else {
                  this.is_disable_btn_modal = true;
               }
            } else {
               if (this.data_customers[this.index_modal_customer].email_user !=
                  this.modal_customer.email_user) {
                     $('#bxm-email').removeClass('success-input').addClass('error-input');
               } else {
                  $('#bxm-email').removeClass('success-input').removeClass('error-input');
               }
               if (this.is_valid_for_update(this.modal_customer,
                  this.data_customers[this.index_modal_customer])) {
                     this.is_disable_btn_modal = false;
               } else {
                  this.is_disable_btn_modal = true;
               }
            }
         } else {
            this.state_inputs_modal.email_user = false;
            if (this.is_modal_create) {
               if (this.is_active_success_email) {
                  $('#bxm-email').removeClass('success-input').addClass('error-input');
                  this.is_active_success_email = false;
               }
               return;
            }
            $('#bxm-email').removeClass('success-input').addClass('error-input');
         }
      },
      onch_is_valid_email: function() {
         if (!/^\w+(\.|-|\w)*@\w+(\.|-|\w)*$/.test(this.modal_customer.email_user)) {
            $('#bxm-email').addClass('error-input');
         }
      },
      is_valid_input: function(key) {
         if(this.modal_customer[key]) {
            if(this.is_modal_create) {
               this.state_inputs_modal[key] = true;
               return;
            } else if(this.is_modal_update_admin) {
               if(this.is_valid_for_update(this.modal_customer, this.data_admin)) {
                  this.is_disable_btn_modal = false;
                  return;
               }
            } else if(this.is_valid_for_update(this.modal_customer,
               this.data_customers[this.index_modal_customer])) {
                  this.is_disable_btn_modal = false;
                  return;
            }
            this.is_disable_btn_modal = true;
         }
         this.state_inputs_modal[key] = false;
      },
      restart_modal: function() {
         if (this.is_modal_create) {
            this.modal_customer = {
               id_user: 1,
               user_user: '',
               name_user: '',
               pa_lastname_user: '',
               mo_lastname_user: '',
               email_user: '',
               phone_user: '',
               password_user: ''
            };
         } else if (this.is_modal_update_admin) {
            this.modal_customer = JSON.parse(JSON.stringify(this.data_admin));
         } else {
            this.modal_customer = JSON.parse(JSON.stringify(
               this.data_customers[this.index_modal_customer]));
         }
         this.is_disable_btn_modal = true;
         this.is_active_success_email = false;
      },
      is_valid_for_update: function(data_copy, data_origin) {
         let everyone_has_data = true;
         let there_is_modification = false;
         for (const key in data_copy) {
            if(!data_copy[key]) {
               everyone_has_data = false;
               break;
            }
         }
         if(everyone_has_data) {
            for (const key in data_copy) {
               if(data_copy[key] != data_origin[key]) {
                  there_is_modification = true;
               }
            }
         }
         return everyone_has_data && there_is_modification;
      },
      get_reservations: function() {
         this.data_reservations = {confirmed: [], unconfirmed: []}
         let type_select = 'unconfirmed';
         if(this.type_select_reservations == 'all') {
            type_select = 'all';
         } else if(this.type_select_reservations == 'confirmed') {
            type_select = 'confirmed';
         }
         $.post('../ajax/admin/selectReservations.php',
            {select_reservations: type_select},
            function(data, status) {
               if(status == 'success') {
                  let data_parse = JSON.parse(data);
                  if(data_parse.type == 'all') {
                     vm.data_reservations.confirmed = data_parse.confirmed;
                     vm.data_reservations.unconfirmed = data_parse.unconfirmed;
                     if(!data_parse.confirmed.length && !data_parse.unconfirmed.length) {
                        create_notification('<strong>Vació</strong>: No hay reservaciones',
                        'alert-success', 'reservations');
                     }
                  } else if(data_parse.type == 'confirmed'){
                     if(data_parse.confirmed.length)
                        vm.data_reservations.confirmed = data_parse.confirmed;
                     else
                        create_notification('<strong>Vació</strong>: No hay reservaciones confirmadas',
                        'alert-success', 'reservations');
                  } else {
                     if(data_parse.unconfirmed.length)
                        vm.data_reservations.unconfirmed = data_parse.unconfirmed;
                     else
                        create_notification('<strong>Vació</strong>: No hay reservaciones por confirmar',
                        'alert-success', 'reservations');
                  }
               } else {
                  create_notification('<strong>Error</strong>: No se pudieron obtener los datos. Conexión fallida',
                     'alert-danger', 'reservations');
               }
            }
         );
      },
      confirm_reservation: function(index_reserv) {
         $.post('../ajax/admin/confirmReservation.php',
            {'id_reservation': this.data_reservations.unconfirmed[index_reserv].id_reservation},
            function(data, status) {
               if(status == 'success') {
                  if(vm.type_select_reservations == 'all') {
                     vm.data_reservations.confirmed.unshift(
                        vm.data_reservations.unconfirmed.splice(index_reserv, 1)[0]);
                  } else {
                     vm.data_reservations.unconfirmed.splice(index_reserv, 1);
                  }
                  vm.total_reservations.unconfirmed--;
                  vm.total_reservations.confirmed++;
                  create_notification('<strong>Exitoso</strong>: Reservación confirmada',
                     'alert-success', 'reservations');
               } else {
                  create_notification('<strong>Error</strong>: No se pudo confirmar la reservación. Conexión fallida',
                     'alert-danger', 'reservations');
               }
            }
         );
      },
      fill_service: function() {
         this.is_modal_service_create = true;
         this.restart_modal_service();
         $('#box-services').modal({
            backdrop: 'static',
            keyboard: false
         });
      },
      create_or_update_service: function() {
         if(this.is_modal_service_create)
            this.create_service();
         else
            this.update_service();
      },
      create_service: function() {
         $.post('../ajax/admin/createService.php',
            {'data_service': JSON.stringify(this.modal_service)},
            function(data, status) {
               if(status == 'success') {
                  let data_parse = JSON.parse(data);
                  if(data_parse.status) {
                     vm.modal_service.id_service = data_parse.id_service;
                     vm.data_services.unshift(JSON.parse(JSON.stringify(vm.modal_service)));
                     create_notification('<strong>Exitoso</strong>: Se registro correctamente el servicio',
                        'alert-success', 'services');
                     return;
                  }
               }
               create_notification('<strong>Error</strong>: No se pudo registrar el servicio',
                  'alert-danger', 'services');
            }
         );
         $('#box-services').modal("hide");
      },
      modify_service: function(index_service) {
         this.index_service = index_service;
         this.is_modal_service_create = false;
         this.restart_modal_service();
         $('#box-services').modal({
            backdrop: 'static',
            keyboard: false
         });
      },
      update_service: function() {
         $.post('../ajax/admin/updateService.php',
            {'data_service': JSON.stringify(this.modal_service)},
            function(data, status) {
               if(status == 'success') {
                  if(JSON.parse(data).status) {
                     Vue.set(vm.data_services, vm.index_service,
                        JSON.parse(JSON.stringify(vm.modal_service)));
                     create_notification('<strong>Exitoso</strong>: Se ha actualizdo la información del servicio',
                        'alert-success', 'services');
                     return;
                  }
               }
               create_notification('<strong>Error</strong>: No se pudo actualizar la información del servicio',
                  'alert-danger', 'services');
            }
         );
         $('#box-services').modal("hide");
      },
      restart_modal_service: function() {
         if(this.is_modal_service_create)
            this.modal_service = {id_service: 1, name_service: '', price: 0, detail: ''}
         else
            this.modal_service = JSON.parse(JSON.stringify(this.data_services[this.index_service]));
      }
   },
   computed: {
      modal_data: function() {
         if (this.is_modal_create) {
            return {
               title: "Agregue los datos para el ",
               strong: 'nuevo usuario',
               text_btn: "Crear usuario",
               style_user: {
                  display: 'flex'
               }
            }
         }
         return {
            title: "Modificar información de ",
            strong: this.modal_customer.user_user,
            text_btn: "Actualizar",
            style_user: {
               display: 'none'
            }
         }
      },
      is_disable_btn_modal: {
         get: function() {
            for (const key in this.state_inputs_modal) {
               if (!this.state_inputs_modal[key]) return true;
            }
            return false;
         },
         set: function(new_state) {
            for (const key in this.state_inputs_modal) {
               this.state_inputs_modal[key] = !new_state;
            }
         }
      },
      modal_data_service: function() {
         if (this.is_modal_service_create) {
            return {
               title: "Agregue los datos para el ",
               strong: 'nuevo servicio',
               text_btn: "Crear servicio",
            }
         }
         return {
            title: "Modificar información del servicio: ",
            strong: this.modal_service.name_service,
            text_btn: "Actualizar",
         }
      }
   },
});

var id_page_current = '#customers';
var id_option_current = '#opt-customers';

$(document).ready(function() {
   $('.list-group span').on('click', function() {
      $('.navbar-toggler').click();
   });

   $(id_page_current).css('display', 'block');
   $(id_option_current).addClass('option-selected');

   let c_date = new Date();
   $('#customers > div > h4').text(c_date.getDate() + '/' + (c_date.getMonth() + 1) +
      '/' + c_date.getFullYear());
   $('#search-customers').on('input', function() {
      //if ($(this).val()) {
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
      //}
   });
   $('#box-modify-customer').on('hidden.bs.modal', function() {
      if (document.getElementById('bxm-error-user')) {
         $('#bxm-error-user').remove();
      }
      $('#bxm-email').removeClass('error-input').removeClass('success-input');
   });
   $('#search-services').on('input', function() {
      //if ($(this).val()) {
         $.post('../ajax/admin/selectServiceForName.php', {
               'name_service': $(this).val()
            },
            function(data, status) {
               if (status == 'success') {
                  let parse_data = JSON.parse(data);
                  if (parse_data.value) {
                     vm.data_services = parse_data.data_services;
                  } else {
                     vm.data_services = [];
                  }
               }
            }
         );
      //}
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

function create_notification(message, type_notification, section) {
   let alert = '#'+section+'>div.alert:first-child';
   $('#'+ section + '> div:last-child').before('<div class="alert ' + type_notification +
      ' alert-dismissible fade show text-center" role="alert">' + message +
      '<button type="button" class="close" data-dismiss="alert" aria-label="close">' +
      '<span aria-hidden="true">&times;</span></button>');
   setTimeout(function() {
      if(document.querySelector(alert))
         $(alert).alert('close');
   }, 6000);
}

function create_error_user_modal() {
   $('#box-modify-customer div.modal-body > div:first-child').after(
      '<p id="bxm-error-user" class="text-danger">Este usuario ya existe, especifique otro usuario</p>');
}

function show_or_hide_password(id_button, id_input) {
   $(id_button).toggleClass('fa-eye-slash fa-eye');

   if ($(id_input).attr('type') == 'password')
      $(id_input).attr('type', 'text');
   else
      $(id_input).attr('type', 'password');
}