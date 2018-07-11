/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.buttonsPrevent = function(){
    $g('a, input[type="submit"], button').on('click', function(event){
        event.preventDefault();
    });
}

app.checkAnimation = function(){
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
    if (app.viewportItems.length > 0) {
        app.checkModule('loadAnimations');
    }
}

app.setMediaRules = function(obj, key, callback)
{
    var desktop =  $g.extend(true, {}, obj.desktop),
        str = '';
    if (disableResponsive) {
        return str;
    }
    for (var ind in breakpoints) {
        if (!obj[ind]) {
            obj[ind] = {};
        }
        var object = $g.extend(true, {}, desktop, obj[ind]);
        str += "@media (max-width: "+breakpoints[ind]+"px) {"
        str += window[callback](object, key, obj.type);
        str += "}";
        desktop =  $g.extend(true, {}, object);
    }
    
    return str;
}

app.checkVideoBackground = function(){
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
}

app.initTooltip = function(element){
    element.off('mouseenter').on('mouseenter', function(){
        var tooltip = element.find('.ba-tooltip'),
            coord = element[0].getBoundingClientRect(),
            top = coord.top,
            data = tooltip.html(),
            center = (coord.right - coord.left) / 2;
            className = tooltip[0].className,
            span = document.createElement('span');
        center = coord.left + center;
        if (tooltip.hasClass('ba-bottom')) {
            top = coord.bottom;
        }
        top += 80;
        span.className = className;
        if (app.blogEditor) {
            span.classList.add('blog-editor');
        }
        span.innerHTML = data;
        span.addEventListener('mousedown', function(event){
            event.stopPropagation();
        });
        window.parent.document.body.appendChild(span);
        var tooltip = $g(span),
            width = tooltip.outerWidth(),
            height = tooltip.outerHeight();
        if (tooltip.hasClass('ba-top') || tooltip.hasClass('ba-help')
            || tooltip.hasClass('tooltip-delay') || tooltip.hasClass('add-section-tooltip')) {
            top -= (5 + height);
            center -= (width / 2);
        }
        if (tooltip.hasClass('ba-bottom')) {
            top += 10;
            center -= (width / 2)
        }
        span.style.top = top+'px';
        span.style.left = center+'px';
        if (breakpoints[app.view]) {
            span.style.marginLeft = 'calc((100vw - '+breakpoints[app.view]+'px)/2)';
        }
    }).off('mouseleave').on('mouseleave', function(){
        window.parent.app.hideIframesTooltip();
    });
}

app.listenMessage = function(obj){
    app.checkModule(obj.callback, obj);
}

app.checkView = function(){
    var width = $g(window).width();
    app.view = 'desktop';
    for (var ind in breakpoints) {
        if (width <= breakpoints[ind]) {
            app.view = ind;
        }
    }
}

app.resize = function(){
    clearTimeout(delay);
    app.checkView();
    delay = setTimeout(function(){
        if ($g('.ba-item-map').length > 0) {
            $g('.ba-item-map').each(function(){
                app.initmap(app.items[this.id], this.id);
            });
        }
    }, 300);
}

var lightboxVideo = {};

function lightboxVideoClose(item)
{
    var iframes = item.querySelectorAll('.ba-item-custom-html iframe, .ba-item-video iframe');
    for (var i = 0; i < iframes.length; i++) {
        var src = iframes[i].src,
            videoId = iframes[i].id;
        if (!lightboxVideo[videoId]) {
            continue;
        }
        if (src && src.indexOf('youtube.com') !== -1 && 'pauseVideo' in lightboxVideo[videoId]) {
            lightboxVideo[videoId].pauseVideo();
        } else if (src && src.indexOf('vimeo.com') !== -1 && 'pause' in lightboxVideo[videoId]) {
            lightboxVideo[videoId].pause();
        }
    }
    iframes = item.querySelectorAll('.ba-item-video video, .ba-item-custom-html video');
    for (var i = 0; i < iframes.length; i++) {
        var videoId = iframes[i].id;
        if (!lightboxVideo[videoId]) {
            continue;
        }
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

function showLightbox($this)
{
    if (!lightboxVideoOpen($this)) {
        return false;
    }
    $this.classList.add('visible-lightbox');
    document.body.classList.add('ba-lightbox-open');
    if (app.items[app.edit].position == 'lightbox-center') {
        var width = window.innerWidth - document.documentElement.clientWidth;
        document.body.classList.add('lightbox-open');
        document.body.style.width = 'calc(100% - '+width+'px)';
    }
}

app.initStickyHeaderPanel = function($this){
    var div = window.parent.document.createElement('div'),
        panel = '<p>Sticky Header</p>',
        panels = window.parent.document.getElementById('lightbox-panels');
    panel += '<span><i class="zmdi zmdi-edit"></i><span class="ba-tooltip settings-tooltip ba-top">'+
        'Edit</span></span><span><i class="zmdi zmdi-close"></i><span class="ba-tooltip'+
        ' settings-tooltip ba-top">Close</span></span><span><i class="zmdi '+
        'zmdi-delete"></i><span class="ba-tooltip settings-tooltip ba-top">Delete</span></span>';
    div.dataset.id = $this.id;
    div.className = 'lightbox-options-panel';
    div.innerHTML = panel;
    panels.appendChild(div);
    $g(div).find('.ba-tooltip').each(function(){
        window.parent.app.initTooltip($g(this).parent());
    });
    $g(div).find('i.zmdi-delete').off('click').on('click', function(){
        $g('#'+this.parentNode.parentNode.dataset.id).find(' > .ba-edit-item .delete-item').trigger('mousedown');
    });
    $g(div).find('i.zmdi-close').off('click').on('click', function(){
        $g('#'+this.parentNode.parentNode.dataset.id).parent().removeClass('visible-sticky-header');
        document.body.classList.remove('sticky-header-opened');
    });
    $g(div).find('i.zmdi-edit').off('click').on('click', function(){
        var section = $g('#'+this.parentNode.parentNode.dataset.id),
            animation = app.items[this.parentNode.parentNode.dataset.id].desktop.animation,
            top = window.pageYOffset;
        section.addClass(animation.effect);
        document.body.classList.add('sticky-header-opened');
        setTimeout(function(){
            section.removeClass(animation.effect);
        }, animation.delay * 1 + animation.duration * 1000);
        section.parent().addClass('visible-sticky-header').css('top', 40 - top);
        section.find(' > .ba-edit-item .edit-item').trigger('mousedown');
    });
}

app.initLightboxPanel = function($this){
    if ($g($this).closest('.ba-item-blog-content').length > 0) {
        return false;
    }
    var div = window.parent.document.createElement('div'),
        panel = '<p>Lightbox</p>',
        panels = window.parent.document.getElementById('lightbox-panels');
    if (app.items[$this.dataset.id].type == 'cookies') {
        panel = '<p>Cookies</p>'
    }
    panel += '<span><i class="zmdi zmdi-edit"></i><span class="ba-tooltip';
    panel += ' settings-tooltip ba-top">Edit</span></span>';
    if (app.items[$this.dataset.id].type == 'cookies') {
        panel += '<span><i class="zmdi zmdi-close"></i><span class="ba-tooltip';
        panel += ' settings-tooltip ba-top">Close</span></span>';
    }
    panel += '<span><i class="zmdi ';
    panel += 'zmdi-delete"></i><span class="ba-tooltip settings-tooltip ba-top">Delete</span></span>';
    div.dataset.id = $this.dataset.id;
    div.className = 'lightbox-options-panel';
    div.innerHTML = panel;
    panels.appendChild(div);
    $g(div).find('.ba-tooltip').each(function(){
        window.parent.app.initTooltip($g(this).parent());
    });
    $g(div).find('i.zmdi-delete').off('click').on('click', function(){
        $g('#'+this.parentNode.parentNode.dataset.id).find(' > .ba-edit-item .delete-item').trigger('mousedown');
    });
    $g(div).find('i.zmdi-close').off('click').on('click', function(){
        $g('.ba-lightbox-backdrop[data-id="'+this.parentNode.parentNode.dataset.id+'"]').removeClass('visible-lightbox');
        lightboxVideoClose($g('.ba-lightbox-backdrop[data-id="'+this.parentNode.parentNode.dataset.id+'"]')[0]);
        document.body.style.width = '';
        $g('body').removeClass('lightbox-open ba-lightbox-open');
    });
    $g(div).find('i.zmdi-edit').off('click').on('click', function(){
        $g('div.ba-lightbox-close').trigger('click');
        $g(panels).find('i.zmdi-close').trigger('click');
        app.edit = this.parentNode.parentNode.dataset.id;
        var item = document.querySelector('.ba-lightbox-backdrop[data-id="'+app.edit+'"]'),
            width = window.innerWidth - document.documentElement.clientWidth;
        if (app.items[app.edit][app.view].disable == 1 && !document.body.classList.contains('show-hidden-elements')) {
            item.classList.remove('visible-lightbox');
            document.body.classList.remove('lightbox-open');
            document.body.classList.remove('ba-lightbox-open');
            document.body.style.width = '';
        } else {
            showLightbox(item);
        }
        if (app.items[app.edit].type == 'cookies') {
            $g('#'+this.parentNode.parentNode.dataset.id).find(' > .ba-edit-item .edit-item').trigger('mousedown');
        } else {
            window.parent.app.edit = app.items[app.edit];
            window.parent.app.checkModule('lightboxEditor');
        }
    });
}

app.init = function(){
    var str = '> .ba-wrapper:not(.ba-lightbox):not(.ba-overlay-section):not(.ba-sticky-header)';
    str += ':not(.tabs-content-wrapper) > .ba-section > .ba-section-items';
    if (themeData.edit_type) {
        document.body.classList.add('ba-'+themeData.edit_type+'-editing');
    }
    makeRowSortable($g('header.header, footer.footer, #ba-edit-section, #blog-layout').find(str), 'row');
    str = '.tabs-content-wrapper > .ba-section > .ba-section-items'
    makeRowSortable($g(str), 'tabs-row');
    str = '.ba-wrapper:not(.ba-lightbox):not(.ba-overlay-section):not(.ba-sticky-header)';
    str += ' > .ba-section > .ba-section-items';
    str += ' > .ba-row-wrapper > .ba-row > .column-wrapper > .ba-grid-column-wrapper > .ba-grid-column';
    str += ', .ba-item-flipbox > .ba-flipbox-wrapper > .column-wrapper > .ba-grid-column-wrapper > .ba-grid-column';
    makeColumnSortable($g('header.header, footer.footer, #ba-edit-section, #blog-layout').find(str), 'column');
    str = ' > .ba-section > .ba-section-items';
    makeRowSortable($g('.ba-lightbox, .ba-overlay-section, .ba-sticky-header').find(str), 'lightbox-row');
    str += ' > .ba-row-wrapper > .ba-row > .column-wrapper > .ba-grid-column-wrapper > .ba-grid-column';
    makeColumnSortable($g('.ba-lightbox, .ba-overlay-section, .ba-wrapper[data-megamenu], .ba-sticky-header').find(str), 'lightbox-column');
    app.buttonsPrevent();
    $g('.ba-section').each(function(){
        editItem(this.id);
        setColumnResizer(this);
    });
    $g('.ba-item').each(function(){
        if (app.items[this.id]) {
            var obj = {
                data : app.items[this.id],
                selector : this.id
            };
            itemsInit.push(obj);
        }
        if (this.classList.contains('ba-item-blog-content')) {
            if (this.querySelector('.ba-item')) {
                this.classList.remove('empty-blog-content');
            } else {
                this.classList.add('empty-blog-content');
            }
        }
    });
    if (itemsInit.length > 0) {
        app.checkModule('initItems', itemsInit.pop());
    }
    app.checkVideoBackground();
    $g('.ba-lightbox-backdrop').find('.ba-lightbox-close').off('click').on('click', function(){
        $g(this).closest('.ba-lightbox-backdrop').removeClass('visible-lightbox');
        document.body.style.width = '';
        $g('body').removeClass('lightbox-open');
        document.body.classList.remove('ba-lightbox-open');
        lightboxVideoClose($g(this).closest('.ba-lightbox-backdrop')[0]);
    });
    window.parent.document.getElementById('lightbox-panels').innerHTML = '';
    $g('.ba-lightbox').each(function(){
        app.initLightboxPanel(this);
    });
    $g('.ba-sticky-header > .ba-section').each(function(){
        app.initStickyHeaderPanel(this);
    });
    $g('.ba-tooltip').each(function(){
        app.initTooltip($g(this).parent());
    });
    $g('.ba-edit-blog-post').off('mousedown').on('mousedown', function(){
        $g('.ba-item-blog-content > .ba-edit-item .edit-item').trigger('mousedown');
    });
    app.checkModule('loadParallax');
}

app.initGridboxEditor = function(){
    if (!themeData.edit_type) {
        $g('#ba-edit-section').sortable({
            handle : '.ba-wrapper > .ba-section > .ba-edit-item .edit-settings',
            change: function(element){
                $g(element).find('.ba-item').each(function(){
                    if (app.items[this.id].type == 'map') {
                        app.initmap(app.items[this.id], this.id);
                    }
                });
                app.checkModule('sectionRules');
                window.parent.app.addHistory();
            },
            selector : '> .ba-wrapper:not(.ba-lightbox):not(.ba-overlay-section)',
            group : 'section'
        });
    }
    $g('body').on('mouseover', '.ba-wrapper, .ba-row-wrapper, .ba-grid-column-wrapper', function(event){
        event.stopPropagation();
        $g('.active-item').removeClass('active-item');
        $g(this).addClass('active-item').parent().parents('.ba-grid-column-wrapper').addClass('active-item');
    }).on('mouseout', function(){
        $g('.active-item').removeClass('active-item');
    })/*.on('contextmenu', '.ba-item, .ba-row, .ba-section, .ba-grid-column, .ba-item [contenteditable="true"]', function(event){
        var target = event.currentTarget,
            flag = false,
            obj = {
                event: event,
                target: target,
                type: 'contextEvent'
            };
        if (flag = (target.classList.contains('ba-section') && app.items[target.id] && app.items[target.id].type == 'section')) {
            obj.context = 'section-context-menu';
        } else if (flag = (target.classList.contains('ba-row') && app.items[target.id] && app.items[target.id].type == 'row')) {
            obj.context = 'row-context-menu';
        } else if (flag = (target.classList.contains('ba-grid-column') && app.items[target.id] && app.items[target.id].type == 'column')) {
            obj.context = 'column-context-menu';
        } else if (flag = (target.classList.contains('ba-item') && app.items[target.id])) {
            obj.context = 'plugin-context-menu';
        }
        if (flag) {
            obj.itemType = app.items[target.id].type;
            obj.item = app.items[target.id];
            top.app.context = obj;
            top.app.checkModule('showContext');
        }
        if (!target.hasAttribute('contenteditable')) {
            event.preventDefault();
        }
        event.stopPropagation();
    });*/
    $g('body').on('mouseover', '.ba-item, .ba-row, .ba-grid-column-wrapper', function(event){
        var item = this,
            $this = $g(this),
            top = left = '';
        if (item.classList.contains('ba-grid-column-wrapper')) {
            $this = $this.closest('.ba-row');
            item = $this[0];
        }
        if ($this.closest('.ba-flipbox-wrapper').length > 0 && !$this.hasClass('sortable-helper')
            && !$this.hasClass('sortable-placeholder')) {
            var rect = item.getBoundingClientRect(),
                obj = app.items[item.id],
                parent = $this.closest('.ba-grid-column')[0].getBoundingClientRect();
            if (item.classList.contains('ba-row')) {
                top = rect.top - 25;
                left = rect.right - 100;
            } else {
                top = rect.top - 25 + ((rect.bottom - rect.top) / 2);
                left = parent.left - 25 + ((parent.right - parent.left) / 2);
            }
            if (obj && (obj.type == 'accordion' || obj.type == 'tabs')) {
                if (obj.type == 'tabs' && obj.position == 'tabs-left') {
                    left = rect.left + 10;
                } else if (obj.type == 'tabs' && obj.position == 'tabs-right') {
                    left = rect.right - 60;
                } else {
                    top = rect.top + 10;
                }
            }
        }
        $this.find('> .ba-edit-item').css({
            'top': top,
            'left': left
        });
    });
    $g(window).on('scroll', function(){
        $g('.ba-flipbox-wrapper').find('.ba-item, .ba-row').each(function(){
            var item = this,
                $this = $g(this),
                top = left = '';
            if ($this.closest('.ba-flipbox-wrapper').length > 0 && !$this.hasClass('sortable-helper')
                && !$this.hasClass('sortable-placeholder')) {
                var rect = item.getBoundingClientRect(),
                    obj = app.items[item.id],
                    parent = $this.closest('.ba-grid-column')[0].getBoundingClientRect();
                if (item.classList.contains('ba-row')) {
                    top = rect.top - 25;
                    left = rect.right - 100;
                } else {
                    top = rect.top - 25 + ((rect.bottom - rect.top) / 2);
                    left = parent.left - 25 + ((parent.right - parent.left) / 2);
                }
                if (obj && (obj.type == 'accordion' || obj.type == 'tabs')) {
                    if (obj.type == 'tabs' && obj.position == 'tabs-left') {
                        left = rect.left + 10;
                    } else if (obj.type == 'tabs' && obj.position == 'tabs-right') {
                        left = rect.right - 60;
                    } else {
                        top = rect.top + 10;
                    }
                }
            }
            $this.find('> .ba-edit-item').css({
                'top': top,
                'left': left
            });
        });
    });
    $g('body').on('mouseover', '.ba-item-flipbox > .ba-edit-item, .ba-row > .ba-edit-item', function(event){
        $g(this).closest('.ba-grid-column-wrapper').addClass('flipbox-edit-item-hovered');
    }).on('mouseout', '.ba-item-flipbox > .ba-edit-item, .ba-row > .ba-edit-item', function(event){
        $g(this).closest('.ba-grid-column-wrapper').removeClass('flipbox-edit-item-hovered');
    });
    app.checkAnimation();
    window.addEventListener('resize', app.resize);
    $g(window).on('scroll', function(){
        var top = window.pageYOffset,
            header = document.querySelector('header.header');
        if (header) {
            if (!('lastPageYOffset' in window)) {
                window.lastPageYOffset = top;
            }
            if (top > 40) {
                header.classList.add('fixed-header');
            } else {
                header.classList.remove('fixed-header');
            }
            if (getComputedStyle(header).position == 'fixed') {
                header.style.top = (40 - top)+'px'
            } else {
                header.style.top = '';
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
                    if (top - 40 >= offset * 1 && (!obj.scrollup || (obj.scrollup && top - window.lastPageYOffset < 0))) {
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
                if ((top - 40 < offset * 1 && !obj.scrollup) || (obj.scrollup && (top - window.lastPageYOffset > 0
                    || top - 40 <= offset * 1))) {
                    this.classList.remove('visible-sticky-header');
                    document.body.classList.remove('sticky-header-opened');
                }
            }).css('top', 40 - top);
            window.lastPageYOffset = top;
        }
        
    });
    $g('body').on('mousedown', function(){
        window.parent.postMessage('mousedown', "*");
    });
    app.pageCss = document.createElement('style');
    document.body.appendChild(app.pageCss);
    app.style = $g('#global-css-sheets style');
    $g('.modal').on('mousedown', function(event){
        $g(document).trigger(event);
        event.stopPropagation();
    });
    if ($g('.ba-item-overlay-section').length > 0) {
        app.checkModule('checkOverlay');
    }
    app.init();
    $g('.ba-add-section').on('mousedown', function(){
        window.parent.document.getElementById('add-section-dialog').classList.remove('add-columns');
        window.parent.app.checkModule('addSection');
    });
    window.parent.app.checkModule('windowLoaded');
}

app.gridboxEditorLoaded = function(){
    $g(window).on('keydown', function(event){
        window.parent.$g(window.parent).trigger(event);
    });
    $g('body').on('keydown', '.content-text[contenteditable]', function(event){
        event.stopPropagation();
    });
    if (!app.blogEditor) {
        $g.ajax({
            type: "POST",
            dataType: 'text',
            url: "index.php?option=com_gridbox&task=editor.getItems",
            data: themeData,
            complete: function(msg){
                var data = JSON.parse(msg.responseText);
                for (var key in data) {
                    if (key != 'theme') {
                        app.items = $g.extend(true, app.items, data[key]);
                    } else if (!data.theme.desktop.body) {
                        data.theme.desktop.body = $g.extend(true, {}, data.theme.desktop.p);
                    }
                }
                for (var ind in app.items) {
                    if (app.items[ind].type == 'footer') {
                        app.footer = app.items[ind];
                        break;
                    }
                }
                app.theme = data.theme;
                var preloader = window.parent.document.getElementsByClassName('preloader');
                preloader[0].classList.add('ba-hide');
                preloader[0].classList.remove('ba-preloader-slide');
                app.initGridboxEditor();
            }
        });
    } else {
        if (window.parent.document.querySelector('.show-hidden-elements').style.display == 'none') {
            document.body.classList.add('show-hidden-elements');
        }
        app.theme = window.parent.app.editor.app.theme;
        app.items = window.parent.app.editor.app.items;
        var content = window.parent.app.editor.document.getElementById('ba-edit-section'),
            styles = {
                width : window.parent.$g(content).closest('.ba-grid-column')[0].offsetWidth,
                column : window.parent.getComputedStyle(window.parent.$g(content).closest('.ba-grid-column')[0]).background,
                row : window.parent.getComputedStyle(window.parent.$g(content).closest('.ba-row')[0]).background,
                section : window.parent.getComputedStyle(window.parent.$g(content).closest('.ba-section')[0]).background,
            },
            html = content.innerHTML,
            scrollTop = window.parent.app.editor.document.querySelectorAll('.ba-item-scroll-to-top, .ba-social-sidebar'),
            baItems = window.parent.app.editor.document.querySelectorAll('.ba-search-result-modal');
        $g('#ba-edit-section').html(html);
        for (var i = 0; i < scrollTop.length; i++) {
            if (app.items[scrollTop[i].id]) {
                scrollTop[i].classList.remove('visible-scroll-to-top');
                var parent = app.items[scrollTop[i].id].parent,
                    column = $g('#'+parent);
                if (column.length > 0) {
                    var scrollItem = scrollTop[i].cloneNode(true);
                    scrollTop[i].parentNode.removeChild(scrollTop[i]);
                    column.find(' > .empty-item').before(scrollItem);
                }
            }
        }
        for (var i = 0; i < baItems.length; i++) {
            $g('#'+baItems[i].dataset.id).append(baItems[i]);
        }
        baItems = window.parent.app.editor.document.querySelectorAll('.ba-overlay-section-backdrop');
        for (var i = 0; i < baItems.length; i++) {
            var overlay =  document.querySelector('.ba-item-overlay-section[data-overlay="'+baItems[i].dataset.id+'"]');
            if (overlay) {
                overlay.appendChild(baItems[i]);
            }
        }
        $g('#ba-edit-section').parent().css({
            background: styles.column,
            width : styles.width
        }).parent().css('background', styles.row).parent().css('background', styles.section);
        document.body.style.borderLeftWidth = 'calc((100vw - '+styles.width+'px)/2)';
        document.body.style.borderRightWidth = 'calc((100vw - '+styles.width+'px)/2)';
        app.initGridboxEditor();
        app.loadModule('backgroundRule');
        if (document.querySelector('.ba-item-gallery')) {
            initGalleries();
        }
        window.parent.app.editor = window.parent.frames['blog-editor'];
    }
}

function checkMegamenuLibrary(item)
{
    item.find('.ba-grid-column > .ba-edit-item').each(function(){
        var $this = $g(this),
            wrapper = $this.closest('.ba-wrapper');
        $this.find('.add-library-item').parent().remove();
        if (!wrapper.hasClass('tabs-content-wrapper') && !wrapper.hasClass('ba-overlay-section') && !wrapper.hasClass('ba-lightbox')) {
            if ($this.find('.add-columns-in-columns').length == 0) {
                var str = '<span class="ba-edit-wrapper"><i class="zmdi zmdi-sort-amount-desc add-columns-in-columns"></i>',
                    lib = window.parent.gridboxLanguage ? window.parent.gridboxLanguage['NESTED_ROW'] : 'Nested Row';
                str += '<span class="ba-tooltip tooltip-delay settings-tooltip">'+lib;
                str += '</span></span>';
                var icon = $this.find('.ba-edit-wrapper:last-child').after(str).next();
                app.initTooltip(icon);
            }
        }
        if (wrapper.attr('data-megamenu') || app.blogEditor || wrapper.hasClass('ba-overlay-section') || wrapper.hasClass('ba-lightbox')) {
            var str = '<span class="ba-edit-wrapper"><i class="zmdi zmdi-collection-text add-library-item"></i>',
                lib = window.parent.gridboxLanguage ? window.parent.gridboxLanguage['LIBRARY'] : 'Library';
            str += '<span class="ba-tooltip tooltip-delay settings-tooltip">'+lib;
            str += '</span></span>';
            var icon = $this.find('.ba-edit-wrapper:last-child').after(str).next();
            app.initTooltip(icon);
        }
    });
    item.find('.ba-edit-item').each(function(){
        var $this = $g(this);
        if ($this.parent().hasClass('ba-row') && $this.find('.modify-columns').length == 0) {
            var str = '<span class="ba-edit-wrapper"><i class="zmdi zmdi-graphic-eq modify-columns"></i>',
                    lib = window.parent.gridboxLanguage ? window.parent.gridboxLanguage['MODIFY_COLUMNS'] : 'Modify Columns';
                str += '<span class="ba-tooltip tooltip-delay settings-tooltip">'+lib;
                str += '</span></span>';
                var icon = $this.find('.ba-edit-wrapper').last().before(str).prev();
                app.initTooltip(icon);
        }
    });
    item.find('.ba-section-items + .ba-edit-wrapper').each(function(){
        $g(this).parent().find('> .ba-edit-item .ba-buttons-wrapper').prepend(this);
    });
}

function editItem(id)
{
    var item = $g('#'+id);
    checkMegamenuLibrary(item);
    item.find('.open-overlay-item').off('mousedown').on('mousedown', function(){
        $g(this).parent().trigger('mouseleave');
        var parent = $g(this).closest('.ba-edit-item').parent()[0],
            overlay = document.querySelector('.ba-overlay-section-backdrop[data-id="'+parent.dataset.overlay+'"]');
        app.edit = overlay.querySelector('.ba-section').id;
        $g(parent).find('a').trigger('click');
        window.parent.app.edit = app.items[app.edit];
        window.parent.app.checkModule('lightboxEditor');
    });
    item.find('.flip-flipbox-item').off('mousedown').on('mousedown', function(){
        if (this.fliped == 'started') {
            return false;
        }
        this.fliped = 'started';
        $g(this).parent().trigger('mouseleave');
        var $this = this,
            parent = $g(this).closest('.ba-item-flipbox'),
            id = parent.attr('id'),
            obj = app.items[id];
        parent.addClass('flipbox-animation-started');
        setTimeout(function(){
            $this.fliped = 'ended';
            parent.removeClass('flipbox-animation-started');
        }, obj.desktop.animation.duration * 1000);
        if (obj.side == 'frontside') {
            obj.side = 'backside';
            parent.addClass('backside-fliped');
        } else {
            obj.side = 'frontside';
            parent.removeClass('backside-fliped');
        }
    });
    item.find('.open-search-results').off('mousedown').on('mousedown', function(){
        var id = $g(this).closest('.ba-item').attr('id');
        openSearchModal(document.querySelector('.ba-search-result-modal[data-id="'+id+'"]'));
    });
    item.find('.edit-item').off('mousedown').on('mousedown', function(event){
        event.stopPropagation();
        $g(this).closest('li.megamenu-item').addClass('megamenu-editing')
            .closest('.ba-row-wrapper').addClass('row-with-megamenu')
            .closest('.ba-wrapper').addClass('section-with-megamenu')
            .closest('body').addClass('body-megamenu-editing');
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-edit-item').parent()[0].id;
        $g('body').trigger('mousedown');
        app.checkModule('editItem');
    });
    item.find('.add-library-item').off('mousedown').on('mousedown', function(event){
        event.stopPropagation();
        $g(this).closest('li.megamenu-item').addClass('megamenu-editing')
            .closest('.ba-row-wrapper').addClass('row-with-megamenu')
            .closest('.ba-wrapper').addClass('section-with-megamenu')
            .closest('body').addClass('body-megamenu-editing');
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-grid-column')[0].id;
        window.parent.app.checkModule('addMegamenuLibrary');
    });
    item.find('.flipbox-add-item').off('mousedown').on('mousedown', function(){
        var flipbox = $g(this).closest('.ba-item-flipbox'),
            id = flipbox.attr('id'),
            search = ' > .ba-flipbox-wrapper > .ba-flipbox-'+app.items[id].side;
        flipbox.find(search+' > .ba-grid-column-wrapper > .ba-grid-column > .empty-item span span').trigger('mousedown');
    });
    item.find('.add-item, .empty-item span span, .empty-item span i').off('mousedown').on('mousedown', function(){
        $g(this).closest('li.megamenu-item').addClass('megamenu-editing')
            .closest('.ba-row-wrapper').addClass('row-with-megamenu')
            .closest('.ba-wrapper').addClass('section-with-megamenu')
            .closest('body').addClass('body-megamenu-editing');
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-grid-column')[0].id;
        app.checkModule('sectionRules');
        window.parent.app.checkModule('addPlugins');
    });
    item.find('.delete-item').off('mousedown').on('mousedown', function(){
        $g(this).closest('li.megamenu-item').addClass('megamenu-editing')
            .closest('.ba-row-wrapper').addClass('row-with-megamenu')
            .closest('.ba-wrapper').addClass('section-with-megamenu')
            .closest('body').addClass('body-megamenu-editing');
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-edit-item').parent()[0].id;
        var item = $g('#'+app.edit);
        if (item.hasClass('row-with-intro-items') || item.parent().hasClass('row-with-intro-items') ||
            item.find('.row-with-intro-items').length > 0) {
            window.parent.app.showNotice(window.parent.gridboxLanguage['DEFAULT_ITEMS_NOTICE'], 'ba-alert');
        } else {
            window.parent.app.checkModule('deleteItem');
        }
    });
    item.find('.copy-item').off('mousedown').on('mousedown', function(){
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-edit-item').parent()[0].id;
        var item = $g('#'+app.edit);
        if (item.hasClass('row-with-intro-items') || item.parent().hasClass('row-with-intro-items') ||
            item.find('.row-with-intro-items').length > 0) {
            window.parent.app.showNotice(window.parent.gridboxLanguage['DEFAULT_ITEMS_NOTICE'], 'ba-alert');
        } else {
            app.checkModule('copyItem');
        }
    });
    item.find('.modify-columns').off('mousedown').on('mousedown', function(){
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-edit-item').parent()[0].id;
        window.parent.document.getElementById('add-section-dialog').classList.add('add-columns');
        window.parent.document.getElementById('add-section-dialog').classList.remove('blog-editor');
        window.parent.app.checkModule('addSection');
    });
    item.find('.add-columns-in-columns').off('mousedown').on('mousedown', function(){
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-grid-column')[0].id;
        window.parent.document.getElementById('add-section-dialog').classList.add('add-columns');
        window.parent.document.getElementById('add-section-dialog').classList.remove('blog-editor');
        window.parent.app.checkModule('addSection');
    });
    item.find('.add-nested-row').off('mousedown').on('mousedown', function(){
        $g(this).parent().trigger('mouseleave');
        var parent = $g(this).closest('.ba-edit-item').parent(),
            key = parent[0].id,
            search = '> .ba-flipbox-wrapper > .ba-flipbox-'+app.items[key].side;
        app.edit = parent.find(search+' > .ba-grid-column-wrapper > .ba-grid-column')[0].id;
        window.parent.document.getElementById('add-section-dialog').classList.add('add-columns');
        window.parent.document.getElementById('add-section-dialog').classList.remove('blog-editor');
        window.parent.app.checkModule('addSection');
    });
    item.find('.add-columns').off('mousedown').on('mousedown', function(){
        $g(this).closest('li.megamenu-item').addClass('megamenu-editing')
            .closest('.ba-row-wrapper').addClass('row-with-megamenu')
            .closest('.ba-wrapper').addClass('section-with-megamenu')
            .closest('body').addClass('body-megamenu-editing');
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-section')[0].id;
        window.parent.document.getElementById('add-section-dialog').classList.add('add-columns');
        if (app.blogEditor) {
            window.parent.document.getElementById('add-section-dialog').classList.add('blog-editor');
        } else {
            window.parent.document.getElementById('add-section-dialog').classList.remove('blog-editor');
        }
        window.parent.app.checkModule('addSection');
    });
    item.find('.add-library').off('mousedown').on('mousedown', function(){
        $g(this).parent().trigger('mouseleave');
        app.edit = $g(this).closest('.ba-edit-item').parent()[0].id;
        if (item.hasClass('row-with-intro-items') || item.parent().hasClass('row-with-intro-items') ||
            item.find('.row-with-intro-items').length > 0) {
            window.parent.app.showNotice(window.parent.gridboxLanguage['DEFAULT_ITEMS_NOTICE'], 'ba-alert');
        } else {
            window.parent.app.checkModule('addLibrary');
        }
    });
}

function makeColumnSortable(parent, group)
{
    var handle = '> .ba-item:not(.ba-item-scroll-to-top):not(.ba-social-sidebar)';
    handle += ':not(.side-navigation-menu) > .ba-edit-item .edit-settings';
    handle += ', > .ba-row-wrapper > .ba-row > .ba-edit-item .edit-settings';
    parent.each(function(){
        $g(this).sortable({
            handle : handle,
            selector : '> .ba-item, > .ba-row-wrapper',
            change: function(element){
                if (element.classList.contains('ba-row-wrapper')) {
                    $g(element).find('.ba-item').each(function(){
                        if (app.items[this.id].type == 'map') {
                            app.initmap(app.items[this.id], this.id);
                        }
                    });
                } else if (app.items[element.id].type == 'map') {
                    app.initmap(app.items[element.id], element.id);
                }
                app.checkModule('sectionRules');
                window.parent.app.addHistory();
            },
            group : group
        });
        if ($g(this).find('> .ba-row-wrapper').length > 0) {
            var str = ' > .ba-row-wrapper > .ba-row > .column-wrapper > .ba-grid-column-wrapper > .ba-grid-column';
            makeColumnSortable($g(this).find(str), group);
        }
    });
}

function makeRowSortable(parent, group)
{
    parent.each(function(){
        $g(this).sortable({
            handle : '> .ba-row-wrapper > .ba-row > .ba-edit-item .edit-settings',
            selector : '> .ba-row-wrapper',
            change: function(element){
                $g('.prevent-default').removeClass('prevent-default');
                $g(element).find('.ba-item').each(function(){
                    if (app.items[this.id].type == 'map') {
                        app.initmap(app.items[this.id], this.id);
                    }
                });
                app.checkModule('sectionRules');
                window.parent.app.addHistory();
            },
            start : function(el){
                if ($g(el).closest('.ba-item').length > 0) {
                    $g(el).closest('.ba-row').addClass('prevent-default');
                }
            },
            group : group
        });
    });
}

function setColumnResizer(item)
{
    $g(item).columnResizer({
        change : function(right, left){
            right.find('.ba-item').each(function(){
                if (app.items[this.id].type == 'map') {
                    app.initmap(app.items[this.id], this.id)
                }
            });
            left.find('.ba-item').each(function(){
                if (app.items[this.id].type == 'map') {
                    app.initmap(app.items[this.id], this.id)
                }
            });
            window.parent.app.addHistory();
        }
    });
}

app.gridboxEditorLoaded();
app.modules.gridboxEditorLoaded = true;