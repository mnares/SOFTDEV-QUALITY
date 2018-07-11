/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.checkOverlay = function(obj, key){
    $g('.ba-item-overlay-section').each(function(){
        var overlay = $g(this).find('.ba-overlay-section-backdrop');
        if (overlay.length > 0) {
        	document.body.appendChild(overlay[0]);
        }
    });
}

app.checkOverlay();