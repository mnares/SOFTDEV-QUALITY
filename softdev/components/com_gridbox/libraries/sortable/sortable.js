/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

!function ($) {
    var dragEl,
        sortGroups = {},
        cloneEl,
        placeEl,
        sortable = function (element, options) {
            this.delete = function(){
                var item = $(element);
                item.off('mousedown.sortable')
            };
            this.init = function(){
                var item = $(element),
                    div = document.createElement('div');
                if (!sortGroups[options.group]) {
                    sortGroups[options.group] = new Array();
                }
                sortGroups[options.group].unshift(item);
                item.on('mousedown.sortable', options.handle, function(event){
                    if (event.button != 0) {
                        return false;
                    }
                    $(item).closest('.ba-wrapper').addClass('sortable-parent-node');
                    $(item).closest('.ba-item-flipbox').addClass('sortable-started');
                    options.start(item[0]);
                    dragEl = $(this).closest(element.children)[0];
                    cloneEl = dragEl.cloneNode(true);
                    $(cloneEl).find('.ba-edit-item').parent().find('> *').not('.ba-edit-item').remove();
                    placeEl = cloneEl.cloneNode(true);
                    placeEl.classList.add('sortable-placeholder');
                    cloneEl.classList.add('sortable-helper');
                    element.insertBefore(cloneEl, dragEl);
                    element.insertBefore(placeEl, cloneEl);
                    $(cloneEl).css({
                        'width' : $(dragEl).width()+'px',
                        'position' : 'fixed',
                        'top' : event.clientY+'px',
                        'left' : event.clientX+'px',
                        'margin-left' : 0,
                        'transition' : 'none'
                    }).on('mouseover', function(event){
                        event.stopPropagation();
                    })
                    $(dragEl).find('.edit-settings').trigger('mouseleave');
                    div.appendChild(dragEl)
                    item.removeClass('active-item');
                    $(document).on('mousemove.sortable', function(event){
                        $(cloneEl).css({
                            'top' : event.clientY+'px',
                            'left' : event.clientX+'px',
                        });
                        var target = null,
                            array = sortGroups[options.group];
                        for (var i = 0; i < array.length; i++) {
                            if (array[i].closest('.ba-item-blog-content').length > 0 ||
                                (cloneEl.classList.contains('ba-row-wrapper') && array[i].hasClass('ba-grid-column')
                                    && array[i].closest('.ba-wrapper').hasClass('tabs-content-wrapper'))) {
                                continue;
                            }
                            if (options.group == 'column' && array[i].closest('.ba-flipbox-backside').length > 0
                                && !array[i].closest('.ba-item-flipbox').hasClass('backside-fliped')) {
                                continue;
                            } else if (options.group == 'column' && array[i].closest('.ba-flipbox-frontside').length > 0
                                && array[i].closest('.ba-item-flipbox').hasClass('backside-fliped')) {
                                continue;
                            }
                            array[i].find(options.selector).not(placeEl).not(cloneEl).each(function(){
                                var rect = this.getBoundingClientRect();
                                if (array[i].hasClass('ba-grid-column') && this.classList.contains('ba-row-wrapper')
                                    && app.view == 'desktop') {
                                    var key = this.querySelector('.ba-row-wrapper > .ba-row').id,
                                        obj = {
                                            top : rect.top - app.items[key].desktop.margin.top,
                                            bottom : rect.bottom * 1 + app.items[key].desktop.margin.bottom * 1,
                                            left : rect.left,
                                            right: rect.right
                                        };
                                    rect = obj;
                                } else if (array[i].hasClass('ba-grid-column') && this.classList.contains('ba-item-flipbox')
                                    && app.view == 'desktop') {
                                    var obj = {
                                            top : rect.top - (app.items[this.id] ? app.items[this.id].desktop.margin.top : 0),
                                            bottom : rect.bottom + (app.items[this.id] ? app.items[this.id].desktop.margin.bottom * 1 : 0),
                                            left : rect.left,
                                            right: rect.right
                                        };
                                    rect = obj;
                                }
                                if (rect.top < event.clientY && rect.bottom > event.clientY &&
                                    rect.left < event.clientX && event.clientX < rect.right) {
                                    target = this;
                                    return false;
                                }
                            });
                            if (!target && cloneEl.classList.contains('ba-row-wrapper') && array[i].hasClass('ba-grid-column')
                                && array[i].closest('.ba-row-wrapper').parent().hasClass('ba-grid-column')) {
                                continue;
                            }
                            if (target) {
                                var rect = target.getBoundingClientRect(),
                                    next = (event.clientY - rect.top) / (rect.bottom - rect.top) > .5,
                                    after = next && target.nextSibling || target;
                                if (next && !target.nextSibling) {
                                    after.parentNode.appendChild(placeEl);
                                } else {
                                    after.parentNode.insertBefore(placeEl, after);
                                }
                            } else {
                                var rect = array[i][0].getBoundingClientRect(),
                                    length = $(array[i][0]).find(options.selector).not(placeEl).not(cloneEl).length;
                                if (rect.top < event.clientY && rect.bottom > event.clientY &&
                                    rect.left < event.clientX && event.clientX < rect.right && length == 0) {
                                    target = array[i][0];
                                }
                                if (target && !target.classList.contains('ba-grid-column')) {
                                    target.appendChild(placeEl);
                                } else if (target) {
                                    $(target).find('> .empty-item').before(placeEl);
                                }
                            }
                            if (target) {
                                $('.placeholder-parent').removeClass('placeholder-parent');
                                $(target).closest('.ba-item-flipbox').addClass('placeholder-parent');
                                break;
                            }
                        }
                        return false;
                    }).off('mouseup.sortable').on('mouseup.sortable', function(){
                        var classList = cloneEl.classList,
                            introStr = '.ba-item-category-intro, .ba-item-error-message, ba-item-post-intro';
                        introStr += ', ba-item-blog-content, .ba-item-blog-posts';
                        if (((classList.contains('ba-item-post-intro') || classList.contains('ba-item-blog-content')
                                || classList.contains('ba-item-blog-posts') || classList.contains('ba-item-error-message')
                                || $g(cloneEl).find('> .ba-row').hasClass('row-with-intro-items'))
                            && ($(placeEl).closest('.ba-wrapper').hasClass('tabs-content-wrapper')
                                || $(placeEl).closest('header').length > 0 || $(placeEl).closest('footer').length > 0))
                            || $(placeEl).parent().closest('.ba-item-blog-content').length > 0) {
                            placeEl.parentNode.removeChild(placeEl);
                            cloneEl.parentNode.insertBefore(dragEl, cloneEl);
                            cloneEl.parentNode.removeChild(cloneEl);
                        } else {
                            cloneEl.parentNode.removeChild(cloneEl);
                            placeEl.parentNode.insertBefore(dragEl, placeEl);
                            placeEl.parentNode.removeChild(placeEl);
                        }
                        $(document).off('mousemove.sortable mouseup.sortable');
                        $('.sortable-parent-node').removeClass('sortable-parent-node');
                        $('.sortable-started').removeClass('sortable-started');
                        $('.row-with-intro-items').removeClass('row-with-intro-items');
                        $('.placeholder-parent').removeClass('placeholder-parent');
                        $(introStr).closest('.ba-row').addClass('row-with-intro-items');
                        $('.ba-item-error-message').closest('.ba-section').addClass('row-with-intro-items');
                        options.change(dragEl);
                    });
                });
            }
        }

    $.fn.sortable = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data('sortable'),
                options = $.extend({}, $.fn.sortable.defaults, typeof option == 'object' && option);
            if (data) {
                data.delete();
                $this.removeData();
            }
            $this.data('sortable', (data = new sortable(this, options)));
            data.init();
        });
    }

    $.fn.sortable.defaults = {
        'selector' : '> *',
        change : function(){
            
        },
        start : function(){

        }
    }
    
    $.fn.sortable.Constructor = sortable;
}(window.$g ? window.$g : window.jQuery);