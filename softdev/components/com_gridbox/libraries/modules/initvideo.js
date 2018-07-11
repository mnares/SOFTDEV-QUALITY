/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.initvideo = function(obj, key){
    var video = document.querySelector('#'+key+' video');
    if (themeData.page.view == 'gridbox' && obj.video.type == 'source' && obj.video.source.file) {
        video.querySelector('source').src = JUri+obj.video.source.file;
    }
    if (video && obj.video.source.autoplay) {
        video.play();
    }
    initItems();
}

app.initvideo(app.modules.initvideo.data, app.modules.initvideo.selector);