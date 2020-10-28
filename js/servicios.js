var current_date = new Date();
current_date.setHours(0,0,0,0);
var date_accept = new Date();
date_accept.setHours(0,0,0,0);
date_accept.setDate(date_accept.getDate() + 2);

var vm = new Vue({
   el: '#app',
   data: {
      year: current_date.getFullYear(),
      month: current_date.getMonth(),
      months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
               'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      week: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
      reservation_type: 'novalue',
      count_time: 0,
      count_people: 0,
      chairs: 0,
      tables: 0,
      tablecloths: 0,
      assistants: 0,
      total: 0,
      selected_date: null,
      reservated_dates: reservations
   },
   methods: {
      clear_fields: function() {
         this.reservation_type = 'novalue';
         this.count_time = 0;
         this.count_people = 0;
         this.chairs = 0;
         this.tables = 0;
         this.tablecloths = 0;
         this.assistants = 0;
         this.total = 0;
      },
      next_month: function() {
         this.reservated_dates = {};
         if(this.month < 11) { this.month++; }
         else {
            this.month = 0;
            this.year++;
         }

         $.post("../ajax/getReservations.php",
            {year: this.year, month: this.month+1},
            function(data, status){
               if(status == 'success') {
                  vm.reservated_dates = JSON.parse(data);
               }
            }
         );
      },
      previuos_month: function() {
         this.reservated_dates = {};
         if(this.month > 0) { this.month--; }
         else {
            this.month = 11;
            this.year--;
         }

         $.post("../ajax/getReservations.php",
            {year: this.year, month: this.month+1},
            function(data, status) {
               if(status == 'success') {
                  vm.reservated_dates = JSON.parse(data);
               }
            }
         );
      },
      select_date: function(index_week, index_day) {
         if($('#cal > div:nth-child('+(index_week+1)+') > div:nth-child('+(index_day+1)+') > div')
            .attr('class').indexOf('disabled')!=-1) { return; }

         let date_select = new Date(this.year, this.month, this.calendar[index_week][index_day]);
         date_select.setHours(0,0,0,0);

         this.selected_date = date_select;
      },
      get_class_date: function(day){
         if(this.reservated_dates[day]) {
            if(this.reservated_dates[day][1])
               return "reservated disabled";
            else
               return "on-hold disabled";
         }
         let date_for_day = new Date(this.year, this.month, day, 0,0,0,0);
         if(date_for_day < date_accept) {
            return "disabled";
         }
         if(this.is_this_month_selected_date &&
            day == this.selected_date.getDate()) {
            return "selected disabled";
         }
         return "btn-success";
      }
   },
   computed: {
      days_each_month: function(){
         let days_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
         if((this.year % 4 == 0 && this.year % 100 != 0) || this.year % 400 == 0) {
            days_month[1] = 29;
         }
         return days_month;
      },
      days_first_week: function() {
         return 7 - new Date(this.year, this.month, 1).getDay();
      },
      days_last_week: function() {
         return (this.days_each_month[this.month] - this.days_first_week) % 7;
      },
      calendar: function() {
         let cal = [];
         cal.push([]);
         //first week in this month
         let maximium_value = this.days_first_week + 1;
         for (let day = 1; day < maximium_value; day++) {
            cal[0].push(day);
         }
         //Next Weeks
         let weeks = parseInt((this.days_each_month[this.month] - this.days_first_week) / 7);
         for (let week = 0; week < weeks; week++) {
            cal.push([]);
            for (let day = 1; day < 8; day++) {
               cal[week + 1].push(week * 7 + day + this.days_first_week);
            }
         }
         //Last Week
         if (this.days_last_week) {
            cal.push([]);
            maximium_value = this.days_last_week + 1;
            for (let day = 1; day < maximium_value; day++) {
               cal[weeks + 1].push(weeks * 7 + day + this.days_first_week);
            }
         }
         return cal;
      },
      is_this_month_selected_date: function() {
         if(this.selected_date &&
            this.year == this.selected_date.getFullYear() &&
            this.month == this.selected_date.getMonth()) { return true; }
         return false;
      }
   }
});

$(document).ready(function() {

   $("#event").change(function() {
      if ($("#event").val() === "other") {
         $("#eventother").append(
            `<div id="boxotheranother" class="col-md-8 mb-2 d-flex flex-wrap justify-content-center mb-3">
    <label for="writeanother" class="mr-2 mt-1">Mencionelo: </label>
    <input type="text" name="values[]" 
      id="writeanother" class="mb-1" min="0"  />
  </div>`
         );
      } else {
         if (document.getElementById("boxotheranother")) {
            $("#boxotheranother").remove();
         }
      }
   });
});

//validate all form inputs

function validateForm() {
   if (document.getElementById("boxotheranother")) {
      if ($("#writeanother").val() === "") {
         showMessage();
         return false;
      }
   } else {
      if ($("#event").val() == "") {
         showMessage();
         return false;
      }
   }

   if (!validateTime("#start-time")) {
      return false;
   }
   if (!validateTime("#final-time")) {
      return false;
   }

   var boxServices = document.getElementById("boxservices");

   for (var i = 0; i < boxServices.children.length; i++) {
      if (!validateService("#" + boxServices.children[i].children[1].id)) {
         return false;
      }
   }

   return true;
}

//validate validate the hours

function validateTime(id) {
   if (isNaN($(id).val()) || ($(id).val().replace(" ", "").trim() == "")) {
      showMessage();
      return false;
   } else {
      if ((($(id).val()) % 1 != 0) || ($(id).val() < 1) || ($(id).val() > 12)) {
         showMessage();
         return false;
      }
   }
   return true;
}

//validate validate the services

function validateService(id) {
   if (isNaN($(id).val()) || ($(id).val().replace(" ", "").trim() == "")) {
      showMessage();
      return false;
   } else {
      if ((($(id).val()) % 1 != 0) || ($(id).val() < 0)) {
         showMessage();
         return false;
      }
   }
   return true;
}

//in case of wrong data in the inputs, this message will be displayed

function showMessage() {
   if (!document.getElementById("msg-error-successful")) {
      $("#box-confirmpass").append(
         `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-danger alert-dismissible fade show" role="alert">
            ¡Vaya! Rellene o corrija los datos
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> 
        </p>`
      );
   }
   $('html, body').animate({
      scrollTop: $("#box-confirmpass").offset().top - 150
   }, 500);
   document.getElementById("total").value="";
}

//clean button repair

function restore() {
   if (document.getElementById("boxotheranother")) {
      $("#boxotheranother").remove();
   }
   document.getElementById("total").value="";
}

//quote services without reloading the page

function quote() {
   if (validateForm()) {
      var finalhour;

      starthour = (($("#start-time-select").val()).toLowerCase() == "am") ?
         parseInt($("#start-time").val()) :
         parseInt($("#start-time").val()) + 12;
      switch (starthour) {
         case 12:
         case 24:
            starthour = starthour - 12;
            break;
      }

      finalhour = (($("#final-time-select").val()).toLowerCase() == "am") ?
         parseInt($("#final-time").val()) :
         parseInt($("#final-time").val()) + 12;
      switch (finalhour) {
         case 12:
         case 24:
            finalhour = finalhour - 12;
            break;
      }
      if (starthour < finalhour) {
         if (document.getElementById('msg-error-successful')) {
            $('#msg-error-successful').remove();
         }

         var datesForm = [starthour, finalhour];
         var boxServices = document.getElementById("boxservices");
         for (var i = 0; i < boxServices.children.length; i++) {
            datesForm.push(boxServices.children[i].children[1].id);
            datesForm.push(boxServices.children[i].children[1].value);
         }
         console.log(datesForm);
         $.ajax({
               data: {
                  datesForm
               },
               type: "post",
               dataType: "json",
               url: "../ajax/my/quoteRental.php",
            })
            .done(function(data, textStatus, jqXHR) {
               document.getElementById("total").value = data;
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
               console.log("mal");
            });
      } else {
         showMessage();
      }
   }
}