/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var file = document.createElement('link');
file.rel = 'stylesheet';
file.href = '{uri_root}components/com_gridbox/libraries/slideshow/css/animation.css';
document.getElementsByTagName('head')[0].appendChild(file);
file = document.createElement('script');
file.onload = function(){
    app.initslideshow(app.modules.initslideshow.data, app.modules.initslideshow.selector);
}
file.src = '{uri_root}components/com_gridbox/libraries/slideshow/js/slideshow.js';
document.getElementsByTagName('head')[0].appendChild(file);
app.videoSlides = {};

function onPlayerSlideshowReady(event)
{
    var obj = event.target,
        iframe = id = ind = null;
    for (var key in obj) {
        if (typeof(obj[key]) == 'object' && obj[key].localName == 'iframe') {
            id = obj[key].id;
            iframe = obj[key];
            break;
        }
    }
    ind = $g(iframe).closest('.ba-item')[0].id;
    var object = app.videoSlides[ind][id];
    if (object.mute) {
        event.target.mute();
    }
    if ($g(iframe).closest('li.item').hasClass('active') && $g(window).width() > 1024) {
        event.target.playVideo();
    }
}

app.initVideoSlides = function(obj){
    for (var ind in app.videoSlides[obj.key]) {
        var object = app.videoSlides[obj.key][ind];
        if (object.type == 'youtube' && app.youtube && !object.player) {
            object.player = new YT.Player(ind, {
                width: 1360,
                height: 765,
                videoId: object.id,
                playerVars: {
                    controls: 0,
                    showinfo: 0,
                    modestbranding: 1,
                    loop : 1,
                    start : object.start * 1,
                    autohide: 1,
                    iv_load_policy: 3,
                    wmode: 'transparent',
                    vq: object.quality
                },
                events: {
                    'onReady': onPlayerSlideshowReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        } else if (object.type == 'vimeo' && app.vimeo && !object.player) {
            var options = {
                    id: object.id,
                    loop: true,
                    byline : false,
                    portrait : false,
                    title : false
                },
                object = app.videoSlides[obj.key][ind];
            app.videoSlides[obj.key][ind].player = new Vimeo.Player(ind, options);
            if (object.mute) {
                object.player.setVolume(0);
            }
            object.player.setCurrentTime(object.start * 1);
            if ($g('#'+ind).closest('li.item').hasClass('active') && $g(window).width() > 1024) {
                object.player.play();
            }
        } else if (object.type == 'source' && object.source) {
            var object = app.videoSlides[obj.key][ind];
            object.player = document.createElement("video");
            object.player.loop = true;
            object.player.innerHTML = '<source src="'+object.source+'" type="video/mp4">';
            $g('#'+ind).html(object.player);
            if (object.mute == 1) {
                object.player.muted = true;
            }
            if (!object.start) {
                object.start = 0;
            }
            object.player.currentTime += object.start;
            if ($g('#'+ind).closest('li.item').hasClass('active') && $g(window).width() > 1024) {
                object.player.play();
            }
        }
    }
}

app.initslideshow = function(obj, key){
    var videoType = {},
        slides = obj.desktop.slides,
        content = $g('#'+key+' .slideshow-content');
    app.videoSlides[key] = {};
    $g('#'+key+' div.ba-slideshow-img').each(function(ind){
        if (slides[ind + 1] && slides[ind + 1].video) {
            var id = this.firstElementChild.id,
                div = document.createElement('div');
            div.id = id;
            this.innerHTML = ''
            this.appendChild(div);
            app.videoSlides[key][id] = $g.extend({}, obj.desktop.slides[ind + 1].video);
            if (!videoType[app.videoSlides[key][id].type]) {
                videoType[app.videoSlides[key][id].type] = app.videoSlides[key][id].type;
            }
        }
    });
    if (content.find('li.item').length == 0) {
        content.addClass('empty-content');
    } else {
        content.removeClass('empty-content');
    }
    for (var ind in videoType) {
        if ((ind == 'youtube' && !app.youtube && videoType.vimeo && !app.vimeo) ||
            (ind == 'vimeo' && !app.vimeo && videoType.youtube && !app.youtube)) {
            var object = {
                data : {
                    type : 'youtube+vimeo',
                    key : key
                },
                selector : null
            }
            app.checkModule('loadVideoApi', object);
            break;
        } else if (ind == 'youtube' && !app.youtube) {
            var object = {
                data : {
                    type : 'youtube',
                    key : key
                },
                selector : null
            }
            app.checkModule('loadVideoApi', object);
        } else if (ind == 'vimeo' && !app.vimeo) {
            var object = {
                data : {
                    type : 'vimeo',
                    key : key
                },
                selector : null
            }
            app.checkModule('loadVideoApi', object);
        } else if (ind == 'vimeo' && app.vimeo) {
            var object = {
                type : 'vimeo',
                key : key
            }
            app.initVideoSlides(object);
        } else if (ind == 'youtube' && app.youtube) {
            var object = {
                type : 'youtube',
                key : key
            }
            app.initVideoSlides(object);
        } else if (ind == 'source') {
            var object = {
                type : 'source',
                key : key
            }
            app.initVideoSlides(object);
        }
    }
    $g('#'+key+' ul.ba-slideshow').slideshow(obj.slideshow).off('slide').on('slide', function(event){
        if (!document.getElementById(key)) {
            return false;
        }
        var prevSLide = $g(event.prevItem).find('.ba-slideshow-img'),
            thisSlide = $g(event.currentItem).find('.ba-slideshow-img');
            id = prevSLide.children().attr('id'),
            object = app.videoSlides[key][id];
        if (object && object.player) {
            if (object.type == 'youtube' && typeof(object.player.pauseVideo) != 'undefined') {
                object.player.pauseVideo();
            } else if (object.type == 'vimeo' && typeof(object.player.pause) != 'undefined') {
                object.player.pause();
            } else if (object.type == 'source') {
                object.player.pause();
            }
        }
        var id = thisSlide.children().attr('id'),
            object = app.videoSlides[key][id];
        if (object && object.player) {
            if (object.type == 'youtube' && typeof(object.player.playVideo) != 'undefined') {
                if ($g(window).width() <= 1024) {
                    object.player.pauseVideo();
                } else {
                    object.player.playVideo();
                }
            } else if (object.type == 'vimeo' && typeof(object.player.play) != 'undefined') {
                if ($g(window).width() <= 1024) {
                    object.player.pause();
                } else {
                    object.player.play();
                }
            } else if (object.type == 'source') {
                if ($g(window).width() <= 1024) {
                    object.player.pause();
                } else {
                    object.player.play();
                }
            }
        }
    });
    initItems();
}