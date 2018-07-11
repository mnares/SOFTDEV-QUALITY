/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.introPostEditor = function(){
    app.selector = '#'+app.editor.app.edit;
    $g('#intro-post-settings-dialog .active').removeClass('active');
    $g('#intro-post-settings-dialog a[href="#intro-post-general-options"]').parent().addClass('active');
    $g('#intro-post-general-options').addClass('active');
    $g('#intro-post-settings-dialog').attr('data-edit', app.edit.type);
    var items = app.editor.document.querySelector(app.selector+' .intro-post-wrapper').children;
    $g('#intro-post-settings-dialog .sorting-container').empty();
    for (var i = 0; i < items.length; i++) {
        var title = key = items[i].className.replace('intro-post-', '').replace('-wrapper', ''),
            str = '<div class="sorting-item" data-key="'+key+'"><div class="sorting-handle">'
        str += '<i class="zmdi zmdi-apps"></i></div><div class="sorting-title">'+key+'</div></div>';
        $g('#intro-post-settings-dialog .sorting-container').append(str);
    }
    $g('#intro-post-settings-dialog .class-suffix').val(app.edit.suffix);
    var value = getValue('margin', 'top');
    $g('#intro-post-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#intro-post-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    value = getValue('padding', 'top');
    $g('#intro-post-settings-dialog [data-group="padding"][data-option="top"]').val(value);
    value = getValue('padding', 'bottom');
    $g('#intro-post-settings-dialog [data-group="padding"][data-option="bottom"]').val(value);
    value = getValue('padding', 'left');
    $g('#intro-post-settings-dialog [data-group="padding"][data-option="left"]').val(value);
    value = getValue('padding', 'right');
    $g('#intro-post-settings-dialog [data-group="padding"][data-option="right"]').val(value);
    value = getValue('image', 'fullscreen');
    $g('#intro-post-settings-dialog [data-group="image"][data-option="fullscreen"]')[0].checked = value;
    setDisableState('#intro-post-settings-dialog');
    $g('#intro-post-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    value = $g('#intro-post-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#intro-post-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#intro-post-settings-dialog .intro-post-design-group input[type="hidden"]').val('title');
    value = $g('#intro-post-settings-dialog .intro-post-design-group li[data-value="title"]').text();
    $g('#intro-post-settings-dialog .intro-post-design-group input[readonly]').val($g.trim(value));
    $g('#intro-post-settings-dialog .intro-post-layout-select input[type="hidden"]').val(app.edit.layout.layout);
    value = $g('#intro-post-settings-dialog .intro-post-layout-select li[data-value="'+app.edit.layout.layout+'"]').text();
    $g('#intro-post-settings-dialog .intro-post-layout-select input[readonly]').val($g.trim(value));
    if (app.edit.layout.layout == 'fullscreen-post') {
        $g('.intro-show-image').hide();
    } else {
        $g('.intro-show-image').css('display', '');
    }
    if (!app.edit.desktop.image.gradient) {
        app.edit.desktop.image.type = 'color';
        app.edit.desktop.image.gradient = {
            effect : 'linear',
            angle: '225',
            color1: 'rgba(8, 174, 234, 0.75)',
            position1: '0',
            color2: 'rgba(42, 245, 152, 0.75)',
            position2: '100'
        }
    }
    value = getValue('image', 'effect', 'gradient');
    $g('#intro-post-settings-dialog .overlay-linear-gradient').hide();
    $g('#intro-post-settings-dialog .overlay-'+value+'-gradient').css('display', '');
    $g('#intro-post-settings-dialog .overlay-gradient-options .gradient-effect-select input[type="hidden"]').val(value);
    value = $g('#intro-post-settings-dialog .overlay-gradient-options .gradient-effect-select li[data-value="'+value+'"]').text().trim();
    $g('#intro-post-settings-dialog .overlay-gradient-options .gradient-effect-select input[type="text"]').val(value);
    value = getValue('image', 'type');
    $g('#intro-post-settings-dialog .overlay-color-options, .overlay-gradient-options').hide();
    $g('#intro-post-settings-dialog .overlay-'+value+'-options').css('display', '');
    $g('#intro-post-settings-dialog .background-overlay-select input[type="hidden"]').val(value);
    value = $g('#intro-post-settings-dialog .background-overlay-select li[data-value="'+value+'"]').text().trim();
    $g('#intro-post-settings-dialog .background-overlay-select input[type="text"]').val(value);
    $g('#intro-post-settings-dialog input[data-subgroup="gradient"][data-group="image"]').each(function(){
        value = getValue('image', this.dataset.option, 'gradient');
        if (this.type == 'number') {
            var range = $g(this).val(value).prev().val(value);
            setLinearWidth(range);
        } else {
            updateInput($g(this), value);
        }
    });
    showIntroPostDesign('title');
    $g('#intro-post-settings-dialog').find('.category-intro-view, .post-intro-view').hide()
    $g('#intro-post-settings-dialog .'+app.edit.type+'-view').css('display', '');
    $g('.intro-post-view-options input[type="checkbox"]').each(function(){
        var option = this.dataset.option,
            group = this.dataset.group;
        if (group == 'info' && app.edit.type != 'category-intro') {
            return true;
        }
        if (group) {
            value = getValue(group, option);
        } else {
            value = getValue(option);
        }
        this.checked = value;
    });
    setTimeout(function(){
        $g('#intro-post-settings-dialog').modal();
    }, 150);
}

$g('#intro-post-settings-dialog .intro-post-design-group .ba-custom-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    showIntroPostDesign(value);
});

function showIntroPostDesign(search)
{
    var parent = $g('#intro-post-design-options'),
        value = getValue(search);;
    parent.children().not('.intro-post-design-group').hide();
    parent.find('.last-element-child').removeClass('last-element-child');
    parent.find('.info-hover-color').hide();
    switch (search) {
        case 'info' :
            if (app.edit.type != 'category-intro') {
                parent.find('.info-hover-color').css('display', '');
            }
        case 'title' :
            parent.find('.intro-post-margin-options').show().addClass('last-element-child')
                .find('[data-subgroup]').attr('data-group', search);
            parent.find('.intro-post-margin-options [data-type="reset"][data-subgroup="margin"]').attr('data-option', search);
            parent.find('.intro-post-typography-color')[0].style.display = '';
            parent.find('.intro-post-typography-options').show().find('[data-subgroup="typography"]').attr('data-group', search);
            parent.find('.intro-post-typography-options .typography-options').addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.intro-post-typography-options .typography-options').removeClass('ba-active-options');
            }, 1);
            break;
        case 'image' :
            parent.find('.intro-post-image-options').show().last().addClass('last-element-child');
            if (value.size == 'cover') {
                parent.find('.contain-size-options').hide();
            } else {
                parent.find('.contain-size-options').css('display', '');
            }
            break;
    }
    for (var ind in value) {
        if (typeof(value[ind]) == 'object') {
            if (ind == 'typography') {
                app.setTypography(parent.find('.intro-post-typography-options .typography-options'), search, ind);
            } else {
                for (var key in value[ind]) {
                    var input = parent.find('[data-group="'+search+'"][data-option="'+key+'"][data-subgroup="'+ind+'"]');
                    if (input.attr('data-type') == 'color') {
                        updateInput(input, value[ind][key]);
                    } else if (input.attr('type') == 'number') {
                        var range = input.prev();
                        input.val(value[ind][key]);
                        range.val(value[ind][key]);
                        setLinearWidth(range);
                    } else  {
                        input.val(value[ind][key]);
                        if (input.attr('type') == 'hidden') {
                            var text = input.closest('.ba-custom-select').find('li[data-value="'+value[ind][key]+'"]').text();
                            input.closest('.ba-custom-select').find('input[readonly]').val($g.trim(text));
                        }
                    }
                }
            }
        } else {
            var input = parent.find('[data-group="'+search+'"][data-option="'+ind+'"]');
            if (input.attr('data-type') == 'color') {
                updateInput(input, value[ind]);
            } else if (input.attr('type') == 'number') {
                var range = input.prev();
                input.val(value[ind]);
                range.val(value[ind]);
                setLinearWidth(range);
            } else if (input.attr('type') == 'hidden') {
                input.val(value[ind]);
                var name = input.closest('.ba-custom-select').find('li[data-value="'+value[ind]+'"]').text();
                input.closest('.ba-custom-select').find('input[readonly]').val($g.trim(name));
            }
        }
    }
}

$g('.intro-post-layout-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    if (value) {
        $g('.intro-show-image').hide();
        app.edit.desktop.image.show = true;
        $g('.intro-show-image input[type="checkbox"]').prop('checked', true);
    } else {
        $g('.intro-show-image').css('display', '');
    }
    app.edit.layout.layout = value;
    app.sectionRules();
    app.addHistory();
});

$g('.intro-post-image-options .ba-custom-select').on('customAction', function(){
    var input = $g(this).find('input[type="hidden"]')[0];
    if (input.dataset.option) {
        setValue(input.value, 'image', input.dataset.option);
        app[input.dataset.action]();
        app.addHistory();
    }
});

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.introPostEditor = true;
app.introPostEditor();