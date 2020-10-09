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
      type_reserv: 'novalue',
      count_time: 0,
      count_people: 0,
      chairs: 0,
      tables: 0,
      tablecloths: 0,
      assistants: 0,
      total: 0,
      day_reserv: null
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
      },
      clearFields: function() {
         console.log('limpiando campos');
         this.count_time = 0;
         this.count_people = 0;
         this.chairs = 0;
         this.tables = 0;
         this.tablecloths = 0;
         this.assistants = 0;
         this.total = 0;
      },
      reservDay: function(w, d) {
         let date_select = new Date(this.year, this.month, this.calendar[w][d]);
         console.log('día: ' + this.calendar[w][d]);

         if (this.day_reserv === null) {
            /**
             * Es la primera vez que se selecciona una fecha
             */
            this.day_reserv = date_select;
         } else if (!(date_select == this.day_reserv)) {
            /**
             * NO es la primera vez que se selecciona una fecha
             * por lo mismo es necesario cambiar el color de la fecha
             * seleccionada previamente y después el cambiar el color
             * de la fecha seleccionada actualmente, el que lanzo el evento
             */
            let day_reserv_prev = this.day_reserv;
            this.day_reserv = date_select;
            if (day_reserv_prev.getFullYear() == this.year && day_reserv_prev.getMonth() == this.month) {
               let pos = this.searchDayInCal(day_reserv_prev);
               let element = document.querySelector('#cal > div:nth-child('+pos.week+')').childNodes[pos.day].firstChild;
               let className = element.className.split(' ');
               className.pop();
               className.pop();
               className.push('btn-success');
               element.className = className.join(' ');
            }
         }
         let element = document.querySelector('#cal > div:nth-child('+(w+1)+')').childNodes[d].firstChild;
         console.log('elemento: ', element.firstChild.nodeValue);
         let className = element.className.split(' ');
         className.pop();
         className.push('btn-warning');
         className.push('disabled');
         element.className = className.join(' ');
      },
      searchDayInCal: function(date) {
         let position = {week: 0, day: 0};
         for (let w = 0; w < this.calendar.length; w++) {
            for (let d = 0; d < this.calendar[w].length; d++) {
               if (date.getDay() == this.calendar[w][d]) {
                  position.week = w + 1;
                  position.day = d + 1;
               }
            }
         }
         return position;
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