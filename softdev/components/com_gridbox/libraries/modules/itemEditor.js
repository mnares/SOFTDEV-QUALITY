/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$g('#item-settings-dialog .disqus-subdomen').on('input', function(){
    clearTimeout(delay);
    var $this = this;
    delay = setTimeout(function(){
        app.edit.subdomen = $this.value;
        app.editor.app.initdisqus(app.edit);
    }, 300);
});

app.itemEditor = function(){
    app.selector = '#'+app.editor.app.edit;
    $g('#item-settings-dialog .active').removeClass('active');
    $g('#item-settings-dialog a[href="#item-general-options"]').parent().addClass('active');
    $g('#item-general-options').addClass('active');
    $g('#item-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    var value = $g('#item-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#item-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#item-settings-dialog .class-suffix').val(app.edit.suffix);
    value = getValue('margin', 'top');
    $g('#item-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#item-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    if (app.edit.type == 'logo' || app.edit.type == 'simple-gallery' || app.edit.type == 'instagram') {
        $g('a[href="#item-design-options"]').parent().css('display', '');
    } else {
        $g('a[href="#item-design-options"]').parent().hide();
    }
    if (app.edit.type == 'logo') {
        $g('#item-settings-dialog [data-option="image"]').val(app.edit.image);
        $g('#item-settings-dialog [data-option="alt"]').val(app.edit.alt);
        $g('#item-settings-dialog [data-option="align"].active').removeClass('active');
        $g('#item-settings-dialog [data-option="align"][data-value="'+app.edit.align+'"]').addClass('active');
        value = getValue('width');
        value = $g('#item-settings-dialog .image-width input[data-option="width"]').val(value).prev().val(value);
        setLinearWidth(value);
        $g('#item-settings-dialog [data-option="text-align"].active').removeClass('active');
        value = getValue('text-align');
        $g('#item-settings-dialog [data-option="text-align"][data-value="'+value+'"]').addClass('active');
        $g('#item-settings-dialog [data-option="link"]').val(app.edit.link.link);
    } else if (app.edit.type == 'disqus') {
        $g('#item-settings-dialog .disqus-subdomen').val(app.edit.subdomen);
    } else if (app.edit.type == 'instagram' || app.edit.type == 'simple-gallery') {
        setPresetsList($g('#item-settings-dialog'));
        $g('.'+app.edit.type+'-options [data-option]').each(function(){
            if (app.edit[this.dataset.group]) {
                value = app.edit[this.dataset.group][this.dataset.option];
            } else if (this.dataset.group) {
                value = getValue(this.dataset.group, this.dataset.option);
            } else {
                value = getValue(this.dataset.option);
            }
            if (this.type == 'checkbox') {
                this.checked = value;
            } else if (this.dataset.type == 'color') {
                updateInput($g(this), value);
            } else {
                this.value = value;
                if (this.type == 'number') {
                    var range = $g(this).prev();
                    range.val(value);
                    setLinearWidth(range);
                }
            }
        });
    }
    if (app.edit.type == 'simple-gallery') {
        var images = app.editor.document.querySelectorAll('#'+app.editor.app.edit+' .ba-instagram-image img');
        sortingList = [];
        $g('#item-settings-dialog .sorting-container').html('');
        for (var i = 0; i < images.length; i++) {
            sortingList.push(images[i].dataset.src);
            $g('#item-settings-dialog .sorting-container').append(addSimpleSortingList(sortingList[i], i));
        }
    }
    setDisableState('#item-settings-dialog');
    $g('#item-settings-dialog').attr('data-edit', app.edit.type);
    if (app.edit.type == 'vk-comments') {
        var attach = app.edit.options.attach.split(',');
        $g('.vk-comments-attach').each(function(){
            if (attach[0] == '*' || attach.indexOf(this.dataset.option)) {
                this.checked = true;
            } else {
                this.checked = false;
            }
        });
        $g('.vk-comments-autopublish').prop('checked', Boolean(app.edit.options.autoPublish));
        $g('.vk-comments-app-id').val(app.edit.app_id);
        var range = $g('.vk-comments-limit').val(app.edit.options.limit).prev().val(app.edit.options.limit);
        setLinearWidth(range);
        $g('.vk-comments-options').css('display', '');
    } else {
        $g('.vk-comments-options').hide();
    }
    if (app.edit.type == 'facebook-comments') {
        $g('.facebook-comments-app-id').val(app.edit.app_id);
        var range = $g('.facebook-comments-limit').val(app.edit.options.limit).prev().val(app.edit.options.limit);
        setLinearWidth(range);
        $g('.facebook-comments-options').css('display', '');
    } else {
        $g('.facebook-comments-options').hide();
    }
    if (app.edit.type == 'hypercomments') {
        $g('.hypercomments-widget-id').val(app.edit.app_id);
        $g('.hypercomments-options').css('display', '');
    } else {
        $g('.hypercomments-options').hide();
    }
    setTimeout(function(){
        $g('#item-settings-dialog').modal();
    }, 150);
}

$g('.vk-comments-attach').on('change', function(){
    var attach = new Array(),
        str = '';
    $g('.vk-comments-attach').each(function(){
        if (this.checked) {
            attach.push(this.dataset.option);
        }
    });
    str = attach.join(',');
    if (str == 'graffiti,photo,audio,video,link') {
        str = '*';
    }
    app.edit.options.attach = str;
    app.editor.app.initvkcomments(app.edit);
    app.addHistory();
});

$g('.vk-comments-autopublish').on('change', function(){
    app.edit.options.autoPublish = Number(this.checked);
    app.editor.app.initvkcomments(app.edit);
    app.addHistory();
});

$g('.vk-comments-app-id').on('input', function(){
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit.app_id = $g('.vk-comments-app-id').val().trim();
        app.editor.app.initvkcomments(app.edit);
        app.addHistory();
    }, 300);
});

$g('.vk-comments-limit').on('input', function(){
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit.options.limit = Number($g('.vk-comments-limit').val().trim());
        app.editor.app.initvkcomments(app.edit);
        app.addHistory();
    }, 300);
});

$g('.facebook-comments-app-id').on('input', function(){
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit.app_id = $g('.facebook-comments-app-id').val().trim();
        app.editor.app.initfacebookcomments(app.edit);
        app.addHistory();
    }, 300);
});

$g('.facebook-comments-limit').on('input', function(){
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit.options.limit = Number($g('.facebook-comments-limit').val().trim());
        app.editor.app.initfacebookcomments(app.edit);
        app.addHistory();
    }, 300);
});

$g('.hypercomments-widget-id').on('input', function(){
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit.app_id = $g('.hypercomments-widget-id').val().trim();
        app.editor.app.inithypercomments(app.edit);
        app.addHistory();
    }, 300);
});

function addSimpleSortingList(image, key)
{
    var str = '<div class="sorting-item" data-key="'+key,
        array = image.split('/');
    str += '"><div class="sorting-handle"><i class="zmdi zmdi-apps"></i></div>';
    str += '<div class="sorting-image">';
    str += '<img src="'+app.editor.JUri+image+'">';
    str += '</div><div class="sorting-title">';
    str += array[array.length - 1];
    str += '</div><div class="sorting-icons">';
    str += '<span><i class="zmdi zmdi-edit"></i></span>';
    str += '<span><i class="zmdi zmdi-delete"></i></span></div></div>';

    return str;
}

$g('#item-settings-dialog .sorting-container').on('click', '.zmdi.zmdi-delete', function(){
    app.itemDelete = $g(this).closest('.sorting-item').attr('data-key');
    app.checkModule('deleteItem');
});

$g('#item-settings-dialog .sorting-container').on('click', '.zmdi.zmdi-edit', function(){
    uploadMode = 'reselectSimpleImage';
    app.itemDelete = $g(this).closest('.sorting-item').attr('data-key');
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
});

$g('#item-settings-dialog .add-new-item .zmdi-plus-circle').on('click', function(){
    uploadMode = 'addSimpleImages';
    app.itemDelete = $g(this).closest('.sorting-item').attr('data-key');
    checkIframe($g('#uploader-modal').attr('data-check', 'multiple'), 'uploader');
});

$g('#item-settings-dialog input[data-group="instagram"]').on('input', function(){
    var $this = this;
    if (this.dataset.option == 'max' && this.value > 20) {
        this.value = 20;
    }
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit.instagram[$this.dataset.option] = $this.value;
         var object = {
            data : app.edit,
            selector : app.editor.app.edit
        };
        app.editor.app.checkModule('initinstagram', object);
        app.addHistory();
    }, 300);
});

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.itemEditor = true;
app.itemEditor();