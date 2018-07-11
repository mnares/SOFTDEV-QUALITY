/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.slideshowEditor = function(){
    app.selector = '#'+app.editor.app.edit;
    $g('#slideshow-settings-dialog .active').removeClass('active');
    $g('#slideshow-settings-dialog a[href="#slideshow-general-options"]').parent().addClass('active');
    $g('#slideshow-general-options').addClass('active');
    var li = app.editor.document.querySelectorAll('#'+app.editor.app.edit+' ul li.item'),
        value;
    sortingList = [];
    $g('#slideshow-settings-dialog .sorting-container').html('');
    value = getValue('slides');
    setPresetsList($g('#slideshow-settings-dialog'));
    if (app.edit.type != 'recent-posts-slider') {
        $g('#slideshow-settings-dialog').find('.ba-settings-group.items-list, li[data-value="description"]').css('display', '');
        $g('#slideshow-settings-dialog').find('li[data-value="info"], li[data-value="intro"]').hide();
        $g('#slideshow-settings-dialog .slideshow-options:not(.carousel-options)').css('display', '');
        $g('#slideshow-settings-dialog .slideset-options:not(.carousel-options)').css('display', '');
        $g('#slideshow-settings-dialog .recent-posts-slider-options').hide();
        for (var i = 0; i < li.length; i++) {
            if (!value[i + 1]) {
                value[i + 1] = {
                    image: "",
                    type: "image",
                    link: "",
                    video: null
                }
            }
            var slide = value[i + 1],
                img = li[i].querySelector('.ba-slideshow-img'),
                title = li[i].querySelector('.ba-slideshow-title').textContent,
                description = li[i].querySelector('.ba-slideshow-description').innerHTML,
                button = li[i].querySelector('.ba-btn-transition'),
                obj = {
                    index : i + 1,
                    title : title,
                    description : description,
                    image : slide.image,
                    type : slide.type,
                    video : slide.video,
                    button : {
                        href : $g(button).attr('href'),
                        type : button.className,
                        title : button.textContent,
                        download: button.getAttribute('download'),
                        target : button.target
                    }
                }
            if (typeof(value[i + 1].link) != 'undefined') {
                obj.button.href = value[i + 1].link;
            }
            if (app.view != 'desktop') {
                obj.type = 'image';
            }
            sortingList.push(obj);
            $g('#slideshow-settings-dialog .sorting-container').append(addSlideSortingList(obj, i));
        }
    } else {
        value = getValue('padding', 'top');
        $g('#slideshow-settings-dialog [data-group="padding"][data-option="top"]').val(value);
        value = getValue('padding', 'right');
        $g('#slideshow-settings-dialog [data-group="padding"][data-option="right"]').val(value);
        value = getValue('padding', 'bottom');
        $g('#slideshow-settings-dialog [data-group="padding"][data-option="bottom"]').val(value);
        value = getValue('padding', 'left');
        $g('#slideshow-settings-dialog [data-group="padding"][data-option="left"]').val(value);
        $g('#slideshow-settings-dialog').find('.ba-settings-group.items-list, li[data-value="description"]').hide();
        $g('#slideshow-settings-dialog').find('li[data-value="info"], li[data-value="intro"]').css('display', '');
        $g('#slideshow-settings-dialog .slideshow-options:not(.carousel-options)').hide();
        $g('#slideshow-settings-dialog .slideset-options:not(.carousel-options)').hide();
        $g('#slideshow-settings-dialog .recent-posts-slider-options').css('display', '');
        $g('#slideshow-settings-dialog .recent-posts-slider-options input[data-group="view"]').each(function(){
            value = getValue('view', this.dataset.option);
            this.checked = value;
        });
        $g('#slideshow-settings-dialog .recent-posts-app-select input[type="hidden"]').val(app.edit.app);
        value = $g('#slideshow-settings-dialog .recent-posts-app-select li[data-value="'+app.edit.app+'"]').text();
        $g('#slideshow-settings-dialog .recent-posts-app-select input[readonly]').val($g.trim(value));
        $g('#slideshow-settings-dialog .recent-posts-display-select input[type="hidden"]').val(app.edit.sorting);
        value = $g('#slideshow-settings-dialog .recent-posts-display-select li[data-value="'+app.edit.sorting+'"]').text();
        $g('#slideshow-settings-dialog .recent-posts-display-select input[readonly]').val($g.trim(value));
        $g('#slideshow-settings-dialog input[data-option="limit"]').val(app.edit.limit);
        $g('#slideshow-settings-dialog input[data-option="maximum"]').val(app.edit.maximum);
        if (!app.edit.categories) {
            app.edit.categories = {};
        }
        $g('#slideshow-settings-dialog .selected-categories li:not(.search-category)').remove();
        $g('#slideshow-settings-dialog .all-categories-list .selected-category').removeClass('selected-category');
        for (var key in app.edit.categories) {
            var str = getCategoryHtml(key, app.edit.categories[key].title);
            $g('#slideshow-settings-dialog .selected-categories li.search-category').before(str);
            $g('#slideshow-settings-dialog .all-categories-list [data-id="'+key+'"]').addClass('selected-category');
        }
        if ($g('#slideshow-settings-dialog .selected-categories li:not(.search-category)').length > 0) {
            $g('#slideshow-settings-dialog .ba-settings-item.tags-categories-list').addClass('not-empty-list');
        } else {
            $g('#slideshow-settings-dialog .ba-settings-item.tags-categories-list').removeClass('not-empty-list');
        }
        $g('#slideshow-settings-dialog .tags-categories .all-categories-list li').hide();
        app.recentPostsCallback = 'getRecentPostsSlider';
    }    
    if (!app.edit.desktop.overlay.gradient) {
        app.edit.desktop.overlay.type = 'color';
        app.edit.desktop.overlay.gradient = {
            effect : 'linear',
            angle: '225',
            color1: 'rgba(8, 174, 234, 0.75)',
            position1: '0',
            color2: 'rgba(42, 245, 152, 0.75)',
            position2: '100'
        }
    }
    value = getValue('overlay', 'effect', 'gradient');
    $g('#slideshow-settings-dialog .overlay-linear-gradient').hide();
    $g('#slideshow-settings-dialog .overlay-'+value+'-gradient').css('display', '');
    $g('#slideshow-settings-dialog .overlay-gradient-options .gradient-effect-select input[type="hidden"]').val(value);
    value = $g('#slideshow-settings-dialog .overlay-gradient-options .gradient-effect-select li[data-value="'+value+'"]').text().trim();
    $g('#slideshow-settings-dialog .overlay-gradient-options .gradient-effect-select input[type="text"]').val(value);
    value = getValue('overlay', 'type');
    $g('#slideshow-settings-dialog .overlay-color-options, .overlay-gradient-options').hide();
    $g('#slideshow-settings-dialog .overlay-'+value+'-options').css('display', '');
    $g('#slideshow-settings-dialog .background-overlay-select input[type="hidden"]').val(value);
    value = $g('#slideshow-settings-dialog .background-overlay-select li[data-value="'+value+'"]').text().trim();
    $g('#slideshow-settings-dialog .background-overlay-select input[type="text"]').val(value);
    $g('#slideshow-settings-dialog input[data-subgroup="gradient"][data-group="overlay"]').each(function(){
        value = getValue('overlay', this.dataset.option, 'gradient');
        if (this.type == 'number') {
            var range = $g(this).val(value).prev().val(value);
            setLinearWidth(range);
        } else {
            updateInput($g(this), value);
        }
    });
    value = getValue('overlay', 'color');
    updateInput($g('#slideshow-settings-dialog [data-option="color"][data-group="overlay"]'), value);
    if (app.edit.type == 'slideshow') {
        $g('#slideshow-settings-dialog [data-group="slideshow"]').each(function(){
            if (this.type == 'checkbox') {
                this.checked = app.edit.slideshow[this.dataset.option];
            } else {
                this.value = app.edit.slideshow[this.dataset.option];
            }
        });
        value = getValue('fullscreen');
        $g('#slideshow-settings-dialog [data-option="fullscreen"]')[0].checked = value;
        $g('.slideshow-animation-select input[type="hidden"]').val(app.edit.animation);
        value = $g('.slideshow-animation-select li[data-value="'+app.edit.animation+'"]').text();
        $g('.slideshow-animation-select input[readonly]').val($g.trim(value));
    } else {
        if (typeof(app.edit.desktop.slideset.pause) == 'undefined') {
            app.edit.desktop.slideset.pause = false;
        }
        $g('#slideshow-settings-dialog [data-group="slideset"]').each(function(){
            value = getValue('slideset', this.dataset.option);
            if (this.type == 'checkbox') {
                this.checked = value;
            } else {
                this.value = value;
            }
        });
        value = getValue('gutter');
        $g('#slideshow-settings-dialog [data-option="gutter"]').prop('checked', value);
        $g('.slideset-animation-select input[type="hidden"]').val(app.edit.animation);
        value = $g('.slideset-animation-select li[data-value="'+app.edit.animation+'"]').text();
        $g('.slideset-animation-select input[readonly]').val($g.trim(value));
        $g('.slideset-caption-select input[type="hidden"]').val(app.edit.desktop.caption.position);
        value = $g('.slideset-caption-select li[data-value="'+app.edit.desktop.caption.position+'"]').text();
        $g('.slideset-caption-select input[readonly]').val($g.trim(value));
        if (app.edit.desktop.caption.hover == 'caption-hover') {
            value = true;
        } else {
            value = false;
        }
        $g('#slideshow-settings-dialog [data-option="hover"][data-group="caption"]').prop('checked', value);
        value = getValue('overflow');
        $g('#slideshow-settings-dialog [data-option="overflow"]').prop('checked', value);
    }
    value = getValue('view', 'dots');
    $g('#slideshow-settings-dialog [data-group="view"][data-option="dots"]')[0].checked = value;
    $g('#slideshow-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    value = $g('#slideshow-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#slideshow-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    value = getValue('view', 'height');
    $g('#slideshow-settings-dialog [data-option="height"]').val(value);
    var range = $g('#slideshow-settings-dialog [data-option="height"]').prev();
    range.val(value);
    setLinearWidth(range);
    value = getValue('view', 'size');
    $g('.slideshow-size-select input[type="hidden"]').val(value);
    value = $g('.slideshow-size-select li[data-value="'+value+'"]').text();
    $g('.slideshow-size-select input[readonly]').val($g.trim(value));
    value = getValue('view', 'arrows');
    $g('#slideshow-settings-dialog [data-group="view"][data-option="arrows"]')[0].checked = value;
    $g('#slideshow-settings-dialog .class-suffix').val(app.edit.suffix);
    value = getValue('margin', 'top');
    $g('#slideshow-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#slideshow-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    setDisableState('#slideshow-settings-dialog');
    $g('#slideshow-settings-dialog .slideshow-design-group input[type="hidden"]').val('title');
    $g('#slideshow-settings-dialog .slideshow-design-group input[readonly]').val(gridboxLanguage['TITLE']);
    showSlideshowDesign('title');
    $g('#slideshow-settings-dialog').attr('data-edit', app.edit.type);
    setTimeout(function(){
        $g('#slideshow-settings-dialog').modal();
    }, 150);
}

function getRecentPostsSlider()
{
    var category = new Array();
    for (var key in app.edit.categories) {
        category.push(key);
    }
    category = category.join(',');
    $g.ajax({
        type: "POST",
        dataType: 'text',
        url: "index.php?option=com_gridbox&task=editor.getRecentPostsSlider&tmpl=component",
        data: {
            id : app.edit.app,
            limit : app.edit.limit,
            sorting : app.edit.sorting,
            category : category,
            maximum : app.edit.maximum
        },
        complete: function(msg){
            app.editor.document.querySelector(app.selector+' .slideshow-content').innerHTML = msg.responseText;
            app.editor.app.buttonsPrevent();
            var object = {
                data : app.edit,
                selector : app.editor.app.edit
            };
            app.editor.app.checkModule('initslideset', object);
            app.addHistory();
        }
    });
}

$g('#slideshow-settings-dialog .slideshow-design-group .ba-custom-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    showSlideshowDesign(value);
});

function showSlideshowDesign(search)
{
    var parent = $g('#slideshow-design-options');
    parent.children().not('.slideshow-design-group').hide();
    parent.find('.last-element-child').removeClass('last-element-child');
    parent.find('.slideshow-typography-hover').hide();
    parent.find('.ba-style-intro-options').hide();
    switch (search) {
        case 'description' :
        case 'intro' :
        case 'info' :
        case 'title' :
            if (app.edit.type == 'recent-posts-slider' && (search == 'title' || search == 'info')) {
                parent.find('.slideshow-typography-hover').css('display', '').find('[data-subgroup]').attr('data-group', search);
            }
            if (search == 'intro') {
                parent.find('.ba-style-intro-options').css('display', '');
            }
            parent.find('.slideshow-margin-options').css('display', '').addClass('last-element-child')
                .find('[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-margin-options [data-type="reset"][data-subgroup="margin"]').attr('data-option', search);
            parent.find('.slideshow-typography-color')[0].style.display = '';
            parent.find('.slideshow-typography-options').css('display', '')
                .find('[data-subgroup="typography"]').attr('data-group', search);
            parent.find('.slideshow-animation-options').css('display', '').find('[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-typography-options .typography-options').addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.slideshow-typography-options .typography-options').removeClass('ba-active-options');
            }, 1);
            break;
        case 'button' :
            parent.find('.slideshow-typography-color').hide();
            parent.find('.slideshow-typography-options').css('display', '').find('[data-subgroup="typography"]').attr('data-group', search);
            parent.find('.slideshow-animation-options').css('display', '').find('[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-margin-options').css('display', '').find('[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-margin-options [data-type="reset"][data-subgroup="margin"]').attr('data-option', search);
            parent.find('.slideshow-normal-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-hover-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-button-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-border-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-shadow-options').css('display', '').addClass('last-element-child')
                .find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-typography-options .typography-options').addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.slideshow-typography-options .typography-options').removeClass('ba-active-options');
            }, 1);
            break;
        case 'arrows' :
            parent.find('.slideshow-normal-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-hover-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-arrows-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-border-options').css('display', '').find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-shadow-options').css('display', '').addClass('last-element-child')
                .find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-normal-options, .slideshow-hover-options, .slideshow-arrows-options')
                .addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.slideshow-normal-options, .slideshow-hover-options, .slideshow-arrows-options')
                    .removeClass('ba-active-options');
            }, 1);
            break;
        case 'dots' :
            parent.find('.slideshow-dots-options').css('display', '').addClass('last-element-child')
                .find('input[data-subgroup]').attr('data-group', search);
            parent.find('.slideshow-dots-options').addClass('ba-active-options');
            setTimeout(function(){
                parent.find('.slideshow-dots-options').removeClass('ba-active-options');
            }, 1);
            break;
        case 'image' :
            parent.find('.slideshow-image-options').css('display', '').last().addClass('last-element-child');
            setTimeout(function(){
                parent.find('.slideshow-image-options').removeClass('ba-active-options');
            }, 1);
            break;
    }
    if (app.edit.type != 'slideshow') {
        parent.find('.slideshow-animation-options').hide();
    }
    value = getValue(search);
    for (var ind in value) {
        if (typeof(value[ind]) == 'object') {
            if (ind == 'typography') {
                app.setTypography(parent.find('.slideshow-typography-options .typography-options'), search, ind);
            } else {
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
            var input = parent.find('[data-group="'+search+'"][data-option="'+ind+'"]'),
                range = input.prev();
            input.val(value[ind]);
            range.val(value[ind]);
            setLinearWidth(range);
        }
    }
}

$g('.slideset-caption-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    app.edit.desktop.caption.position = value;
    app.sectionRules();
    var object = {
        data : app.edit,
        selector : app.editor.app.edit
    };
    app.editor.app.checkModule('initslideset', object);
    app.addHistory();
});

$g('#slideshow-settings-dialog [data-option="hover"][data-group="caption"]').on('change', function(){
    var item = app.editor.document.querySelector(app.selector+' ul');
    if (this.checked) {
        app.edit.desktop.caption.hover = 'caption-hover';
    } else {
        app.edit.desktop.caption.hover = '';
    }
    app.sectionRules();
    setTimeout(function(){
        var object = {
            data : app.edit,
            selector : app.editor.app.edit
        };
        app.editor.app.checkModule('initslideset', object);
    }, 300);
    app.addHistory();
});

$g('.slideshow-item-effect-select').on('customAction', function(){
    var $this = $g(this).find('input[type="hidden"]')[0],
        value = $this.value,
        option = $this.dataset.option,
        group = $this.dataset.group,
        subgroup = $this.dataset.subgroup,
        items = app.editor.document.querySelectorAll(app.selector+' .ba-slideshow-'+group);
    if (group == 'button') {
        items = app.editor.document.querySelectorAll(app.selector+' .slideshow-button a');
    }
    if (app.edit.desktop[group][subgroup][option]) {
        for (var i = 0; i < items.length; i ++) {
            items[i].classList.remove(app.edit.desktop[group][subgroup][option]);
        }
    }
    app.edit.desktop[group][subgroup][option] = value;
    if (app.edit.desktop[group][subgroup][option]) {
        for (var i = 0; i < items.length; i ++) {
            items[i].classList.add(app.edit.desktop[group][subgroup][option]);
        }
    }
    app.addHistory();
});

$g('.slideshow-animation-select, .slideset-animation-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val(),
        item = app.editor.document.querySelector(app.selector+' ul');
    item.classList.remove(app.edit.animation);
    app.edit.animation = value;
    item.classList.add(app.edit.animation);
    app.addHistory();
});

$g('#slideshow-settings-dialog [data-group="slideshow"]').on('change input', function(){
    var option = this.dataset.option,
        value = this.value;
    if (this.type == 'checkbox') {
        value = this.checked;
    }
    setValue(value, 'slideshow', option);
    app.editor.app.initslideshow(app.edit, app.editor.app.edit);
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.addHistory();
    }, 300);
});

$g('#slideshow-settings-dialog [data-group="slideset"]').on('change input', function(){
    var option = this.dataset.option,
        value = this.value;
    if (this.type == 'checkbox') {
        value = this.checked;
    }
    setValue(value, 'slideset', option);
    var object = {
        data : app.edit,
        selector : app.editor.app.edit
    }
    app.sectionRules();
    app.editor.app.checkModule('initItems', object);
    delay = setTimeout(function(){
        app.addHistory();
    }, 300);
});

$g('#slideshow-settings-dialog [data-option="gutter"]').on('change', function(){
    app.edit.desktop.gutter = this.checked;
    app.editor.$g('.ba-item-'+app.edit.type).each(function(){
        if (app.editor.app.items[this.id]) {
            var obj = {
                data : app.editor.app.items[this.id],
                selector : this.id
            };
            app.editor.itemsInit.push(obj);
        }
    });
    if (app.editor.itemsInit.length > 0) {
        app.editor.app.checkModule('initItems', app.editor.itemsInit.pop());
    }
    app.sectionRules();
    app.addHistory();
});

$g('#slideshow-settings-dialog .add-new-item i').on('click', function(){
    uploadMode = 'addNewSlides';
    checkIframe($g('#uploader-modal').attr('data-check', 'multiple'), 'uploader');
    return false;
});

$g('#slideshow-settings-dialog .sorting-container').on('click', 'i.zmdi.zmdi-edit', function(){
    var key = $g(this).closest('.sorting-item').attr('data-key'),
        obj = $g.extend({}, sortingList[key]),
        value = 'image',
        video = {
            type : 'youtube',
            id : '',
            mute : true,
            start : 0,
            quality : 'hd720'
        },
        slides = getValue('slides'),
        object = slides[obj.index];
    if (object.video && app.view == 'desktop') {
        value = 'video';
        video = object.video;
    }
    if (video.type == 'source') {
        $g('#slideshow-item-dialog .video-source-select').css('display', '');
        $g('#slideshow-item-dialog .video-id').hide();
    } else {
        $g('#slideshow-item-dialog .video-source-select').hide();
        $g('#slideshow-item-dialog .video-id').css('display', '');
    }
    if (!video.source) {
        video.source == '';
    }
    $g('#slideshow-item-dialog .video-options, #slideshow-item-dialog .image-options').hide();
    $g('#slideshow-item-dialog .'+value+'-options').show();
    $g('#slideshow-item-dialog .slide-type-select input[type="hidden"]').val(value);
    value = $g('#slideshow-item-dialog .slide-type-select li[data-value="'+value+'"]').text().trim();
    $g('#slideshow-item-dialog .slide-type-select input[readonly]').val(value);
    $g('#slideshow-item-dialog .slide-image').val(object.image);
    $g('#slideshow-item-dialog .video-select input[type="hidden"]').val(video.type);
    value = $g('#slideshow-item-dialog .video-select li[data-value="'+video.type+'"]').text().trim();
    $g('#slideshow-item-dialog .video-select input[readonly]').val(value);
    $g('#slideshow-item-dialog .slide-video-id').val(video.id);
    $g('#slideshow-item-dialog .video-source-select input').val(video.source);
    $g('#slideshow-item-dialog .slide-video-start').val(video.start);
    $g('#slideshow-item-dialog .slide-video-mute').prop('checked', video.mute);
    $g('#slideshow-item-dialog .youtube-quality input[type="hidden"]').val(video.quality);
    value = $g('#slideshow-item-dialog .youtube-quality li[data-value="'+video.quality+'"]').text().trim();
    $g('#slideshow-item-dialog .youtube-quality input[readonly]').val(value);
    $g('#slideshow-item-dialog .slide-title').val(obj.title);
    $g('#slideshow-item-dialog .slide-description').val(obj.description);
    if (obj.button.type.indexOf('ba-overlay-slideshow-button') != -1) {
        value = 'link';
        $g('#slideshow-item-dialog .slideshow-button-label').hide();
    } else {
        value = 'button';
        $g('#slideshow-item-dialog .slideshow-button-label').show();
    }
    $g('#slideshow-item-dialog .slide-button-type-select input[type="hidden"]').val(value);
    value = $g('#slideshow-item-dialog .slide-button-type-select li[data-value="'+value+'"]').text().trim();
    $g('#slideshow-item-dialog .slide-button-type-select input[readonly]').val(value);
    $g('#slideshow-item-dialog').find('.slide-button-link').val(obj.button.href);
    $g('#slideshow-item-dialog').find('.slide-button-label').val(obj.button.title);
    $g('#slideshow-item-dialog .slide-button-target-select input[type="hidden"]').val(obj.button.target);
    value = $g('#slideshow-item-dialog .slide-button-target-select li[data-value="'+obj.button.target+'"]').text().trim();
    $g('#slideshow-item-dialog .slide-button-target-select input[readonly]').val(value);
    if (obj.button.download == null) {
        obj.button.download = '';
    } else {
        obj.button.download = 'download';
    }
    $g('#slideshow-item-dialog .slide-button-attribute-select input[type="hidden"]').val(obj.button.download);
    value = $g('#slideshow-item-dialog .slide-button-attribute-select li[data-value="'+obj.button.download+'"]').text().trim();
    $g('#slideshow-item-dialog .slide-button-attribute-select input[readonly]').val(value);
    $g('#apply-new-slide').removeClass('disable-button').addClass('active-button').attr('data-edit', key);
    if (app.edit.type != 'slideshow') {
        $g('.slideshow-slide-select').hide();
    } else {
        $g('.slideshow-slide-select')[0].style.display = '';
    }
    $g('#slideshow-item-dialog').modal();
});

$g('#slideshow-item-dialog').find('.slide-image').on('click', function(){
    fontBtn = this;
    uploadMode = 'slideImage';
    checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
});

$g('#slideshow-item-dialog').find('.slide-image, .slide-video-id').on('input', function(){
    if (this.value.trim()) {
        $g('#apply-new-slide').removeClass('disable-button').addClass('active-button');
    } else {
        $g('#apply-new-slide').addClass('disable-button').removeClass('active-button');
    }
});

$g('#slideshow-settings-dialog .sorting-container').on('click', '.zmdi.zmdi-delete', function(){
    app.itemDelete = $g(this).closest('.sorting-item').attr('data-key');
    app.checkModule('deleteItem');
});

$g('#slideshow-item-dialog .slide-button-type-select').on('customAction', function(){
    var value = $g(this).find('input[type="hidden"]').val();
    if (value == 'button') {
        $g('#slideshow-item-dialog .slideshow-button-label').show();
    } else {
        $g('#slideshow-item-dialog .slideshow-button-label').hide();
    }
});

$g('#slideshow-item-dialog .slide-type-select').on('customAction', function(){
    var target = $g(this).find('input[type="hidden"]').val(),
        parent = $g('#slideshow-item-dialog .'+target+'-options');
    $g('#slideshow-item-dialog').find('.image-options, .video-options').hide();
    parent.show();
    parent.addClass('ba-active-options');
    setTimeout(function(){
        parent.removeClass('ba-active-options');
    }, 1);
    $g('#slideshow-item-dialog .video-source-select').hide();
    $g('#slideshow-item-dialog').find('.slide-image, .slide-video-id, .video-source-select input').val('');
    $g('#apply-new-slide').addClass('disable-button').removeClass('active-button');
});

$g('#apply-new-slide').on('click', function(){
    if (!this.classList.contains('active-button')) {
        return false;
    }
    var modal = $g('#slideshow-item-dialog'),
        obj = {
            image : modal.find('.slide-image').val(),
            type : modal.find('.slide-type-select input[type="hidden"]').val(),
            video : {
                type : modal.find('.video-select input[type="hidden"]').val(),
                id : modal.find('.slide-video-id').val().trim(),
                source: modal.find('.video-source-select input').val().trim(),
                mute : modal.find('.slide-video-mute')[0].checked,
                start : modal.find('.slide-video-start').val().trim(),
                quality : modal.find('.youtube-quality input[type="hidden"]').val()
            },
            title : modal.find('.slide-title').val().trim(),
            description : modal.find('.slide-description').val().trim(),
            button : {
                href : modal.find('.slide-button-link').val().trim(),
                type : modal.find('.slide-button-type-select input[type="hidden"]').val(),
                title : modal.find('.slide-button-label').val().trim(),
                target : modal.find('.slide-button-target-select input[type="hidden"]').val(),
                download : modal.find('.slide-button-attribute-select input[type="hidden"]').val()
            }
        };
    if (obj.type == 'image') {
        obj.video = null;
    }
    if (obj.button.type == 'button') {
        obj.button.type = 'ba-btn-transition';
    } else {
        obj.button.type = 'ba-btn-transition ba-overlay-slideshow-button';
    }
    var str = getSlideHtml(obj),
        key = this.dataset.edit,
        item = $g('#slideshow-settings-dialog .sorting-container .sorting-item[data-key="'+key+'"]'),
        div;
    obj.index = sortingList[key].index;
    sortingList[key] = obj;
    item.replaceWith(addSlideSortingList(obj, key));
    $g('#slideshow-settings-dialog .sorting-container .sorting-item').each(function(ind){
        if (this.dataset.key == key) {
            if (!app.edit[app.view].slides) {
                app.edit[app.view].slides = {};
            }
            app.edit.desktop.slides[ind + 1].link = obj.button.href;
            app.edit[app.view].slides[ind + 1] = {
                image : obj.image,
                type : obj.type,
                link : obj.button.href,
                video : obj.video
            }
            div = app.editor.document.querySelector('#'+app.editor.app.edit+' .slideshow-content > li:nth-child('+(ind + 1)+')');
            $g(div).replaceWith(str);
            return false;
        }
    });
    app.editor.app.buttonsPrevent();
    var object = {
        data : app.edit,
        selector : app.editor.app.edit
    }
    app.editor.app.checkModule('initItems', object);
    app.sectionRules();
    app.addHistory();
    modal.modal('hide');
});

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.slideshowEditor = true;
app.slideshowEditor();