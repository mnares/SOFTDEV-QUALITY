app.categoriesEditor = function(){
	app.selector = '#'+app.editor.app.edit;
    $g('#categories-settings-dialog .active').removeClass('active');
    $g('#categories-settings-dialog a[href="#categories-general-options"]').parent().addClass('active');
    $g('#categories-general-options').addClass('active');
    setPresetsList($g('#categories-settings-dialog'));
    $g('#categories-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    var value = $g('#categories-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#categories-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#categories-settings-dialog .class-suffix').val(app.edit.suffix);
    value = getValue('margin', 'top');
    $g('#categories-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#categories-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    setDisableState('#categories-settings-dialog');
    $g('#categories-settings-dialog .categories-app-custom-select input[type="hidden"]').val(app.edit.app);
    value = $g('#categories-settings-dialog .categories-app-custom-select li[data-value="'+app.edit.app+'"]').text().trim();
    $g('#categories-settings-dialog .categories-app-custom-select input[readonly]').val(value);
    value = getValue('view', 'sub');
    $g('#categories-settings-dialog input[data-option="sub"]').prop('checked', value);
    value = getValue('view', 'counter');
    $g('#categories-settings-dialog input[data-option="counter"]').prop('checked', value);
    app.setTypography($g('#categories-settings-dialog .typography-options'), 'nav-typography');
    value = getValue('nav-hover', 'color');
    updateInput($g('#categories-settings-dialog .hover-group [data-option="color"]').attr('data-group', 'nav-hover'), value);
    setTimeout(function(){
        $g('#categories-settings-dialog').modal();
    }, 150);
}

$g('.categories-app-custom-select').on('customAction', function(){
    var id = this.querySelector('input[type="hidden"]').value;
    if (id != app.edit.app) {
        app.edit.app = id;
        app.editor.$g(app.selector).attr('data-app', app.edit.app);
        $g.ajax({
            type: "POST",
            dataType: 'text',
            url: "index.php?option=com_gridbox&task=editor.getBlogCategories&tmpl=component",
            data: {
                id : app.edit.app
            },
            complete: function(msg){
                app.editor.document.querySelector(app.selector+' .ba-categories-wrapper').innerHTML = msg.responseText;
                app.editor.app.buttonsPrevent();
                app.addHistory();
            }
        });
    }
});

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.categoriesEditor = true;
app.categoriesEditor();