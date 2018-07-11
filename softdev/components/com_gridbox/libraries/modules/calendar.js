/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

function setupCalendar(input, button, onUpdate)
{
    Calendar.setup({
        inputField: input,
        ifFormat: "%Y-%m-%d %H:%M:%S",
        button : button,
        align: "Tl",
        singleClick: true,
        firstDay: 0,
        onUpdate : function(){
            if (onUpdate) {
                onUpdate();
            }
        }
    });

    return true;
}

var file = document.createElement('link');
file.rel = 'stylesheet';
file.href = '{uri_root}media/system/css/calendar-jos.css';
document.getElementsByTagName('head')[0].appendChild(file);
file = document.createElement('script');
file.src = '{uri_root}media/system/js/calendar.js';
document.getElementsByTagName('head')[0].appendChild(file);
file.onload = function(){
    file = document.createElement('script');
    file.src = '{uri_root}media/system/js/calendar-setup.js';
    document.getElementsByTagName('head')[0].appendChild(file);
    file.onload = function(){
        app.loadModule('setCalendar');
    }
}