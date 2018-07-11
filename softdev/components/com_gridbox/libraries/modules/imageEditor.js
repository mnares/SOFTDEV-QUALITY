/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.imageEditor = function(){
    app.selector = '#'+app.editor.app.edit;
    $g('#image-settings-dialog .active').removeClass('active');
    $g('#image-settings-dialog a[href="#image-general-options"]').parent().addClass('active');
    $g('#image-general-options').addClass('active');
    $g('#image-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    var value = $g('#image-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#image-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#image-settings-dialog .class-suffix').val(app.edit.suffix);
    value = getValue('margin', 'top');
    $g('#image-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#image-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    setDisableState('#image-settings-dialog');
    $g('#image-settings-dialog').find('.video-item-options, .ba-image-options').css('display', '');
    setPresetsList($g('#image-settings-dialog'));
    switch(app.edit.type) {
        case 'image' :
            $g('#image-settings-dialog .video-item-options').hide();
            $g('#image-settings-dialog [data-option="image"]').val(app.edit.image);
            $g('#image-settings-dialog [data-option="alt"]').val(app.edit.alt);
            $g('#image-settings-dialog [data-option="align"].active').removeClass('active');
            value = getValue('style', 'align');
            $g('#image-settings-dialog [data-option="align"][data-value="'+value+'"]').addClass('active');
            value = getValue('style', 'width');
            value = $g('#image-settings-dialog .image-width input[data-option="width"]').val(value).prev().val(value);
            setLinearWidth(value);
            $g('#image-settings-dialog [data-option="link"]').val(app.edit.link.link);
            $g('#image-settings-dialog .link-target-select input[type="hidden"]').val(app.edit.link.target);
            value = $g('#image-settings-dialog .link-target-select li[data-value="'+app.edit.link.target+'"]').text();
            $g('#image-settings-dialog .link-target-select input[readonly]').val($g.trim(value));
            if (!app.edit.link.type) {
                app.edit.link.type = '';
            }
            $g('#image-settings-dialog .link-type-select input[type="hidden"]').val(app.edit.link.type);
            value = $g('#image-settings-dialog .link-type-select li[data-value="'+app.edit.link.type+'"]').text();
            $g('#image-settings-dialog .link-type-select input[readonly]').val($g.trim(value));
            $g('#image-settings-dialog [data-option="popup"]').prop('checked', app.edit.popup);
            value = app.edit.lightbox.color;
            updateInput($g('#image-settings-dialog input[data-option="color"][data-group="lightbox"]'), value);
            break;
        case 'video':
            $g('#image-settings-dialog .ba-image-options').hide();
            $g('.select-video-source input[type="hidden"]').val(app.edit.video.type);
            value = $g('.select-video-source li[data-value="'+app.edit.video.type+'"]').text().trim();
            $g('.select-video-source input[type="text"]').val(value);
            $g('.video-item-options input[data-option="id"]').val(app.edit.video.id);
            for (var ind in app.edit.video.vimeo) {
                $g('.video-item-options input[data-option="'+ind+'"][data-subgroup="video"]').prop('checked', app.edit.video.vimeo[ind]);
            }
            for (var ind in app.edit.video.youtube) {
                if (ind != 'start') {
                    $g('.video-item-options input[data-option="'+ind+'"][data-subgroup="youtube"]').prop('checked', app.edit.video.youtube[ind]);
                } else {
                    $g('.video-item-options input[data-option="'+ind+'"][data-subgroup="youtube"]').val(app.edit.video.youtube[ind]);
                }
            }
            for (var ind in app.edit.video.source) {
                if (ind != 'file') {
                    $g('.video-item-options input[data-option="'+ind+'"][data-subgroup="source"]').prop('checked', app.edit.video.source[ind]);
                } else {
                    $g('.video-item-options input[data-option="'+ind+'"][data-subgroup="source"]').val(app.edit.video.source[ind]);
                }
            }
            $g('.video-vimeo-options, .video-youtube-options, .video-source-options').hide();
            if (app.edit.video.type != 'source') {
                $g('#image-settings-dialog .video-id').css('display', '');
            } else {
                $g('#image-settings-dialog .video-id').hide();
            }
            $g('.video-'+app.edit.video.type+'-options').css('display', '');
            break;
    }
    value = getValue('shadow', 'value');
    value = $g('#image-settings-dialog input[data-option="value"][data-group="shadow"]').val(value).prev().val(value);
    setLinearWidth(value);
    value = getValue('shadow', 'color');
    updateInput($g('#image-settings-dialog input[data-option="color"][data-group="shadow"]'), value);
    value = getValue('border', 'radius');
    value = $g('#image-settings-dialog input[data-option="radius"][data-group="border"]').val(value).prev().val(value);
    setLinearWidth(value);
    value = getValue('border', 'width');
    value = $g('#image-settings-dialog input[data-option="width"][data-group="border"]').val(value).prev().val(value);
    setLinearWidth(value);
    value = getValue('border', 'color');
    updateInput($g('#image-settings-dialog input[data-option="color"][data-group="border"]'), value);
    value = getValue('border', 'style');
    $g('#image-settings-dialog .border-style-select input[type="hidden"]').val(value);
    value = $g('#image-settings-dialog .border-style-select li[data-value="'+value+'"]').text();
    $g('#image-settings-dialog .border-style-select input[readonly]').val($g.trim(value));
    $g('#image-settings-dialog').attr('data-edit', app.edit.type);
    setTimeout(function(){
        $g('#image-settings-dialog').modal();
    }, 150);
}

function setItemVideo()
{
    app.editor.$g(app.selector+' .ba-video-wrapper video').removeAttr('autoplay');
    if (app.edit.video.type != 'source') {
        var iframe = app.editor.document.querySelector(app.selector+' iframe'),
            src = 'https://www.youtube.com/embed/',
            obj = app.edit.video[app.edit.video.type];
        if (!iframe) {
            iframe = '<iframe src="" frameborder="0" allowfullscreen></iframe>';
            app.editor.document.querySelector(app.selector+' .ba-video-wrapper').innerHTML = iframe;
            iframe = app.editor.document.querySelector(app.selector+' iframe')
        }
        if (app.edit.video.type == 'vimeo') {
            src = 'https://player.vimeo.com/video/';
        }
        src += app.edit.video.id+'?';
        for (var ind in obj) {
            src += ind+'='+String(Number(obj[ind]))+'&';
        }
        iframe.src = src.substr(0, src.length - 1);
    } else {
        var obj = app.edit.video.source,
            video = '<video><source src="'+obj.file+'" type="video/mp4"></video>';
        app.editor.document.querySelector(app.selector+' .ba-video-wrapper').innerHTML = video;
        video = app.editor.document.querySelector(app.selector+' video');
        for (var ind in obj) {
            if (ind == 'autoplay' || ind == 'file') {
                continue;
            }
            if (obj[ind]) {
                video.setAttribute(ind, '');
            } else {
                video.removeAttribute(ind);
            }
        }
        var object = {
            data : app.edit,
            selector : app.editor.app.edit
        };
        app.editor.app.checkModule('initvideo', object);
    }
    app.addHistory();
}

$g('input[data-option="file"][data-group="video"]').on('click', function(){
    fontBtn = this;
    uploadMode = 'videoSource';
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
}).on('change', function(){
    app.edit.video.source.file = this.value;
    setItemVideo();
});

$g('.select-video-source').on('customAction', function(){
    app.edit.video.type = $g(this).find('input[type="hidden"]').val();
    app.edit.video.id = '';
    app.edit.video.source.file = '';
    setItemVideo();
    $g('.video-vimeo-options, .video-youtube-options, .video-source-options').hide();
    if (app.edit.video.type != 'source') {
        $g('#image-settings-dialog .video-id').css('display', '');
    } else {
        $g('#image-settings-dialog .video-id').hide();
    }
    $g('.video-'+app.edit.video.type+'-options').css('display', '').addClass('ba-active-options');
    $g('.video-item-options').find('input[data-option="id"], input[data-option="file"]').val('');
    setTimeout(function(){
        $g('.video-item-options .ba-active-options').removeClass('ba-active-options');
    }, 1);
});

$g('.video-item-options input[type="checkbox"]').on('change', function(){
    app.edit.video[this.dataset.subgroup][this.dataset.option] = this.checked;
    setItemVideo();
});

$g('.video-item-options input[data-option="start"]').on('input', function(){
    clearTimeout(delay);
    var $this = this;
    delay = setTimeout(function(){
        app.edit.video.youtube.start = $this.value;
        setItemVideo();
    }, 300);
});

$g('.video-item-options input[data-option="id"]').on('input', function(){
    clearTimeout(delay);
    var $this = this;
    delay = setTimeout(function(){
        app.edit.video.id = $this.value;
        setItemVideo();
    }, 300);
});

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.imageEditor = true;
app.imageEditor();