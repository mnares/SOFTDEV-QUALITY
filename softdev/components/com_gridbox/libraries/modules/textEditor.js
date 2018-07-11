/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var textEditor = window.frames['text-editor'];

app.textEditor = function() {
    app.selector = '#'+app.editor.app.edit;
    var array = new Array('h1' ,'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'links');
    if (app.edit.global) {
        delete(app.edit.global);
        array.forEach(function(el){
            delete(app.edit.desktop[el]);
            for (var ind in app.editor.breakpoints) {
                delete(app.edit[ind][el]);
            }
        });
    }
    if (!app.edit.desktop.p) {
        array.forEach(function(el){
            if (el != 'links') {
                app.edit.desktop[el] = {
                    "font-family" : "@default",
                    "font-style" : "@default"
                };
                for (var ind in app.editor.breakpoints) {
                    app.edit[ind][el] = {};
                }
            }
        });
    }
    if (!app.edit.desktop.links) {
        app.edit.desktop.links = {};
    }
    $g('#text-editor-dialog .typography-select input[type="hidden"]').val('h1');
    $g('#text-editor-dialog .typography-select input[type="text"]').val('H1');
    app.setTypography($g('#text-editor-dialog .typography-options'), 'h1');
    $g('#text-editor-dialog .show-general-cell').removeClass('show-general-cell').addClass('hide-general-cell');
    $g('#text-editor-dialog li.active').removeClass('active');
    $g('#text-editor-dialog li').first().addClass('active');
    $g('#text-editor-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    var value = $g('#text-editor-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#text-editor-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#text-editor-dialog .class-suffix').val(app.edit.suffix);
    value = getValue('margin', 'top');
    $g('#text-editor-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#text-editor-dialog [data-group="margin"][data-option="bottom"]').val(value);
    setDisableState('#text-editor-dialog');
    app.editor.app.checkModule('sectionRules');
    app.editor.app.checkModule('themeRules');
    setTimeout(function(){
        checkIframe($g('#text-editor-dialog'), 'textEditor', setText);
    }, 150);
}

function setText()
{
    var item = app.editor.document.getElementById(app.editor.app.edit);
    item = item.querySelector('.content-text');
    textEditor.app.setContent(item.innerHTML);
}

$g('i.apply-text').on('mousedown', function(){
    var item = app.editor.document.getElementById(app.editor.app.edit);
    item = item.querySelector('.content-text');
    item.innerHTML = textEditor.app.getContent();
    app.addHistory();
});

app.modules.textEditor = true;
app.textEditor();