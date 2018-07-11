/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/


!function ($) {

    var weather = function (element, options) {
        this.item = $(element);
        this.options = options;
        this.query;
    }
    
    weather.prototype = {
        init : function(){
            var src,
                $this = this;
            src = $this.makeYQL();
            $.getJSON(src, function(data) {
                if (!data.query.results) {
                    return false;
                }
                var query = data.query.results.channel;
                $this.query = {
                    code : query.item.condition.code,
                    temp : query.item.condition.temp,
                    humidity : query.atmosphere.humidity,
                    pressure : query.atmosphere.pressure+' '+query.units.pressure,
                    sunrise : query.astronomy.sunrise,
                    sunset : query.astronomy.sunset,
                    direction : query.wind.direction,
                    speed : query.wind.speed,
                    forecast : query.item.forecast
                }
                $.ajax({
                    type:"POST",
                    dataType:'text',
                    url:"index.php?option=com_gridbox&task=editor.getWeatherLang",
                    complete: function(msg){
                        $this.lang = JSON.parse(msg.responseText);
                        $this.create();
                    }
                });
            });
        },
        lang : {},
        replaceMap : {
            1 : "01",
            2 : "02",
            3 : "03",
            4 : "04",
            5 : "05",
            6 : "06",
            7 : "07",
            8 : "08",
            9 : "09",
        },
        create : function() {
            var date = new Date(),
                $this = this,
                sunset = this.query.sunset.split(' '),
                sunrise = this.query.sunrise.split(' ');
            sunrise[0] = sunrise[0].split(':');
            if (this.replaceMap[sunrise[0][1]]) {
                sunrise[0][1] = sunrise[0][1].replace(sunrise[0][1], this.replaceMap[sunrise[0][1]])
            }
            sunset[0] = sunset[0].split(':');
            if (this.replaceMap[sunset[0][1]]) {
                sunset[0][1] = sunset[0][1].replace(sunset[0][1], this.replaceMap[sunset[0][1]])
            }
            this.item.find('.city').text(this.options.location);
            this.item.find('.date').text(date.getDate()+' '+this.lang[date.getMonth()]+' '+date.getFullYear());
            this.item.find('.weather .icon i')[0].className = this.icons[this.query.code];
            this.item.find('.temp-wrapper .temp').text(this.query.temp);
            this.item.find('.temp-wrapper .unit').text('°'+this.options.unit.toUpperCase());
            var speed = this.lang.wind+': '+this.query.speed+' ';
            if (this.options.unit != 'c') {
                speed += this.lang.mph;
            } else {
                speed += this.lang.speed;
            }
            this.item.find('.wind').text(speed);
            this.item.find('.humidity').text(this.lang.humidity+': '+this.query.humidity+'%');
            this.item.find('.pressure').text(this.lang.pressure+': '+this.query.pressure);
            this.item.find('.sunrise').text(this.lang.sunrise+': '+sunrise[0][0]+':'+sunrise[0][1]+' '+sunrise[1]);
            this.item.find('.sunset').text(this.lang.sunset+': '+sunset[0][0]+':'+sunset[0][1]+' '+sunset[1]);
            this.item.find('.forecast').each(function(ind){
                var forecast = $(this);
                forecast.find('.day').text($this.lang[$this.query.forecast[ind].day.toLowerCase()]);
                forecast.find('.icon i')[0].className = $this.icons[$this.query.forecast[ind].code];
                forecast.find('.day-temp .temp').text($this.query.forecast[ind].high);
                forecast.find('.day-temp .unit').text('°'+$this.options.unit.toUpperCase());
                forecast.find('.night-temp .temp').text($this.query.forecast[ind].low);
                forecast.find('.night-temp .unit').text('°'+$this.options.unit.toUpperCase());
            });
        },
        makeYQL : function(){
            var query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1)',
                src = 'https://query.yahooapis.com/v1/public/yql?q=';
            query += ' where text="'+this.options.location+'") and u="'+this.options.unit+'"';
            src += query;
            src += '&format=json';

            return src;
        },
        icons : {
            '0' : 'wi wi-tornado',
            '1' : 'wi wi-storm-showers',
            '2' : 'wi wi-tornado',
            '3' : 'wi wi-thunderstorm',
            '4' : 'wi wi-thunderstorm',
            '5' : 'wi wi-snow',
            '6' : 'wi wi-rain-mix',
            '7' : 'wi wi-rain-mix',
            '8' : 'wi wi-sprinkle',
            '9' : 'wi wi-sprinkle',
            '10' : 'wi wi-hail',
            '11' : 'wi wi-showers',
            '12' : 'wi wi-showers',
            '13' : 'wi wi-snow',
            '14' : 'wi wi-storm-showers',
            '15' : 'wi wi-snow',
            '16' : 'wi wi-snow',
            '17' : 'wi wi-hail',
            '18' : 'wi wi-hail',
            '19' : 'wi wi-cloudy-gusts',
            '20' : 'wi wi-fog',
            '21' : 'wi wi-fog',
            '22' : 'wi wi-fog',
            '23' : 'wi wi-cloudy-gusts',
            '24' : 'wi wi-cloudy-windy',
            '25' : 'wi wi-thermometer',
            '26' : 'wi wi-cloudy',
            '27' : 'wi wi-night-cloudy',
            '28' : 'wi wi-day-cloudy',
            '29' : 'wi wi-night-cloudy',
            '30' : 'wi wi-day-cloudy',
            '31' : 'wi wi-night-clear',
            '32' : 'wi wi-day-sunny',
            '33' : 'wi wi-night-clear',
            '34' : 'wi wi-day-sunny-overcast',
            '35' : 'wi wi-hail',
            '36' : 'wi wi-day-sunny',
            '37' : 'wi wi-thunderstorm',
            '38' : 'wi wi-thunderstorm',
            '39' : 'wi wi-thunderstorm',
            '40' : 'wi wi-storm-showers',
            '41' : 'wi wi-snow',
            '42' : 'wi wi-snow',
            '43' : 'wi wi-snow',
            '44' : 'wi wi-cloudy',
            '45' : 'wi wi-lightning',
            '46' : 'wi wi-snow',
            '47' : 'wi wi-thunderstorm',
            '3200' : 'wi wi-cloud',
        }
    }
    
    $.fn.weather = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('weather'),
                options = $.extend({}, $.fn.weather.defaults, typeof option == 'object' && option);
            if (data) {
                $this.removeData();
            }
            $this.data('weather', (data = new weather(this, options)));
            data.init();
        });
    }
    
    $.fn.weather.defaults = {
        location : 'New York, NY, United States',
        unit : 'c'
    }
    $.fn.weather.Constructor = weather;
}(window.$g ? window.$g : window.jQuery);