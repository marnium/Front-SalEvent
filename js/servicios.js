var current_date = new Date();
var c_year = current_date.getFullYear();
var c_month = current_date.getMonth();

var vm = new Vue({
   el: '#app',
   data: {
      year: c_year,
      month: c_month,
      months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
               'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      daysMonth: [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
      week: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
   },
   methods: {
      nextMonth: function() {
         if(this.month < 11) { this.month++; }
         else if(this.month >= 11) {
            this.month = 0;
            this.year++;
         }
      },
      previuosMonth: function() {
         if(this.month > 0) { this.month--; }
         else if(this.month <= 0) {
            this.month = 11;
            this.year--;
         }
      }
   },
   computed: {
      dayOne: function() {
         let current_date = new Date(this.year, this.month, 1);
         return current_date.getDay();
      },
      daysOneWeek: function() {
         return 7 - this.dayOne;
      },
      daysLastWeek: function() {
         return (this.daysMonth[this.month] - this.daysOneWeek) % 7;
      },
      calendar: function() {
         let cal = [];
         cal.push([]);
         //Week one
         let limite = this.daysOneWeek + 1;
         for (let day = 1; day < limite; day++) {
            cal[0].push(day);
         }
         //Next Weeks
         let weeks = (this.daysMonth[this.month] - this.daysOneWeek) / 7;
         let lastWeek = !Number.isInteger(weeks);
         weeks = parseInt(weeks);
         for (let week = 0; week < weeks; week++) {
            cal.push([]);
            for (let day = 1; day < 8; day++) {
               cal[week + 1].push(week * 7 + day + this.daysOneWeek);
            }
         }
         //Last Week
         if (lastWeek) {
            cal.push([]);
            limite = this.daysLastWeek + 1;
            for (let day = 1; day < limite; day++) {
               cal[weeks + 1].push(weeks * 7 + day + this.daysOneWeek);
            }
         }
         return cal;
      }
   }
});