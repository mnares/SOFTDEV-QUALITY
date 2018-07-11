/**
* @package   Gridbox template
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
console.log = function(){
    return false;
};

var $g = jQuery,
    delay = '',
    itemsInit = new Array(),
    app = {
        view : 'desktop',
        modules : {},
        loading : {},
        edit : {},
        items : {},
        checkAnimation: function(){
            app.viewportItems = new Array();
            $g('.ba-section, .ba-row, .ba-grid-column').each(function(){
                if (app.items[this.id]) {
                    var object = $g.extend(true, {}, app.items[this.id].desktop.animation);
                    if (app.view != 'desktop') {
                        for (var ind in breakpoints) {
                            if (!app.items[this.id][ind]) {
                                app.items[this.id][ind] = {
                                    animation : {}
                                };
                            }
                            object = $g.extend(true, {}, object, app.items[this.id][ind].animation);
                            if (ind == app.view) {
                                break;
                            }
                        }
                    }
                    if (object.effect && app.items[this.id].type != 'sticky-header') {
                        var obj = {
                            effect : object.effect,
                            item : $g(this)
                        }
                        app.viewportItems.push(obj);
                    } else if (object.effect) {
                        $g(this).addClass('visible');
                    }
                }
            });
            if (app.viewportItems.length > 0 || $g('.ba-item-slideshow').length > 0 || $g('.ba-item-main-menu'.length > 0)) {
                app.checkModule('loadAnimations');
            }
        },
        checkModule : function(module, obj){
            if (typeof(obj) != 'undefined') {
                app.modules[module] = obj;
            }
            if (typeof(app[module]) == 'undefined' && !app.loading[module]) {
                app.loading[module] = true;
                app.loadModule(module);
            } else if (typeof(app[module]) != 'undefined') {
                if (typeof(obj) != 'undefined') {
                    app[module](obj.data, obj.selector);
                } else {
                    app[module]();
                }
            }
        },
        checkVideoBackground : function(){
            var flag = false;
            $g('.ba-section, .ba-row, .ba-grid-column').each(function(){
                if (app.items[this.id] && app.items[this.id].desktop.background.type == 'video') {
                    flag = true;
                    return false;
                }
            });
            $g('.ba-item-flipbox').each(function(){
                if (app.items[this.id] && app.items[this.id].sides.frontside.desktop.background.type == 'video') {
                    flag = true;
                    return false;
                }
                if (app.items[this.id] && app.items[this.id].sides.backside.desktop.background.type == 'video') {
                    flag = true;
                    return false;
                }
            });
            if (app.theme.desktop.background.type == 'video') {
                flag = true;
            }
            if (flag) {
                app.checkModule('createVideo', {});
            }
        },
        loadModule : function(module){
            $g.ajax({
                type:"POST",
                dataType:'text',
                url:JUri+"index.php?option=com_gridbox&task=editor.loadModule",
                data:{
                    module : module
                },
                complete: function(msg){
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    document.getElementsByTagName('head')[0].appendChild(script);
                    script.innerHTML = msg.responseText;
                }
            });
        },
        checkView: function(){
            var width = $g(window).width();
            app.view = 'desktop';
            for (var ind in breakpoints) {
                if (width <= breakpoints[ind]) {
                    app.view = ind;
                }
            }
        },
        resize : function(){
            clearTimeout(delay);
            app.checkView();
        },
        gridboxLoaded : function(){
            app.checkView();
            app.checkAnimation();
            checkOnePage();
            window.addEventListener('resize', app.resize);
            $g(window).on('scroll', function(){
                var top = window.pageYOffset;
                if (!('lastPageYOffset' in window)) {
                    window.lastPageYOffset = top;
                }
                if (top > 40) {
                    $g('header').addClass('fixed-header');
                } else {
                    $g('header').removeClass('fixed-header');
                }
                $g('.ba-sticky-header').each(function(){
                    var section = this.querySelector('.ba-sticky-header > .ba-section'),
                        obj = app.items[section.id]
                        offset = obj.desktop.offset;
                    if (app.view != 'desktop') {
                        for (var ind in breakpoints) {
                            if (!obj[ind]) {
                                obj[ind] = {};
                            }
                            offset = obj[ind].offset ? obj[ind].offset : offset;
                            if (ind == app.view) {
                                break;
                            }
                        }
                    }
                    if (!this.classList.contains('visible-sticky-header')) {
                        if (top >= offset * 1 && (!obj.scrollup || (obj.scrollup && top - window.lastPageYOffset < 0))) {
                            this.classList.add('visible-sticky-header');
                            document.body.classList.add('sticky-header-opened');
                            if (obj.desktop.animation.effect) {
                                section.classList.add(obj.desktop.animation.effect);
                                setTimeout(function(){
                                    section.classList.remove(obj.desktop.animation.effect);
                                }, obj.desktop.animation.delay * 1 + obj.desktop.animation.duration * 1000);
                            }
                        }
                    }
                    if ((top < offset * 1 && !obj.scrollup) || (obj.scrollup && (top - window.lastPageYOffset > 0
                        || top <= offset * 1))) {
                        this.classList.remove('visible-sticky-header');
                        document.body.classList.remove('sticky-header-opened');
                    }
                });
                window.lastPageYOffset = top;
            });
            $g(window).trigger('scroll');
            $g('[contenteditable]').removeAttr('contenteditable');
            $g('.ba-item').each(function(){
                if (app.items[this.id]) {
                    var obj = {
                        data : app.items[this.id],
                        selector : this.id
                    };
                    itemsInit.push(obj);
                }
            });
            if (itemsInit.length > 0) {
                app.checkModule('initItems', itemsInit.pop());
            }
            if ($g('.ba-item-overlay-section').length > 0) {
                app.checkModule('checkOverlay');
            }
            app.checkVideoBackground();
            $g('.ba-lightbox-backdrop').find('.ba-lightbox-close').on('click', function(){
                lightboxVideoClose($g(this).closest('.ba-lightbox-backdrop')[0]);
                $g(this).closest('.ba-lightbox-backdrop').removeClass('visible-lightbox');
                $g('body').removeClass('lightbox-open');
            });
            $g('.ba-lightbox-backdrop').each(function(){
                var obj = app.items[this.dataset.id];
                if (obj.type == 'cookies') {
                    initLightbox(this, obj);
                } else if (!obj.session.enable) {
                    initLightbox(this, obj);
                } else {
                    var flag = true;
                    if (localStorage[this.dataset.id]) {
                        var date =  new Date().getTime(),
                            expires = new Date(localStorage[this.dataset.id]);
                        expires.getTime();
                        if (date >= expires) {
                            flag = true;
                            localStorage.removeItem(this.dataset.id);
                        } else {
                            flag = false;
                        }
                    }
                    if (flag) {
                        var expiration = new Date();
                        expiration.setDate(expiration.getDate() + obj.session.duration);
                        localStorage.setItem(this.dataset.id, expiration);
                        initLightbox(this, obj);
                    }
                }
            });
            $g('.ba-section, .ba-row, .ba-grid-column').each(function(){
                if (app.items[this.id] && app.items[this.id].parallax && app.items[this.id].parallax.enable) {
                    app.checkModule('loadParallax');
                    return false;
                }
            });
        }
    };

document.addEventListener("DOMContentLoaded", function(){
    $g('li.megamenu-item').on('mouseenter', function(){
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
    $g('.ba-item-main-menu').closest('.ba-row').addClass('row-with-menu');
    $g.ajax({
        type: "POST",
        dataType: 'text',
        url: JUri+"index.php?option=com_gridbox&task=editor.getItems",
        data: themeData,
        complete: function(msg){
            var data = JSON.parse(msg.responseText)
            for (var key in data) {
                if (key != 'theme') {
                    app.items = $g.extend(true, app.items, data[key]);
                }
            }
            app.theme = data.theme;
            app.gridboxLoaded();
        }
    });
});

var lightboxVideo = {};

function lightboxVideoClose(item)
{
    var iframes = item.querySelectorAll('.ba-item-custom-html iframe, .ba-item-video iframe');
    for (var i = 0; i < iframes.length; i++) {
        var src = iframes[i].src,
            videoId = iframes[i].id;
        if (src && src.indexOf('youtube.com') !== -1 && 'pauseVideo' in lightboxVideo[videoId]) {
            lightboxVideo[videoId].pauseVideo();
        } else if (src && src.indexOf('vimeo.com') !== -1 && 'pause' in lightboxVideo[videoId]) {
            lightboxVideo[videoId].pause();
        }
    }
    iframes = item.querySelectorAll('.ba-item-video video, .ba-item-custom-html video');
    for (var i = 0; i < iframes.length; i++) {
        var videoId = iframes[i].id;
        lightboxVideo[videoId].pause();
    }
}

function lightboxVideoOpen(item)
{
    var iframes = item.querySelectorAll('.ba-item-custom-html iframe, .ba-item-video iframe'),
        youtube = false,
        vimeo = false,
        id = +new Date();
    for (var i = 0; i < iframes.length; i++) {
        var src = iframes[i].src,
            videoId;
        if (src && src.indexOf('youtube.com') !== -1) {
            if (!app.youtube) {
                youtube = true;
            } else {
                if (src.indexOf('enablejsapi=1') === -1) {
                    if (src.indexOf('?') === -1) {
                        src += '?';
                    } else {
                        src += '&'
                    }
                    src += 'enablejsapi=1';
                    iframes[i].src = src;
                }
                if (!iframes[i].id) {
                    iframes[i].id = id++;
                }
                videoId = iframes[i].id;
                if (!lightboxVideo[videoId] || !('playVideo' in lightboxVideo[videoId])) {
                    lightboxVideo[videoId] = new YT.Player(videoId, {
                        events: {
                            onReady: function(event){
                                lightboxVideo[videoId].playVideo();
                            }
                        }
                    });
                } else {
                    lightboxVideo[videoId].playVideo();
                }
            }
        } else if (src && src.indexOf('vimeo.com') !== -1) {
            if (!app.vimeo) {
                vimeo = true;
            } else {
                if (!iframes[i].id) {
                    iframes[i].id = id++;
                }
                videoId = iframes[i].id;
                if (!lightboxVideo[videoId] || !('play' in lightboxVideo[videoId])) {
                    src = src.split('/');
                    src = src.slice(-1);
                    src = src[0].split('?');
                    src = src[0];
                    var options = {
                        id: src * 1,
                        loop: true,
                    };
                    lightboxVideo[videoId] = new Vimeo.Player(videoId, options);
                }
                lightboxVideo[videoId].play();
            }
        }
    }
    iframes = item.querySelectorAll('.ba-item-video video, .ba-item-custom-html video');
    for (var i = 0; i < iframes.length; i++) {
        if (!iframes[i].id) {
            iframes[i].id = id++;
        }
        videoId = iframes[i].id;
        if (!lightboxVideo[videoId]) {
            lightboxVideo[videoId] = iframes[i];
        }
        lightboxVideo[videoId].play();
    }
    if (youtube || vimeo) {
        var object = {
            data : {}
        };
        if (youtube && !vimeo) {
            object.data.type = 'youtube';
        } else if (vimeo && !youtube) {
            object.data.type = 'vimeo';
        } else {
            object.data.type = 'youtube+vimeo';
        }
        app.checkModule('loadVideoApi', object);
    }
    if (youtube) {
        lightboxVideo.overlay = item;
    } else if (vimeo) {
        lightboxVideo.overlay = item;
    }

    return !youtube && !vimeo;
}

function initLightbox($this, obj)
{
    var obj = app.items[$this.dataset.id];
    if (obj.type == 'cookies') {
        if (localStorage['ba-item-cookie']) {
            return false;
        }
        $g($this).find('.ba-item-button[data-cookie="accept"]').on('click', function(event){
            event.preventDefault();
            localStorage.setItem('ba-item-cookie', 'accept');
            $g(this).closest('.ba-lightbox-backdrop').removeClass('visible-lightbox');
            $g('body').removeClass('lightbox-open');
        });
        showLightbox($this);
    } else if (obj.trigger.type == 'time-delay') {
        setTimeout(function(){
            showLightbox($this);
        }, obj.trigger.time);
    } else if (obj.trigger.type == 'scrolling') {
        lightboxScroll($this, obj.trigger.scroll);
    } else if(obj.trigger.type == 'exit-intent') {
        $g(document).one('mouseleave.ba-lightbox'+$this.dataset.id, function(){
            showLightbox($this);
        });
    } else {
        lightboxScroll($this, 100);
    }
}

function lightboxScroll($this, scroll)
{
    var item = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html'),
        top,
        docHeight,
        htmlHeight;
    $g(window).on('scroll.ba-lightbox'+$this.dataset.id+' load.ba-lightbox'+$this.dataset.id, function(){
        top = $g(item).scrollTop();
        docHeight = document.documentElement.clientHeight
        htmlHeight = Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight
        );
        var x = (docHeight + top) * 100 / htmlHeight;
        if (x >= scroll) {
            $g(window).off('scroll.ba-lightbox'+$this.dataset.id+' load.ba-lightbox'+$this.dataset.id);
            showLightbox($this);
        }
    });
}

function showLightbox($this)
{
    if (!lightboxVideoOpen($this)) {
        return false;
    }
    $this.classList.add('visible-lightbox');
    var obj = app.items[$this.dataset.id];
    if (obj.position == 'lightbox-center') {
        document.body.classList.add('lightbox-open');
    }
}

function checkOnePage()
{
    var alias = location.hash.replace('#', '');
    alias = decodeURIComponent(alias);
    if (alias && document.querySelector('.ba-item-one-page-menu a[data-alias="'+alias+'"]')) {
        var $this = $g('.ba-item-one-page-menu a[data-alias="'+alias+'"]')[0],
            item = $g($this.hash);
        if ($this.hash && item.length > 0) {
            $g($this).closest('ul').find('.active').removeClass('active');
            $this.parentNode.classList.add('active');
            var value = item.offset().top,
                header = $g('header'),
                comp = header[0] ? getComputedStyle(header[0]) : {},
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
            if (top != value) {
                $g('html, body').stop().animate({
                    'scrollTop' : value
                }, 1000);
            }
        }
    } else {
        checkOnePageActive();
    }
}

function checkOnePageActive()
{
    var top = window.pageYOffset,
        items = new Array(),
        alias = '',
        flag = false;
    $g('.ba-item-one-page-menu ul li a').each(function(){
        if ($g(this).height() > 0 && this.hash && $g(this.hash).height() > 0) {
            var computed = getComputedStyle(document.querySelector(this.hash));
            if (computed.display != 'none') {
                items.push(this);
            }
        }
    });
    items.sort(function(item1, item2){
        var target1 = $g(item1.hash),
            target2 = $g(item2.hash),
            top1 = target1.closest('header.header').length == 0 ? target1.offset().top : 0,
            top2 = target2.closest('header.header').length == 0 ? target2.offset().top : 0;
        if (top1 > top2) {
            return 1;
        } else if (top1 < top2) {
            return -1;
        } else {
            return 0;
        }
    });
    for (var i = items.length - 1; i >= 0; i--) {
        alias = items[i].dataset.alias;
        var $this = items[i],
            id = $this.hash,
            item = $g(id),
            value = item.offset().top,
            header = $g('header.header'),
            comp = header[0] ? getComputedStyle(header[0]) : {},
            url = location.href.replace(window.location.hash, '')+'#'+alias;
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
        if (Math.floor(value) <= Math.floor(top) + 1) {
            flag = true;
            $g('a[href="'+id+'"]').closest('ul').find('.active').removeClass('active');
            $g('a[href="'+id+'"]').parent().addClass('active');
            break;
        }
    }
    if (!flag) {
        $g('.ba-item-one-page-menu .main-menu ul.nav.menu .active').removeClass('active');
        if (window.location.hash) {
            window.history.replaceState(null, null, location.href.replace(window.location.hash, ''));
        }
    } else {
        if (decodeURI(window.location.hash) != '#'+alias) {
            window.history.replaceState(null, null, url);
        }
    }
}

jQuery(window).on('popstate.onepage', function(){
    onePageScroll = false;
    setTimeout(function(){
        onePageScroll = true;
    }, 300);
});

/*
    default joomla
*/
(function($){
    $(document).ready(function(){
        $('*[rel=tooltip]').tooltip();
        $('.radio.btn-group label').addClass('btn');
        $('fieldset.btn-group').each(function() {
            if (this.disabled) {
                $(this).css('pointer-events', 'none').off('click');
                $(this).find('.btn').addClass('disabled');
            }
        });
        $(".btn-group label:not(.active)").click(function(){
            var label = $(this),
                input = $('#' + label.attr('for'));
            if (!this.checked) {
                label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
                if (input.val() == '') {
                    label.addClass('active btn-primary');
                } else if (input.val() == 0) {
                    label.addClass('active btn-danger');
                } else {
                    label.addClass('active btn-success');
                }
                input.prop('checked', true).trigger('change');
            }
        });
        $(".btn-group input[checked=checked]").each(function(){
            if (this.value == '') {
                $("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
            } else if ($(this).val() == 0) {
                $("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
            } else {
                $("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
            }
        });
        $('#back-top').on('click', function(e) {
            e.preventDefault();
            $("html, body").animate({scrollTop: 0}, 1000);
        });
    })
})(jQuery);