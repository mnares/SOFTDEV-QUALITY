/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.blogContentEditor = function(){
    setTimeout(function(){
        var url = 'index.php?option=com_gridbox&view=gridbox&layout=blog-editor&tmpl=blog-editor&id='+$g('.page-id').val();
        $g('#blog-content-dialog .tab-pane:first-child').html('<iframe name="blog-editor" src="'+url+'"></iframe>');
        var str = gridboxLanguage['LOADING']+'<img src="components/com_gridbox/assets/images/reload.svg"></img>';
        app.showNotice(str);
    }, 50);
}

$g("#blog-content-dialog").on('hide', function(){
    var galleries = app.editor.document.querySelectorAll('.ba-item-gallery .ba-gallery');
    for (var i = 0; i < galleries.length; i++){
        if (!galleries[i].querySelector('.modal-scrollable')) {
            var scrollable = app.editor.document.querySelector('body > .modal-scrollable .gallery-modal').parentNode;
            galleries[i].appendChild(scrollable);
        }
    }
    var scrollTop = app.editor.document.querySelectorAll('.ba-item-scroll-to-top, .ba-social-sidebar'),
        baItems = app.editor.document.querySelectorAll('.ba-item-overlay-section');
    for (var i = 0; i < scrollTop.length; i++) {
        scrollTop[i].classList.remove('visible-scroll-to-top');
        var parent = app.editor.app.items[scrollTop[i].id].parent,
            item = app.editor.document.getElementById(parent);
        if (!item) {
            item = app.editor.document.querySelector('.ba-grid-column');
            if (item) {
                app.editor.app.items[scrollTop[i].id].parent = item.id;
            }
        }
    };
    for (var i = 0; i < scrollTop.length; i++) {
        if (app.editor.app.items[scrollTop[i].id]) {
            var parent = app.editor.app.items[scrollTop[i].id].parent,
                column = app.editor.$g('#'+parent);
            if (column.length > 0) {
                var scrollItem = scrollTop[i].cloneNode(true);
                column.find(' > .empty-item').before(scrollItem);
            }
        }
    }
    for (var i = 0; i < baItems.length; i++) {
        var overlay =  app.editor.document.querySelector('.ba-overlay-section-backdrop[data-id="'+baItems[i].dataset.overlay+'"]');
        overlay.classList.remove('visible-section');
        baItems[i].appendChild(overlay);
    }
    baItems = app.editor.document.querySelectorAll('.ba-item-search');
    for (var i = 0; i < baItems.length; i++) {
        var overlay =  app.editor.document.querySelector('.ba-search-result-modal[data-id="'+baItems[i].id+'"]');
        overlay.classList.remove('visible-section');
        baItems[i].appendChild(overlay);
    }
    baItems = app.editor.document.querySelectorAll('.visible-lightbox');
    for (var i = 0; i < baItems.length; i++) {
        baItems[i].classList.remove('visible-lightbox');
    }
    app.editor.document.body.classList.remove('lightbox-open');
    baItems = app.editor.document.querySelectorAll('.visible-menu');
    for (var i = 0; i < baItems.length; i++) {
        baItems[i].classList.remove('visible-menu');
        baItems[i].classList.remove('hide-menu');
        app.editor.document.querySelector('.column-with-menu').classList.remove('column-with-menu');
        app.editor.document.querySelector('.row-with-menu').classList.remove('row-with-menu');
    }
    var content = app.editor.document.getElementById('ba-edit-section').innerHTML;
    app.editor = window.frames['editor-iframe'];
    app.editor.$g('#ba-edit-section').html(content);
    app.editor.$g('header.header').html(app.editor.$g('header.header')[0].innerHTML);
    app.editor.$g('footer.footer').html(app.editor.$g('footer.footer')[0].innerHTML);
    app.editor.$g('#blog-layout').html(app.editor.$g('#blog-layout')[0].innerHTML);
    baItems = app.editor.document.querySelectorAll('.ba-item-custom-html');
    for (var i = 0; i < baItems.length; i++) {
        baItems[i].querySelector('style:first-child').innerHTML = app.editor.app.items[baItems[i].id].css;
    }
    app.editor.app.setNewFont = true;
    app.editor.app.fonts = {};
    app.editor.app.checkModule('sectionRules');
    if (app.editor.document.querySelector('.ba-item-gallery')) {
        app.editor.initGalleries();
    }
    app.editor.app.init();
    $g('body').trigger('mousedown');
});

app.blogContentEditor();
app.modules.blogContentEditor = true;