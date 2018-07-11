/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var onePageScroll = true,
    pageAS = {
    scrolling :false,
    delta :1,
    startCoords : {},
    endCoords : {},
    anchor : jQuery('.gridbox-class'),
    animateScroll: function(){
        if (onePageScroll && pageAS.anchor.length > 0) {
            var scroll = $g(window).scrollTop(),
                index = 0,
                header = $g('header.header'),
                comp = header[0] ? getComputedStyle(header[0]) : {};
            pageAS.anchor.each(function(ind){
                var value = $g(this).offset().top;
                if (!header.hasClass('sidebar-menu') && comp.position == 'fixed') {
                    value -= header.height();
                    if (header.find('.resizing-header').length > 0) {
                        var resizingSection = getComputedStyle(header.find('.resizing-header')[0]);
                        value += resizingSection.paddingTop.replace('px', '') * 1;
                        value += resizingSection.paddingBottom.replace('px', '') * 1;
                    }
                }
                if ($g(this).closest('.ba-wrapper').parent().hasClass('header')) {
                    value = 0;
                }
                if (Math.floor(value) == Math.floor(scroll)) {
                    index = ind + (-1 * pageAS.delta);
                    return false;
                }
            });
            if (index >= 0 && index < pageAS.anchor.length) {
                pageAS.scrolling = true;
                var obj = app.items[this.item].autoscroll,
                    section = jQuery(pageAS.anchor[index]),
                    value = section.offset().top;
                if (!header.hasClass('sidebar-menu') && comp.position == 'fixed') {
                    value -= header.height();
                    if (header.find('.resizing-header').length > 0) {
                        var resizingSection = getComputedStyle(header.find('.resizing-header')[0]);
                        value += resizingSection.paddingTop.replace('px', '') * 1;
                        value += resizingSection.paddingBottom.replace('px', '') * 1;
                    }
                }
                if (section.closest('.ba-wrapper').parent().hasClass('header')) {
                    value = 0;
                }
                onePageScroll = false;
                jQuery('html, body').stop().animate({
                    scrollTop: value
                }, obj.speed * 1, obj.animation, function(){
                    if (window.pageYOffset != value) {
                        window.scrollTo(0, value);
                    }
                    onePageScroll = true;
                    checkOnePageActive();
                    setTimeout(function(){
                        pageAS.scrolling = false;
                    }, 200);
                });
            }
        }
    },
    wheelHandle: function(event){
        pageAS.checkItems();
        if (pageAS.anchor.length > 0) {
            event.preventDefault();
            var value = event.originalEvent.wheelDelta || -event.originalEvent.deltaY || -event.originalEvent.detail;
            pageAS.delta = Math.max(-1, Math.min(1, value));
            if (pageAS.scrolling) {
                return false;
            }
            pageAS.animateScroll();
        }
    },
    keydownHandle: function(event){
        var flag = false;
        if (flag = event.keyCode == 38 || event.keyCode == 33) {
            pageAS.delta = 1;
        } else if (flag = event.keyCode == 40 || event.keyCode == 34) {
            pageAS.delta = -1;
        }
        if (flag) {
            pageAS.checkItems();
            if (pageAS.anchor.length > 0) {
                event.preventDefault();            
                if (!pageAS.scrolling) {
                    pageAS.animateScroll();
                }
            }
        }
    },
    checkItems: function(){
        if (app.view != 'desktop') {
            this.anchor = new Array();
        } else {
            var items = '';
            $g('#'+this.item).find('ul li a').each(function(){
                if ($g(this).height() > 0 && this.hash && $g(this.hash).height() > 0) {
                    if (items) {
                        items += ', ';
                    }
                    items += this.hash;
                }
            });
            this.anchor = $g(items);
        }
    },
    setEvents: function(key){
        this.item = key;
        pageAS[key] = true;
        $g(window).on('wheel.'+key, pageAS.wheelHandle);
        $g(window).on('keydown.'+key, pageAS.keydownHandle);
    },
    removeEvents: function(key){
        if (pageAS[key]) {
            $g(window).off('wheel.'+key);
            $g(window).off('keydown.'+key);
        }
    }
}

app['initone-page'] = function(obj, key){
    if (!obj.autoscroll) {
        obj.autoscroll = {
            "enable": false,
            "speed": 1000,
            "animation": "easeInSine"
        }
    }
    if (themeData.page.view != 'gridbox' && obj.autoscroll.enable) {
        pageAS.setEvents(key);
    } else {
        pageAS.removeEvents(key);
    }
    $g('#'+key+' .open-menu i').on('mousedown', function(event){
        event.stopPropagation();
        setTimeout(function(){
            $g('#'+key+' .main-menu').addClass('visible-menu').removeClass('hide-menu')
                .closest('.column-wrapper').addClass('column-with-menu').closest('.ba-row-wrapper').addClass('row-with-menu');
            if (themeData.page.view == 'gridbox') {
                var computed = getComputedStyle(document.querySelector('header'));
                document.querySelector('header').classList.add('ba-header-position-'+computed.position);
            }
            $g('#'+key+' .ba-menu-backdrop').addClass('ba-visible-menu-backdrop');
            $g('body').addClass('ba-opened-menu');
        }, 50);
    });
    $g('.ba-menu-backdrop, .close-menu i').off('click').on('click', function(){
        closeOnePageMenu();
    });
    $g('#'+key+' ul').on('click', 'a', function(event){
        event.preventDefault();
        var item = $g(this.hash);
        if (this.hash && item.length > 0) {
            $g(this).closest('ul').find('.active').removeClass('active');
            this.parentNode.classList.add('active');
            var value = item.offset().top,
                speed = app.items[key].autoscroll.speed * 1,
                animation = app.items[key].autoscroll.animation,
                wrapper = $g(this).closest('.ba-wrapper'),
                header = wrapper.hasClass('ba-sticky-header') ? wrapper : $g('header.header'),
                comp = header[0] ? getComputedStyle(header[0]) : {},
                alias = this.dataset.alias,
                url = location.href.replace(location.hash, '')+'#'+alias,
                top = window.pageYOffset;
            if (item.closest('.ba-wrapper').parent().hasClass('header')) {
                value = 0;
            }
            if (!header.hasClass('sidebar-menu') && comp.position == 'fixed') {
                value -= header.height();
                if (header.find('.resizing-header').length > 0) {
                    var resizingSection = getComputedStyle(header.find('.resizing-header')[0]);
                    value += resizingSection.paddingTop.replace('px', '') * 1;
                    value += resizingSection.paddingBottom.replace('px', '') * 1;
                }
            }
            onePageScroll = false;
            if (top != value) {
                $g('html, body').stop().animate({
                    'scrollTop' : value
                }, speed, animation, function(){
                    setTimeout(function(){
                        onePageScroll = true;
                    }, 200);
                });
            }
            window.history.replaceState(null, null, url);
        }
        closeOnePageMenu();
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

function closeOnePageMenu()
{
    $g('.visible-menu').addClass('hide-menu').removeClass('visible-menu')
        .closest('.column-wrapper').removeClass('column-with-menu').closest('.ba-row-wrapper').removeClass('row-with-menu');
    $g('.ba-menu-backdrop').removeClass('ba-visible-menu-backdrop');
    setTimeout(function(){
        if (themeData.page.view == 'gridbox') {
            var computed = getComputedStyle(document.querySelector('header'));
            document.querySelector('header').classList.remove('ba-header-position-'+computed.position);
        }
        $g('body').removeClass('ba-opened-menu');
    }, 500);
}

if (!$g('body').hasClass('gridbox')) {
    $g(window).off('scroll.onepage').on('scroll.onepage', function(){
        if (onePageScroll) {
            checkOnePageActive();
        }
    });
}

app['initone-page'](app.modules['initone-page'].data, app.modules['initone-page'].selector);