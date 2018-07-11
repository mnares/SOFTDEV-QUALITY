/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.searchEditor = function(){
    app.selector = '#'+app.editor.app.edit;
    $g('#search-settings-dialog .active').removeClass('active');
    $g('#search-settings-dialog a[href="#search-general-options"]').parent().addClass('active');
    $g('#search-general-options').addClass('active');
    var value = '';
    value = getValue('padding', 'top');
    $g('#search-settings-dialog [data-group="padding"][data-option="top"]').val(value);
    value = getValue('padding', 'right');
    $g('#search-settings-dialog [data-group="padding"][data-option="right"]').val(value);
    value = getValue('padding', 'bottom');
    $g('#search-settings-dialog [data-group="padding"][data-option="bottom"]').val(value);
    value = getValue('padding', 'left');
    $g('#search-settings-dialog [data-group="padding"][data-option="left"]').val(value);
    $g('#search-settings-dialog input.search-placeholder').val(app.edit.placeholder);
    value = getValue('icons', 'size');
    $g('#search-settings-dialog [data-option="size"][data-group="icons"]').val(value);
    var range = $g('#search-settings-dialog [data-option="size"][data-group="icons"]').prev();
    range.val(value);
    setLinearWidth(range);
    value = app.edit.icon.icon.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '');
    $g('#search-settings-dialog [data-option="icon"][data-group="icon"]').val(value);
    $g('#search-settings-dialog .search-icon-position input[type="hidden"]').val(app.edit.desktop.icons.position);
    value = $g('#search-settings-dialog .search-icon-position li[data-value="'+app.edit.desktop.icons.position+'"]').text();
    $g('#search-settings-dialog .search-icon-position input[readonly]').val($g.trim(value));
    app.setTypography($g('#search-settings-dialog .typography-options'), 'typography');
    $g('#search-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    value = $g('#search-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#search-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#search-settings-dialog .class-suffix').val(app.edit.suffix);
    value = getValue('margin', 'top');
    $g('#search-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#search-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    for (var key in app.edit.desktop.border) {
        var input = $g('#search-settings-dialog input[data-option="'+key+'"][data-group="border"]');
        value = getValue('border', key);
        switch (key) {
            case 'color' :
                updateInput(input, value);
                break;
            case 'width' :
            case 'radius' :
                input.val(value);
                var range = input.prev();
                range.val(value);
                setLinearWidth(range);
                break;
            case 'style' :
                input.val(value);
                var select = input.closest('.ba-custom-select');
                value = select.find('li[data-value="'+value+'"]').text();
                select.find('input[readonly]').val($g.trim(value));
                break;
            default:
                if (value == 1) {
                    input.prop('checked', true);
                } else {
                    input.prop('checked', false);
                }
        }
    }
    setDisableState('#search-settings-dialog');
    $g('#search-settings-dialog').attr('data-edit', app.edit.type);
    setTimeout(function(){
        $g('#search-settings-dialog').modal();
    }, 150);
}

$g('#search-settings-dialog .search-placeholder').on('input', function(){
    var $this = this;
    clearTimeout(delay);
    delay = setTimeout(function(){
        var input = app.editor.document.querySelector(app.selector+' .ba-search-wrapper input');
        app.edit.placeholder = $this.value;
        input.placeholder = $this.value;
        app.addHistory();
    });
});

$g('#search-settings-dialog input[data-option="icon"][data-group="icon"]').on('click', function(){
    uploadMode = 'addSearchIcon';
    checkIframe($g('#icon-upload-dialog'), 'icons');
    fontBtn = this;
});

function removeSearchIcon()
{
    var i = app.editor.document.getElementById(app.editor.app.edit);
    i = i.querySelector('.ba-search-wrapper i');
    if (i) {
        i.parentNode.removeChild(i);
    }
}

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.searchEditor = true;
app.searchEditor();