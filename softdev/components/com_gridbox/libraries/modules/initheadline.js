/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

if (themeData.page.view == 'gridbox') {
    var file = document.createElement('link');
    file.rel = 'stylesheet';
    file.href = '{uri_root}components/com_gridbox/libraries/headline/css/animation.css';
    document.getElementsByTagName('head')[0].appendChild(file);
}

function checkHeadline($this)
{
    var wHeight = $g(window).height(),
        itemTop = Math.round($g($this).offset().top) + 50,
        itemBottom = itemTop + ($g($this).height()),
        top = window.pageYOffset,
        bottom = (top + wHeight);
    if ((itemTop < bottom) && (itemBottom > top)) {
        var tag = $this.querySelector('.headline-wrapper '+app.items[$this.id].tag);
        tag.parentNode.classList.add(app.items[$this.id].desktop.animation.effect);
        $g(window).off('scroll.headline-'+$this.id);
    } else {
        $this.querySelector('.headline-wrapper').classList.remove(app.items[$this.id].desktop.animation.effect);
    }
}

app.initheadline = function(obj, key){
    $this = $g('#'+key)[0];
    if (app.items[key].desktop.animation.effect) {
        $g(window).off('scroll.headline-'+key).on('scroll.headline-'+key, $g.proxy(checkHeadline, $this, $this));
        checkHeadline($this);
    }
    initItems();
}

app.initheadline(app.modules.initheadline.data, app.modules.initheadline.selector);