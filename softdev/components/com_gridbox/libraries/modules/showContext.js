/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var libHandle = document.getElementById('library-item-handle');
app.buffer = null;

app.showEditorRbtnContext = function(){
    var rect = document.querySelector('.editor-iframe').getBoundingClientRect(),
        deltaX = document.documentElement.clientWidth - app.context.event.clientX + rect.left,
        deltaY = document.documentElement.clientHeight - app.context.event.clientY + rect.top,
        top = app.context.event.clientY + rect.top,
        left = app.context.event.clientX + rect.left,
        context = document.querySelector('.'+app.context.context);
    context.style.display = 'block';
    if (deltaX - context.offsetWidth < 0) {
        context.classList.add('ba-left');
    } else {
        context.classList.remove('ba-left');
    }
    if (deltaY - context.offsetHeight < 0) {
        context.classList.add('ba-top');
        if (top < context.offsetHeight) {
            top = context.offsetHeight + 10;
        }
    } else {
        context.classList.remove('ba-top');
        if (top + context.offsetHeight > document.documentElement.clientHeight) {
            top = top - 10 - (top + context.offsetHeight - document.documentElement.clientHeight);
        }
    }
    context.style.top = top+'px';
    context.style.left = left+'px';
    if (app.buffer && app.buffer.type == app.context.itemType) {
        $g('span.context-paste-buffer').removeClass('disable-button');
    } else {
        $g('span.context-paste-buffer').addClass('disable-button');
    }
}

app.showContext = function(){
    if (!app.context) {
        return false;
    }
    if (app.context.type && app.context.type == 'contextEvent') {
        setTimeout(function(){
            app.showEditorRbtnContext();
        }, 50);
        return false;
    } if (app.context.dataset.context == 'responsive-context-menu' && app.context.classList.contains('disable-button')) {
        return false;
    }
    var rect = app.context.getBoundingClientRect(),
        target = app.context.dataset.context,
        context = document.getElementsByClassName(target)[0];
    context.style.top = rect.bottom+'px';
    context.style.left = rect.left+'px';
    if (app.context.dataset.context == 'page-context-menu') {
        context.style.left = rect.right+'px';
    }
    setTimeout(function(){
        if (app.context.dataset.context == 'section-library-list') {
            if (app.editor.document.getElementById('blog-layout')) {
                $g('a[href="#plugins-library-cell"]').trigger('click');
            }
            $g.ajax({
                type: "POST",
                dataType: 'text',
                url: "index.php?option=com_gridbox&task=editor.getLibraryItems",
                complete: function(msg){
                    var obj = JSON.parse(msg.responseText),
                        str = returnLibraryHtml(obj.sections, 'section', obj.delete, obj.global);
                    $g('.section-library-list .ba-library-item').parent().remove();
                    $g('#section-library-cell').prepend(str);
                    str = returnLibraryHtml(obj.plugins, 'plugin', obj.delete, obj.global);
                    $g('#plugins-library-cell').prepend(str);
                    $g('.ba-library-item .ba-tooltip').each(function(){
                        app.initTooltip($g(this).parent());
                    });
                    $g('.editor-iframe').addClass('push-left-body');
                    if (app.editor) {
                        app.editor.document.getElementById('library-backdrop').classList.add('visible-backdrop');
                    }
                    $g(context).addClass('ba-sidebar-panel');
                }
            });
        } else if (app.context.dataset.context == 'section-page-blocks-list') {
            $g('.editor-iframe').addClass('push-left-body');
            if (app.editor) {
                app.editor.document.getElementById('library-backdrop').classList.add('visible-backdrop');
            }
            $g(context).addClass('ba-sidebar-panel');
        }
        context.style.display = 'block';
    }, 15);
};

function returnLibraryHtml(array, type, delete_item, global_item)
{
    var str = '';
    for (var i = 0; i < array.length; i++) {
        str += '<span class="library-item-wrapper">';
        if (array[i].image) {
            str += '<span class="library-image" style="background-image:url('+array[i].image+');"><img src="';
            str += 'components/com_gridbox/assets/images/default-theme.png">';
            str += '<div class="camera-container" data-id="'+array[i].id;
            str += '"><i class="zmdi zmdi-camera"></i></div></span>';
        }
        str += '<span class="ba-library-item" data-id="'+array[i].id+'">';
        str += '<span class="library-handle" data-type="'+type+'" data-id="'+array[i].id+'">';
        str += '<i class="zmdi zmdi-apps"></i></span><span class="library-title">';
        str += array[i].title+'</span>';
        if (array[i].global_item) {
            str += '<span class="library-global-item" data-id="'+array[i].global_item+'">';
            str += '<i class="zmdi zmdi-star"></i><span class="ba-tooltip ba-top">'+global_item+'</span></span>';
        }
        str += '<span class="delete-from-library" data-id="'+array[i].id+'">';
        str += '<i class="zmdi zmdi-delete"></i><span class="ba-tooltip ba-top">'+delete_item;
        str += '</span></span></span></span>';
    }

    return str;
}

function returnPointLibraryItem(event, type, offset)
{
    var pageY = event.clientY,
        pageX = event.clientX,
        item = null,
        rect = null,
        editSection = app.editor.document.getElementById('ba-edit-section'),
        str = '.ba-wrapper:not(.ba-lightbox):not(.ba-overlay-section)';
    str += ':not(.tabs-content-wrapper)';
    if (type == 'section' || type == 'blocks') {
        $g(editSection).find(str).each(function(){
            rect = this.getBoundingClientRect();
            if (rect.top + offset < event.clientY && rect.bottom + offset > event.clientY &&
                rect.left < event.clientX && event.clientX < rect.right) {
                item = this;
                return false;
            }
        });
        if (!item) {
            item = editSection;
        }
    } else {
        editSection = app.editor.document.body;
        str += ' > .ba-section > .ba-section-items > .ba-row-wrapper > .ba-row >';
        str += ' .column-wrapper > .ba-grid-column-wrapper > .ba-grid-column';
        $g(editSection).find(str).each(function(){
            if ($g(this).closest('.ba-item-blog-content').length == 0) {
                rect = this.getBoundingClientRect();
                if (rect.top + offset < event.clientY && rect.bottom + offset > event.clientY &&
                    rect.left < event.clientX && event.clientX < rect.right) {
                    item = this;
                    return false;
                }
            }
        });
        if (item) {
            $g(item).find(' > .ba-item').each(function(){
                if ($g(this).parent().closest('.ba-item-blog-content').length == 0) {
                    rect = this.getBoundingClientRect();
                    if (rect.top + offset < event.clientY && rect.bottom + offset > event.clientY &&
                        rect.left < event.clientX && event.clientX < rect.right) {
                        item = this;
                        return false;
                    }
                }
            });
        }
    }
    
    return item;
}

$g('#uploader-modal').on('hide', function(){
    var iframe = this.querySelector('iframe').contentWindow;
    iframe.document.body.classList.remove('media-manager-enabled');
});

$g('span.pages-list').on('mousedown', function(){
    setTimeout(function(){
        checkIframe($g('#pages-list-modal'), 'pages');
    }, 200);
    $g('body').trigger('mousedown');
    return false;
});

$g('span.love-gridbox').on('mousedown', function(){
    setTimeout(function(){
        $g('#love-gridbox-modal').modal();
    }, 50);
});

$g('span.shortcuts-gridbox').on('mousedown', function(){
    setTimeout(function(){
        $g('#shortcuts-modal').modal();
    }, 50);
});

$g('.left-context-menu, #login-modal').on('mousedown', function(event){
    event.stopPropagation();
})

$g('body').on('mousedown', function(){
    $g('.ba-context-menu').hide();
    $g('.editor-iframe').removeClass('push-left-body');
    $g('.ba-sidebar-panel').removeClass('ba-sidebar-panel');
    app.editor.document.getElementById('library-backdrop').classList.remove('visible-backdrop');
});

$g('.section-page-blocks-list .ba-page-block-item').on('mousedown', function(event){
    if (this.classList.contains('disabled')) {
        $g('.ba-username, .ba-password').val('');
        $g('.login-button').attr('data-type', 'blocks');
        app.checkModule('login');
        return false;
    } else {
        var id = this.dataset.id,
            item = null,
            next;
        app.editor.app.edit = null;
        app.editor.app.checkModule('copyItem');
        $g('body').trigger('mousedown');
        libHandle.style.display = '';
        libHandle.style.top = event.clientY+'px';
        libHandle.style.left = event.clientX+'px';
        app.editor.document.getElementById('library-backdrop').dataset.id = id;
        var placeholder = app.editor.document.getElementById('library-placeholder');
        $g(document).on('mousemove.library', function(event){
            libHandle.style.top = event.clientY+'px';
            libHandle.style.left = event.clientX+'px';
            placeholder.style.display = '';
            item = returnPointLibraryItem(event, 'blocks', 80);
            if (item) {
                var rect = item.getBoundingClientRect(),
                    obj = {
                        "left" : rect.left + 16,
                        "width" : rect.right - rect.left - 30
                    };
                next = (event.clientY - (rect.top + 80)) / (rect.bottom - rect.top) > .5;
                if (next || item.classList.contains('ba-grid-column')) {
                    obj.top = rect.bottom;
                } else {
                    obj.top = rect.top;
                }
                $g(placeholder).css(obj);
            } else {
                placeholder.style.display = 'none';
            }
            return false;
        }).on('mouseup.library', function(event){
            libHandle.style.display = 'none';
            placeholder.style.display = 'none';
            $g(document).off('mouseup.library mousemove.library');
            $g(app.editor.document).off('mouseup.library mousemove.library');
            var obj =  {
                "data" : item,
                "selector" : {
                    id : id,
                    type : 'blocks',
                    next : next, 
                    globalItem : null
                }
            };
            if (obj.data) {
                app.editor.app.checkModule('setLibraryItem', obj);
            }
        });
        $g(app.editor.document).on('mousemove.library', function(event){
            libHandle.style.top = event.clientY+80+'px';
            libHandle.style.left = event.clientX+'px';
            placeholder.style.display = '';
            item = returnPointLibraryItem(event, 'blocks', 0);
            if (item) {
                var rect = item.getBoundingClientRect(),
                    obj = {
                        "left" : rect.left + 16,
                        "width" : rect.right - rect.left - 30
                    };
                next = (event.clientY - rect.top) / (rect.bottom - rect.top) > .5;
                if (next || item.classList.contains('ba-grid-column')) {
                    obj.top = rect.bottom;
                } else {
                    obj.top = rect.top;
                }
                $g(placeholder).css(obj);
            } else {
                placeholder.style.display = 'none';
            }
            return false;
        }).on('mouseup.library', function(event){
            libHandle.style.display = 'none';
            placeholder.style.display = 'none';
            $g(document).off('mouseup.library mousemove.library');
            $g(app.editor.document).off('mouseup.library mousemove.library');
            var obj =  {
                "data" : item,
                "selector" : {
                    id : id,
                    type : 'blocks',
                    next : next,
                    globalItem : null
                }
            };
            if (obj.data) {
                app.editor.app.checkModule('setLibraryItem', obj);
            }
        });
        return false;
    }
});

$g('#section-library-cell, #plugins-library-cell').on('mousedown', '.library-handle', function(event){
    var id = this.dataset.id,
        type = this.dataset.type,
        item = null,
        globalItem = this.parentNode;
    globalItem = globalItem.querySelector('.library-global-item');
    if (globalItem) {
        globalItem = globalItem.dataset.id;
        var item = app.editor.document.getElementById(globalItem);
        if (item) {
            app.showNotice(gridboxLanguage['GLOBAL_ITEM_NOTICE']);
            return false;
        }
    }
    app.editor.app.edit = null;
    app.editor.app.checkModule('copyItem');
    $g('body').trigger('mousedown');
    libHandle.style.display = '';
    libHandle.style.top = event.clientY+'px';
    libHandle.style.left = event.clientX+'px';
    app.editor.document.getElementById('library-backdrop').dataset.id = id;
    var placeholder = app.editor.document.getElementById('library-placeholder');
    $g(document).on('mousemove.library', function(event){
        libHandle.style.top = event.clientY+'px';
        libHandle.style.left = event.clientX+'px';
        placeholder.style.display = '';
        item = returnPointLibraryItem(event, type, 80);
        if (item) {
            var rect = item.getBoundingClientRect(),
                next = (event.clientY - (rect.top + 80)) / (rect.bottom - rect.top) > .5,
                obj = {
                    "left" : rect.left + 16,
                    "width" : rect.right - rect.left - 30
                };
            if (next || item.classList.contains('ba-grid-column')) {
                obj.top = rect.bottom;
            } else {
                obj.top = rect.top;
            }
            $g(placeholder).css(obj);
        } else {
            placeholder.style.display = 'none';
        }
        return false;
    }).on('mouseup.library', function(){
        libHandle.style.display = 'none';
        placeholder.style.display = 'none';
        $g(document).off('mouseup.library mousemove.library');
        $g(app.editor.document).off('mouseup.library mousemove.library');
        var obj =  {
            "data" : item,
            "selector" : {
                id : id,
                type : type,
                globalItem : globalItem
            }
        };
        if (obj.data) {
            rect = obj.data.getBoundingClientRect();
            obj.selector.next = (event.clientY - (rect.top)) / (rect.bottom - rect.top) > .5;
            app.editor.app.checkModule('setLibraryItem', obj);
        }
    });
    $g(app.editor.document).on('mousemove.library', function(event){
        libHandle.style.top = event.clientY+80+'px';
        libHandle.style.left = event.clientX+'px';
        placeholder.style.display = '';
        item = returnPointLibraryItem(event, type, 0);
        if (item) {
            var rect = item.getBoundingClientRect(),
                next = (event.clientY - (rect.top + 0)) / (rect.bottom - rect.top) > .5,
                obj = {
                    "left" : rect.left + 16,
                    "width" : rect.right - rect.left - 30
                };
            if (next || item.classList.contains('ba-grid-column')) {
                obj.top = rect.bottom;
            } else {
                obj.top = rect.top;
            }
            $g(placeholder).css(obj);
        } else {
            placeholder.style.display = 'none';
        }
        return false;
    }).on('mouseup.library', function(){
        libHandle.style.display = 'none';
        placeholder.style.display = 'none';
        $g(document).off('mouseup.library mousemove.library');
        $g(app.editor.document).off('mouseup.library mousemove.library');
        var obj =  {
            "data" : item,
            "selector" : {
                id : id,
                type : type,
                globalItem : globalItem
            }
        };
        if (obj.data) {
            rect = obj.data.getBoundingClientRect();
            obj.selector.next = (event.clientY - (rect.top)) / (rect.bottom - rect.top) > .5;
            app.editor.app.checkModule('setLibraryItem', obj);
        }
    });
    return false;
});

$g('#section-library-cell, #plugins-library-cell').on('mousedown', '.delete-from-library', function(event){
    app.itemDelete = this.dataset.id;
    if ($g(this).closest('.ba-library-item').find('.library-global-item').length > 0) {
        $g('#delete-dialog .global-library-delete').show();
        $g('#delete-dialog .can-delete').hide();
    } else {
        $g('#delete-dialog .global-library-delete').hide();
        $g('#delete-dialog .can-delete').show();
    }
    app.checkModule('deleteItem');
});

$g('#section-library-cell, #plugins-library-cell').on('mousedown', '.camera-container', function(event){
    app.itemDelete = this.dataset.id;
    uploadMode = 'reselectLibraryImage';
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
});

$g('span.add-to-menu').on('mousedown', function(){
    app.checkModule('addToMenu');
});

$g('span.context-edit-item').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .edit-item').trigger('mousedown');
});
$g('span.context-add-new-row').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .add-columns').trigger('mousedown');
});
$g('span.context-modify-columns').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .modify-columns').trigger('mousedown');
});

$g('span.context-add-nested-row').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .add-columns-in-columns').trigger('mousedown');
});
$g('span.context-add-new-element').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .add-item').trigger('mousedown');
});


$g('span.context-add-to-library').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .add-library').trigger('mousedown');
});
$g('span.context-copy-item').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .copy-item').trigger('mousedown');
});
$g('span.context-delete-item').on('mousedown', function(){
    app.editor.$g(app.context.target).find('> .ba-edit-item .delete-item').trigger('mousedown');
});
$g('span.context-copy-style').on('mousedown', function(){
    if (presetsPatern[app.context.itemType]) {
        app.buffer = {
            type: app.context.itemType,
            store: 'style',
            data: {}
        }
        var patern = $g.extend(true, {}, presetsPatern[app.context.itemType]);
        if (app.context.itemType == 'section' || app.context.itemType == 'row' || app.context.column == 'column') {
            patern.desktop.image = '';
            patern.desktop.video = '';
        }
        for (var ind in patern) {
            if (ind == 'desktop') {
                app.buffer.data[ind] = {};
                for (var key in patern[ind]) {
                    app.buffer.data[ind][key] = $g.extend(true, {}, app.context.item[ind][key]);
                }
                for (var ind in app.editor.breakpoints) {
                    if (app.context.item[ind]) {
                        app.buffer.data[ind] = {};
                        for (var key in patern.desktop) {
                            if (app.buffer.data[ind][key]) {
                                app.buffer.data[ind][key] = $g.extend(true, {}, app.context.item[ind][key]);
                            } else {
                                app.buffer.data[ind][key] = {};
                            }
                        }
                    }
                }
            } else {
                app.buffer.data[ind] = $g.extend(true, {}, app.context.item[ind]);
            }
        }
    }
});
$g('span.context-copy-content').on('mousedown', function(){
    app.buffer = {
        type: app.context.itemType,
        store: 'content',
        data: {
            html: app.context.target.cloneNode(true),
            items: $g.extend(true, {}, app.editor.app.items)
        }
    }
});
$g('span.context-paste-buffer').on('mousedown', function(){
    if (!this.classList.contains('disable-button')) {
        if (app.buffer.store == 'style') {
            for (var ind in app.buffer.data) {
                if (ind == 'desktop') {
                    for (var key in app.buffer.data[ind]) {
                        app.context.item[ind][key] = $g.extend(true, {}, app.buffer.data[ind][key]);
                    }
                    for (var ind in app.editor.breakpoints) {
                        if (app.buffer.data[ind]) {
                            for (var key in app.buffer.data.desktop) {
                                if (app.buffer.data[ind][key]) {
                                    app.context.item[ind][key] = $g.extend(true, {}, app.buffer.data[ind][key]);
                                } else {
                                    app.context.item[ind][key] = {};
                                }
                            }
                        }
                    }
                } else {
                    app.context.item[ind] = $g.extend(true, {}, app.buffer.data[ind]);
                }
            }
            app.editor.app.setNewFont = true;
            app.editor.app.fonts = {};
            app.editor.app.customFonts = {};
            app.editor.app.checkModule('sectionRules');
            if (app.context.item.desktop.shape && 'setShapeDividers' in window) {
                var str = '.ba-'+app.context.item.type.replace('column', 'grid-column');
                setShapeDividers(app.context.item, app.context.target.id);
            }
            if (app.context.item.type == 'progress-pie') {
                app.drawPieLine();
            }
            app.editor.app.checkModule('checkOverlay');
            app.editor.app.checkVideoBackground();
            app.editor.app.checkModule('loadParallax');
            app.addHistory();
        } else if (app.buffer.store == 'content') {
            app.editor.app.copyAction = 'context';
            app.editor.app.checkModule('copyItem');
        }
    }
});
$g('span.context-delete-content').on('mousedown', function(){
    app.itemDelete = null;
    app.deleteAction = 'context';
    app.checkModule('deleteItem');
});
$g('span.context-reset-style').on('mousedown', function(){
    if (presetsPatern[app.context.itemType]) {
        var patern = $g.extend(true, {}, presetsPatern[app.context.itemType]),
            object = defaultElementsStyle[app.context.itemType];
        if (app.context.itemType == 'section' || app.context.itemType == 'row' || app.context.column == 'column') {
            patern.desktop.image = '';
            patern.desktop.video = '';
        }
        for (var ind in patern) {
            if (ind == 'desktop') {
                for (var key in patern[ind]) {
                    app.context.item[ind][key] = $g.extend(true, {}, object[ind][key]);
                }
                for (var ind in app.editor.breakpoints) {
                    if (app.context.item[ind]) {
                        for (var key in patern.desktop) {
                            if (object[ind] && object[ind][key]) {
                                app.context.item[ind][key] = $g.extend(true, {}, object[ind][key]);
                            } else {
                                app.context.item[ind][key] = {};
                            }
                        }
                    }
                }
            } else {
                app.context.item[ind] = $g.extend(true, {}, object[ind]);
            }
        }
        app.editor.app.setNewFont = true;
        app.editor.app.fonts = {};
        app.editor.app.customFonts = {};
        app.editor.app.checkModule('sectionRules');
        if (app.context.item.desktop.shape && 'setShapeDividers' in window) {
            var str = '.ba-'+app.context.item.type.replace('column', 'grid-column');
            setShapeDividers(app.context.item, app.context.target.id);
        }
        if (app.context.item.type == 'progress-pie') {
            app.drawPieLine();
        }
        app.editor.app.checkModule('checkOverlay');
        app.editor.app.checkVideoBackground();
        app.editor.app.checkModule('loadParallax');
        app.addHistory();
    }
});

app.modules.showContext = true;
app.showContext();