/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.starRatingsEditor = function(){
    app.selector = '#'+app.editor.app.edit;
    $g('#star-ratings-settings-dialog .active').removeClass('active');
    $g('#star-ratings-settings-dialog a[href="#star-ratings-general-options"]').parent().addClass('active');
    $g('#star-ratings-general-options').addClass('active');
    $g('#star-ratings-settings-dialog').attr('data-edit', app.edit.type);
    setPresetsList($g('#star-ratings-settings-dialog'));
    $g('#star-ratings-settings-dialog .class-suffix').val(app.edit.suffix);
    var value = getValue('margin', 'top');
    $g('#star-ratings-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#star-ratings-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    setDisableState('#star-ratings-settings-dialog');
    $g('#star-ratings-settings-dialog input[data-option="name"]').val(app.edit.name);
    $g('#star-ratings-settings-dialog textarea[data-option="description"]').val(app.edit.description);
    $g('#star-ratings-settings-dialog input[data-option="image"]').val(app.edit.image);
    value = getValue('view', 'rating');
    $g('#star-ratings-settings-dialog input[data-option="rating"][data-group="view"]').prop('checked', value);
    value = getValue('view', 'votes');
    $g('#star-ratings-settings-dialog input[data-option="votes"][data-group="view"]').prop('checked', value);
    $g('#star-ratings-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    value = $g('#star-ratings-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#star-ratings-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#star-ratings-settings-dialog .star-ratings-design-group input[type="hidden"]').val('icon');
    value = $g('#star-ratings-settings-dialog .star-ratings-design-group li[data-value="icon"]').text();
    $g('#star-ratings-settings-dialog .star-ratings-design-group input[readonly]').val($g.trim(value));
    showstarRatingsDesign('icon');
    setTimeout(function(){
        $g('#star-ratings-settings-dialog').modal();
    }, 150);
}

$g('#star-ratings-settings-dialog').find('[data-option="name"], [data-option="description"], [data-option="image"]').on('input', function(){
    var $this = this;
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit[$this.dataset.option] = $this.value;
        app.editor.$g(app.selector+' [itemprop="'+$this.dataset.option+'"]').attr('content', $this.value);
        app.addHistory();
    }, 300);
});

$g('#star-ratings-settings-dialog [data-option="image"]').on('mousedown', function(){
    fontBtn = this;
    uploadMode = 'selectStarRatingsImage';
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
});

$g('#star-ratings-settings-dialog .star-ratings-design-group .ba-custom-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    showstarRatingsDesign(value);
});

function showstarRatingsDesign(search)
{
    var parent = $g('#star-ratings-design-options');
    parent.children().not('.star-ratings-design-group').hide();
    parent.find('.last-element-child').removeClass('last-element-child')
    switch (search) {
        case 'info' :
            parent.find('.star-ratings-typography-options').show()
                .find('[data-subgroup="typography"]').attr('data-group', search);
            parent.find('.star-ratings-typography-options .typography-options').addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.star-ratings-typography-options .typography-options').removeClass('ba-active-options');
            }, 1);
            app.setTypography(parent.find('.star-ratings-typography-options .typography-options'), search);
            break;
        case 'icon' :
            parent.find('.star-ratings-icon-options').show().last().addClass('last-element-child');
            app.setTypography(parent.find('.star-ratings-icon-options'), search);
            break;
    }
}

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.starRatingsEditor = true;
app.starRatingsEditor();