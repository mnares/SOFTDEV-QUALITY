/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.deleteItem = function(){
	setTimeout(function(){
		$g("#delete-dialog").modal();
	}, 50);
}

$g("#delete-dialog").on('hide', function(){
    $g('#delete-dialog .global-library-delete').hide();
    $g('#delete-dialog .can-delete').show();
    app.deleteAction = null;
});

function removeItem(item, search)
{
    item.find(search).each(function(){
        if (app.editor.app.items[this.id] && app.editor.app.items[this.id].type == 'overlay-button') {
            var overlay =  app.editor.document.querySelector('.ba-overlay-section-backdrop[data-id="'+this.dataset.overlay+'"]');
            removeItem($g(overlay), '.ba-section');
            removeItem($g(overlay), '.ba-row');
            removeItem($g(overlay), '.ba-grid-column');
            removeItem($g(overlay), '.ba-item');
            overlay.parentNode.removeChild(overlay);
        } else if (app.editor.app.items[this.id] && app.editor.app.items[this.id].type == 'search') {
            var overlay =  app.editor.document.querySelector('.ba-search-result-modal[data-id="'+this.id+'"]');
            removeItem($g(overlay), '.ba-item');
            overlay.parentNode.removeChild(overlay);
        } else if (app.editor.app.items[this.id] && app.editor.app.items[this.id].type == 'one-page') {
            if (app.editor.app.items[this.id].autoscroll) {
                app.editor.app.items[this.id].autoscroll.enable = false;
            }
        }

        delete(app.editor.app.items[this.id]);
    });
}

$g('#delete-dialog a.ba-btn[data-dismiss="modal"]').on('mousedown', function(){
    if ($g('#menu-item-edit-modal').hasClass('in')) {
        $g('#menu-item-edit-modal input[data-property="megamenu"]').prop('checked', true);
    }
});

app.DOMdeleteItem = function(item)
{
    var childApp = app.editor.app,
        type = null;
    if (childApp.items[childApp.edit]) {
        type = childApp.items[childApp.edit].type;
    }
    if (!childApp.items[childApp.edit] || type == 'section' || type == 'row' || type == 'lightbox'
        || type == 'cookies' || type == 'sticky-header') {
        if (item.parentNode.localName != 'body') {
            item = item.parentNode;
        }
        removeItem($g(item), '.ba-section');
        removeItem($g(item), '.ba-row');
        removeItem($g(item), '.ba-grid-column');
        removeItem($g(item), '.ba-item');
    } else {
        if (childApp.items[childApp.edit] && childApp.items[childApp.edit].type == 'one-page') {
            if (childApp.items[childApp.edit].autoscroll) {
                childApp.items[childApp.edit].autoscroll.enable = false;
            }
        }
        delete(childApp.items[childApp.edit]);
        removeItem($g(item), '.ba-item');
    }
    if (type == 'lightbox' || type == 'cookies') {
        $g('#lightbox-panels').find('div[data-id="'+childApp.edit+'"]').remove();
        item = item.parentNode;
    }
    if (type == 'sticky-header') {
        $g('#lightbox-panels').find('div[data-id="'+childApp.edit+'"]').remove();
        document.body.classList.remove('sticky-header-opened');
    }
    if (type == 'overlay-button') {
        var overlay =  app.editor.document.querySelector('.ba-overlay-section-backdrop[data-id="'+item.dataset.overlay+'"]');
        removeItem($g(overlay), '.ba-section');
        removeItem($g(overlay), '.ba-row');
        removeItem($g(overlay), '.ba-grid-column');
        removeItem($g(overlay), '.ba-item');
        overlay.parentNode.removeChild(overlay);
    }
    if (type == 'search') {
        var overlay =  app.editor.document.querySelector('.ba-search-result-modal[data-id="'+item.id+'"]');
        removeItem($g(overlay), '.ba-item');
        overlay.parentNode.removeChild(overlay);
    }
    item.parentNode.removeChild(item);
    app.editor.$g('.row-with-sidebar-menu').each(function(){
        if (!this.querySelector('.ba-item-one-page-menu.side-navigation-menu')) {
            this.classList.remove('row-with-sidebar-menu');
        }
    });
}

$g('#apply-delete').on('mousedown', function(){
    if ($g('#menu-item-edit-modal').hasClass('in')) {
        $g("#delete-dialog").modal('hide');
        return false;
    }
    if (app.itemDelete) {
        if (app.itemDelete.indexOf('ba-delete-preset:') === 0) {
            var key = app.itemDelete.replace('ba-delete-preset:', '');
            delete(app.editor.app.theme.presets[app.edit.type][key]);
            if (app.editor.app.theme.defaultPresets[app.edit.type] == key) {
                delete(app.editor.app.theme.defaultPresets[app.edit.type]);
            }
            app.editor.app.checkModule('editItem');
            for (var ind in app.editor.app.items) {
                if (app.editor.app.items[ind].preset == key) {
                    comparePresets(app.editor.app.items[ind]);
                }
            }
        } else if ($g('#social-icons-settings-dialog').hasClass('in')) {
            $g('#social-icons-settings-dialog .sorting-item[data-key="'+app.itemDelete+'"]').remove();
            delete(sortingList[app.itemDelete]);
            delete(app.edit.icons[app.itemDelete]);
            var i = 0,
                obj = {};
            sortingList = [];
            $g('#social-icons-settings-dialog .sorting-container').html('');
            for (var ind in app.edit.icons) {
                sortingList.push(app.edit.icons[ind]);
                obj[i] = app.edit.icons[ind];
                $g('#social-icons-settings-dialog .sorting-container').append(addSortingList(obj[i], i));
                i++;
            }
            getSocialIconsHtml(obj);
            app.edit.icons = obj;
        } else if ($g('#menu-settings-dialog').hasClass('in') && app.edit.type == 'one-page') {
            $g('#menu-settings-dialog .one-page-options .sorting-item').each(function(ind, el){
                if (this.dataset.key == app.itemDelete) {
                    this.parentNode.removeChild(this);
                    return false;
                }
            });
            delete(sortingList[app.itemDelete]);
            var ul = app.editor.document.querySelector('#'+app.editor.app.edit+' ul'),
                str = '';
            $g('#menu-settings-dialog .one-page-options .sorting-container .sorting-item').each(function(){
                var key = this.dataset.key;
                str += '<li><a href="'+sortingList[key].href;
                str += '" data-alias="'+sortingList[key].alias+'">';
                if (sortingList[key].icon) {
                    str += '<i class="ba-menu-item-icon '+sortingList[key].icon;
                    str += '" data-value="'+sortingList[key].icon+'"></i>';
                }
                str += sortingList[key].title+'</a></li>';
            });
            ul.innerHTML = str;
            app.addHistory();
        } else if ($g('#menu-settings-dialog').hasClass('in') && app.edit.type == 'menu') {
            var parent_id = 1,
                id = sortingList[app.itemDelete].id,
                li = app.editor.$g(app.selector+' li.item-'+id),
                item = $g('#menu-settings-dialog .menu-options .sorting-item[data-key="'+app.itemDelete+'"]')
                parent = item.closest('.deeper-sorting-container');
            if (parent.length > 0) {
                parent_id = parent.attr('data-parent') * 1;
            }
            item.find('+ .deeper-sorting-container > .sorting-item-wrapper').each(function(){
                var key = $g(this).find('> .sorting-item').attr('data-key');
                item.parent().before(this);
                li.before(app.editor.$g('li.item-'+sortingList[key].id));
            });
            li.remove();
            item.remove();
            delete(sortingList[app.itemDelete]);
            $g.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=editor.deleteMenuItem",
                data:{
                    id : id,
                    parent_id : parent_id
                },
                complete: function(msg){
                }
            });
        } else if ($g('#map-editor-dialog').hasClass('in')) {
            if (locationMarkers[app.itemDelete]) {
                locationMarkers[app.itemDelete].marker.setMap(null);
                if (locationMarkers[app.itemDelete].marker.infoWindow) {
                    locationMarkers[app.itemDelete].marker.infoWindow.close();
                }
            }
            if (app.itemDelete != 0) {
                delete(locationMarkers[app.itemDelete]);
                delete(app.edit.marker[app.itemDelete]);
                $g('#map-editor-dialog .sorting-item[data-marker="'+app.itemDelete+'"]').remove();
            } else {
                delete(app.edit.marker[app.itemDelete].position);
                app.edit.marker[app.itemDelete].place = '';
                app.edit.marker[app.itemDelete].description = '';
                $g('#choose-location').val('');
            }
            setMarker();
            app.addHistory();
        } else if ($g('#item-settings-dialog').hasClass('in')) {
            var children = app.editor.document.querySelector('#'+app.editor.app.edit+' .instagram-wrapper').children,
                str = '';
            children[app.itemDelete].parentNode.removeChild(children[app.itemDelete]);
            var images = app.editor.document.querySelectorAll('#'+app.editor.app.edit+' .ba-instagram-image img');
            sortingList = [];
            $g('#item-settings-dialog .sorting-container').html('');
            for (var i = 0; i < images.length; i++) {
                sortingList.push(images[i].dataset.src);
                $g('#item-settings-dialog .sorting-container').append(addSimpleSortingList(sortingList[i], i));
            }
            app.addHistory();
        } else if ($g('#tabs-settings-dialog').hasClass('in')) {
            var li = app.editor.document.querySelector('#'+app.editor.app.edit+' a[href="'+sortingList[app.itemDelete].href+'"]'),
                div = app.editor.document.querySelector(sortingList[app.itemDelete].href);
            if (sortingList[app.itemDelete].className.indexOf('accordion-heading') != -1) {
                div.parentNode.parentNode.removeChild(div.parentNode);
            } else {
                li.parentNode.parentNode.removeChild(li.parentNode);
                div.parentNode.removeChild(div);
            }
            delete(sortingList[app.itemDelete])
            $g('#tabs-settings-dialog .sorting-container .sorting-item[data-key="'+app.itemDelete+'"]').remove();
            app.addHistory();
        } else if ($g('#slideshow-settings-dialog').hasClass('in')) {
            var flag = false,
                item;
            $g('#slideshow-settings-dialog .sorting-item').each(function(ind){
                if (flag) {
                    sortingList[this.dataset.key].index = ind;
                    app.edit.desktop.slides[ind] = app.edit.desktop.slides[ind + 1];
                    delete(app.edit.desktop.slides[ind + 1]);
                    for (var key in app.editor.breakpoints) {
                        if (app.edit[key].slides && app.edit[key].slides[ind + 1]) {
                            app.edit[key].slides[ind] = app.edit[key].slides[ind + 1];
                            delete(app.edit[key].slides[ind + 1])
                        }
                    }
                }
                if (app.itemDelete == this.dataset.key) {
                    flag = true;
                    item = ind + 1;
                    delete(app.edit.desktop.slides[sortingList[app.itemDelete].index]);
                    for (var key in app.editor.breakpoints) {
                    	if (app.edit[key].slides && app.edit[key].slides[sortingList[app.itemDelete].index]) {
                            app.edit[key].slides[ind] = app.edit[key].slides[ind + 1];
                            delete(app.edit[key].slides[sortingList[app.itemDelete].index])
                        }
                    }
                    delete(sortingList[app.itemDelete]);
                }
            });
            var image = app.editor.document.querySelector('#'+app.editor.app.edit+' li.item:nth-child('+item+')'),
                dot = app.editor.document.querySelector('#'+app.editor.app.edit+' .ba-slideshow-dots .zmdi:nth-child('+item+')'),
                sort = document.querySelector('#slideshow-settings-dialog .sorting-item:nth-child('+item+')');
            image.parentNode.removeChild(image);
            if (dot) {
                dot.parentNode.removeChild(dot);
            }
            sort.parentNode.removeChild(sort);
            app.sectionRules();
            var object = {
                data : app.edit,
                selector : app.editor.app.edit
            }
            app.editor.app.checkModule('initItems', object);
            app.addHistory();
        } else if ($g('.section-library-list').hasClass('ba-sidebar-panel')) {
            $g.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=editor.removeLibrary",
                data:{
                    id : app.itemDelete
                }
            });
            var item = document.querySelector('.ba-library-item[data-id="'+app.itemDelete+'"]').parentNode;
            item.parentNode.removeChild(item);
        }
    } else {
        if (app.deleteAction == 'context') {
            if (app.context.itemType != 'column') {
                content = $g(app.context.target).find('> .ba-section-items > .ba-row-wrapper > .ba-row');
            } else {
                content = $g(app.context.target).find('> .ba-item, > .ba-row-wrapper > .ba-row');
            }
            content.each(function(){
                app.DOMdeleteItem(this);
            });
        } else {
            app.DOMdeleteItem(app.editor.document.getElementById(app.editor.app.edit));
        }
        app.addHistory();
    }
    for (var key in app.videoBg) {
        if (!document.getElementById(key)) {
            delete(app.videoBg[key])
        }
    }
    for (var key in app.videoSlides) {
        if (!document.getElementById(key)) {
            delete(app.videoSlides[key])
        } else {
            for (var ind in app.videoSlides[key]) {
                if (!document.getElementById(ind)) {
                    delete(app.videoSlides[key][ind]);
                }
            }
        }
    }
    $g("#delete-dialog").modal('hide');
    app.showNotice(gridboxLanguage['COM_GRIDBOX_N_ITEMS_DELETED']);
});
app.modules.deleteItem = true;
app.deleteItem();