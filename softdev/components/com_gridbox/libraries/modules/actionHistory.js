/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.actionHistory = function(){
    var key = app.historyObj.key,
        obj = app.historyObj.data;
    if (key == 'body') {
        app.editor.app.theme = $g.extend(true, {}, obj.items.body);
        var classNames = app.history[app.hIndex].items.body.suffix.split(' ');
        classNames.forEach(function(el, ind){
            if (el) {
                app.editor.document.body.classList.remove(el);
            }
        });
        classNames = obj.items.body.suffix.split(' ');
        classNames.forEach(function(el, ind){
            if (el) {
                app.editor.document.body.classList.add(el);
            }
        });
        app.themeRules();
        app.editor.app.checkModule('sectionRules');
    } else {
        var scrollTop = app.editor.document.querySelectorAll('.ba-item-scroll-to-top, .ba-social-sidebar'),
            object = $g.extend(true, {}, obj.items),
            header = obj.content.querySelector('header.header'),
            footer = obj.content.querySelector('footer.footer'),
            content = obj.content.querySelector('#ba-edit-section').cloneNode(true);
        if (object[key] && object[key].type == 'header') {
            var item = app.editor.document.querySelector('header.header');
            if (app.editor.app.items[key].layout) {
                item.classList.remove(app.editor.app.items[key].layout);
            }
            if (object[key].layout) {
                item.classList.add(object[key].layout);
            }
            if (!object[key].layout) {
                $g('.full-group').removeAttr('style');
            } else {
                $g('.full-group').hide();
            }
        }
        for (var i = 0; i < scrollTop.length; i++) {
            scrollTop[i].parentNode.removeChild(scrollTop[i]);
        };
        delete(object.body);
        app.editor.app.items = $g.extend(true, {}, object);
        if (header) {
            header = header.cloneNode(true);
        } else {
            header = app.editor.document.querySelector('header.header').cloneNode(true);
        }
        if (footer) {
            footer = footer.cloneNode(true);
        } else {
            footer = app.editor.document.querySelector('footer.footer').cloneNode(true);
        }
        app.editor.document.querySelector('header.header').innerHTML = header.innerHTML;
        app.editor.document.querySelector('footer.footer').innerHTML = footer.innerHTML;
        app.editor.document.querySelector('#ba-edit-section').innerHTML = content.innerHTML;
        app.editor.$g('.ba-section, .ba-row, .ba-grid-column').each(function(){
            if (app.editor.app.items[this.id] && app.editor.app.items[this.id].desktop.animation.effect) {
                this.classList.remove(app.editor.app.items[this.id].desktop.animation.effect);
            }
        });
        app.editor.app.checkModule('sectionRules');
        app.editor.app.init();
    }
    app.editor.app.checkVideoBackground();
    app.checkModule('loadParallax');
};

app.modules.actionHistory = true;
app.actionHistory();