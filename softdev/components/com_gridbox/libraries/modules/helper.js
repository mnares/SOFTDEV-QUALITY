/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var file = document.createElement('link'),
    color = '',
    sortingList = new Array(),
    fontBtn = '',
    toolbarButtons = {
        'text-decoration' : true,
        'text-transform' : true,
        'font-style' : true,
        'text-align' : true
    };
file.rel = 'stylesheet';
file.href = JUri+'media/jui/css/jquery.minicolors.css';
document.getElementsByTagName('head')[0].appendChild(file);
file = document.createElement('script');
file.src = JUri+'components/com_gridbox/libraries/minicolors/jquery.minicolors.js';
file.onload = function(){
    $g('.variables-color-picker').minicolors({
        opacity: true,
        theme: 'bootstrap',
        change: function(hex, opacity) {
            var rgba = $g(this).minicolors('rgbaString');
            fontBtn.value = hex;
            $g('.variables-color-picker').closest('#color-picker-cell')
                .find('.minicolors-opacity').val(opacity * 1);
            fontBtn.dataset.rgba = rgba;
            $g(fontBtn).trigger('minicolorsInput').next().find('.minicolors-swatch-color')
                .css('background-color', rgba).closest('.ba-settings-item')
                .find('.minicolors-opacity').val(opacity * 1).removeAttr('readonly');
        }
    });
    $g('.color-variables-group').on('click', '.color-variables-item', function(){
        var variable = this.dataset.variable,
            value = app.editor.app.theme.colorVariables[variable].color,
            color = rgba2hex(value);
        fontBtn.value = variable;
        fontBtn.dataset.rgba = variable;
        $g(fontBtn).trigger('minicolorsInput').next().find('.minicolors-swatch-color')
            .css('background-color', value).closest('.ba-settings-item')
            .find('.minicolors-opacity').val('').attr('readonly', true);
        $g(this).trigger('mouseleave');
        $g('#color-variables-dialog').modal('hide');
    });
    $g('#color-variables-dialog').on('show', function(){
        $g(this).find('.color-variables-item').each(function(){
            var color = app.editor.app.theme.colorVariables[this.dataset.variable].color;
            $g(this).find('.color-varibles-color-swatch').css('background-color', color);
        });
    }).on('hide', function(){
        app.addHistory();
    });
}
app.modules.helper = true;
document.getElementsByTagName('head')[0].appendChild(file);
file = document.createElement('script');
file.src = $g('.sorting-url').val();
file.onload = function(){
    $g('#intro-post-settings-dialog .sorting-container').sortable({
        handle : '.sorting-handle i',
        selector : '> .sorting-item',
        change : function(){
            var div = document.createElement('div'),
                wrapper = app.editor.document.querySelector('#'+app.editor.app.edit+' .intro-post-wrapper');
            $g('#intro-post-settings-dialog .sorting-container .sorting-item').each(function(){
                var key = this.dataset.key.replace('title', 'title-wrapper').replace('image', 'image-wrapper');
                div.appendChild(wrapper.querySelector('.intro-post-'+key));
            });
            $g(div.children).each(function(){
                wrapper.appendChild(this)
            });
            app.addHistory();
        },
        group : 'tabs'
    });
    $g('#tabs-settings-dialog .sorting-container').sortable({
        handle : '.sorting-handle i',
        selector : '> .sorting-item',
        change : function(){
            if (app.edit.type == 'tabs') {
                var ul = app.editor.document.querySelector('#'+app.editor.app.edit+' ul.nav-tabs'),
                    str = '';
                $g('#tabs-settings-dialog .sorting-container .sorting-item').each(function(){
                    var key = this.dataset.key;
                    str += '<li class="'+sortingList[key].className+'"><a href="'+sortingList[key].href;
                    str += '" data-toggle="tab"><span><span class="tabs-title';
                    if (!sortingList[key].title) {
                        str += ' empty-textnode';
                    }
                    str += '">'+sortingList[key].title+'</span>';
                    if (sortingList[key].icon) {
                        str += '<i class="'+sortingList[key].icon+'"></i>';
                    }
                    str += '</span></a></li>';
                });
                ul.innerHTML = str;
            } else {
                var parent = app.editor.document.querySelector('#'+app.editor.app.edit+' > .accordion'),
                    div = document.createElement('div');
                $g('#tabs-settings-dialog .sorting-container .sorting-item').each(function(){
                    var key = this.dataset.key,
                        child = app.editor.document.getElementById(sortingList[key].href.replace('#', ''));
                    div.appendChild(child.parentNode);
                });
                parent.innerHTML = div.innerHTML;
            }
            app.addHistory();
        },
        group : 'tabs'
    });
    $g('#menu-settings-dialog .one-page-options .sorting-container').sortable({
        handle : '.sorting-handle i',
        selector : '> .sorting-item',
        change : function(){
            var ul = app.editor.document.querySelector('#'+app.editor.app.edit+' ul.nav.menu'),
                str = '';
            $g('#menu-settings-dialog .one-page-options .sorting-container .sorting-item').each(function(){
                var key = this.dataset.key;
                str += '<li><a href="'+sortingList[key].href;
                str += '" data-alias="'+sortingList[key].alias+'">'+sortingList[key].title+'</a></li>';
            });
            ul.innerHTML = str;
            app.addHistory();
        },
        group : 'tabs'
    });
    $g('#menu-settings-dialog .menu-options > .sorting-container').sortable({
        handle : '> .sorting-item-wrapper > .sorting-item > .sorting-handle i',
        selector : '> .sorting-item-wrapper',
        change : function(dragEl){
            sortMenuItems();
        },
        group : 'menu-items'
    });
    $g('#slideshow-settings-dialog .sorting-container').sortable({
        handle : '.sorting-handle i',
        selector : '> .sorting-item',
        change : function(){
            var div = app.editor.document.querySelector('#'+app.editor.app.edit+' .slideshow-content'),
                object = {
                    'desktop' : {
                        'slides' : {}
                    }
                };
            for (var ind in app.editor.breakpoints) {
                object[ind] = {
                    slides : {}
                }
                if (!app.edit[ind]) {
                    app.edit[ind] = {};
                }
            }
            div.innerHTML = '';
            $g('#slideshow-settings-dialog .sorting-container .sorting-item').each(function(ind){
                var key = this.dataset.key,
                    str = getSlideHtml(sortingList[key]);
                div.appendChild(str);
                for (var index in object) {
                    if (app.edit[index].slides && app.edit[index].slides[sortingList[key].index]) {
                        object[index].slides[ind + 1] = app.edit[index].slides[sortingList[key].index];
                    }
                }
                sortingList[key].index = ind + 1;
            });
            for (var ind in object) {
                app.edit[ind].slides = object[ind].slides;
            }
            app.sectionRules();
            var object = {
                data : app.edit,
                selector : app.editor.app.edit
            }
            app.editor.app.checkModule('initItems', object);
            app.addHistory();
        },
        group : 'slide'
    });
    $g('#item-settings-dialog .sorting-container').sortable({
        handle : '.sorting-handle i',
        selector : '> .sorting-item',
        change : function(){
            var children = app.editor.document.querySelector('#'+app.editor.app.edit+' .instagram-wrapper').children,
                str = '';
            $g('#item-settings-dialog .sorting-container .sorting-item').each(function(ind){
                var key = this.dataset.key,
                    src = sortingList[key],
                    img = children[ind].querySelector('img');
                if (src.indexOf('balbooa.com') == -1) {
                    src = app.editor.JUri+sortingList[key];
                }
                children[ind].style.backgroundImage = 'url('+src+')';
                img.src = src;
                img.dataset.src = sortingList[key];
            });
            app.addHistory();
        },
        group : 'slide'
    });
    $g('#social-icons-settings-dialog .sorting-container').sortable({
        handle : '.sorting-handle i',
        selector : '> .sorting-item',
        change : function(){
            var obj = {};
            $g('#social-icons-settings-dialog .sorting-container .sorting-item').each(function(ind){
                obj[ind] = sortingList[this.dataset.key];
            });
            getSocialIconsHtml(obj);
            app.edit.icons = obj;
            app.addHistory();
        },
        group : 'slide'
    });
}
document.getElementsByTagName('head')[0].appendChild(file);

app.sectionRules = function(){
    var obj = {
        callback : 'sectionRules',
    }
    app.editor.app.listenMessage(obj);
}

app.setTypography = function(parent, target, subgroup){
    var obj = app.edit.desktop[target],
        fontKey = 'body';
    if (app.view != 'desktop') {
        parent.find('.desktop-only').hide();
    } else if (target != 'links') {
        parent.find('.desktop-only').removeAttr('style');
    }
    if (!subgroup) {
        parent.find('[data-group]').attr('data-group', target);
    } else {
        obj = app.edit.desktop[target][subgroup];
    }
    if (app.edit.type == 'text' || app.edit.type == 'headline') {
        obj = app.editor.app.theme.desktop[target];
        fontKey = target;
    }
    if (app.editor.$g(app.selector).closest('footer.footer').length > 0) {
        var parentFont = app.editor.app.footer.desktop[fontKey]['font-family'];
    } else {
        var parentFont = app.editor.app.theme.desktop[fontKey]['font-family'];
    }
    for (var key in obj) {
        var element = parent.find('[data-option="'+key+'"][data-group="'+target+'"]'),
            display = '',
            val = getValue(target, key);
        if (subgroup) {
            val = getValue(target, key, subgroup);
            element = parent.find('[data-option="'+key+'"][data-group="'+target+'"][data-subgroup="'+subgroup+'"]');
        }
        if ((app.edit.type == 'text' || app.edit.type == 'headline') && val == undefined) {
            val = getTextTypographyValue(target, key);
            display = 'none';
        } else if ((app.edit.type == 'text' || app.edit.type == 'headline')
            && app.edit[app.view][target] && val != app.edit[app.view][target][key]) {
            display = 'none';
        }
        if (key == 'font-family'){
            var family = val == '@default' ? gridboxLanguage['INHERIT'] : val.replace(/\+/g, ' '),
                ul = element.next().next().empty();
            element.val(val).prev().val(family);
            if (target != 'body') {
                ul.append('<li data-value="@default">'+gridboxLanguage['INHERIT']+'</li>');
            }
            for (var ind in fontsLibrary) {
                ul.append('<li data-value="'+ind+'">'+ind.replace(/\+/g, ' ')+'</li>');
                if (ind == val || (val == '@default' && ind == parentFont)) {
                    var weightUl = $g(element).closest('.typography-options').find('.font-weight-select ul').empty();
                    if (target != 'body') {
                        weightUl.append('<li data-value="@default">'+gridboxLanguage['INHERIT']+'</li>');
                    }
                    for (var i = 0; i < fontsLibrary[ind].length; i++) {
                        var weight = fontsLibrary[ind][i].styles,
                            str = '<li data-value="'+weight+'">'+weight.replace('i', ' Italic')+'</li>';
                        weightUl.append(str)
                    }
                }
            }
        } else if (key == 'font-weight') {
            var weight = val == '@default' ? gridboxLanguage['INHERIT'] : val.replace('i', ' Italic');
            element.val(val).prev().val(weight);
        } else if (toolbarButtons[key]) {
            element.each(function(){
                if (this.dataset.value == val) {
                    $g(this).addClass('active');
                } else {
                    $g(this).removeClass('active');
                }
            });
        } else if (key == 'color' || key == 'hover-color' || key == 'hover') {
            updateInput(element, val);
        } else {
            if (app.edit.type == 'text' || app.edit.type == 'headline') {
                element.closest('.ba-settings-item').find('> div:last-child').css('display', display);
            }
            var range = element.val(val).prev().val(val);
            setLinearWidth(range);
        }
    }
}

function getSocialIconsHtml(obj)
{
    var wrapper = app.editor.$g(app.selector+' .ba-icon-wrapper').empty();
    for (var ind in obj) {
        var str = '<a href="'+obj[ind].link.link+'" target="'+obj[ind].link.target;
        str += '"><i class="'+obj[ind].icon+' ba-btn-transition"></i></a>';
        wrapper.append(str);
    }
    app.editor.app.buttonsPrevent();
}

function addSlideSortingList(obj, key)
{
    var str = '<div class="sorting-item" data-key="'+key;
    str += '"><div class="sorting-handle"><i class="zmdi zmdi-apps"></i></div>';
    str += '<div class="sorting-image">';
    if (!obj.video) {
        var src = obj.image;
        if (src.indexOf('balbooa.com') == -1) {
            src = app.editor.JUri+obj.image;
        }
        str += '<img src="'+src+'">';
    } else {
        str += '<i class="zmdi zmdi-play-circle-outline"></i>'
    }
    str += '</div><div class="sorting-title">';
    if (obj.video) {
        str += 'Video';
    } else {
        var title = obj.image.split('/');
        str += title[title.length - 1];
    }
    str += '</div><div class="sorting-icons">';
    str += '<span><i class="zmdi zmdi-edit"></i></span>';
    str += '<span><i class="zmdi zmdi-delete"></i></span></div></div>';

    return str;
}

function addSortingList(obj, key)
{
    var str = '<div class="sorting-item" data-key="'+key;
    str += '"><div class="sorting-handle"><i class="zmdi zmdi-apps"></i></div>';
    str += '<div class="sorting-title">';
    if (obj.title) {
        str += obj.title;
    } else if (obj.icon) {
        str += obj.icon.replace('zmdi zmdi-', '').replace('fa fa-', '');
    }
    str += '</div><div class="sorting-icons">';
    str += '<span><i class="zmdi zmdi-edit"></i></span>';
    str += '<span><i class="zmdi zmdi-delete"></i></span></div></div>';

    return str;
}

function editClass(val, target, obj)
{
    clearTimeout(delay);
    delay = setTimeout(function(){
        var classNames = obj.suffix.split(' ');
        if (target == 'body') {
            target = app.editor.document.body;
        } else {
            target = app.editor.document.getElementById(target);
        }
        classNames.forEach(function(el, ind){
            if (el) {
                target.classList.remove(el);
            }
        });
        obj.suffix = val;
        classNames = obj.suffix.split(' ');
        classNames.forEach(function(el, ind){
            if (el) {
                target.classList.add(el);
            }
        });
        app.addHistory();
    }, 300);
}

function updateInput(input, rgba)
{
    if (rgba.indexOf('@') === 0) {
        var color = new Array(),
            bg = '';
        if (app.editor.app.theme.colorVariables[rgba]) {
            bg = app.editor.app.theme.colorVariables[rgba].color;
        }
        color.push(rgba);
        color.push('');
    } else {
        var color = rgba2hex(rgba),
            bg = rgba;
    }
    $g(input).attr('data-rgba', rgba).val(color[0]).next().find('.minicolors-swatch-color').css('background-color', bg);
    input.closest('.ba-settings-item').find('.minicolors-opacity').val(color[1]);
}

function rgba2hex(rgb)
{
    var parts = rgb.toLowerCase().match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/),
        hex = '#',
        part,
        color = new Array();
    if (parts) {
        for (var i = 1; i <= 3; i++) {
            part = parseInt(parts[i]).toString(16);
            if (part.length < 2) {
                part = '0'+part;
            }
            hex += part;
        }
        if (!parts[4]) {
            parts[4] = 1;
        }
        color.push(hex);
        color.push(parts[4] * 1);
        
        return color;
    } else {
        color.push(rgb.trim());
        color.push(1);
        
        return color;
    }
}

function setTabsAnimation()
{
    $g('.general-tabs ul').off('show').on('show', function(event){
        event.stopPropagation();
        var ind = new Array(),
            ul = $g(event.currentTarget),
            id = $g(event.relatedTarget).attr('href'),
            aId = $g(event.target).attr('href');
        ul.find('li a').each(function(i){
            if (this == event.target) {
                ind[0] = i;
            }
            if (this == event.relatedTarget) {
                ind[1] = i;
            }
        });
        if (ind[0] > ind[1]) {
            $g(id).addClass('out-left');
            $g(aId).addClass('right');
            setTimeout(function(){
                $g(id).removeClass('out-left');
                $g(aId).removeClass('right');
            }, 500);
        } else {
            $g(id).addClass('out-right');
            $g(aId).addClass('left');
            setTimeout(function(){
                $g(id).removeClass('out-right');
                $g(aId).removeClass('left');
            }, 500);
        }
        if ((event.target.hash == '#section-general-options' || event.target.hash == '#section-layout-options')
            && app.edit && app.edit.type == 'flipbox') {
            if (app.edit.side != 'frontside') {
                app.edit.side = 'frontside';
                app.editor.setFlipboxSide(app.edit, app.edit.side);
                var duration = getValue('animation', 'duration');
                app.editor.$g(app.selector).addClass('flipbox-animation-started').removeClass('backside-fliped');
                setTimeout(function(){
                    app.editor.$g(app.selector).removeClass('backside-fliped');
                }, duration * 1000);
                setSectionBackgroundOptions();
                $g('.flipbox-select-side input[type="hidden"]').val(app.edit.side);
                $g('.flipbox-select-side input[type="text"]').val(gridboxLanguage[app.edit.side.toUpperCase()]);
            }
        }
    }).on('shown', function(event){
        event.stopPropagation();
    });
    $g('.general-tabs a').off('show').on('show', function(event){
        var parent = $g(this).closest('.general-tabs'),
            prev = event.relatedTarget.getBoundingClientRect(),
            next = event.target.getBoundingClientRect();
        parent.find('.tabs-underline').stop().css({
            'left' : prev.left,
            'right' : document.documentElement.clientWidth - prev.right,
        }).show().animate({
            'left' : next.left,
            'right' : document.documentElement.clientWidth - next.right,
        }, 500, function(){
            parent.find('.tabs-underline').hide()
        });
    });
}

function setDisableState(search)
{
    var parent = $g(search),
        value = Boolean(app.edit.desktop.disable * 1);
    parent.find('input[data-option="disable"][data-group="desktop"]').prop('checked', value);
    for (var key in app.editor.breakpoints) {
        if (!app.edit[key] || typeof(app.edit[key].disable) == 'undefined') {
            continue;
        }
        value = Boolean(app.edit[key].disable * 1);
        parent.find('input[data-option="disable"][data-group="'+key+'"]').prop('checked', value);
    }
    if (!app.edit.access_view) {
        app.edit.access_view = 1;
    }
    parent.find('.section-access-view-select input[type="hidden"]').val(app.edit.access_view);
    value = parent.find('.section-access-view-select li[data-value="'+app.edit.access_view+'"]').text();
    parent.find('.section-access-view-select input[readonly]').val(value.trim());
}

function getCategoryHtml(id, title)
{
    var str = '<li class="chosen-category"><span>'+title;
    str += '</span><i class="zmdi zmdi-close" data-remove="'+id+'"></i></li>';

    return str;
}

function showBaStyleDesign(search, $this)
{
    var parent = $g($this).closest('.tab-pane'),
        value = getValue(search);
    parent.find('> .ba-settings-group:not(.blog-posts-background-options):not(.blog-posts-shadow-options)').hide();
    parent.find('> .ba-settings-group:first-child').css('display', '');
    parent.find('.last-element-child').removeClass('last-element-child');
    parent.find('.ba-style-typography-color')[0].style.display = '';
    parent.find('.ba-style-typography-hover-color').hide();
    switch (search) {
        case 'image' :
            parent.find('.ba-style-'+search+'-options').css('display', '');
            if (app.edit.type != 'blog-posts') {
                parent.find('.ba-style-border-options').show()
                    .find('input[data-subgroup]').attr('data-group', search);
            }
            break;
        case 'pagination' :
            parent.find('.ba-style-'+search+'-options').css('display', '');
            break;
        case 'button' :
            parent.find('.ba-style-typography-color').hide();
            parent.find('.ba-style-typography-options').show().find('[data-subgroup="typography"]').attr('data-group', search);
            parent.find('.ba-style-margin-options').show().find('[data-subgroup]').attr('data-group', search);
            parent.find('.ba-style-margin-options [data-type="reset"][data-subgroup="margin"]').attr('data-option', search);
            parent.find('.ba-style-'+search+'-options').show().find('input[data-subgroup]').attr('data-group', search);
            parent.find('.ba-style-border-options').show()
                .find('input[data-subgroup]').attr('data-group', search);
            parent.find('.ba-style-typography-options .typography-options').addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.ba-style-typography-options .typography-options').removeClass('ba-active-options');
            }, 1);
            break;
        case 'intro' :
            parent.find('.ba-style-'+search+'-options').css('display', '');
        default:
            parent.find('.ba-style-typography-options').show().find('[data-subgroup="typography"]').attr('data-group', search);
            parent.find('.ba-style-margin-options').show().find('[data-subgroup]').attr('data-group', search);
            parent.find('.ba-style-margin-options [data-type="reset"][data-subgroup="margin"]')
                .attr('data-option', search);
            parent.find('.ba-style-typography-options .typography-options').addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.ba-style-typography-options .typography-options').removeClass('ba-active-options');
            }, 1);
            break;
    }
    if (app.edit.layout.layout == 'ba-cover-layout') {
        $g('#recent-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().hide();
        $g('#blog-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().hide();
    } else {
        $g('#recent-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().css('display', '');
        $g('#blog-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().css('display', '');
        $g('.blog-posts-cover-options').hide();
    }
    if (value.typography) {
        app.setTypography(parent.find('.ba-style-typography-options .typography-options'), search, 'typography');
        parent.find('.ba-style-typography-hover-color').hide();
    }
    if (search == 'title' || search == 'info') {
        parent.find('.ba-style-typography-hover-color input[data-option="color"]').attr('data-group', search);
        parent.find('.ba-style-typography-hover-color').css('display', '');
    }
    for (var ind in value) {
        if (typeof(value[ind]) == 'object') {
            if (ind != 'typography') {
                for (var key in value[ind]) {
                    var input = parent.find('[data-group="'+search+'"][data-option="'+key+'"][data-subgroup="'+ind+'"]');
                    if (input.attr('data-type') == 'color') {
                        updateInput(input, value[ind][key]);
                    } else if (input.attr('type') == 'number') {
                        var range = input.prev();
                        input.val(value[ind][key]);
                        range.val(value[ind][key]);
                        setLinearWidth(range);
                    } else  {
                        input.val(value[ind][key]);
                        if (input.attr('type') == 'hidden') {
                            var text = input.closest('.ba-custom-select').find('li[data-value="'+value[ind][key]+'"]').text();
                            input.closest('.ba-custom-select').find('input[readonly]').val($g.trim(text));
                        }
                    }
                }
            }
        } else {
            var input = parent.find('[data-group="'+search+'"][data-option="'+ind+'"]');
            if (input.attr('data-type') == 'color') {
                updateInput(input, value[ind]);
            } else if (input.attr('type') == 'number') {
                var range = input.prev();
                input.val(value[ind]);
                range.val(value[ind]);
                setLinearWidth(range);
            } else if (input.attr('type') == 'hidden') {
                input.val(value[ind]);
                var name = input.closest('.ba-custom-select').find('li[data-value="'+value[ind]+'"]').text();
                input.closest('.ba-custom-select').find('input[readonly]').val($g.trim(name));
            }
        }
    }
}

function createVideo(selector)
{
    var obj = {
        callback : 'createVideo',
        selector : selector,
        data : app.edit.desktop.video
    }
    if (app.edit.type == 'flipbox') {
        obj.selector = '#'+app.editor.$g(selector+' .ba-flipbox-'+app.edit.side+' > .ba-grid-column-wrapper > .ba-grid-column').attr('id');
        obj.data = app.edit.sides[app.edit.side].desktop.video;
    }
    app.editor.app.listenMessage(obj);
}

function setShapeDividers(obj, id)
{
    app.editor.$g('#'+id+' > .ba-shape-divider').remove();
    var divider = document.createElement('div'),
        dividerBottom = document.createElement('div'),
        topKeys = new Array(),
        bottomKeys = new Array();
    if (obj.desktop.shape.bottom.effect) {
        bottomKeys.push(obj.desktop.shape.bottom.effect);
    }
    if (obj.desktop.shape.top.effect) {
        topKeys.push(obj.desktop.shape.top.effect);
    }
    for (var key in app.editor.breakpoints) {
        if (obj[key] && obj[key].shape) {
            if (obj[key].shape.bottom && obj[key].shape.bottom.effect) {
                bottomKeys.push(obj[key].shape.bottom.effect)
            }
            if (obj[key].shape.top && obj[key].shape.top.effect) {
                topKeys.push(obj[key].shape.top.effect)
            }
        }
    }
    if (bottomKeys.length > 0) {
        var str = '';
        for (var i = 0; i < bottomKeys.length; i++) {
            str += shapeDividers[bottomKeys[i]] ? shapeDividers[bottomKeys[i]] : '';
        }
        dividerBottom.className = 'ba-shape-divider ba-shape-divider-bottom';
        dividerBottom.innerHTML = str;
        app.editor.$g('#'+id+' > .ba-overlay').after(dividerBottom);
    }
    if (topKeys.length > 0) {
        var str = '';
        for (var i = 0; i < topKeys.length; i++) {
            str += shapeDividers[topKeys[i]] ? shapeDividers[topKeys[i]] : '';
        }
        divider.className = 'ba-shape-divider ba-shape-divider-top';
        divider.innerHTML = str;
        app.editor.$g('#'+id+' > .ba-overlay').after(divider);
    }
}

function rangeAction(range, callback)
{
    var $this = $g(range),
        max = $this.attr('max') * 1,
        min = $this.attr('min') * 1,
        number = $this.next();
    number.on('input', function(){
        var value = this.value * 1;
        if (max && value > max) {
            this.value = value = max;
        }
        if (min && value < min) {
            value = min;
        }
        $this.val(value);
        setLinearWidth($this);
        callback(number);
    });
    $this.on('input', function(){
        var value = this.value * 1;
        number.val(value).trigger('input');
    });
}

function setLinearWidth(range)
{
    var max = range.attr('max') * 1,
        value = range.val() * 1,
        sx = ((Math.abs(value) * 100) / max) * range.width() / 100,
        linear = range.prev();
    if (value < 0) {
        linear.addClass('ba-mirror-liner');
    } else {
        linear.removeClass('ba-mirror-liner');
    }
    if (linear.hasClass('letter-spacing')) {
        sx = sx / 2;
    }
    linear.width(sx);
}

function videoDelay(selector)
{
    clearTimeout(delay);
    if (app.edit.desktop.video.id || app.edit.desktop.video.source) {
        delay = setTimeout(function(){
            createVideo(selector);
            app.addHistory();
        }, 300);
    }
}

function setValue(value, group, option, type)
{
    if (typeof(app.edit.desktop[group]) == 'undefined' && group != 'span') {
        if (type) {
            app.edit[group][type][option] = value;
        } else {
            if (option) {
                app.edit[group][option] = value;
            } else {
                app.edit[group] = value;
            }
        }
    } else {
        if (!app.edit[app.view][group]) {
            app.edit[app.view][group] = {};
        }
        if (type) {
            if (!app.edit[app.view][group][type]) {
                app.edit[app.view][group][type] = {};
            }
            app.edit[app.view][group][type][option] = value;
        } else {
            if (option) {
                app.edit[app.view][group][option] = value;
            } else {
                app.edit[app.view][group] = value;
            }
        }
    }
}

function getSlideHtml(obj)
{
    var li = document.createElement('li'),
        caption = document.createElement('div'),
        inner = document.createElement('div'),
        str = '<div class="slideshow-title-wrapper',
        img = document.createElement('div');
    li.className = 'item';
    img.className = 'ba-slideshow-img';
    if (app.edit.type == 'slideshow') {
        if (obj.video) {
            img.dataset.video = true;
        }
        var video = document.createElement('div');
        video.id = new Date().getTime() + Math.floor(Math.random() * 100);
        img.appendChild(video);
        li.appendChild(img);
        li.appendChild(caption);
        var animation = {
            title : app.edit.desktop.title.animation.effect,
            description : app.edit.desktop.description.animation.effect,
            button : app.edit.desktop.button.animation.effect,
        }
    } else {
        inner.className = 'slideset-inner';
        li.appendChild(inner);
        inner.appendChild(img);
        inner.appendChild(caption);
        var animation = {
            title : '',
            description : '',
            button : ''
        }
    }
    caption.className = 'ba-slideshow-caption';
    if (!obj.title) {
        str += ' empty-content';
    }
    str += '"><h3 class="ba-slideshow-title '+animation.title+'">';
    str += obj.title+'</h3></div><div class="slideshow-description-wrapper';
    if (!obj.description) {
        str += ' empty-content';
    }
    str += '"><div class="ba-slideshow-description '+animation.description;
    str += '">'+obj.description+'</div></div><div class="slideshow-button';
    if (!obj.button.title) {
        str += ' empty-content';
    }
    str += '"><a class="'+obj.button.type+" ";
    str += animation.button+'" href="'+obj.button.href;
    str += '" target="'+obj.button.target+'"';
    if (obj.button.download) {
        str += ' download';
    }
    str += '>'+obj.button.title+'</a></div>';
    caption.innerHTML = str;

    return li
}

function getTextTypographyValue(group, option, type)
{
    var obj = app.editor.$g(app.selector).closest('footer.footer').length > 0 ? app.editor.app.footer : app.editor.app.theme,
        object = $g.extend(true, {}, obj.desktop);
    if (app.view != 'desktop') {
        for (var ind in app.editor.breakpoints) {
            if (!obj[ind]) {
                obj[ind] = {};
            }
            object = $g.extend(true, {}, object, obj[ind]);
            if (ind == app.view) {
                break;
            }
        }
    }
    if (type) {
        return object[group][type][option];
    } else if (option) {
        return object[group][option];
    } else {
        return object[group];
    }
}

function getValue(group, option, type)
{
    var object = $g.extend(true, {}, app.edit.desktop);
    if (app.view != 'desktop') {
        for (var ind in app.editor.breakpoints) {
            if (!app.edit[ind]) {
                app.edit[ind] = {};
            }
            object = $g.extend(true, {}, object, app.edit[ind]);
            if (ind == app.view) {
                break;
            }
        }
    }
    if (!object[group]) {
        return false;
    } else if (type) {
        return object[group][type][option];
    } else if (option) {
        return object[group][option];
    } else {
        return object[group];
    }
}

function inputCallback(input)
{
    var val = input.val(),
        module = input.attr('data-module'),
        option = input.attr('data-option'),
        callback = input.attr('data-callback'),
        subgroup = input.attr('data-subgroup'),
        group = input.attr('data-group');
    if (!group) {
        group = option;
        option = '';
    }
    if (group || option || subgroup) {
        setValue(val, group, option, subgroup);
        app[callback]();
        clearTimeout(delay)
        delay = setTimeout(function(){
            if (app.edit.type == 'slideset' || app.edit.type == 'carousel' || app.edit.type == 'recent-posts-slider') {
                var object = {
                    data : app.edit,
                    selector : app.editor.app.edit
                };
                app.editor.app.checkModule('initslideset', object);
            } else if (app.edit.type == 'progress-pie') {
                app.drawPieLine();
            }
            app.addHistory();
            if (module) {
                app.editor.app.checkModule(module);
            }
        }, 300);
    }
    if (app.edit && (app.edit.type == 'text' || app.edit.type == 'headline') && group != 'margin') {
        input.closest('.ba-settings-item').find('> div:last-child').css('display', '');
    }
}

function linkAction(query, $this)
{
    var img = app.editor.document.getElementById(app.editor.app.edit);
    img = img.querySelector(query);
    if (img.parentNode.localName == 'a') {
        if ($g.trim($this.value)) {
            img.parentNode.href = $this.value;
        } else {
            var a = img.parentNode;
            a.parentNode.insertBefore(img, a);
            a.parentNode.removeChild(a);
        }
    } else {
        if ($g.trim($this.value)) {
            var a = document.createElement('a');
            a.href = $this.value;
            a.target = app.edit.link.target;
            if (app.edit.link.type) {
                a.setAttribute('download', '');
            } else {
                a.removeAttribute('download');
            }
            img.parentNode.insertBefore(a, img);
            a.appendChild(img);
            a.addEventListener('click', function(event){
                event.preventDefault();
            });
        }
    }
    app.edit.link.link = $this.value;
}

function setMinicolorsColor(value)
{
    var rgba = app.editor.app.theme.colorVariables[value] ? app.editor.app.theme.colorVariables[value].color : value,
        color = rgba2hex(rgba);
    var obj = {
        color : color[0],
        opacity : color[1],
        update: false
    }
    $g('.variables-color-picker').minicolors('value', obj).closest('#color-picker-cell')
        .find('.minicolors-opacity').val(color[1]);
    $g('#color-variables-dialog .active').removeClass('active');
    $g('#color-picker-cell, #color-variables-dialog .nav-tabs li:first-child').addClass('active');
}

function inputColor()
{
    var value = this.value.trim().toLowerCase();
    if (value.indexOf('@') === 0) {
        $g(this).closest('.ba-settings-item').find('.minicolors-opacity').val('').attr('readonly', true);
        if (app.editor.app.theme.colorVariables[value]) {
            this.dataset.rgba = value;
            var color = app.editor.app.theme.colorVariables[value].color
            $g(this).next().find('.minicolors-swatch-color').css('background-color', color);
            setMinicolorsColor(value);
            $g(this).trigger('minicolorsInput');
        }
    } else {
        var parts = value.match(/[^#]\w/g),
            opacity = 1;
        if (parts && parts.length == 3) {
            var rgba = 'rgba(';
            for (var i = 0; i < 3; i++) {
                rgba += parseInt(parts[i], 16);
                rgba += ', ';
            }
            if (!this.dataset.rgba || this.dataset.rgba.indexOf('@') === 0) {
                rgba += '1)';
            } else {
                parts = this.dataset.rgba.toLowerCase().match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);
                if (!parts) {
                    rgba += '1)';
                } else {
                    opacity = parts[4];
                    rgba += parts[4]+')';
                }
            }
            this.dataset.rgba = rgba;
            $g(this).next().find('.minicolors-swatch-color').css('background-color', rgba);
            $g(this).trigger('minicolorsInput');
            setMinicolorsColor(rgba);
        }
        $g(this).closest('.ba-settings-item').find('.minicolors-opacity').val(opacity).removeAttr('readonly');
    }
}

$g('input[data-type="color"]').each(function(){
    var div = document.createElement('div'),
        callback = $g(this).parent().find('.minicolors-opacity').attr('data-callback');
    div.className = 'minicolors minicolors-theme-bootstrap';
    this.dataset.callback = callback;
    this.classList.add('minicolors-input');
    $g(this).wrap(div);
    $g(this).after('<span class="minicolors-swatch"><span class="minicolors-swatch-color"></span></span>');
});

$g('.ba-range-wrapper input[type="range"]').each(function(){
    rangeAction(this, inputCallback);
});

$g('.ba-settings-toolbar input[type="number"]').on('input', function(){
    inputCallback($g(this));
});

$g('[data-type="upload-image"]').on('mousedown', function(){
    fontBtn = this;
    var modal = $g('#uploader-modal').attr('data-check', 'single');
    uploadMode = 'image';
    checkIframe(modal, 'uploader');
});

$g('.border-style-select').on('customAction', function(){
    var $this = $g(this).find('input[type="hidden"]'),
        val = $this.val(),
        subgroup = $this.attr('data-subgroup'),
        group = $this.attr('data-group'),
        option = $this.attr('data-option');
    setValue(val, group, option, subgroup);
    app.sectionRules();
    app.addHistory();
});

$g('.image-options .ba-custom-select').on('customAction', function(){
    var option = $g(this).find('input[type="hidden"]')[0];
    setValue(option.value, 'background', option.dataset.option, 'image');
    app[option.dataset.action]();
    app.addHistory();
});

$g('.video-select').on('customAction', function(){
    var type = $g(this).find('[data-option="video-type"]').val(),
        value = $g(this).find('li[data-value="'+type+'"]').text().trim(),
        parent = $g(this).closest('.video-options');
    parent.addClass('ba-active-options');
    parent.find('.video-source-select, .youtube-quality').hide();
    parent.find('.video-id').css('display', '');
    if (type == 'youtube') {
        parent.find('.youtube-quality').show();
    } else if (type == 'source') {
        parent.find('.video-id').hide();
        parent.find('.video-source-select').css('display', '');
    }
    $g(this).find('input[readonly]').val(value);
    setTimeout(function(){
        parent.removeClass('ba-active-options');
    }, 1);
});

$g('.video-source-select input').on('click', function(){
    fontBtn = this;
    uploadMode = 'videoSource';
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
}).on('change', function(){
    if (this.dataset.option) {
        var option = this.dataset.option,
            type = $g(this).closest('.video-options').find('[data-option="video-type"]').val();
        app.edit.desktop.video.type = type;
        app.edit.desktop.video[option] = this.value;
        app.edit.desktop.video['id'] = '';
        $g(this).closest('.ba-settings-group').find('[data-option="id"]').val('');
        videoDelay(app.selector);
    } else {
        $g('#apply-new-slide').removeClass('disable-button').addClass('active-button');
    }
});

$g('.video-options [data-option="id"], .video-options [data-option="start"]').on('input', function(){
    var option = this.dataset.option,
        type = $g(this).closest('.video-options').find('[data-option="video-type"]').val();
    app.edit.desktop.video.type = type;
    app.edit.desktop.video[option] = this.value;
    if (option == 'id') {
        app.edit.desktop.type = 'video';
        app.edit.desktop.video['source'] = '';
        $g(this).closest('.ba-settings-group').find('[data-option="source"]').val('');
    }
    videoDelay(app.selector);
});

$g('.video-options [data-option="mute"]').on('change', function(){
    var type = $g(this).closest('.video-options').find('[data-option="video-type"]').val();
    app.edit.desktop.video.type = type;
    if (app.edit.desktop.video.mute) {
        app.edit.desktop.video.mute = 0;
    } else {
        app.edit.desktop.video.mute = 1;
    }
    videoDelay(app.selector);
});

$g('.video-quality').on('customAction', function(){
    var quality = $g(this).find('input[type="hidden"]').val(),
        type = $g(this).closest('.video-options').find('[data-option="video-type"]').val();
    app.edit.desktop.video.type = type;
    app.edit.desktop.video.quality = quality;
    videoDelay(app.selector);
});

function backgroundSelectAction($this, callback)
{
    var target = $this.find('input[type="hidden"]').val(),
        parent = $g('.'+target+'-options');
    setValue(target, 'background', 'type');
    app[callback]();
    $this.closest('.ba-settings-group').find('.background-options').find('> div').hide();
    parent.css('display', '').addClass('ba-active-options');
    if (typeof(app.editor.videoResize) != 'undefined') {
        app.editor.videoResize();
    }
    setTimeout(function(){
        parent.removeClass('ba-active-options');
    }, 1);
}

$g('.background-select').on('customAction', function(){
    var $this = $g(this);
    setValue('', 'video', 'id');
    setValue('', 'video', 'source');
    setValue('', 'background', 'image', 'image');
    if (app.edit.parallax) {
        app.edit.parallax.enable = false;
        $g('[data-group="parallax"][data-option="enable"]').prop('checked', app.edit.parallax.enable);
        app.editor.app.loadParallax();
        $g('.parallax-options').css('display', 'none');
    }
    backgroundSelectAction($this, this.dataset.callback);
    $this.closest('.ba-settings-group').find('[data-type="upload-image"], [data-option="id"], [data-option="source"]').val('');
    app.addHistory();
});

$g('.backround-size').on('customAction', function(){
    var size = $g(this).find('input[type="hidden"]').val(),
        parent = $g(this).closest('.tab-pane').find('.contain-size-options');
    if (size == 'contain' || size == 'initial') {
        parent.show().addClass('ba-active-options');
    } else {
        parent.hide();
    }
    setTimeout(function(){
        parent.removeClass('ba-active-options');
    }, 1);
});

$g('[data-type="reset"]').not('.reset-text-typography').on('mousedown', function(){
    var option = this.dataset.option,
        action = this.dataset.action,
        subgroup = this.dataset.subgroup,
        search = '[data-group="'+option+'"]',
        parent = $g(this).closest('.ba-settings-toolbar');
    if (subgroup) {
        search += '[data-subgroup="'+subgroup+'"]';
    }
    parent.find(search).not(this).each(function(){
        var key = this.dataset.option;
        this.value = 0;
        setValue('0', option, key, subgroup);
    });
    app[action]();
    app.addHistory();
});

$g('.reset-text-typography').on('mousedown', function(){
    var input = $g(this).closest('.ba-settings-item').find('input[type="number"]'),
        group = input.attr('data-group'),
        option = input.attr('data-option'),
        val = getTextTypographyValue(group, option);
    var range = input.val(val).prev().val(val);
    setLinearWidth(range);
    delete(app.edit[app.view][group][option]);
    app.sectionRules();
    app.addHistory();
    $g(this).closest('div').hide();
});

$g('input[data-option="disable"]').on('change', function(){
    var val = 0,
        group = this.dataset.group;
    if ($g(this).prop('checked')) {
        val = 1;
    }
    if ((app.edit.type == 'lightbox' || app.edit.type == 'cookies') && group == app.view) {
        var item = app.editor.document.querySelector('.ba-lightbox-backdrop[data-id="'+app.editor.app.edit+'"]');
        if (val == 1 && $g('.show-hidden-elements')[0].style.display != 'none') {
            item.classList.remove('visible-lightbox');
            app.editor.document.body.classList.remove('lightbox-open');
            app.editor.document.body.classList.remove('ba-lightbox-open');
        } else {
            item.classList.add('visible-lightbox');
            app.editor.document.body.classList.remove('ba-lightbox-open');
            if (app.edit.position == 'lightbox-center') {
                app.editor.document.body.classList.add('lightbox-open');
            }
        }
    }
    if (app.edit.type == 'overlay-section' && group == app.view) {
        var item = app.editor.document.querySelector('.ba-overlay-section-backdrop[data-id="'+app.editor.app.edit+'"]');
        if (val == 1 && $g('.show-hidden-elements')[0].style.display != 'none') {
            item.classList.remove('visible-section');
            app.editor.document.body.classList.remove('lightbox-open');
        } else {
            item.classList.add('visible-section');
            app.editor.document.body.classList.add('lightbox-open');
        }
    }
    if (app.edit.type == 'column') {
        var item = app.editor.document.getElementById(app.editor.app.edit).parentNode,
            className = '';
        switch (group) {
            case 'tablet':
                className = 'md';
                break;
            case 'phone' : 
                className = 'sm';
                break;
            default : 
                className = 'lg';
        }
        if (val == 0) {
            item.classList.remove('ba-hidden-'+className);
            if (group == 'desktop' && item.parentNode.lastElementChild == item) {
                item.previousElementSibling.classList.remove('ba-hidden-node');
            }
        } else {
            item.classList.add('ba-hidden-'+className);
            if (group == 'desktop' && item.parentNode.lastElementChild == item) {
                item.previousElementSibling.classList.add('ba-hidden-node');
            }
        }
    }
    app.edit[group].disable = val;
    app.sectionRules();
    app.addHistory();
});

$g('.section-access-select').on('customAction', function(){
    var val = $g(this).find('input[type="hidden"]').val();
    app.edit.access = val;
    app.addHistory();
});

$g('.class-suffix').on('input', function(){
    var id = app.editor.app.edit,
        val = this.value;
    editClass(val, id, app.edit);
});

$g('.typography-select').on('customAction', function(){
    var target = $g(this).find('input[type="hidden"]').val(),
        parent = $g(this).closest('.ba-settings-group').find('.typography-options');
    parent.find('> div').hide();
    if (target == 'links') {
        parent.find('.links').removeAttr('style');
    } else {
        parent.find('> div').not('.links').removeAttr('style')
    }
    app.setTypography(parent, target);
    parent.addClass('ba-active-options');
    setTimeout(function(){
        parent.removeClass('ba-active-options');
    }, 1);
});

$g('label[data-option]').on('click', function(){
    var val = this.dataset.value,
        option = this.dataset.option,
        group = this.dataset.group,
        subgroup = this.dataset.subgroup,
        callback = this.dataset.callback;
    switch (option) {
        case 'text-align' :
        case 'open-align' :
        case 'close-align' :
        case 'align' :
            if (!$g(this).hasClass('active')) {
                var label = $g(this).closest('.ba-settings-toolbar').find('label[data-option="'+option+'"].active');
                if (!group) {
                    group = option;
                    option = '';
                }
                setValue(val, group, option, subgroup);
                label.removeClass('active');
                app[callback]();
                $g(this).addClass('active');
                app.addHistory();
            }
            break;
        case 'font-style' :
            if ($g(this).hasClass('active')) {
                setValue('normal', group, option, subgroup);
                $g(this).removeClass('active');
            } else {
                setValue(val, group, option, subgroup);
                $g(this).addClass('active');
            }
            app[callback]();
            app.addHistory();
            break;
        default :
            if ($g(this).hasClass('active')) {
                setValue('none', group, option, subgroup);
                $g(this).removeClass('active');
            } else {
                setValue(val, group, option, subgroup);
                $g(this).addClass('active');
            }
            app[callback]();
            app.addHistory();
    }
});

$g('#color-variables-dialog .minicolors-opacity').on('input', function(){
    var obj = {
        color: $g('.variables-color-picker').val(),
        opacity: this.value * 1,
        update: false
    }
    $g('.variables-color-picker').minicolors('value', obj);
    fontBtn.dataset.rgba = $g('.variables-color-picker').minicolors('rgbaString');
    $g(fontBtn).trigger('minicolorsInput');
    if (fontBtn.localName == 'input') {
        $g(fontBtn).next().find('.minicolors-swatch-color').css('background-color', fontBtn.dataset.rgba)
            .closest('.minicolors').next().find('.minicolors-opacity').val(this.value);
    }
});

$g('.minicolors-opacity[data-callback]').on('input', function(){
    var input = $g(this).parent().prev().find('.minicolors-input')[0],
        opacity = this.value * 1
        value = input.dataset.rgba;
    if (value.indexOf('@') === -1 && this.value) {
        var parts = value.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/),
            rgba = 'rgba(';
        if (parts) {
            for (var i = 1; i < 4; i++) {
                rgba += parts[i]+', ';
            }
        } else {
            parts = value.match(/[^#]\w/g);
            for (var i = 0; i < 3; i++) {
                rgba += parseInt(parts[i], 16);
                rgba += ', ';
            }
        }
        rgba += this.value+')';
        input.dataset.rgba = rgba;
        $g(input).trigger('minicolorsInput');
        $g(input).next().find('.minicolors-swatch-color').css('background-color', rgba);
    }
});

$g('input[data-type="color"]').on('click', function(){
    fontBtn = this;
    setMinicolorsColor(this.dataset.rgba);
    var rect = this.getBoundingClientRect();
    $g('#color-variables-dialog').css({
        left : rect.left - 285,
        top : rect.bottom - ((rect.bottom - rect.top) / 2) - 174
    }).removeClass('ba-right-position').modal().find('.nav-tabs li:last').css('display', '');
}).on('minicolorsInput', function(){
    var rgba = this.dataset.rgba,
        option = this.dataset.option,
        subgroup = this.dataset.subgroup,
        group = this.dataset.group;
    if (!group) {
        group = option;
        option = '';
    }
    setValue(rgba, group, option, subgroup);
    app[this.dataset.callback]();
    if (app.edit.type == 'progress-pie' && (option == 'bar' || option == 'background')) {
        app.drawPieLine();
    }
}).on('input', inputColor).next().on('click', function(){
    $g(this).prev().trigger('click');
});

$g('.show-text-editor-general').on('click', function(event){
    event.preventDefault();
    var parent = $g(this).closest('.general-tabs'),
        show = $g.Event('show', {
        relatedTarget : parent.find('li.active a')[0],
        target : this
    });
    parent.find('.hide-general-cell').removeClass('hide-general-cell').addClass('show-general-cell');
    parent.find('li.active').removeClass('active');
    $g(this).trigger(show).trigger('shown').parent().addClass('active');
});

$g('.hide-text-editor-general').on('click', function(event){
    event.preventDefault();
    var parent = $g(this).closest('.general-tabs'),
        show = $g.Event('show', {
        relatedTarget : parent.find('li.active a')[0],
        target : this
    });
    parent.find('.show-general-cell').removeClass('show-general-cell').addClass('hide-general-cell');
    if (!this.dataset.toggle) {
        parent.find('li.active').removeClass('active');
        $g(this).trigger(show).parent().addClass('active');
    }
});

$g('.link-target-select').on('customAction', function(){
    app.edit.link.target = $g(this).find('input[type="hidden"]').val();
    var a = app.editor.document.getElementById(app.editor.app.edit);
    a = a.querySelector('a');
    if (a) {
        a.target = app.edit.link.target;
    }
    app.addHistory();
});

$g('.media-fullscrean').on('click', function(){
    var modal = $g(this).closest('.modal');
    if (!modal.hasClass('fullscrean')) {
        modal.addClass('fullscrean');
        $g(this).removeClass('zmdi-fullscreen').addClass('zmdi-fullscreen-exit');
    } else {
        modal.removeClass('fullscrean');
        $g(this).addClass('zmdi-fullscreen').removeClass('zmdi-fullscreen-exit');
    }        
});

$g('.reset:not(.disabled-reset) i').on('click', function(){
    var option = this.dataset.option,
        callback = this.dataset.callback,
        group  = this.dataset.group;
    $g('input[data-option="'+option+'"][data-group="'+group+'"]').val('');
    setValue('', group, option);
    window[callback]();
    app.addHistory();
});

$g('[data-option="link"][data-group="link"]').on('input', function(){
    var $this = this;
    clearTimeout(delay);
    delay = setTimeout(function(){
        switch (app.edit.type) {
            case 'icon' :
                linkAction('.ba-icon-wrapper i', $this);
                break
            case 'image' :
                linkAction('img', $this);
                break;
            default :
                var a = app.editor.document.getElementById(app.editor.app.edit);
                a = a.querySelector('a');
                a.href = $this.value;
                app.edit.link.link = $this.value;
        }
        app.addHistory();
    }, 300);
});

$g('[data-option="type"][data-group="link"]').on('change', function(){
    var a = app.editor.document.querySelector(app.selector+' a');
    app.edit.link.type = this.value;
    if (a) {
        if (app.edit.link.type) {
            a.setAttribute('download', '');
        } else {
            a.removeAttribute('download');
        }
    }
});

$g('input[data-option="alt"]').on('input', function(){
    clearTimeout(delay);
    var $this = this,
        img = app.editor.document.getElementById(app.editor.app.edit);
    img = img.querySelector('img');
    delay = setTimeout(function(){
        app.edit.alt = $this.value;
        img.alt = $this.value;
        app.addHistory();
    }, 300);
});

$g('input[data-option="image"].reselect-image').on('mousedown', function(){
    fontBtn = this;
    uploadMode = 'reselectImage';
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
});

$g('input[type="checkbox"][data-group="border"]').on('change', function(){
    var val = 0,
        option = this.dataset.option,
        subgroup = this.dataset.subgroup,
        group = this.dataset.group;
    if (this.checked) {
        val = 1;
    }
    setValue(val, group, option, subgroup);
    app.sectionRules();
    app.addHistory();
});

$g('.set-value-css').on('change input', function(){
    var $this = this,
        time = 300;
    if (this.type == 'checkbox') {
        time = 0;
    }
    clearTimeout(delay);
    delay = setTimeout(function(){
        var option = $this.dataset.option,
            value = $this.value,
            subgroup = $this.dataset.subgroup,
            group = $this.dataset.group;
        if (!group) {
            group = option;
            option = '';
        }
        if ($this.type == 'checkbox') {
            value = $this.checked;
        }
        setValue(value, group, option, subgroup);
        app.sectionRules();
        app.addHistory();
        if (app.edit.type == 'slideset' || app.edit.type == 'carousel' || app.edit.type == 'recent-posts-slider') {
            var object = {
                data : app.edit,
                selector : app.editor.app.edit
            };
            app.editor.app.checkModule('initslideset', object);
        }
    }, time);
});

$g('.ba-style-custom-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    showBaStyleDesign(value, this);
});

$g('.ba-style-image-options .ba-custom-select').on('customAction', function(){
    var input = $g(this).find('input[type="hidden"]')[0];
    setValue(input.value, 'image', input.dataset.option);
    app[input.dataset.action]();
    app.addHistory();
});

$g('.blog-posts-layout-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    app.edit.layout.layout = value;
    $g('.blog-posts-cover-options').hide();
    $g('.blog-posts-background-options').css('display', '');
    $g('#recent-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().css('display', '');
    $g('#blog-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().css('display', '');
    if (app.edit.layout.layout == 'ba-classic-layout') {
        $g('.blog-posts-grid-options').hide();
        $g('.blog-posts-grid-options input[data-option="count"]').closest('.ba-settings-group').addClass('enabled-grid');
        if (app.edit.type != 'blog-posts') {
            $g('#recent-posts-design-options .ba-style-image-options').first().css('display', '');
        }
    } else {
        $g('.blog-posts-grid-options').css('display', '');
        $g('.blog-posts-grid-options input[data-option="count"]').closest('.ba-settings-group').removeClass('enabled-grid');
        if (app.edit.layout.layout == 'ba-cover-layout') {
            $g('.ba-style-image-options .blog-posts-grid-options').hide();
            $g('.blog-posts-cover-options').css('display', '');
            $g('.blog-posts-background-options').hide();
            $g('#recent-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().hide();
            $g('#blog-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().hide();
        }
    }
    app.sectionRules();
    app.addHistory();
});

$g('.selected-categories .search-category input').on('click', function(event){
    event.stopPropagation();
    $g('.all-categories-list li[data-app="'+app.edit.app+'"]:not(.selected-category)').css('display', '');
    $g('body').one('click', function(){
        $g('.all-categories-list li').hide();
    });
});

$g('.all-categories-list li').on('click', function(){
    if (!this.classList.contains('selected-category')) {
        this.classList.add('selected-category');
        var obj = {
            title : this.textContent.trim(),
            id : this.dataset.id
        }
        var str = getCategoryHtml(obj.id, obj.title);
        app.edit.categories[obj.id] = obj;
        $g(this).closest('.tags-categories').find('.selected-categories li.search-category').before(str);
        $g('.ba-settings-item.tags-categories-list').addClass('not-empty-list');
        window[app.recentPostsCallback]();
    }
});

$g('.selected-categories').on('click', 'li.chosen-category .zmdi-close', function(){
    $g('.all-categories-list li[data-id="'+this.dataset.remove+'"]').removeClass('selected-category');
    delete(app.edit.categories[this.dataset.remove]);
    $g(this).closest('li').remove();
    if ($g('.selected-categories li:not(.search-category)').length > 0) {
        $g('.ba-settings-item.tags-categories-list').addClass('not-empty-list');
    } else {
        $g('.ba-settings-item.tags-categories-list').removeClass('not-empty-list');
    }
    window[app.recentPostsCallback]();
});

$g('.recent-posts-app-select').on('customAction', function(){
    var input = this.querySelector('input[type="hidden"]');
    if (input.value != app.edit[input.dataset.option]) {
        app.edit[input.dataset.option] = input.value;
        app.edit.categories = {};
        $g('.selected-categories li:not(.search-category)').remove();
        $g('.all-categories-list .selected-category').removeClass('selected-category');
        $g('.ba-settings-item.tags-categories-list').removeClass('not-empty-list');
        window[app.recentPostsCallback]();
    }
});

$g('.recent-posts-display-select, .related-posts-display-select').on('customAction', function(){
    var input = this.querySelector('input[type="hidden"]');
    if (input.value != app.edit[input.dataset.option]) {
        app.edit[input.dataset.option] = input.value;
        window[app.recentPostsCallback]();
    }
});

$g('#recent-posts-settings-dialog, #slideshow-settings-dialog').find('input.recent-limit, input[data-option="maximum"]')
    .on('input', function(){
    var $this = this;
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.edit[$this.dataset.option] = $this.value;
        if (app.recentPostsCallback) {
            window[app.recentPostsCallback]();
        }
    });
});

$g('.select-link').on('click', function(){
    fontBtn = $g(this).parent().find('input[type="text"]');
    app.checkModule('selectLink');
});

$g('.select-file').on('click', function(){
    fontBtn = $g(this).parent().find('input[type="text"]');
    uploadMode = 'selectFile';
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
});

$g('.reset-element-icon i').on('click', function(){
    var parent = $g(this).closest('.ba-modal-sm');
    $g(parent).find('.select-item-icon').attr('data-value', '').val('').trigger('input');
});

$g('.select-item-icon').on('click', function(){
    uploadMode = 'selectItemIcon';
    checkIframe($g('#icon-upload-dialog'), 'icons');
    fontBtn = this;
});

$g('.background-overlay-select').on('customAction', function(){
    var input = this.querySelector('input[type="hidden"]'),
        parent = $g('.overlay-'+input.value+'-options');
    setValue(input.value, input.dataset.property, 'type');
    $g('.overlay-color-options, .overlay-gradient-options').hide();
    parent.css('display', '').addClass('ba-active-options');
    setTimeout(function(){
        parent.removeClass('ba-active-options');
    }, 1);
    if (input.dataset.callback) {
        app[input.dataset.callback]();
    } else {
        app.sectionRules();
    }
    app.addHistory();
});

$g('.gradient-effect-select').on('customAction', function(){
    var input = this.querySelector('input[type="hidden"]'),
        parent = $g(this).closest('.tab-pane');
    setValue(input.value, input.dataset.property, 'effect', 'gradient');
    parent.find('.'+input.dataset.property+'-linear-gradient').hide();
    parent.find('.'+input.dataset.property+'-'+input.value+'-gradient').css('display', '');
    if (input.dataset.callback) {
        app[input.dataset.callback]();
    } else {
        app.sectionRules();
    }
    app.addHistory();
});

function addFontLink(obj, key)
{
    var object = app.editor.$g(app.selector).closest('footer.footer').length > 0 ? app.editor.app.footer : app.editor.app.theme,
        font = obj.font == '@default' ? getTextParentFamily(object.desktop, key) : obj.font,
        styles = obj.styles == '@default' ? getTextParentWeight(object.desktop, key) : obj.styles,
        link = '//fonts.googleapis.com/css?family='+font+':'+styles,
        file = app.editor.document.createElement('link');
    link += '&subset=latin,cyrillic,greek,latin-ext,greek-ext,vietnamese,cyrillic-ext';
    file.rel = 'stylesheet';
    file.type = 'text/css';
    file.href = link;
    app.editor.document.head.appendChild(file);
}

function addFontStyle(obj, key)
{
    var object = app.editor.$g(app.selector).closest('footer.footer').length > 0 ? app.editor.app.footer : app.editor.app.theme,
        style = document.createElement('style'),
        font = obj.font == '@default' ? getTextParentFamily(object.desktop, key) : obj.font,
        styles = obj.styles == '@default' ? getTextParentWeight(object.desktop, key) : obj.styles,
        str = "@font-face {font-family: '"+font.replace(/\+/g, ' ')+"';";
    str += 'font-weight : '+styles+';';
    str += ' src: url('+JUri+'templates/gridbox/library/fonts/'+obj.custom_src+');}';
    style.type = 'text/css';
    app.editor.document.head.appendChild(style);
    style.innerHTML = str;
}

function addFontFamily(obj, $this)
{
    var callback = $this.dataset.callback,
        key = (app.edit.type == 'text' || app.edit.type == 'headline') ? $this.dataset.group : 'body',
        subgroup = $this.dataset.subgroup,
        group = $this.dataset.group;
    if (!obj.custom_src) {
        addFontLink(obj, key);
    } else {
        addFontStyle(obj, key);
    }
    if (!subgroup) {
        app.edit.desktop[group]['font-family'] = obj.font;
        app.edit.desktop[group]['font-weight'] = obj.styles;
        app.edit.desktop[group]['custom'] = obj.custom_src;
    } else {
        app.edit.desktop[group][subgroup]['font-family'] = obj.font;
        app.edit.desktop[group][subgroup]['font-weight'] = obj.styles;
        app.edit.desktop[group][subgroup]['custom'] = obj.custom_src;
    }
    setTimeout(function(){
        app[callback]();
        if (callback != 'sectionRules') {
            app.sectionRules();
        }
    }, 300);
    app.addHistory();
}

function getTextParentFamily(obj, key)
{
    var family = obj[key]['font-family'];
    if (family == '@default') {
        family = obj.body['font-family'];
    }

    return family;
}

function getTextParentWeight(obj, key)
{
    var weight = obj[key]['font-weight'];
    if (weight == '@default') {
        weight = obj.body['font-weight'];
    }

    return weight;
}

function getTextParentCustom(obj, key)
{
    var object = obj[key];
    if (object['font-family'] == '@default') {
        object = obj.body;
    }

    return object['custom'];
}

function getTextParentList(obj, key)
{
    var family = getTextParentFamily(obj, key), array;
    if (fontsLibrary[family]) {
        array = fontsLibrary[family];
    } else {
        array =  new Array();
    }

    return array;
}

$g('input[data-option="font-family"]').on('change', function(){
    var ul = $g(this).closest('.typography-options').find('.font-weight-select ul').empty(),
        key = 'body',
        array = fontsLibrary[this.value],
        input = ul.prev().prev();
    if (app.edit.type == 'text' || app.edit.type == 'headline') {
        key = this.dataset.group;
    }
    if (!app.edit.type || app.edit.type == 'footer') {
        app.editor.app.setNewFont = true;
        app.editor.app.fonts = {};
        app.editor.app.customFonts = {};
    }
    if (this.value == '@default') {
        if (app.editor.$g(app.selector).closest('footer.footer').length > 0) {
            var parent = app.editor.app.footer.desktop;
        } else {
            var parent = app.editor.app.theme.desktop;
        }
        array = getTextParentList(parent, key);
        var object = {
                font: this.value,
                styles: this.value,
                custom_src: getTextParentCustom(parent, key)
            };
    } else {
        var object = $g.extend({}, array[0]);
    }
    if (this.dataset.group != 'body') {
        object.styles = '@default';
    }
    if (this.dataset.group != 'body') {
        ul.append('<li data-value="@default">'+gridboxLanguage['INHERIT']+'</li>');
    }
    for (var i = 0; i < array.length; i++) {
        var weight = array[i].styles,
            str = '<li data-value="'+weight+'">'+weight.replace('i', ' Italic')+'</li>';
        ul.append(str);
    }
    var value = object.styles == '@default' ? gridboxLanguage['INHERIT'] : object.styles.replace('i', ' Italic');
    input.val(object.styles).prev().val(value);
    addFontFamily(object, this);
});

$g('input[data-option="font-weight"]').on('change', function(){
    var font = $g(this).closest('.typography-options').find('.font-family-select input[type="hidden"]').val(),
        obj = {};
    if (font == '@default' || this.value == '@default') {
        var key = 'body';
        if (app.edit.type == 'text' || app.edit.type == 'headline') {
            key = this.dataset.group;
        }
        if (app.editor.$g(app.selector).closest('footer.footer').length > 0) {
            var parent = app.editor.app.footer.desktop;
        } else {
            var parent = app.editor.app.theme.desktop;
        }
        obj = {
            font: font,
            styles: this.value,
            custom_src: font == '@default' ? getTextParentCustom(parent, key) : fontsLibrary[font][0].custom_src
        }
        if (this.value != '@default' && !this.dataset.subgroup) {
            obj.custom_src = app.edit.desktop[this.dataset.group]['custom'];
        } else if (this.value != '@default') {
            obj.custom_src = app.edit.desktop[this.dataset.group][this.dataset.subgroup]['custom'];
        }
    } else {
        for (var i = 0; i < fontsLibrary[font].length; i++) {
            if (fontsLibrary[font][i].styles == this.value) {
                obj = fontsLibrary[font][i];
            }
        }
    }
    if (!app.edit.type || app.edit.type == 'footer') {
        app.editor.app.setNewFont = true;
        app.editor.app.fonts = {};
        app.editor.app.customFonts = {};
    }
    addFontFamily(obj, this);
});

$g('.create-new-preset').on('click', function(){
    $g('.preset-title').val('');
    $g('#save-preset').removeClass('active-button').addClass('disable-button').attr('data-key', '');
    $g('.save-as-default-preset').prop('checked', false);
    $g('#create-preset-dialog').modal();
    $g(this).closest('.select-preset').trigger('click');
});

$g('.edit-preset-item').on('click', function(){
    if (!this.classList.contains('disable-button')) {
        $g('.preset-title').val(app.editor.app.theme.presets[app.edit.type][this.dataset.value].title);
        $g('#save-preset').removeClass('active-button').addClass('disable-button').attr('data-key', this.dataset.value);
        $g('.save-as-default-preset').prop('checked', app.editor.app.theme.defaultPresets[app.edit.type] == this.dataset.value);
        $g('#create-preset-dialog').modal();
        $g(this).closest('.select-preset').trigger('click');
    }
});

$g('.delete-preset-item').on('click', function(){
    if (!this.classList.contains('disable-button')) {
        app.itemDelete = 'ba-delete-preset:'+this.dataset.value;
        app.checkModule('deleteItem');
        $g(this).closest('.select-preset').trigger('click');
    }
});

$g('.save-as-default-preset').on('change', function(){
    var value = $g('.preset-title').val().trim();
    if (value) {
        $g('#save-preset').addClass('active-button').removeClass('disable-button');
    } else {
        $g('#save-preset').removeClass('active-button').addClass('disable-button');
    }
});

$g('.preset-title').on('input', function(){
    if (this.value.trim() && !app.editor.app.theme.presets[app.edit.type][this.value.trim()]) {
        $g('#save-preset').addClass('active-button').removeClass('disable-button');
    } else {
        $g('#save-preset').removeClass('active-button').addClass('disable-button');
    }
});

$g('#save-preset').on('click', function(event){
    event.preventDefault();
    if (this.classList.contains('active-button')) {
        if (!this.dataset.key) {
            var patern = presetsPatern[app.edit.type],
                title = $g('.preset-title').val().trim(),
                value = title,
                obj = {};
            for (var ind in patern) {
                if (ind == 'desktop') {
                    obj[ind] = {};
                    for (var key in patern[ind]) {
                        obj[ind][key] = $g.extend(true, {}, app.edit[ind][key]);
                    }
                    for (var ind in app.editor.breakpoints) {
                        if (app.edit[ind]) {
                            obj[ind] = {};
                            for (var key in patern.desktop) {
                                if (obj[ind][key]) {
                                    obj[ind][key] = $g.extend(true, {}, app.edit[ind][key]);
                                } else {
                                    obj[ind][key] = {};
                                }
                            }
                        }
                    }
                } else {
                    obj[ind] = $g.extend(true, {}, app.edit[ind]);
                }
            }
            app.editor.app.theme.presets[app.edit.type][value] = {
                'title': title,
                'data' : obj
            };
            app.edit.preset = value;
            comparePresets(app.edit);
            checkPresetProperties();
            app.addHistory();
        } else {
            var title = $g('.preset-title').val().trim(),
                value = this.dataset.key;
            app.editor.app.theme.presets[app.edit.type][value].title = title;
            if (!$g('.save-as-default-preset').prop('checked') && app.editor.app.theme.defaultPresets[[app.edit.type]] == value) {
                delete(app.editor.app.theme.defaultPresets[[app.edit.type]]);
            }
        }
        if ($g('.save-as-default-preset').prop('checked')) {
            app.editor.app.theme.defaultPresets[[app.edit.type]] = value;
        }
        app.editor.app.checkModule('editItem');
        $g('#create-preset-dialog').modal('hide');
    }
});

$g('.select-preset').on('customAction', function(){
    app.edit.preset = this.querySelector('input[type="hidden"]').value;
    comparePresets(app.edit);
    app.editor.app.checkModule('editItem');
    app.editor.app.setNewFont = true;
    app.editor.app.fonts = {};
    app.editor.app.customFonts = {};
    app.sectionRules();
    checkPresetProperties();
    app.addHistory();
});

function checkPresetProperties()
{
    if (app.edit.preset) {
        if (app.edit.desktop.shape && 'setShapeDividers' in window) {
            var str = '.ba-'+app.edit.type.replace('column', 'grid-column');
            app.editor.$g(str).each(function(){
                if (app.editor.app.items[this.id] && app.editor.app.items[this.id].preset == app.edit.preset) {
                    setShapeDividers(app.editor.app.items[this.id], this.id);
                }
            });
        }
        if (app.edit.type == 'progress-pie') {
            app.drawPieLine();
        }
        app.editor.$g(app.selector).closest('li').trigger('mouseenter');
    }
}

function compareFlipboxPresets(obj, object)
{
    obj.parallax = object.parallax;
    obj.desktop.background = object.desktop.background;
    obj.desktop.overlay = object.desktop.overlay;
    for (var i in app.editor.breakpoints) {
        if (object[i].background) {
            obj[i].background = object[i].background;
        }
        if (object[i].overlay) {
            obj[i].overlay = object[i].overlay;
        }
    }
}

function comparePresets(obj)
{
    if (obj.preset && app.editor.app.theme.presets[obj.type] && app.editor.app.theme.presets[obj.type][obj.preset]) {
        var object = app.editor.app.theme.presets[obj.type][obj.preset];
        for (var ind in object.data) {
            if (ind == 'desktop' || ind in app.editor.breakpoints) {
                for (key in object.data[ind]) {
                    obj[ind][key] = object.data[ind][key];
                }
            } else if (obj.type == 'flipbox' && ind == 'sides') {
                compareFlipboxPresets(obj.sides.backside, object.data[ind].backside);
                compareFlipboxPresets(obj.sides.frontside, object.data[ind].frontside);
            } else {
                obj[ind] = app.editor.app.theme.presets[obj.type][obj.preset].data[ind];
            }
        }
    } else {
        obj.presets = '';
        for (var ind in obj) {
            if (typeof(obj[ind]) == 'object') {
                obj[ind] = $g.extend(true, {}, obj[ind]);
            }
        }
    }
}

function setPresetsList(modal)
{
    if (app.edit.preset && app.editor.app.theme.presets[app.edit.type] && app.editor.app.theme.presets[app.edit.type][app.edit.preset]) {
        modal.find('.select-preset input[type="hidden"]').val(app.edit.preset)
            .prev().val(app.editor.app.theme.presets[app.edit.type][app.edit.preset].title);
    } else {
        modal.find('.select-preset input[type="hidden"]').val('');
        modal.find('.select-preset input[type="text"]').val(gridboxLanguage['NO_NE']);
    }
    getPresetsLi(modal);
}

function getPresetsLi(modal)
{
    var str = getPresetLi('', gridboxLanguage['NO_NE']);
    if (!app.editor.app.theme.presets[app.edit.type]) {
        app.editor.app.theme.presets[app.edit.type] = {};
    }
    for (var ind in app.editor.app.theme.presets[app.edit.type]) {
        str += getPresetLi(ind, app.editor.app.theme.presets[app.edit.type][ind].title);
    }
    modal.find('.select-preset .ba-lg-custom-select-body').empty().append(str);
}

function getPresetLi(value, title)
{
    var str = '<li data-value="'+value+'"><label>';
    str += '<input type="radio" name="preset-checkbox" value="'+value+'">';
    str += '<i class="zmdi zmdi-circle-o"></i><i class="zmdi zmdi-check"></i></label><span>'+title+'</span>';
    if (app.editor.app.theme.defaultPresets[app.edit.type] == value) {
        str += '<i class="zmdi zmdi-star"></i>';
    }
    str += '</li>';

    return str;
}

app.drawPieLine = function(){
    app.editor.$g('.ba-item-progress-pie').each(function(){
        var canvas = this.querySelector('canvas'),
            context = canvas.getContext('2d'),
            obj = app.editor.app.items[this.id],
            view = getValue('view');
        canvas.width = view.width;
        canvas.height = canvas.width;
        context.lineCap = 'round';
        app.editor.drawPieLine(obj.target * 3.6, canvas, context, this);
    });
}

app.loadModule('presetsPatern');
setTabsAnimation();