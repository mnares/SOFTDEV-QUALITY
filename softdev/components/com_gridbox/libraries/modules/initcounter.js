/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var file = document.createElement('script');
file.onload = function(){
    app.initcounter(app.modules.initcounter.data, app.modules.initcounter.selector);
}
file.src = '{uri_root}/components/com_gridbox/libraries/counter/counter.js';
document.getElementsByTagName('head')[0].appendChild(file);

app.initcounter = function(obj, key){
    $g('#'+key+' span.counter-number').counter(obj.counter);
    initItems();
}