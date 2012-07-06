(function( $ ) {
    $.fn.timesago = function(o){

        var settings = $.extend({
            months: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
            days: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
            firstday: 1,
            refresh: 1,
            hoursago: '%d saat önce',
            minutesago: '%d dakika önce',
            secondsago: '%d saniye önce',
        }, o);

        this.each(function(){

            var that = $(this);
            var timestamp = that.html();

            var d1 = new Date(timestamp*1000);
            var d1Year = d1.getFullYear();
            var d1Month = d1.getMonth();
            var d1MonthDay = d1.getDate();
            var d1WeekDay = d1.getDay();
            var d1Hours = d1.getHours();
            var d1Minutes = d1.getMinutes();
            var d1Seconds = d1.getSeconds();
            var d1Time = d1.getTime();

            var calculate = function () {

                var d2 = new Date();
                var d2Year = d2.getFullYear();
                var d2Month = d2.getMonth();
                var d2MonthDay = d2.getDate();
                var d2WeekDay = d2.getDay();
                var d2WeekFirst = d2MonthDay - d2WeekDay + settings.firstday;
                var d2Hours = d2.getHours();
                var d2Minutes = d2.getMinutes();
                var d2Seconds = d2.getSeconds();
                var d2Time = d2.getTime();

                var leftSeconds = Math.floor((d2Time-d1Time)/1000);
                var leftMinutes = Math.floor(leftSeconds/60);
                var leftHours = Math.floor(leftMinutes/60);

                if (d2Year > d1Year) {
                    that.html(
                        d1MonthDay +' '+
                        settings.months[d1Month] +' '+
                        d1Year +' '+
                        settings.days[d1WeekDay] +' '+
                        pad2(d1Hours) +':'+ pad2(d1Minutes));
                    return;
                }

                if (d2Month > d1Month || d2WeekFirst > d1MonthDay) {
                    that.html(
                        d1MonthDay +' '+
                        settings.months[d1Month] +' '+
                        settings.days[d1WeekDay] +' '+
                        pad2(d1Hours) +':'+ pad2(d1Minutes));
                    return;
                }

                if (d2MonthDay > d1MonthDay) {
                    that.html(
                        settings.days[d1WeekDay] +' '+
                        pad2(d1Hours) +':'+ pad2(d1Minutes));
                    return;
                }

                if (leftHours > 0) {
                    that.html(settings.hoursago.replace('%d', leftHours));
                    return;
                }

                if (leftMinutes > 0) {
                    that.html(settings.minutesago.replace('%d', leftMinutes));
                    return;
                }

                if (leftSeconds > 0) {
                    that.html(settings.secondsago.replace('%d', leftSeconds));
                    return;
                }
            }

            that.attr('title',
                d1MonthDay +' '+
                settings.months[d1Month] +' '+
                d1Year +' '+
                settings.days[d1WeekDay] +' '+
                d1Hours +':'+ pad2(d1Minutes) +':'+ pad2(d1Seconds));

            calculate();

            setInterval(function() {
                calculate(); }, 1000*settings.refresh);

        });

        function pad2(number) {
             return (number < 10 ? '0' : '') + number
        }
    }
})( jQuery );
