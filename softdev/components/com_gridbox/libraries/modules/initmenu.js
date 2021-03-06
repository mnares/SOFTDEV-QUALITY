/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.initmenu = function(obj, key){
    $g('#'+key+' .open-menu i').on('mousedown', function(event){
        event.stopPropagation();
        setTimeout(function(){
            $g('#'+key+' > .ba-menu-wrapper > .main-menu').find('ul.nav-child, .ba-wrapper[data-megamenu]').css('max-height', '');
            $g('#'+key+' > .ba-menu-wrapper > .main-menu').addClass('visible-menu').removeClass('hide-menu')
                .closest('.column-wrapper').addClass('column-with-menu').closest('.ba-row-wrapper').addClass('row-with-menu');
            if (themeData.page.view == 'gridbox') {
                var computed = getComputedStyle(document.querySelector('header.header'));
                document.querySelector('header.header').classList.add('ba-header-position-'+computed.position);
            }
            $g('#'+key+' > .ba-menu-backdrop').addClass('ba-visible-menu-backdrop');
            $g('body').addClass('ba-opened-menu');
        }, 50);
    });
    $g('.ba-menu-backdrop, .close-menu i').off('click').on('click', function(){
        if (!document.body.classList.contains('body-megamenu-editing')) {
            $g('.visible-menu').addClass('hide-menu').removeClass('visible-menu')
                .closest('.column-wrapper').removeClass('column-with-menu');
            $g('.ba-menu-backdrop').removeClass('ba-visible-menu-backdrop');
            $g('#'+key+' > .ba-menu-wrapper > .main-menu').find('ul.nav-child, .ba-wrapper[data-megamenu]').css('max-height', '');
            setTimeout(function(){
                if (themeData.page.view == 'gridbox') {
                    var computed = getComputedStyle(document.querySelector('header.header'));
                    document.querySelector('header.header').classList.remove('ba-header-position-'+computed.position);
                }
                $g('body').removeClass('ba-opened-menu');
                $g('.row-with-menu').removeClass('row-with-menu');
            }, 500);
        }
    });
    if (themeData.page.view == 'gridbox') {
        $g('#'+key+' .ba-menu-wrapper').on('click', '.ba-edit-item', function(event){
            event.preventDefault();
            event.stopPropagation();
        });
    }
    $g('#'+key+' > .ba-menu-wrapper .tabs-content-wrapper[data-megamenu]').each(function(){
        var li = $g('#'+key+' > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li.'+this.dataset.megamenu);
        if (li.length != 0 && $g(this).closest('li').length == 0) {
            li.prepend(this);
        }
    });
    $g('#'+key).on('mouseenter', 'li.megamenu-item', function(){
        var rectangle = this.getBoundingClientRect(),
            left = rectangle.left * -1,
            wrapper = $g(this).find(' > div.tabs-content-wrapper'),
            width = document.documentElement.clientWidth,
            maxwidth = width - rectangle.right;
        if (wrapper.hasClass('megamenu-center') && wrapper.hasClass('ba-container')) {
            left = $g(this).width() / 2;
        }
        if (rectangle.left < maxwidth) {
            maxwidth = rectangle.left;
        }
        if (!wrapper.hasClass('megamenu-center')) {
            maxwidth = width - rectangle.left;
        } else if (wrapper.hasClass('ba-container')) {
            left -= wrapper.outerWidth() / 2;
        }
        if (wrapper.hasClass('megamenu-center')) {
            maxwidth = (maxwidth + (rectangle.right - rectangle.left) / 2) * 2;
        }
        if ($g(this).closest('.ba-menu-wrapper').hasClass('vertical-menu')) {
            maxwidth = width - rectangle.right;
        }
        wrapper.css({
            'margin-left' : left+'px',
            'width' : width+'px',
            'max-width' : maxwidth+'px'
        });
    });
    $g('#'+key).on('click', 'li.deeper.parent > a > i.zmdi-caret-right, li.deeper.parent > span > i.zmdi-caret-right', function(event){
        event.preventDefault();
        event.stopPropagation();
        var li = $g(this).closest('li.deeper.parent');
        if (li.hasClass('visible-nav-child')) {
            li.removeClass('visible-nav-child').addClass('hidden-nav-child');
        } else {
            $g('#'+key+' .visible-nav-child').find(' > ul, > .ba-wrapper').css('max-height', '');
            li.addClass('visible-nav-child').removeClass('hidden-nav-child');
            setTimeout(function(){
                $g('#'+key+' .visible-nav-child').find(' > ul, > .ba-wrapper').each(function() {
                   this.style.maxHeight = $g(this).height()+'px';
                });

            }, 500);
        }
    });
    var endCoords = startCoords = {}
    $g('#'+key).on('touchstart', function(event){
        endCoords = event.originalEvent.targetTouches[0];
        startCoords = event.originalEvent.targetTouches[0];
    }).on('touchmove', function(event){
        endCoords = event.originalEvent.targetTouches[0];
    }).on('touchend', function(event){
        var hDistance = endCoords.pageX - startCoords.pageX,
            xabs = Math.abs(endCoords.pageX - startCoords.pageX),
            yabs = Math.abs(endCoords.pageY - startCoords.pageY);
        if(hDistance >= 100 && xabs >= yabs * 2) {
            $g('#'+key+' .ba-menu-backdrop').trigger('click');
        }
    });

    initItems();
}

app.initmenu(app.modules.initmenu.data, app.modules.initmenu.selector);