/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.inittabs = function(obj, key){
    $g('#'+key+' a[data-toggle="tab"]').on('shown', function(e){
        $g(this.hash).find('.ba-item-slideshow, .ba-item-slideset, .ba-item-carousel, .ba-item-map').each(function(){
            var object = {
                data : app.items[this.id],
                selector : this.id
            };
            app.checkModule('initItems', object);
        });
    });
    initItems();
}

app.inittabs(app.modules.inittabs.data, app.modules.inittabs.selector);