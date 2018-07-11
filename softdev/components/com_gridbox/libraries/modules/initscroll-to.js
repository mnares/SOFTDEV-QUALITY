/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var file = document.createElement('script');
file.onload = function(){
    app['initscroll-to'](app.modules['initscroll-to'].data, app.modules['initscroll-to'].selector);
}
file.src = '{uri_root}/components/com_gridbox/libraries/smoothScroll/smoothScroll.js';
document.getElementsByTagName('head')[0].appendChild(file);

app['initscroll-to'] = function(obj, key){
    $g('#'+key+' a.ba-btn-transition').smoothScroll(obj.init);
    initItems();
}