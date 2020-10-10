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
      date_reserved: null,
      is_visibility_reserv: false
   },
   methods: {
      nextMonth: function() {
         if(this.month < 11) { this.month++; }
         else if(this.month >= 11) {
            this.month = 0;
            this.year++;
         }
         this.rendererDateReserved();
      },
      previuosMonth: function() {
         if(this.month > 0) { this.month--; }
         else if(this.month <= 0) {
            this.month = 11;
            this.year--;
         }
         this.rendererDateReserved();
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
      reservedDay: function(w, d) {
         if (w == null || d == null) return;

         let date_selected = new Date(this.year, this.month, this.calendar[w][d]);

         if (this.date_reserved == null) {
            this.date_reserved = date_selected;
         } else if (this.date_reserved.getFullYear() == date_selected.getFullYear() &&
             this.date_reserved.getMonth() == date_selected.getMonth()) {
            let date_reserved_old = this.date_reserved;
            this.date_reserved = date_selected;
            if (date_reserved_old.getFullYear() == this.year && date_reserved_old.getMonth() == this.month) {
               this.removeDateReserved(date_reserved_old);
            }
         }
         this.addDateReserved(this.date_reserved);
         this.is_visibility_reserv = true;
      },
      searchDayInCal: function(date) {
         let position = {week: 0, day: 0};
         for (let w = 0; w < this.calendar.length; w++) {
            for (let d = 0; d < this.calendar[w].length; d++) {
               if (date.getDate() == this.calendar[w][d]) {
                  position.week = w + 1;
                  position.day = d;
               }
            }
         }
         return position;
      },
      rendererDateReserved: function(date_old) {
         if (this.date_reserved == null) return;
         if (this.year == this.date_reserved.getFullYear() &&
             this.month == this.date_reserved.getMonth()) {
            this.addDateReserved(this.date_reserved);
            this.is_visibility_reserv = true;
         } else if (this.is_visibility_reserv) {
            let filas = document.querySelectorAll('#cal > div.row-cal');
            for (const f of filas) {
               for (const c of f.childNodes) {
                  let className = c.firstChild.className;
                  if (className.indexOf('btn-warning') != -1) {
                     className = className.split(' ');
                     className.pop();
                     className.pop();
                     className.push('btn-sucess');
                     c.firstChild.className = className.join(' ');
                     this.is_visibility_reserv = false;
                  }
               }
            }
         }
      },
      removeDateReserved: function(date) {
         let pos = this.searchDayInCal(date);
         let element = document.querySelector('#cal > div:nth-child('+pos.week+')').childNodes[pos.day].firstChild;
         let className = element.className.split(' ');
         className.pop();
         className.pop();
         className.push('btn-success');
         element.className = className.join(' ');
      },
      addDateReserved: function(date) {
         let pos = this.searchDayInCal(date);
         let element = document.querySelector('#cal > div:nth-child('+(pos.week)+')').childNodes[pos.day].firstChild;
         let className = element.className.split(' ');
         className.pop();
         className.push('btn-warning');
         className.push('disabled');
         element.className = className.join(' ');
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