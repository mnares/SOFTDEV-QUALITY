/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var file = document.createElement('link'),
    slidesetDelay = null,
    windowWidth = $g(window).width();
file.rel = 'stylesheet';
file.href = '{uri_root}/components/com_gridbox/libraries/slideset/css/animation.css';
document.getElementsByTagName('head')[0].appendChild(file);
file = document.createElement('script');
file.onload = function(){
    app.initslideset(app.modules.initslideset.data, app.modules.initslideset.selector);
}
file.src = '{uri_root}/components/com_gridbox/libraries/slideset/js/slideset.js';
document.getElementsByTagName('head')[0].appendChild(file);

$g(window).on('resize', function(){
    clearTimeout(slidesetDelay);
    slidesetDelay = setTimeout(function(){
        var width = $g(window).width();
        if (width != windowWidth) {
            windowWidth = width;
            $g('ul.ba-slideset').each(function(){
                var key = $g(this).closest('.ba-item')[0].id;
                $g(this).slideset(getSlidesetObject(key));
            });
        }
    }, 300);
});

app.initslideset = function(obj, key){
    var content = $g('#'+key+' .slideshow-content');
    if (content.find('li.item').length == 0) {
        content.addClass('empty-content');
    } else {
        content.removeClass('empty-content');
    }
    $g('#'+key+' ul.ba-slideset').slideset(getSlidesetObject(key));
    initItems();
}

function getSlidesetObject(key)
{
    var object = $g.extend(true, {}, app.items[key].desktop.slideset);
    if (app.view != 'desktop') {
        for (var ind in breakpoints) {
            if (!app.items[key][ind]) {
                app.items[key][ind] = {
                    slideset : {}
                };
            }
            object = $g.extend(true, {}, object, app.items[key][ind].slideset);
            if (ind == app.view) {
                break;
            }
        }
    }
    object.gutter = app.items[key].desktop.gutter;

    return object;
}