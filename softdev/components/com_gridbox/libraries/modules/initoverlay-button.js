/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var overlayVideo = {};

function overlayClose(item)
{
    var iframes = item.querySelectorAll('.ba-item-custom-html iframe, .ba-item-video iframe');
    for (var i = 0; i < iframes.length; i++) {
        var src = iframes[i].src,
            videoId = iframes[i].id;
        if (src && src.indexOf('youtube.com') !== -1 && 'pauseVideo' in overlayVideo[videoId]) {
            overlayVideo[videoId].pauseVideo();
        } else if (src && src.indexOf('vimeo.com') !== -1 && 'pause' in overlayVideo[videoId]) {
            overlayVideo[videoId].pause();
        }
    }
    iframes = item.querySelectorAll('.ba-item-video video, .ba-item-custom-html video');
    for (var i = 0; i < iframes.length; i++) {
        var videoId = iframes[i].id;
        overlayVideo[videoId].pause();
    }
}

function overlayOpen(item)
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
                if (!overlayVideo[videoId] || !('playVideo' in overlayVideo[videoId])) {
                    overlayVideo[videoId] = new YT.Player(videoId, {
                        events: {
                            onReady: function(event){
                                if (item.classList.contains('visible-section')) {
                                    overlayVideo[videoId].playVideo();
                                }
                            }
                        }
                    });
                } else {
                    overlayVideo[videoId].playVideo();
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
                if (!overlayVideo[videoId] || !('play' in overlayVideo[videoId])) {
                    src = src.split('/');
                    src = src.slice(-1);
                    src = src[0].split('?');
                    src = src[0];
                    var options = {
                        id: src * 1,
                        loop: true,
                    };
                    overlayVideo[videoId] = new Vimeo.Player(videoId, options);
                }
                overlayVideo[videoId].play();
            }
        }
    }
    iframes = item.querySelectorAll('.ba-item-video video, .ba-item-custom-html video');
    for (var i = 0; i < iframes.length; i++) {
        if (!iframes[i].id) {
            iframes[i].id = id++;
        }
        videoId = iframes[i].id;
        if (!overlayVideo[videoId]) {
            overlayVideo[videoId] = iframes[i];
        }
        overlayVideo[videoId].play();
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
        overlayVideo.overlay = item;
    } else if (vimeo) {
        overlayVideo.overlay = item;
    }

    return !youtube && !vimeo;
}

app['initoverlay-button'] = function(obj, key){
    var button = $g('#'+key)[0],
        id = button.id,
        overlay = button.dataset.overlay;
    $g('#'+key+' > .ba-button-wrapper > a').on('click', function(event){
        event.preventDefault();
        var item = document.querySelector('.ba-overlay-section-backdrop[data-id="'+overlay+'"]');
        if (app.items[overlay][app.view].disable == 1 && !document.body.classList.contains('show-hidden-elements')) {
            item.classList.remove('visible-section');
            document.body.classList.remove('lightbox-open');
            document.body.classList.remove('ba-not-default-header');
        } else {
            if (overlayOpen(item)) {
                openOverlay(item);
            }
        }
    });
    $g('.ba-overlay-section-backdrop[data-id="'+overlay+'"] .ba-overlay-section-close').on('click', function(){
        var item = $g(this).closest('.ba-overlay-section-backdrop');
        item.removeClass('visible-section');
        if (!$g('.ba-overlay-section-backdrop').not(item).hasClass('visible-section')) {
            document.body.classList.remove('lightbox-open');
            document.body.classList.remove('ba-not-default-header');
            document.body.style.width = '';
        }
        item.find('div.ba-overlay-section-close').css('width', '');
        overlayClose(item[0]);
    }).on('mouseover', function(event){
        event.stopPropagation();
    });
    initItems();
}

function openOverlay(item)
{
    var style = document.querySelector('header.header') ? getComputedStyle(document.querySelector('header.header')): {},
        width = window.innerWidth - document.documentElement.clientWidth;
    document.body.style.width = 'calc(100% - '+width+'px)';
    item.querySelector('div.ba-overlay-section-close').style.width = 'calc(100% - '+width+'px)';
    item.classList.add('visible-section');
    document.body.classList.add('lightbox-open');
    if (style.position != 'relative') {
        document.body.classList.add('ba-not-default-header');
    }
}

app['initoverlay-button'](app.modules['initoverlay-button'].data, app.modules['initoverlay-button'].selector);