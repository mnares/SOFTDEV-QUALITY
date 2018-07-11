/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

function photoEditor(url)
{
    var canvas = document.getElementById('photo-editor'),
        obj = $g.extend(true, {}, itemDelete),
        container = $g(canvas),
        scaleH = 1,
        scaleV = 1,
        ctx = canvas.getContext('2d'),
        ocanvas = document.getElementById('ba-overlay-canvas'),
        octx = ocanvas.getContext('2d'),
        angle = 0,
        orig = new Image(),
        image = new Image(),
        lastAction = '',
        canvasSize = {
            width: $g('.resize-image-wrapper').width(),
            height: $g('.resize-image-wrapper').height()
        },
        keep = {
            enable: false,
            ratio: null
        },
        type = 'image/png',
        eState = {},
        prop = {};

    function getImageSize(width, height, imgWidth, imgHeight)
    {
        var ratio = imgWidth / imgHeight;
        if (imgWidth > width || imgHeight > height) {
            if (ratio > 1) {
                imgWidth = width;
                imgHeight = imgWidth / ratio;
                if (imgHeight > height) {
                    imgHeight = height;
                    imgWidth = imgHeight * ratio;
                }
            } else {
                imgHeight = height;
                imgWidth = imgHeight * ratio;
                if (imgWidth > width) {
                    imgWidth = width;
                    imgHeight = imgWidth / ratio;
                }
            }
        }
        eState.imgWidth = Math.floor(imgWidth);
        eState.imgHeight = Math.floor(imgHeight);
        canvas.width = eState.imgWidth;
        canvas.height = eState.imgHeight;
    }

    function generateOverlayCanvas()
    {
        var left = eState.oLeft - eState.minLeft,
            top = eState.oTop - eState.minTop;
        ocanvas.width = eState.oWidth;
        ocanvas.height = eState.oHeight;
        octx.save();
        octx.clearRect(0, 0, eState.oWidth, eState.oHeight);
        octx.drawImage(canvas, left, top, eState.oWidth, eState.oHeight, 0, 0, eState.oWidth, eState.oHeight)
        octx.restore();
    }

    function getImageType()
    {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url);
        xhr.responseType = "blob";
        xhr.onload = function() {
            if (xhr.status === 200) {
                type = xhr.response.type
            }
        };
        xhr.send();
    }

    image.onload = function(){
        getImageSize(canvasSize.width, canvasSize.height, this.width, this.height);
        ctx.drawImage(image, 0, 0, eState.imgWidth, eState.imgHeight);
        keep.ratio = this.width / this.height;
        init();
    }

    getImageType()
    orig.onload = restoreImage;
    orig.src = url;

    function checkSaveBtn()
    {
        if (image.src.indexOf('data:') === 0) {
            $g('.photo-editor-save-image').attr('data-context', 'save-image-context-menu');
        } else {
            $g('.photo-editor-save-image').removeAttr('data-context');
        }
    }

    function init()
    {
        $g('.ba-crop-overlay').off('mousedown').on('mousedown', startMoving)
            .find('.ba-crop-overlay-resize-handle').off('mousedown').on('mousedown', handleResize);
        $g('.flip-action').off('click').on('click', flip);
        $g('.rotate-action').off('click').on('click', rotate);
        $g('.crop-action').off('click').on('click', cropAction);
        $g('.resize-action').off('click').on('click', resizeAction);
        $g('.reset-image').off('click').on('click', restoreImage);
        $g('.keep-proportions').prop('checked', false).off('change').on('change', checkProportion);
        $g('.aspect-ratio-select input[type="hidden"]').val('original').prev().val(gridboxLanguage['ORIGINAL']);
        $g('.aspect-ratio-select').off('customAction').on('customAction', changeRatio);
        $g('.crop-width').off('input').on('input', cropWidth);
        $g('.crop-height').off('input').on('input', cropHeight);
        $g('.resize-width').off('input').on('input', resizeWidth);
        $g('.resize-height').off('input').on('input', resizeHeight);
        $g('.photo-editor-save-copy').off('mousedown').on('mousedown', function(){
            if (image.src.indexOf('data:') === 0) {
                $g('.photo-editor-file-title').val('');
                $g('#save-copy-dialog').modal().find('#apply-save-copy')
                    .removeClass('active-button').addClass('disable-button');
            }
        });
        $g('.photo-editor-file-title').off('input').on('input', function(){
            if (this.value.trim()) {
                $g('#apply-save-copy').addClass('active-button').removeClass('disable-button');
            } else {
                $g('#apply-save-copy').removeClass('active-button').addClass('disable-button');
            }
        });
        $g('#apply-save-copy').off('click').on('click', function(event){
            event.preventDefault();
            if (this.classList.contains('active-button')) {
                var object = {
                        ext: obj.ext,
                        name: obj.name,
                        path: obj.path,
                        title: $g('.photo-editor-file-title').val().trim()
                    },
                    data = JSON.stringify(object),
                    XHR = new XMLHttpRequest();
                XHR.onreadystatechange = function(e) {
                    if (XHR.readyState == 4) {
                        if (!Boolean(XHR.responseText)) {
                            $g('#save-copy-dialog').modal('hide');
                            obj.title = $g('.photo-editor-file-title').val().trim();
                            saveImage();
                        } else {
                            $g('#save-copy-notice-dialog').modal();
                        }
                    }
                };
                XHR.open("POST", JUri+'administrator/index.php?option=com_gridbox&task=uploader.checkFileExists', true);
                XHR.send(data);
            }
        });
        $g('#apply-overwrite-copy').off('click').on('click', function(event){
            event.preventDefault();
            $g('#save-copy-notice-dialog').modal('hide');
            $g('#save-copy-dialog').modal('hide');
            obj.title = $g('.photo-editor-file-title').val().trim();
            saveImage();
        });
        $g('.save-photo-editor-image').off('mousedown').on('mousedown', saveImage);
        container.off('mousedown.createOverlay').on('mousedown.createOverlay', createOverlay);
        $g('#photo-editor-dialog .resize-image-wrapper').addClass('photo-editor-loaded');
        setTimeout(function(){
            $g('.resize-image-wrapper').addClass('resize-enabled');
        }, 300);
        $g(window).off('resize.photoEditor').on('resize.photoEditor', function(){
            var offset = $g(canvas).offset();
            $g('.ba-crop-overlay').css({
                top : offset.top,
                left : offset.left
            });
        });
    }

    function saveImage()
    {
        obj.image = image.src;
        obj.quality = $g('.photo-editor-quality').val();
        if (obj.image.indexOf('data:') === 0) {
            var data = JSON.stringify(obj),
                XHR = new XMLHttpRequest(),
                str = gridboxLanguage['SAVING']+'<img src="'+JUri+'administrator/components/com_gridbox/assets/images/reload.svg"></img>';
            notification.find('p').html(str);
            notification.removeClass('animation-out').addClass('notification-in');
            XHR.onreadystatechange = function(e) {
                if (XHR.readyState == 4) {
                    showNotice(gridboxLanguage['SUCCESS_UPLOAD']);
                    window.frames['uploader-iframe'].location.href = window.frames['uploader-iframe'].location.href;
                    setTimeout(function(){
                        $g('#photo-editor-dialog').modal('hide');
                    }, 3000)
                }
            };
            XHR.open("POST", JUri+'administrator/index.php?option=com_gridbox&task=uploader.savePhotoEditorImage', true);
            XHR.send(data);
        }
    }

    function checkProportion()
    {
        keep.enable = this.checked;
        keepProportion();
        $g('.crop-action').addClass('active-button');
    }

    function changeRatio()
    {
        var ratio = $g('.aspect-ratio-select').find('input[type="hidden"]').val(),
            array = new Array();
        if (ratio == 'original') {
            ratio = image.width+':'+image.height;
        }
        array = ratio.split(':');
        keep.ratio = array[0] / array[1];
        keep.enable = true;
        $g('.keep-proportions')[0].checked = true;
        keepProportion();
        $g('.crop-action').addClass('active-button');
    }

    function keepProportion(wFlag, hFlag)
    {
        if (keep.enable) {
            var h = Math.floor(eState.oWidth / keep.ratio),
                w = Math.floor(eState.oWidth),
                t = eState.oTop,
                b = '';
            if (h > eState.imgHeight) {
                h = Math.floor(eState.oHeight);
                w = Math.floor(h * keep.ratio);
            }
            if (t + h > eState.cBottom) {
                t = '';
                b = document.documentElement.clientHeight - eState.cBottom;
            }
            $g('.ba-crop-overlay').css({
                width: w,
                top: t,
                bottom: b,
                height : h
            });
            saveEventState();
            generateOverlayCanvas();
            var width = w * prop.x,
                height = h * prop.y;
            if (image.width > image.height) {
                width = keep.ratio * height;
            } else {
                height = width / keep.ratio;
            }
            if (!wFlag) {
                $g('.crop-width').val(Math.round(width));
            }
            if (!hFlag) {
                $g('.crop-height').val(Math.round(height));
            }
        }
    }

    function resizeWidth()
    {
        var height = this.value / (image.width / image.height);
        $g('.resize-height').val(Math.round(height));
        $g('.resize-action').addClass('active-button');
    }

    function resizeHeight()
    {
        var width = this.value * (image.width / image.height);
        $g('.resize-width').val(Math.round(width));
        $g('.resize-action').addClass('active-button');
    }

    function cropWidth()
    {
        var w = this.value,
            l = eState.oLeft,
            r = '';
        if (w > image.width) {
            w = image.width;
        }
        w = Math.floor(w / prop.x);
        if (l + w > eState.cRight) {
            l = '';
            r = document.documentElement.clientWidth - eState.cRight;
        }
        $g('.ba-crop-overlay').css({
            width: w,
            left: l,
            right : r
        });
        saveEventState();
        generateOverlayCanvas();
        keepProportion(true, false);
        $g('.crop-action').addClass('active-button');
    }

    function cropHeight()
    {
        var h = this.value,
            t = eState.oTop,
            l = eState.oLeft,
            w = eState.oWidth,
            b = '';
        if (h > image.height) {
            h = image.height;
        }
        h = h / prop.y;
        if (t + h > eState.cBottom) {
            t = '';
            b = document.documentElement.clientHeight - eState.cBottom;
        }
        if (keep.enable) {
            w = h * keep.ratio;
            if (w > image.width / prop.x) {
                w = image.width / prop.x;
                h = w / keep.ratio
            }
        }
        $g('.ba-crop-overlay').css({
            width: w,
            height: h,
            left: l,
            right: '',
            top: t,
            bottom: b
        });
        saveEventState();
        generateOverlayCanvas();
        keepProportion(false, true);
        $g('.crop-action').addClass('active-button');
    }

    function hideOverlay()
    {
        var offset = $g(canvas).offset();
        $g('.ba-crop-overlay').css({
            top : offset.top,
            left : offset.left,
            width : canvas.width,
            height : canvas.height,
            bottom : '',
            right : ''
        });
        var width = Math.round(canvas.width * prop.x),
            height = Math.round(canvas.height * prop.y),
            propWidth = image.width,
            propHeight = image.height;
        if (width >= propWidth) {
            width = propWidth;
            height = propHeight;
        }
        if (height >= propHeight) {
            width = propWidth;
            height = propHeight;
        }
        $g('.crop-width, .resize-width').val(width);
        $g('.crop-height, .resize-height').val(height);
        saveEventState();
        generateOverlayCanvas();
    }

    function restoreImage(event)
    {
        event.preventDefault();
        if (this.localName == 'a' && !this.classList.contains('active-button')) {
            return false;
        }
        getImageSize(canvasSize.width, canvasSize.height, orig.width, orig.height);
        ctx.drawImage(orig, 0, 0, eState.imgWidth, eState.imgHeight);
        scaleH = 1;
        scaleV = 1;
        angle = 0;
        image.src = orig.src;
        saveProportion();
        hideOverlay();
        setRangeValue($g('.photo-editor-quality'), 100);
        checkSaveBtn();
        $g('#photo-editor-dialog').find('.active-button').removeClass('active-button');
    }

    function handleResize(event)
    {
        if (event.button == 0) {
            event.stopPropagation();
            saveEventState();
            var dir = this.dataset.resize
                item = $g('.ba-crop-overlay'),
                start = item.offset();
            start.bottom = start.top + eState.oHeight;
            start.right = start.left + eState.oWidth;
            item.css({
                'transition' : 'none'
            });
            $g(document).on('mousemove.resizable', function(e){
                var w = h = l = t = b = r = '';
                if (dir == 'bottom-right') {
                    w = e.clientX - start.left;
                    h = e.clientY - start.top;
                    b = document.documentElement.clientHeight - e.clientY;
                    r = document.documentElement.clientWidth - e.clientX;
                    if (w < 0) {
                        w = start.left - e.clientX;
                        r = document.documentElement.clientWidth - start.left;
                    }
                    if (h < 0) {
                        h = start.top - e.clientY;
                        b = document.documentElement.clientHeight - start.top;
                    }
                } else if (dir == 'top-right') {
                    w = e.clientX - start.left;
                    h = start.bottom - e.clientY;
                    t = e.clientY
                    r = document.documentElement.clientWidth - e.clientX;
                    if (w < 0) {
                        w = start.left - e.clientX;
                        r = document.documentElement.clientWidth - start.left;
                    }
                    if (h < 0) {
                        t = start.bottom;
                        h = e.clientY - start.bottom;
                    }
                } else if (dir == 'bottom-left') {
                    w = start.right - e.clientX;
                    h = e.clientY - start.top;
                    b = document.documentElement.clientHeight - e.clientY;
                    l = e.clientX;
                    if (w < 0) {
                        w = e.clientX - start.right;
                        l = start.right;
                    }
                    if (h < 0) {
                        h = start.top - e.clientY;
                        b = document.documentElement.clientHeight - start.top;
                    }
                } else if (dir == 'top-left') {
                    w = start.right - e.clientX;
                    h = start.bottom - e.clientY;
                    t = e.clientY;
                    l = e.clientX;
                    if (w < 0) {
                        w = e.clientX - start.right;
                        l = start.right;
                    }
                    if (h < 0) {
                        t = start.bottom;
                        h = e.clientY - start.bottom;
                    }
                }
                if (e.clientX >= eState.cRight) {
                    if (l !== '') {
                        w = eState.cRight - start.right;
                    } else {
                        w = eState.cRight - start.left;
                    }
                    if (r !== '') {
                        r = document.documentElement.clientWidth - eState.cRight;
                    }
                }
                if (e.clientY >= eState.cBottom) {
                    if (t !== '') {
                        h = eState.cBottom - start.bottom;
                    } else {
                        h = eState.cBottom - start.top;
                    }
                    if (b !== '') {
                        b = document.documentElement.clientHeight - eState.cBottom;
                    }
                }
                if (e.clientX <= eState.minLeft) {
                    if (r !== '') {
                        w = start.left - eState.minLeft;
                    } else {
                        w = start.right - eState.minLeft;
                    }
                    if (l !== '') {
                        l = eState.minLeft
                    }
                }
                if (e.clientY < eState.minTop) {
                    if (t !== '') {
                        h = start.bottom - eState.minTop;
                    } else {
                        h = start.top - eState.minTop;
                    }
                    if (t !== '') {
                        t = eState.minTop
                    }
                }
                if (keep.enable) {
                    h = w / keep.ratio;
                    t = '';
                    if (b !== '') {
                        b = document.documentElement.clientHeight - start.top - h;
                    } else {
                        b = document.documentElement.clientHeight - start.bottom;
                    }
                    if (document.documentElement.clientHeight - b - h < eState.minTop) {
                        h = document.documentElement.clientHeight - b - eState.minTop;
                        w = h * keep.ratio;
                        if (r !== '') {
                            r = document.documentElement.clientWidth - start.left - w;
                        }
                        if (l !== '') {
                            l = start.right - w;
                        }
                    } else if (document.documentElement.clientHeight - b > eState.cBottom) {
                        b = document.documentElement.clientHeight - eState.cBottom;
                        h = eState.cBottom - start.top;
                        w = h * keep.ratio;
                        if (r !== '') {
                            r = document.documentElement.clientWidth - start.left - w;
                        }
                        if (l !== '') {
                            l = start.right - w;
                        }
                    }
                }
                $g('.ba-crop-overlay').css({
                    width: w,
                    height: h,
                    left: l,
                    top: t,
                    bottom : b,
                    right: r
                });
                var width = w * prop.x,
                    height = h * prop.y;
                if (keep.enable) {
                    height = width / keep.ratio;
                }
                $g('.crop-width').val(Math.round(width));
                $g('.crop-height').val(Math.round(height));
                saveEventState();
                generateOverlayCanvas();
                return false;
            }).on('mouseup.resizable', function(event){
                saveEventState();
                jQuery(document).off('mousemove.resizable mouseup.resizable');
                $g('.crop-action').addClass('active-button');
            });
        }
    }

    function createOverlay(e)
    {
        if (e.button != 0 || !$g('#crop-image-options').hasClass('active')) {
            return false;
        }
        $g('.ba-crop-overlay').hide().css({
            top : e.clientY,
            left : e.clientX,
            width : 0,
            height : 0,
            bottom : e.clientY,
            right : e.clientX
        }).find('> *').hide();
        var start = {
            top : e.clientY,
            left : e.clientX,
            bottom : e.clientY,
            right : e.clientX
        };
        saveEventState();
        $g(document).on('mousemove.createOverlay', function(e){
            var w = h = r = b = '';
            w = e.clientX - start.left;
            h = e.clientY - start.top;
            b = document.documentElement.clientHeight - e.clientY;
            r = document.documentElement.clientWidth - e.clientX;
            if (w < 0) {
                w = start.left - e.clientX;
                r = document.documentElement.clientWidth - start.left;
            }
            if (h < 0) {
                h = start.top - e.clientY;
                b = document.documentElement.clientHeight - start.top;
            }
            if (e.clientX >= eState.cRight) {
                w = eState.cRight - start.left;
                r = document.documentElement.clientWidth - eState.cRight;
            }
            if (e.clientY >= eState.cBottom) {
                h = eState.cBottom - start.top;
                b = document.documentElement.clientHeight - eState.cBottom;
            }
            if (e.clientX <= eState.minLeft) {
                w = start.left - eState.minLeft;
            }
            if (e.clientY < eState.minTop) {
                h = start.top - eState.minTop;
            }
            $g('.ba-crop-overlay').css({
                top: '',
                left: '',
                width: w,
                height: h,
                bottom: b,
                right: r,
                display: ''
            });
            $g('.crop-width').val(Math.round(w * prop.x));
            $g('.crop-height').val(Math.round(h * prop.y));
            saveEventState();
            generateOverlayCanvas();
        }).on('mouseup.createOverlay', function(event){
            jQuery(document).off('mousemove.createOverlay mouseup.createOverlay');
            $g('.ba-crop-overlay').find('> *').css('display', '');
        });
        return false;
    }

    function saveEventState()
    {
        var overlay = $g('.ba-crop-overlay'),
            rect = overlay.offset();
        eState.oLeft = rect.left;
        eState.oTop = rect.top;
        eState.oWidth = overlay.outerWidth();
        eState.oHeight = overlay.outerHeight();
        rect = container.offset();
        eState.minLeft = rect.left;
        eState.maxLeft = rect.left + eState.imgWidth - eState.oWidth;
        eState.minTop = rect.top;
        eState.maxTop = rect.top + eState.imgHeight - eState.oHeight;
        eState.cRight = rect.left + eState.imgWidth;
        eState.cBottom = rect.top + eState.imgHeight;
    };

    function startMoving(e)
    {
        if (e.button != 0) {
            return false;
        }
        e.preventDefault();
        e.stopPropagation();
        saveEventState();
        eState.deltaX = e.clientX - eState.oLeft;
        eState.deltaY = e.clientY - eState.oTop;
        $g(document).on('mousemove', moving);
        $g(document).on('mouseup', endMoving);
    };

    function endMoving(e)
    {
        e.preventDefault();
        $g(document).off('mouseup', endMoving);
        $g(document).off('mousemove', moving);
        $g('.crop-action').addClass('active-button');
    };

    function moving(e)
    {
        e.preventDefault();
        e.stopPropagation();
        var x = e.clientX - eState.deltaX,
            y = e.clientY - eState.deltaY;
        if (x > eState.maxLeft) {
            x = eState.maxLeft;
        }
        if (x < eState.minLeft) {
            x = eState.minLeft;
        }
        if (y > eState.maxTop) {
            y = eState.maxTop;
        }
        if (y < eState.minTop) {
            y = eState.minTop;
        }
        $g('.ba-crop-overlay').css({
            'left': x,
            'top':  y
        });
        saveEventState();
        generateOverlayCanvas();
    }

    function transformImage()
    {
        if (angle == 90 || angle == 270) {
            getImageSize(canvasSize.width, canvasSize.height, image.height, image.width);
        } else {
            getImageSize(canvasSize.width, canvasSize.height, image.width, image.height);
        }
        ctx.save();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.translate(eState.imgWidth / 2, eState.imgHeight / 2);
        ctx.rotate(angle * Math.PI / 180);
        ctx.scale(scaleH, scaleV);
        if (angle == 90 || angle == 270) {
            ctx.drawImage(image, -eState.imgHeight / 2, -eState.imgWidth / 2, eState.imgHeight, eState.imgWidth);
        } else {
            ctx.drawImage(image, -eState.imgWidth / 2, -eState.imgHeight / 2, eState.imgWidth, eState.imgHeight);
        }
        ctx.restore();
        applyImageTransform();
    }

    function applyImageTransform()
    {
        $g('#photo-editor-dialog ul').off('click')
            .one('click', 'a[href="#resize-image-options"], a[href="#crop-image-options"]', function(event){
            event.preventDefault();
            event.stopPropagation();
            var cropC = document.createElement('canvas'),
                $this = this,
                context = cropC.getContext('2d'),
                str = gridboxLanguage['LOADING']+'<img src="'+JUri+'administrator/components/com_gridbox/assets/images/reload.svg"></img>';
            notification.find('p').html(str);
            notification.removeClass('animation-out').addClass('notification-in');
            if (angle == 90 || angle == 270) {
                cropC.width = image.height;
                cropC.height = image.width;
            } else {
                cropC.width = image.width;
                cropC.height = image.height;
            }
            context.translate(cropC.width / 2, cropC.height / 2);
            context.rotate(angle * Math.PI / 180);
            context.scale(scaleH, scaleV);
            context.drawImage(image, -image.width / 2, -image.height / 2);
            setTimeout(function(){
                image.onload = function(){
                    getImageSize(canvasSize.width, canvasSize.height, this.width, this.height);
                    ctx.save();
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(image, 0, 0, eState.imgWidth, eState.imgHeight);
                    ctx.restore();
                    scaleH = 1;
                    scaleV = 1;
                    angle = 0;
                    saveProportion();
                    hideOverlay();
                    keepProportion();
                    checkSaveBtn();
                    $g($this).trigger('click');
                    setTimeout(function(){
                        notification.addClass('animation-out').removeClass('notification-in');
                    }, 1500);
                }
                $g('#photo-editor-dialog').find('.active-button').removeClass('active-button');
                setRangeValue($g('.photo-editor-quality'), 100);
                image.src = cropC.toDataURL(type, 1);
                orig.onload = function(){};
                orig.src = image.src;
            }, 500);
        });
    }

    function rotate()
    {
        if (angle == 0) {
            angle = 360;
        }
        angle = (angle + this.dataset.rotate * 1) % 360;
        transformImage();
    }

    function flip()
    {
        if (this.dataset.flip == 'horizontal') {
            scaleH *= -1;
        } else {
            scaleV *= -1;
        }
        transformImage();
    }

    function saveProportion()
    {
        prop = {
            x: image.width / canvas.width,
            y: image.height / canvas.height,
        }
    }

    function cropAction(event)
    {
        if (!this.classList.contains('active-button')) {
            return false;
        }
        event.preventDefault();
        var cropC = document.createElement('canvas'),
            context = cropC.getContext('2d'),
            left = eState.oLeft - eState.minLeft,
            top = eState.oTop - eState.minTop,
            width = $g('.crop-width').val(),
            height = $g('.crop-height').val();
        cropC.width = width;
        cropC.height = height;
        context.save();
        context.clearRect(0, 0, cropC.width, cropC.height);
        context.drawImage(image, left * prop.x, top * prop.y, width, height, 0, 0, width, height);
        context.restore();
        image.onload = function(){
            getImageSize(canvasSize.width, canvasSize.height, this.width, this.height);
            ctx.save();
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(image, 0, 0, eState.imgWidth, eState.imgHeight);
            ctx.restore();
            scaleH = 1;
            scaleV = 1;
            angle = 0;
            saveProportion();
            hideOverlay();
            checkSaveBtn();
        }
        if (lastAction && lastAction != 'cropAction') {
            setRangeValue($g('.photo-editor-quality'), 100);
            orig.onload = function(){};
            orig.src = image.src;
        }
        image.src = cropC.toDataURL(type, 1);
        lastAction = 'cropAction';
        $g('#resize-image-options').find('.active-button').removeClass('active-button');
        $g('.crop-action').removeClass('active-button');
        $g('#crop-image-options .reset-image').addClass('active-button');
    }

    function resizeAction(event)
    {
        event.preventDefault();
        if (!this.classList.contains('active-button')) {
            return false;
        }
        var cropC = document.createElement('canvas'),
            context = cropC.getContext('2d'),
            width = $g('.resize-width').val(),
            quality = $g('.photo-editor-quality').val() / 100,
            height = $g('.resize-height').val();
        if (lastAction && lastAction != 'resizeAction') {
            setRangeValue($g('.photo-editor-quality'), 100);
            orig.onload = function(){};
            orig.src = image.src;
        }
        cropC.width = width;
        cropC.height = height;
        context.save();
        context.clearRect(0, 0, cropC.width, cropC.height);
        context.drawImage(orig, 0, 0, orig.width, orig.height, 0, 0, width, height);
        context.restore();
        image.onload = function(){
            getImageSize(canvasSize.width, canvasSize.height, this.width, this.height);
            ctx.save();
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(image, 0, 0, eState.imgWidth, eState.imgHeight);
            ctx.restore();
            scaleH = 1;
            scaleV = 1;
            angle = 0;
            saveProportion();
            hideOverlay();
            checkSaveBtn();
        }
        image.src = cropC.toDataURL(type, quality);
        lastAction = 'resizeAction';
        $g('#crop-image-options').find('.active-button').removeClass('active-button');
        $g('.resize-action').removeClass('active-button');
        $g('#resize-image-options .reset-image').addClass('active-button');
    }
}

function setRangeValue(input, value)
{
    var range = input.val(value).prev().val(value);
    setLinearWidth(range);
}

app.photoEditor = function(){
    var canvas = document.getElementById('photo-editor')
        ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.restore();
    $g('.crop-width, .crop-height, .resize-width, .resize-height').val('');
    $g('.photo-editor-save-image').removeAttr('data-context');
    setRangeValue($g('.photo-editor-quality'), 100);
    $g('#photo-editor-dialog .active').removeClass('active');
    $g('#photo-editor-dialog').find('ul li:first, #resize-image-options').addClass('active');
    $g('.resize-image-wrapper').removeClass('crop-enabled flip-rotate-enabled resize-enabled');
    $g('#photo-editor-dialog .resize-image-wrapper').removeClass('photo-editor-loaded');
    $g('#photo-editor-dialog').modal().find('.active-button').removeClass('active-button');
    $g('#photo-editor-dialog ul').off('click');
    setTimeout(function(){
        photoEditor(itemDelete.url);
    }, 600);
}
app.photoEditorQuality = function(){
    $g('#resize-image-options .resize-action').addClass('active-button');
}
$g('#photo-editor-dialog .nav-tabs').on('show', function(event){
    var className = event.target.hash.replace('image-options', '').replace('#', '')+'enabled';
    $g('.resize-image-wrapper').removeClass('crop-enabled flip-rotate-enabled resize-enabled').addClass(className);
});
$g('#photo-editor-dialog').on('mousedown', function(){
    $g('.save-image-context-menu').hide();
});
$g('.save-image-context-menu').on('mousedown', function(event){
    event.stopPropagation();
    this.style.display = 'none';
});
$g('#photo-editor-dialog').on('hide', function(){
    $g(window).off('resize.photoEditor');
});
$g('.photo-editor-save-image').on('click', function(event){
    if (this.dataset.context) {
        var rect = this.getBoundingClientRect(),
            target = this.dataset.context,
            context = document.getElementsByClassName(target)[0];
        context.style.top = rect.bottom+'px';
        context.style.left = rect.left+'px';
        context.style.display = 'block';
    }
});

app.photoEditor();