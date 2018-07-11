/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

function duplicateObject(obj, id)
{
    var object = JSON.stringify(obj);
    object = JSON.parse(object);

    return object;
}

function checkSlideshow($this, id)
{
    if (app.items[$this.id].type == 'slideshow') {
        $g($this).find('.ba-slideshow-img').each(function(){
            this.firstElementChild.id = id;
            id++
        });
    }

    return id;
}

function checkAccordions($this, id)
{
    if (app.items[$this.id].type == 'accordion') {
        var accordion = $g($this).find('> .accordion'),
            parent = 'accordion-'+id;
        accordion[0].id = parent;
        id++;
        accordion.find('> .accordion-group > .accordion-heading a').each(function(){
            var old = this.hash;
            this.dataset.parent = '#'+parent;
            this.href = '#collapse-'+id;
            $g($this).find(old)[0].id = 'collapse-'+id;
            id++;
        });
        accordion.find('.accordion-inner > .ba-wrapper > .ba-section').each(function(){
            this.id = 'item-'+(id++);
        }).find('> .ba-section-items > .ba-row-wrapper > .ba-row').each(function(){
            this.id = 'item-'+(id++);
        }).find('> .column-wrapper > .ba-grid-column > .ba-grid-column').each(function(){
            this.id = 'item-'+(id++);
        });
    }

    return id;
}

function checkTabs($this, id)
{
    if (app.items[$this.id].type == 'tabs') {
        var tabs = $g($this);
        tabs.find('> .ba-tabs-wrapper > ul.nav.nav-tabs a').each(function(){
            var old = this.hash;
            this.href = '#tab-'+id;
            $g($this).find(old)[0].id = 'tab-'+id;
            id++;
        });
        tabs.find('.tab-pane > .tabs-content-wrapper > .ba-section').each(function(){
            this.id = 'item-'+(id++);
        }).find('> .ba-section-items > .ba-row-wrapper > .ba-row').each(function(){
            this.id = 'item-'+(id++);
        }).find('> .column-wrapper > .ba-grid-column > .ba-grid-column').each(function(){
            this.id = 'item-'+(id++);
        });
    }

    return id;
}

function copyItem(child, items, data, id)
{
    if (child[0].classList.contains('ba-item-search')) {
        if (!child[0].querySelector('.ba-search-result-modal')) {
            var overlay =  document.querySelector('.ba-search-result-modal[data-id="'+child[0].id+'"]');
            if (overlay) {
                overlay = overlay.cloneNode(true);
                child[0].appendChild(overlay);
            }
        }
    }
    child[0].id = 'item-'+id;
    id++;
    if (child.hasClass('ba-item')) {
        items.push(child[0].id);
        id = checkSlideshow(child[0], id);
        id = checkTabs(child[0], id);
        id = checkAccordions(child[0], id);
    }
    if (app.items[child[0].id].type == 'overlay-button') {
        if (!child[0].querySelector('.ba-overlay-section-backdrop')) {
            var overlay =  document.querySelector('.ba-overlay-section-backdrop[data-id="'+child[0].dataset.overlay+'"]');
            if (overlay) {
                overlay = overlay.cloneNode(true);
                child[0].appendChild(overlay);
            }
        }
    } else if (app.items[child[0].id].type == 'search') {
        child[0].querySelector('.ba-search-result-modal').dataset.id = child[0].id;
    }
    $g('.ba-overlay-section-backdrop').each(function(){
        var button = child[0].querySelector('.ba-item-overlay-section[data-overlay="'+this.dataset.id+'"]');
        if (button) {
            button.appendChild(this.cloneNode(true));
        }
    });
    child.find('.ba-item-search').each(function(){
        if (!this.querySelector('.ba-search-result-modal')) {
            var overlay =  document.querySelector('.ba-search-result-modal[data-id="'+this.id+'"]');
            if (overlay) {
                overlay = overlay.cloneNode(true);
                this.appendChild(overlay);
            }
        }
    });
    child.find('.ba-item').each(function(){
        var ind = this.id;
        this.id = 'item-'+id;
        if (data[ind]) {
            app.items['item-'+id] = duplicateObject(data[ind], ind);
            if (app.items['item-'+id].type =='search') {
                this.querySelector('.ba-search-result-modal').dataset.id = this.id;
            }
            items.push('item-'+id);
            id++;
            id = checkTabs(this, id);
            id = checkAccordions(this, id);
            id = checkSlideshow(this, id);
        }
    });
    child.find('.ba-row, .ba-grid-column, .ba-section').each(function(){
        var ind = this.id;
        if (data[ind]) {
            app.items['item-'+id] = duplicateObject(data[ind], ind);
            if (app.items['item-'+id].type == 'overlay-section') {
                var overlay = child[0].querySelector('.ba-overlay-section-backdrop[data-id="'+this.id+'"]');
                overlay.dataset.id = 'item-'+id;
                overlay.parentNode.dataset.overlay = 'item-'+id;
            } else if (app.items['item-'+id].type == 'mega-menu-section') {
                $g(this).closest('.tabs-content-wrapper').attr('data-id', 'item-'+id);
            }
        }
        this.id = 'item-'+id;
        id++;
    });
    child.find('.star-ratings-wrapper').each(function(){
        var ratings = $g(this)
        ratings.find('i').addClass('active');
        ratings.find('.rating-value').text('0.00');
        ratings.find('.votes-count').text('0');
        ratings.find('.info-wrapper').attr('id', 'star-ratings-'+ratings.closest('.ba-item-star-ratings').attr('id'))
    });
    id = child[0].id;

    return id;
}

app.copyItemsContent = function(item, style, key){
    var items = new Array(),
        clone,
        child,
        id = new Date().getTime() * 10;
    if (style[key].type == 'section' || style[key].type == 'row') {
        item = item.parent();
    }
    app.items['item-'+id] = duplicateObject(style[key]);
    clone = item.clone();
    clone.removeAttr('data-global');
    clone.find('[data-global]').removeAttr('data-global');
    if (style[key].type == 'section' || style[key].type == 'row') {
        child = clone.find('#'+key);
    } else {
        child = clone;
    }
    id = copyItem(child, items, style, id);
    if (app.copyAction == 'context' && top.app.context.itemType != 'column') {
        $g(top.app.context.target).find('> .ba-section-items').append(clone);
    } else if (app.copyAction == 'context' && top.app.context.itemType == 'column') {
        $g(top.app.context.target).find('> .empty-item').before(clone);
    } else {
        item.after(clone);
    }
    editItem(id);
    app.checkModule('sectionRules');
    for (var i = 0; i < items.length; i++) {
        var obj = {
            data : app.items[items[i]],
            selector : items[i]
        };
        itemsInit.push(obj);
    }
    if (itemsInit.length > 0) {
        app.checkModule('initItems', itemsInit.pop());
    }
    clone.find('.ba-tooltip').each(function(){
        app.initTooltip($g(this).parent());
    });
    clone.columnResizer({
        change : function(right, left){
            right.find('.ba-item').each(function(){
                if (app.items[this.id].type == 'map') {
                    app.initmap(app.items[this.id], this.id)
                }
            });
            left.find('.ba-item').each(function(){
                if (app.items[this.id].type == 'map') {
                    app.initmap(app.items[this.id], this.id)
                }
            });
        }
    });
    var wrapper = clone.closest('.ba-wrapper'),
        rowSort = $g('header.header, footer.footer, #ba-edit-section').find(clone).find('.tabs-content-wrapper .ba-section-items');
    makeRowSortable(rowSort, 'tabs-row');
    makeRowSortable($g('#blog-layout').find(clone).find('.tabs-content-wrapper .ba-section-items'), 'blog-tabs-row');
    if (wrapper.hasClass('ba-lightbox') || wrapper.hasClass('ba-overlay-section')) {
        makeColumnSortable(clone.find('.ba-grid-column'), 'lightbox-column');
        makeRowSortable(clone.find(' > .ba-section > .ba-section-items'), 'lightbox-row');
    } else if (wrapper.attr('data-menu')) {
        makeColumnSortable($g(clone).find('.ba-grid-column'), 'lightbox-column');
        makeRowSortable($g(clone).find(' > .ba-section > .ba-section-items'), 'row');
    } else {
        makeColumnSortable($g(clone).find('.ba-grid-column'), 'column');
        makeRowSortable($g(clone).find(' > .ba-section > .ba-section-items'), 'row');
    }
}

app.copyItem = function(){
    if (app.copyAction == 'context') {
        var content = null;
        if (top.app.context.itemType != 'column') {
            content = $g(top.app.buffer.data.html).find('> .ba-section-items > .ba-row-wrapper > .ba-row');
        } else {
            content = $g(top.app.buffer.data.html).find('> .ba-item, > .ba-row-wrapper > .ba-row');
        }
        content.each(function(){
            app.copyItemsContent($g(this), top.app.buffer.data.items, this.id);
        });
    } else {
        if (!app.edit) {
            return false;
        }
        app.copyItemsContent($g('#'+app.edit), app.items, app.edit);
    }
    app.buttonsPrevent();
    app.checkModule('checkOverlay');
    app.checkVideoBackground();
    app.checkModule('loadParallax');
    window.parent.app.addHistory();
    window.parent.app.showNotice(window.parent.gridboxLanguage['GRIDBOX_DUPLICATED']);
    app.copyAction = null;
}

app.copyItem();