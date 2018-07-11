/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.loadPlugin = function(layout, data){
    $g.ajax({
        type: "POST",
        dataType: 'text',
        url: "index.php?option=com_gridbox&task=editor.loadPlugin&tmpl=component",
        data: {
            layout : layout,
            data : data,
            edit_type : themeData.edit_type,
            id : document.getElementById('grid_id').value
        },
        complete: function(msg){
            if (!msg.responseText) {
                return false;
            }
            var cookies = null,
                sticky = null;
            msg = JSON.parse(msg.responseText);
            for (var key in msg.items) {
                var type = msg.items[key].type
                if (app.theme.defaultPresets[type] && app.theme.presets[type] && app.theme.presets[type][app.theme.defaultPresets[type]]) {
                    msg.items[key] = $g.extend(true, msg.items[key], app.theme.presets[type][app.theme.defaultPresets[type]].data);
                }
            }
            for (var key in msg.items) {
                if (msg.items[key].type == 'cookies') {
                    cookies = key
                    break;
                } else if (msg.items[key].type == 'sticky-header') {
                    sticky = key;
                }
            }
            for (var key in msg.items) {
                app.items[key] = msg.items[key];
                if (msg.items[key].type == 'tabs' || msg.items[key].type == 'accordion'
                    || msg.items[key].type == 'lightbox' || msg.items[key].type == 'overlay-section') {
                    break;
                }
            }
            if (cookies) {
                key = cookies;
            } else if (sticky) {
                key = sticky;
            }
            if (app.items[key].type == 'slideshow' || app.items[key].type == 'slideset' || app.items[key].type == 'carousel') {
                for (var i = 0; i < data.length; i++) {
                    app.items[key]['desktop'].slides[i + 1] = {
                        image : data[i],
                        type : 'image',
                        link : "",
                        video : null
                    }
                }
            }
            app.setNewFont = true;
            app.fonts = {};
            app.customFonts = {};
            var obj = {
                data : msg.items[key],
                selector : key
            };
            if (sticky) {
                $g('header.header').prepend(msg.html);
                makeRowSortable($g('#'+key+' .ba-section-items'), 'lightbox-row');
                makeColumnSortable($g('#'+key+' .ba-grid-column'), 'lightbox-column');
                setColumnResizer('#'+key);
                app.initStickyHeaderPanel(document.getElementById(key));
            } else if (msg.items[key].type == 'lightbox' || msg.items[key].type == 'cookies') {
                $g('#'+app.edit).closest('.ba-wrapper').parent().append(msg.html);
                makeRowSortable($g('#'+key+' .ba-section-items'), 'lightbox-row');
                makeColumnSortable($g('#'+key+' .ba-grid-column'), 'lightbox-column');
                setColumnResizer('#'+key);
                $g('#'+key).closest('.ba-lightbox-backdrop').find('.ba-lightbox-close').on('click', function(){
                    $g(this).closest('.ba-lightbox-backdrop').removeClass('visible-lightbox');
                    document.body.style.width = '';
                    $g('body').removeClass('lightbox-open');
                });
                app.initLightboxPanel(document.getElementById(key).parentNode);
            } else if (msg.items[key].type == 'overlay-section') {
                var div = document.createElement('div');
                div.innerHTML = msg.html;
                var item = div.firstElementChild,
                    overlay = div.lastElementChild;
                $g('#'+app.edit+' > .empty-item').before(item);
                $g('body').append(overlay);
                makeRowSortable($g('#'+overlay.dataset.id+' .ba-section-items'), 'lightbox-row');
                makeColumnSortable($g('#'+overlay.dataset.id+' .ba-grid-column'), 'lightbox-column');
                $g('#'+key).closest('.ba-overlay-section-backdrop').find('.ba-overlay-section-close').on('click', function(){
                    $g(this).closest('.ba-overlay-section-backdrop').removeClass('visible-section');
                });
                editItem(item.id);
                $g('#'+item.id+' .ba-tooltip').each(function(){
                    app.initTooltip($g(this).parent());
                });
                obj = {
                    data : msg.items[item.id],
                    selector : item.id
                };
            } else {
                $g('#'+app.edit+' > .empty-item').before(msg.html);
            }
            if (msg.items[key].type == 'flipbox') {
                makeColumnSortable($g('#'+key+' .ba-grid-column'), 'column');
            }
            for (var ind in msg.items) {
                if (msg.items[ind].type == 'lightbox' || msg.items[ind].type == 'overlay-section' || msg.items[ind].type == 'cookies') {
                    document.getElementById(ind).classList.add('visible');
                    window.parent.setShapeDividers(app.items[ind], ind);
                }
            }
            app.checkModule('sectionRules');
            switch (msg.items[key].type) {
                case 'slideshow':
                case 'slideset':
                case 'carousel':
                    window.parent.app.edit = app.items[key];
                    for (var i = 0; i < data.length; i++) {
                        var object = {
                                image : data[i],
                                index : (i + 1),
                                type : 'image',
                                video : null,
                                title : '',
                                description :'',
                                button : {
                                    href : '#',
                                    type : 'ba-btn-transition',
                                    title : '',
                                    target : '_blank'
                                }
                            },
                            li = window.parent.getSlideHtml(object);
                        $g('#'+key+' .slideshow-content').append(li);
                    }
                    break;
                case 'tabs' : 
                case 'accordion' : 
                    makeRowSortable($g('#'+key+' .ba-section-items'), 'tabs-row');
                    makeColumnSortable($g('#'+key+' .ba-grid-column'), 'column');
                    break;
                case 'image' :
                case 'logo' :
                    var src = $g('#'+key+' img').attr('src'),
                        pos = src.indexOf('/images/');
                    src = src.substr(pos + 1);
                    app.items[key].image = src;
                    break;
                case 'countdown' :
                    var date = new Date(),
                        month = date.getMonth(),
                        year = date.getFullYear(),
                        day = date.getDate(),
                        time = date.getHours()+':'+date.getMinutes()+':';
                        sec = date.getSeconds();
                    month++;
                    if (month < 10) {
                        month = '0'+month;
                    }
                    if (day < 10 ) {
                        day = '0'+day;
                    }
                    if (sec < 10) {
                        sec = '0'+sec;
                    }
                    app.items[key].date = year+'-'+month+'-'+day+' '+time+sec;
                    break;
            }
            $g('#'+key+' .ba-edit-item').css('display', '');
            editItem(key);
            app.checkModule('initItems', obj);
            var add = window.parent.document.getElementById('add-plugin-dialog');
            $g(add).find('.zmdi.zmdi-close').trigger('click');
            if (layout == 'bagallery') {
                initGallery();
            } else if (layout == 'tags' || layout == 'categories') {
                document.getElementById(key).dataset.app = msg.items[key].app;
            } else if (layout == 'recent-posts') {
                document.getElementById(key).dataset.app = msg.items[key].app;
                document.getElementById(key).dataset.count = msg.items[key].limit;
                document.getElementById(key).dataset.sorting = msg.items[key].sorting;
                document.getElementById(key).dataset.maximum = msg.items[key].maximum;
            } else if (layout == 'related-posts') {
                document.getElementById(key).dataset.app = msg.items[key].app;
                document.getElementById(key).dataset.count = msg.items[key].limit;
                document.getElementById(key).dataset.related = msg.items[key].related;
                document.getElementById(key).dataset.maximum = msg.items[key].maximum;
            } else if (layout == 'post-navigation') {
                document.getElementById(key).dataset.maximum = msg.items[key].maximum;
            }
            switch (msg.items[key].type) {
                case 'text' :
                case 'lightbox' :
                case 'sticky-header' :
                case 'cookies' :
                case 'overlay-section' :
                    break;
                default :
                    $g('#'+key+' > .ba-edit-item .edit-item').trigger('mousedown');
            }
            $g('a, input[type="submit"], button').on('click', function(event){
                event.preventDefault();
            });
            $g('#'+key+' .ba-tooltip').each(function(){
                app.initTooltip($g(this).parent());
            });
            window.parent.app.addHistory();
        }
    });
}

app.loadPlugin(app.modules.loadPlugin.data, app.modules.loadPlugin.selector)