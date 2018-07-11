/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// location of function prepareItem in getSession

var scrollTop = {};

function prepareAnimation($this)
{
    var $item = $g($this);
    $item.find('.ba-item-slideshow .ba-slideshow').addClass('first-load-slideshow');
    $item.find('.slideshow-content li.active').removeClass('active');
    $item.find('.slideshow-content li:first-child').addClass('active');
    $item.find('.slideset-loaded').removeClass('slideset-loaded');
    $item.find('.ba-item-slideset, .ba-item-carousel').each(function(){
        var obj = app.editor.app.items[this.id];
        if (obj) {
            $g(this).find('li').each(function(ind){
                if (ind == obj.desktop.slideset.count) {
                    return false;
                }
                this.classList.add('active');
            });
            $g(this).find('ul').css('height', '');
        }
    });
    $item.find('.ba-item-instagram .ba-instagram-image').remove();
    $item.find('.ba-item-progress-bar .ba-animated-bar').css('width', '0%').find('.progress-bar-number').text('0%');
    $item.find('.ba-item-progress-pie').find('.progress-pie-number').text('0%');
    $item.find('.ba-slideshow-dots .active').removeClass('active');
    $item.find('.ba-slideshow-dots div:first-child').addClass('active');
    $item.find('.hidden').removeClass('hidden');
    $item.find('.visible-sticky-header').removeClass('visible-sticky-header');
    $item.find('.ba-sticky-header').removeAttr('style');
    $item.find('.visible').removeClass('visible animated');
    $item.find('.visible.animated').removeClass('visible animated');
    $item.find('.ba-next').removeClass('ba-next');
    $item.find('.ba-prev').removeClass('ba-prev');
    $item.find('.ba-left').removeClass('ba-left');
    $item.find('.ba-right').removeClass('ba-right');
    $item.find('.burns-out').removeClass('burns-out');
    $item.find('.left-animation').removeClass('left-animation');
    $item.find('.right-animation').removeClass('right-animation');
    $item.find('.prev-animation').removeClass('prev-animation');
    $item.find('.next-animation').removeClass('next-animation');

    return $this;
}

function prepareHTML(search, obj, items)
{
    var item = app.editor.document.querySelector(search);
    search = search.replace('.header', '').replace('.footer', '');
    if (!item) {
        return false;
    }
    item = item.cloneNode(true);
    var clone = $g(item);
    if (search == '#blog-layout') {
        clone.find('.ba-item-blog-content .blog-content-wrapper').html('[blog_content]');
    }
    clone.find('.ba-item-main-menu > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > .tabs-content-wrapper')
        .each(function(){
        $g(this).closest('.ba-menu-wrapper').append(this);
    });
    item = prepareAnimation(item);
    for (var i = 0; i < scrollTop.length; i++) {
        if (items[scrollTop[i].id]) {
            var parent = items[scrollTop[i].id].parent,
                column = $g(item).find('#'+parent);
            if (column.length > 0) {
                var scrollItem = scrollTop[i].cloneNode(true);
                column.find(' > .empty-item').before(scrollItem);
            }
        }
    }
    clone.find('.ba-item-search-result').each(function(){
        $g(this).next().find('img')[0].src = 'components/com_gridbox/assets/images/reload.svg';
        $g(this).find('.ba-blog-post-image a').each(function(){
            var image = $g(this).css("background-image").replace(/^url\(/g,"").replace(/\)$/g,"").replace(/("|')/g,""),
                pos = image.indexOf('/components/');
            $g(this).css("background-image", 'url('+image.substr(pos+1)+')');
        });
    });
    clone.find('.ba-item-simple-gallery .ba-instagram-image img').each(function(){
        this.src = this.dataset.src;
        $g(this).closest('.ba-instagram-image').css('background-image', 'url('+this.dataset.src+')');
    });
    clone.find('.visible-lightbox').removeClass('visible-lightbox');
    clone.find('> .page-layout').remove();
    clone.find('[data-global]').replaceWith(function(){
        obj.global[this.dataset.global] = {};
        obj.global[this.dataset.global].items = replaceGlobalItems(this, obj, items);
        obj.global[this.dataset.global].html = this.outerHTML;
        return '[global item='+this.dataset.global+']';
    });
    clone.find('.ba-item-blog-posts .ba-blog-posts-header').html('[blog_posts_category_header]');
    clone.find('.ba-item-blog-posts .ba-blog-posts-wrapper').html('[blog_posts_items]');
    clone.find('.ba-item-blog-posts .ba-blog-posts-pagination-wrapper').html('[blog_posts_pagination]');
    clone.find('.intro-post-image-wrapper').replaceWith('[intro-post-image]');
    clone.find('.intro-post-title').html('[intro-post-title]');
    clone.find('.intro-post-date').html('[intro-post-date]');
    clone.find('.intro-post-category').html('[intro-post-category]');
    clone.find('.intro-post-views').html('[intro-post-views]');
    clone.find('.ba-item-post-tags .ba-button-wrapper').html('[blog_post_tags]');
    clone.find('.ba-section').each(function(){
        if (items[this.id]) {
            if (items[this.id].type == 'header') {
                obj.theme.layout = items[this.id].layout
            }
            obj.theme[search].items[this.id] = items[this.id];
        }
    });
    clone.find('.ba-row').each(function(){
        if (items[this.id]) {
            obj.theme[search].items[this.id] = items[this.id];
        }
    });
    clone.find('.ba-grid-column').each(function(){
        if (items[this.id]) {
            obj.theme[search].items[this.id] = items[this.id];
        }
    });
    clone.find('.ba-item').each(function(){
        if (items[this.id]) {
            obj.theme[search].items[this.id] = items[this.id];
            prepareItem(this, items[this.id]);
        }
    });
    clone.find('.ba-item-main-menu').each(function(){
        this.innerHTML = this.innerHTML.trim().replace(/\n/g, "")
            .replace(/[\t ]+\</g, "<").replace(/\>[\t ]+\</g, "><").replace(/\>[\t ]+$/g, ">");
    });
    obj.theme[search].html = item.innerHTML.trim();
}

function replaceGlobalItems(item, obj, items)
{
    var glob = {};
    $g(item).find('.ba-section').each(function(){
        if (items[this.id]) {
            glob[this.id] = items[this.id];
        }
    });
    $g(item).find('.ba-row').each(function(){
        if (items[this.id]) {
            glob[this.id] = items[this.id];
        }
    });
    $g(item).find('.ba-grid-column').each(function(){
        if (items[this.id]) {
            glob[this.id] = items[this.id];
        }
    });
    $g(item).find('.ba-item').each(function(){
        if (items[this.id]) {
            glob[this.id] = items[this.id];
            prepareItem(this, items[this.id]);
        }
    });
    if (item.classList.contains('ba-item')) {
        if (items[item.id]) {
            glob[item.id] = items[item.id];
            prepareItem(item, items[item.id]);
        }
    }

    return glob;
}

app.gridboxSave = function(){
    if (app.editor.app.blogEditor) {
        return false;
    }
    var button = document.querySelector('.gridbox-save')
    if (button.dataset.action == 'clicked') {
        return false;
    } else {
        button.dataset.action = 'clicked';
    }
    app.editor.$g('.ba-item-flipbox').each(function(){
        var $this = this;
        this.classList.remove('backside-fliped');
        this.classList.add('flipbox-animation-started');
        app.editor.app.items[this.id].side = "frontside";
        setTimeout(function(){
            $this.classList.remove('flipbox-animation-started');
        }, app.editor.app.items[this.id].desktop.animation.duration * 1000);
    });
    scrollTop = app.editor.document.querySelectorAll('.ba-item-scroll-to-top, .ba-social-sidebar');
    var baItems = app.editor.document.querySelectorAll('.ba-item-overlay-section');
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
    app.editor.document.body.classList.remove('ba-lightbox-open');
    app.editor.document.body.classList.remove('search-open');
    baItems = app.editor.document.querySelectorAll('.visible-menu');
    for (var i = 0; i < baItems.length; i++) {
        baItems[i].classList.remove('visible-menu');
        baItems[i].classList.remove('hide-menu');
        app.editor.document.querySelector('.column-with-menu').classList.remove('column-with-menu');
        app.editor.document.querySelector('.row-with-menu').classList.remove('row-with-menu');
    }
    app.editor.document.body.classList.remove('ba-opened-menu');
    var page = app.editor.document.getElementById('ba-edit-section'),
        newMetaTags = false,
        grid = app.editor.document.getElementById('grid_id'),
        theme = app.editor.document.getElementById('page_theme'),
        obj = {
            global : {},
            breakpoints : $g.extend(true, {}, app.editor.breakpoints),
            megamenu: {},
            theme : {
                params : app.editor.app.theme,
                header : {
                    items : {}
                },
                footer : {
                    items : {}
                },
                '#ba-edit-section' : {
                    items : {}
                },
                '#blog-layout' :  {
                    items : {}
                }
            },
            website : {
                container : $g('.website-container').val().trim(),
                favicon : $g('input.favicon').val().trim(),
                header_code : $g('textarea.header-code').val().trim(),
                body_code : $g('textarea.body-code').val().trim(),
                date_format : $g('.ba-custom-date-format input[type="text"]').val(),
                disable_responsive: Number($g('.disable-responsive').prop('checked'))
            },
            code : {
                css : app.editor.document.getElementById('code-css-value').value,
                js : app.editor.document.getElementById('code-js-value').value
            }
        }
    if (!obj.website.date_format) {
        obj.website.date_format = 'j F Y';
    }
    obj.breakpoints.menuBreakpoint = app.editor.menuBreakpoint;
    if (!app.editor.themeData.edit_type) {
        obj.page = {
            style : $g.extend({}, app.editor.app.items),
            id : grid.value,
            theme : theme.value,
            title : $g('.page-title').val().trim(),
            page_alias : $g('.page-alias').val().trim(),
            page_access : $g('.access-select input[type="hidden"]').val(),
            created : $g('#published_on').val(),
            end_publishing : $g('#published_down').val(),
            language : $g('.language-select input[type="hidden"]').val(),
            intro_image : $g('.intro-image').val(),
            intro_text : $g('.intro-text').val(),
            meta_title : $g('.page-meta-title').val().trim(),
            meta_description : $g('.page-meta-description').val().trim(),
            meta_keywords : $g('.page-meta-keywords').val().trim(),
            page_category : $g('#page-category').val(),
            meta_tags : new Array()
        };
        if (!obj.page.end_publishing) {
            obj.page.end_publishing = '0000-00-00 00:00:00';
        }
        $g('.meta_tags option').each(function(){
            if (this.value.indexOf('new$') != -1) {
                newMetaTags = true;
            }
            obj.page.meta_tags.push(this.value);
        });
    } else if (app.editor.themeData.edit_type == 'system') {
        obj.page = {
            style : $g.extend({}, app.editor.app.items),
            theme : theme.value,
            type: app.editor.systemType,
            id : grid.value
        };
        obj.edit_type = app.editor.themeData.edit_type;
        console.info(obj)
    } else {
        obj.page = {
            style : $g.extend({}, app.editor.app.items),
            id : grid.value,
            theme : theme.value,
            title : $g('.page-title').val().trim(),
            alias : $g('.page-alias').val().trim()
        };
        obj.edit_type = app.editor.themeData.edit_type;
    }
    prepareHTML('header.header', obj, obj.page.style);
    prepareHTML('footer.footer', obj, obj.page.style);
    prepareHTML('#ba-edit-section', obj, obj.page.style);
    prepareHTML('#blog-layout', obj, obj.page.style);
    if (obj.theme['#blog-layout'].html) {
        obj.post = $g.extend(true, {}, obj.theme['#blog-layout']);
    }
    obj.page.params = obj.theme['#ba-edit-section'].html;
    obj.page.style = $g.extend(true, {}, obj.theme['#ba-edit-section'].items);
    delete(obj.theme['#ba-edit-section']);
    delete(obj.theme['#blog-layout']);
    var XHR = new XMLHttpRequest(),
        url = 'index.php?option=com_gridbox&task=editor.gridboxSave';
    $g('.create-new-page').each(function(){
        if (this.href.indexOf('&category=') != -1) {
            var array = this.href.split('&');
            for (var i = 0; i < array.length; i++) {
                if (array[i].indexOf('category=') != -1) {
                    array[i] = 'category='+obj.page.page_category;
                    break;
                }
            }
            this.href = array.join('&');
        }
    });
    XHR.onreadystatechange = function(e) {
        if (XHR.readyState == 4) {
            if (!newMetaTags) {
                button.dataset.action = 'enabled';
                app.showNotice(XHR.responseText);
            } else {
                $g.ajax({
                    type:"GET",
                    dataType:'text',
                    url:"index.php?option=com_gridbox&task=editor.getPageTags",
                    data : {
                        id : obj.page.id
                    },
                    success: function(msg){
                        msg = JSON.parse(msg);
                        $g('select.meta_tags').empty();
                        $('.picked-tags .tags-chosen').remove();
                        $('select[name="meta_tags"]').empty();
                        $('.all-tags li').removeClass('selected-tag');
                        for (var key in msg) {
                            var str = '<li class="tags-chosen"><span>';
                            if ($g('.all-tags li[data-id="'+key+'"]').length == 0) {
                                $g('.all-tags').append('<li data-id="'+key+'" style="display:none;">'+msg[key]+'</li>');
                            }
                            $g('.all-tags li[data-id="'+key+'"]').addClass('selected-tag');
                            str += msg[key]+'</span><i class="zmdi zmdi-close" data-remove="'+key+'"></i></li>';
                            $g('.picked-tags .search-tag').before(str);
                            str = '<option value="'+key+'" selected>'+msg[key]+'</option>';
                            $g('select.meta_tags').append(str);
                        }
                        $g('.meta-tags .picked-tags .search-tag input').val('');
                        $g('.all-tags li').hide();
                        button.dataset.action = 'enabled';
                        app.showNotice(XHR.responseText);
                    }
                });
            }
        }
    };
    XHR.open("POST", url, true);
    XHR.send(JSON.stringify(obj));
    app.editor.app.checkModule('checkOverlay');
    baItems = app.editor.document.querySelectorAll('.ba-item-search');
    for (var i = 0; i < baItems.length; i++) {
        var overlay =  app.editor.document.querySelector('.ba-search-result-modal[data-id="'+baItems[i].id+'"]');
        app.editor.document.body.appendChild(overlay);
    }
}

app.modules.gridboxSave = true;
app.gridboxSave();