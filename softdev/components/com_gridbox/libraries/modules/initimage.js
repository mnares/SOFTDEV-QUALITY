/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.initimage = function(obj, key){
    $g('#'+key+' img').off('click.lightbox').on('click.lightbox', function(){
        if (app.items[key].popup && this.parentNode.localName != 'a') {
            var div = document.createElement('div'),
                width = this.width,
                height = this.height,
                offset = $g(this).offset(),
                imgHeight = this.naturalHeight,
                imgWidth = this.naturalWidth,
                modal = $g(div),
                wWidth = $g(window).width(),
                wHeigth = $g(window).height(),
                percent = imgWidth / imgHeight,
                flag = true,
                img = document.createElement('img');
            img.style.borderRadius = getComputedStyle(this).borderRadius;
            img.src = this.src;
            div.className = 'ba-image-modal';
            div.style.top = (offset.top - $g(window).scrollTop())+'px';
            div.style.left = offset.left+'px';
            div.style.width = width+'px';
            div.style.height = height+'px';
            div.style.backgroundColor = app.getCorrectColor(app.items[key].lightbox.color);
            div.appendChild(img);
            modal.on('click', function(){
                this.classList.add('image-lightbox-out');
                modal.css({
                    'width' : width,
                    'height' : height,
                    'left' : offset.left,
                    'top' : offset.top - $g(window).scrollTop()
                });
                setTimeout(function(){
                    modal.remove();
                }, 500);
            });
            $g('body').append(div);
            if (wWidth > 1024) {
                if (imgWidth < wWidth && imgHeight < wHeigth) {
                
                } else {
                    if (imgWidth > imgHeight) {
                        imgWidth = wWidth - 100;
                        imgHeight = imgWidth / percent;
                    } else {
                        imgHeight = wHeigth - 100;
                        imgWidth = percent * imgHeight;
                    }
                    if (imgHeight > wHeigth) {
                        imgHeight = wHeigth - 100;
                        imgWidth = percent * imgHeight;
                    }
                    if (imgWidth > wWidth) {
                        imgWidth = wWidth - 100;
                        imgHeight = imgWidth / percent;
                    }
                }
            } else {
                percent = imgWidth / imgHeight;
                if (percent >= 1) {
                    imgWidth = wWidth * 0.90;
                    imgHeight = imgWidth / percent;
                    if (wHeigth - imgHeight < wHeigth * 0.1) {
                        imgHeight = wHeigth * 0.90;
                        imgWidth = imgHeight * percent;
                    }
                } else {
                    imgHeight = wHeigth * 0.90;
                    imgWidth = imgHeight * percent;
                    if (wWidth - imgWidth < wWidth * 0.1) {
                        imgWidth = wWidth * 0.90;
                        imgHeight = imgWidth / percent;
                    }
                }
            }
            var modalTop = (wHeigth - imgHeight) / 2,
                left = (wWidth - imgWidth) / 2;
            setTimeout(function(){
                modal.css({
                    'width' : Math.round(imgWidth),
                    'height' : Math.round(imgHeight),
                    'left' : Math.round(left),
                    'top' : Math.round(modalTop)
                });
            }, 100);
        }
    });
    initItems();
}

app.initimage(app.modules.initimage.data, app.modules.initimage.selector);