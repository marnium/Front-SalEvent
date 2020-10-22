var current_date = new Date();
current_date.setHours(0,0,0,0);

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

         $.post("getReservations.php",
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

         $.post("getReservations.php",
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
         if(date_for_day < current_date) {
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