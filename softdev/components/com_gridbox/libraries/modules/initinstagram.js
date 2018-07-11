/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var file = document.createElement('script');
file.onload = function(){
    app.initinstagram(app.modules.initinstagram.data, app.modules.initinstagram.selector);
}
file.src = '{uri_root}/components/com_gridbox/libraries/instagram/instagram.js';
document.getElementsByTagName('head')[0].appendChild(file);

$g.ajax({
    type:"POST",
    dataType:'text',
    url:"index.php?option=com_gridbox&task=editor.getInstagramLang",
    complete: function(msg){
        app.instagramLanguage = JSON.parse(msg.responseText);
    }
});

function replaceInstagramTags(text, tags)
{
    var matches = text.match(/#\w+/g);
    if (matches) {
        for (var i = 0; i < matches.length; i++) {
            var str = '<a href="https://www.instagram.com/explore/tags/'+matches[i].replace('#', '')+
                '" target="_blank">'+matches[i]+'</a>';
            text = text.replace(matches[i], str);
        }
    }
    matches = text.match(/@\w+/g);
    if (matches) {
        for (var i = 0; i < matches.length; i++) {
            var str = '<a href="https://www.instagram.com/'+matches[i].replace('@', '')+
            '" target="_blank">'+matches[i]+'</a>';
            text = text.replace(matches[i], str);
        }
    }

    return text;
}

function createInstagramModal(wrapper, $this, parent)
{
    var div = document.createElement('div'),
        index = $this.dataset.key * 1,
        endCoords = startCoords = {},
        images = wrapper.data('instagram').images,
        image = images[index],
        modal = $g(div).attr('data-enableSlide', 'true'),
        str = '<div class="instagram-modal-image-wrapper"><img></div><div class="';
    div.className = 'ba-instagram-modal';
    str += 'instagram-modal-description-wrapper"></div></div><i class="zmdi zmdi-chevron-left"></i>';
    str += '<i class="zmdi zmdi-chevron-right"></i><i class="zmdi zmdi-close">';
    div.innerHTML = str;
    parent.appendChild(div);
    setInstagramImage(image, modal);
    modal.find('.zmdi-chevron-left').on('click', function(event){
        event.stopPropagation();
        index = instagramGetPrev(modal, images, index);
    });
    modal.find('.zmdi-chevron-right').on('click', function(event){
        event.stopPropagation();
        index = instagramGetNext(modal, images, index);
    });
    $g(parent).find('.zmdi-close, .instagram-modal-close').on('click', function(event){
        event.stopPropagation();
        instagramModalClose(modal)
    });
    modal.on('touchstart', function(event){
        endCoords = event.originalEvent.targetTouches[0];
        startCoords.pageX = event.originalEvent.targetTouches[0].pageX;
        startCoords.pageY = event.originalEvent.targetTouches[0].pageY;
    }).on('touchmove', function(event){
        endCoords = event.originalEvent.targetTouches[0];
    }).on('touchend', function(event){
        var vDistance = endCoords.pageY - startCoords.pageY,
            hDistance = endCoords.pageX - startCoords.pageX,
            xabs = Math.abs(endCoords.pageX - startCoords.pageX),
            yabs = Math.abs(endCoords.pageY - startCoords.pageY);
        if(hDistance >= 100 && xabs >= yabs) {
            index = instagramGetPrev(modal, images, index);
        } else if (hDistance <= -100 && xabs >= yabs) {
            index = instagramGetNext(modal, images, index);
        }
    }).on('click', '.play-instagram-video', function(event){
        event.stopPropagation();
        var player = modal.find('video')[0];
        this.style.display = 'none';
        player.play();
    }).on('click', '.pause-instagram-video', function(){
        var player = modal.find('video')[0];
        this.querySelector('.play-instagram-video').style.display = '';
        player.pause();
    });
    $g(window).on('keyup.instagram', function( event ) {
        event.preventDefault();
        event.stopPropagation();
        if (event.keyCode === 37) {
            index = instagramGetPrev(modal, images, index);
        } else if (event.keyCode === 39) {
            index = instagramGetNext(modal, images, index);
        } else if (event.keyCode === 27) {
            instagramModalClose(modal)
        }
    });
}

app.initinstagram = function(obj, key){
    var wrapper = $g('#'+key+' .instagram-wrapper');
    wrapper.instagram(obj.instagram);
    wrapper.off('click.lightbox').on('click.lightbox', '.ba-instagram-image', function(event){
        if (app.items[key].popup.enable) {
            if (!wrapper.data('instagram').images) {
                return false;
            }
            event.preventDefault();
            var div = document.createElement('div');
            div.className = 'ba-instagram-modal-wrapper';
            div.style.backgroundColor = app.getCorrectColor(app.items[key].lightbox.color);
            div.innerHTML = '<div class="instagram-modal-close"></div>'
            var width = window.innerWidth - document.documentElement.clientWidth;
            document.body.appendChild(div);
            document.body.style.width = 'calc(100% - '+width+'px)';
            document.body.classList.add('instagram-modal-open');
            createInstagramModal(wrapper, this, div);
        }
    });
    initItems();
}

function calcInstagramImages(modal, width, height, src, image)
{
    var imgWidth = width,
        imgHeight = height,
        percent = imgWidth / imgHeight,
        dWidth = window.innerWidth - 50,
        dHeight = window.innerHeight - 50,
        modalTop;
    if (app.view == 'desktop') {
        dWidth = dWidth - 350
    }
    if (imgWidth < dWidth && imgHeight < dHeight) {
        
    } else {
        if (imgWidth > imgHeight) {
            imgWidth = dWidth;
            imgHeight = imgWidth / percent;
        } else {
            imgHeight = dHeight;
            imgWidth = percent * imgHeight;
        }
        if (imgHeight > dHeight) {
            imgHeight = dHeight;
            imgWidth = percent * imgHeight;
        }
        if (imgWidth > dWidth) {
            imgWidth = dWidth;
            imgHeight = imgWidth / percent;
        }
    }
    modal.addClass('animate-instagram-image').animate({
        'width' : Math.round(imgWidth),
        'height' : Math.round(imgHeight)
    }, 300, function(){
        modal.removeClass('animate-instagram-image').attr('data-enableSlide', 'true');
        if (image.videos) {
            var video = '<video loop><source src="'+src+'" type="video/mp4"></video>'+
                '<div class="pause-instagram-video"><i class="zmdi zmdi-play play-instagram-video"></i></div>';
            modal.find('.instagram-modal-image-wrapper').html(video);
        } else {
            modal.find('.instagram-modal-image-wrapper').html('<img src="'+src+'">');
        }
        modal.find('.instagram-modal-image-wrapper img').attr('src', src);
        var text = image.caption ? replaceInstagramTags(image.caption.text) : '';
        str = '<div class="instagram-user-info"><a href="https://www.instagram.com/'+
            image.user.username+'" target="_blank"><img src="'+image.user.profile_picture+'"></a>'+
            '<a href="https://www.instagram.com/'+image.user.username+
            '" target="_blank">'+image.user.username+'</a></div><div class="instagram-image-description">'+
            text+'</div><div class="instagram-comments-wrapper">';
        for (var i = 0; i < image.comments.data.length; i++) {
            str += '<div class="instagram-comment"><span class="instagram-comment-autor'+
            '"><a href="https://www.instagram.com/'+
            image.comments.data[i].from.username+'" target="_blank">'+image.comments.data[i].from.username+
            '</a></span><span>'+replaceInstagramTags(image.comments.data[i].text)+'</span></div>';
        }
        str += '</div><div class="instagram-image-icons-wrapper">'+
            '<span><i class="zmdi zmdi-favorite"></i>'+image.likes.count+
            '</span><span><i class="zmdi zmdi-comment-text-alt"></i>'+image.comments.count+
            '</span><span>'+getInstagramDate(image.created_time * 1000)+'</span></div>';
        modal.find('.instagram-modal-description-wrapper').html(str);
    });
}

function setInstagramImage(image, modal)
{
    modal.attr('data-enableSlide', 'false');
    var player = modal.find('video')[0];
    if (player) {
        player.pause();
    }
    if (image.videos) {
        var $this = image.videos.standard_resolution;
        calcInstagramImages(modal, $this.width, $this.height, $this.url, image);
    } else {
        var img = document.createElement('img');
        img.onerror = function(){
            var $this = image.images.standard_resolution;
            calcInstagramImages(modal, $this.width, $this.height, $this.url, image);
            modal[0].dataset.locked = 'true';
        }
        img.onload = function(){
            calcInstagramImages(modal, this.width, this.height, this.src, image);
        }
        if (modal[0].dataset.locked == 'true') {
            img.src = image.images.standard_resolution.url;
        } else {
            img.src = image.link+'media/?size=l';
        }
    }
}

function getInstagramDate(time)
{
    var today = new Date(),
        past = new Date(time),
        tYear = today.getFullYear(),
        pYear = past.getFullYear(),
        diff = Math.floor(today.getTime() - past.getTime()),
        hour = 1000 * 60 * 60,
        days = Math.floor(diff / (hour * 24)),
        str = '';
    if (pYear < tYear) {
        str = past.getDate()+' '+app.instagramLanguage[past.getMonth()]+' '+pYear;
    } else if (days == 0) {
        var hours = Math.floor(diff / hour);
        str = hours > 1 ? hours+' '+app.instagramLanguage['HOURS_AGO'] : '1 '+app.instagramLanguage['HOURS_AGO'];
    } else if (days < 8) {
        str = days > 1 ? days+' '+app.instagramLanguage['DAYS_AGO'] : '1 '+app.instagramLanguage['DAY_AGO'];
    } else {
        str = past.getDate()+' '+app.instagramLanguage[past.getMonth()];
    }

    return str;
}

function instagramGetPrev(modal, images, index)
{
    if (modal.attr('data-enableSlide') != 'true') {
        return index;
    }
    var ind = images[index - 1] ? index - 1 : images.length - 1;
    image = images[ind];
    setInstagramImage(image, modal);

    return ind;
}

function instagramGetNext(modal, images, index)
{
    if (modal.attr('data-enableSlide') != 'true') {
        return index;
    }
    var ind = images[index + 1] ? index + 1 : 0;
    image = images[ind];
    setInstagramImage(image, modal);

    return ind;
}

function instagramModalClose(modal)
{
    var player = modal.find('video')[0];
    if (player) {
        player.pause();
    }
    $g(window).off('keyup.instagram');
    modal.parent().addClass('instagram-image-out');
    setTimeout(function(){
        modal.parent().remove();
        document.body.style.width = '';
        document.body.classList.remove('instagram-modal-open');
    }, 300);
}