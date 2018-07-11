/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

function compareProgressBarPosition($this)
{
    var wHeight = $g(window).height(),
        itemTop = Math.round($g($this).offset().top) + 50,
        itemBottom = itemTop + ($g($this).height()),
        top = window.pageYOffset,
        bottom = (top + wHeight);
    if ((itemTop < bottom) && (itemBottom > top)){
        startProgressBar(app.items[$this.id], $this.id);
        $g(window).off('scroll.progress-bar-'+$this.id);
    }
}

function checkProgressBar()
{
    compareProgressBarPosition(this);
}

function startProgressBar(obj, key)
{
    var bar = $g('#'+key).find('.ba-animated-bar');
    bar.find('.progress-bar-number').text('0%');
    bar.stop().css('width', '0%').animate({
        width: obj.target+'%'
    }, {
        duration: obj.duration * 1,
        easing: obj.easing,
        step: function(now, fx) {
            $g(this).find('.progress-bar-number').text(Math.floor(now)+'%');
        },
        complete: function(){
            $g(this).find('.progress-bar-number').text(obj.target+'%');
        }
    });
}

app.initprogressBar = function(obj, key){
    $g(window).off('scroll.progress-bar-'+key).on('scroll.progress-bar-'+key, $g.proxy(checkProgressBar, $g('#'+key)[0]));
    compareProgressBarPosition($g('#'+key)[0]);
    initItems();
}

app.initprogressBar(app.modules.initprogressBar.data, app.modules.initprogressBar.selector);