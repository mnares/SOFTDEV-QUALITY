/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.recentPostsEditor = function(){
    app.selector = '#'+app.editor.app.edit;
    $g('#recent-posts-settings-dialog .active').removeClass('active');
    $g('#recent-posts-settings-dialog a[href="#recent-posts-general-options"]').parent().addClass('active');
    $g('#recent-posts-general-options').addClass('active');
    $g('#recent-posts-settings-dialog').attr('data-edit', app.edit.type);
    if (app.edit.type != 'search-result') {
        setPresetsList($g('#recent-posts-settings-dialog'));
        $g('#recent-posts-general-options .preset-options').css('display', '');
    } else {
        $g('#recent-posts-general-options .preset-options').hide();
    }
    $g('#recent-posts-settings-dialog .recent-posts-app-select input[type="hidden"]').val(app.edit.app);
    var value = $g('#recent-posts-settings-dialog .recent-posts-app-select li[data-value="'+app.edit.app+'"]').text();
    $g('#recent-posts-settings-dialog .recent-posts-app-select input[readonly]').val($g.trim(value));
    $g('#recent-posts-settings-dialog .recent-posts-display-select input[type="hidden"]').val(app.edit.sorting);
    value = $g('#recent-posts-settings-dialog .recent-posts-display-select li[data-value="'+app.edit.sorting+'"]').text();
    $g('#recent-posts-settings-dialog .recent-posts-display-select input[readonly]').val($g.trim(value));
    $g('#recent-posts-settings-dialog input[data-option="limit"]').val(app.edit.limit);
    $g('#recent-posts-settings-dialog .blog-posts-layout-select input[type="hidden"]').val(app.edit.layout.layout);
    value = $g('#recent-posts-settings-dialog .blog-posts-layout-select li[data-value="'+app.edit.layout.layout+'"]').text();
    $g('#recent-posts-settings-dialog .blog-posts-layout-select input[readonly]').val($g.trim(value));
    value = getValue('background', 'color');
    updateInput($g('#recent-posts-settings-dialog .blog-posts-background-options input[data-option="color"]'), value);
    value = getValue('shadow', 'color');
    updateInput($g('#recent-posts-settings-dialog .blog-posts-shadow-options input[data-option="color"]'), value);
    value = getValue('shadow', 'value');
    var input = $g('#recent-posts-settings-dialog .blog-posts-shadow-options input[data-option="value"]'),
        range = input.prev();
    input.val(value);
    range.val(value);
    setLinearWidth(range);
    value = getValue('border', 'radius');
    value = $g('#recent-posts-settings-dialog input[data-option="radius"][data-group="border"]').val(value).prev().val(value);
    setLinearWidth(value);
    value = getValue('border', 'width');
    value = $g('#recent-posts-settings-dialog input[data-option="width"][data-group="border"]').val(value).prev().val(value);
    setLinearWidth(value);
    value = getValue('border', 'color');
    updateInput($g('#recent-posts-settings-dialog input[data-option="color"][data-group="border"]'), value);
    value = getValue('border', 'style');
    $g('#recent-posts-layout-options .border-style-select input[type="hidden"]').val(value);
    value = $g('#recent-posts-layout-options .border-style-select li[data-value="'+value+'"]').text();
    $g('#recent-posts-layout-options .border-style-select input[readonly]').val($g.trim(value));
    if (app.edit.type == 'related-posts') {
        $g('#recent-posts-settings-dialog .related-posts-display-select input[type="hidden"]').val(app.edit.related);
        value = $g('#recent-posts-settings-dialog .related-posts-display-select li[data-value="'+app.edit.related+'"]').text();
        $g('#recent-posts-settings-dialog .related-posts-display-select input[readonly]').val($g.trim(value));
        app.recentPostsCallback = 'getRelatedPosts';
    } else if (app.edit.type == 'recent-posts') {
        if (!app.edit.categories) {
            app.edit.categories = {};
        }
        $g('.selected-categories li:not(.search-category)').remove();
        $g('.all-categories-list .selected-category').removeClass('selected-category');
        for (var key in app.edit.categories) {
            var str = getCategoryHtml(key, app.edit.categories[key].title);
            $g('#recent-posts-settings-dialog .selected-categories li.search-category').before(str);
            $g('#recent-posts-settings-dialog .all-categories-list [data-id="'+key+'"]').addClass('selected-category');
        }
        if ($g('.selected-categories li:not(.search-category)').length > 0) {
            $g('.ba-settings-item.tags-categories-list').addClass('not-empty-list');
        } else {
            $g('.ba-settings-item.tags-categories-list').removeClass('not-empty-list');
        }
        $g('.tags-categories .all-categories-list li').hide();
        app.recentPostsCallback = 'getRecentPosts';
    } else if (app.edit.type == 'post-navigation') {
        app.recentPostsCallback = 'getPostNavigation';
    } else if (app.edit.type == 'search-result') {
        app.recentPostsCallback = null
    }
    $g('.blog-posts-cover-options').hide();
    $g('#recent-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().css('display', '');
    if (app.edit.layout.layout == 'ba-classic-layout') {
        $g('.blog-posts-grid-options').hide();
        $g('.blog-posts-grid-options input[data-option="count"]').closest('.ba-settings-group').addClass('enabled-grid');
    } else {
        $g('.blog-posts-grid-options').css('display', '');
        $g('.blog-posts-grid-options input[data-option="count"]').closest('.ba-settings-group').removeClass('enabled-grid');
        if (app.edit.layout.layout == 'ba-cover-layout') {
            $g('#recent-posts-design-options .ba-style-image-options').first().find('.ba-settings-item').first().hide();
            $g('.blog-posts-cover-options').css('display', '');
            $g('.blog-posts-background-options').hide();
        }
    }
    value = getValue('overlay', 'color');
    updateInput($g('#recent-posts-settings-dialog input[data-group="overlay"][data-option="color"]'), value);
    value = getValue('view', 'count');
    $g('#recent-posts-settings-dialog input[data-option="count"]').val(value);
    $g('#recent-posts-settings-dialog input[data-option="maximum"]').val(app.edit.maximum);
    $g('#recent-posts-settings-dialog input[data-group="view"][type="checkbox"]').each(function(){
        value = getValue('view', this.dataset.option);
        this.checked = true;
    })
    $g('#recent-posts-settings-dialog .class-suffix').val(app.edit.suffix);
    value = getValue('margin', 'top');
    $g('#recent-posts-settings-dialog [data-group="margin"][data-option="top"]').val(value);
    value = getValue('margin', 'bottom');
    $g('#recent-posts-settings-dialog [data-group="margin"][data-option="bottom"]').val(value);
    setDisableState('#recent-posts-settings-dialog');
    $g('#recent-posts-settings-dialog .section-access-select input[type="hidden"]').val(app.edit.access);
    value = $g('#recent-posts-settings-dialog .section-access-select li[data-value="'+app.edit.access+'"]').text();
    $g('#recent-posts-settings-dialog .section-access-select input[readonly]').val($g.trim(value));
    $g('#recent-posts-settings-dialog .ba-style-custom-select input[type="hidden"]').val('image');
    value = $g('#recent-posts-settings-dialog .ba-style-custom-select li[data-value="image"]').text();
    $g('#recent-posts-settings-dialog .ba-style-custom-select input[readonly]').val($g.trim(value));
    showBaStyleDesign('image', document.querySelector('#recent-posts-settings-dialog .ba-style-custom-select'));
    if (app.edit.type == 'search-result') {
        if (app.edit.app) {
            $g('.search-result-app').css('display', '');
            value = 'app';
        } else {
            $g('.search-result-app').hide();
            value = '';
        }
        $g('.search-result-select input[type="hidden"]').val(value);
        value = $g('.search-result-select li[data-value="'+value+'"]').text();
        $g('.search-result-select input[readonly]').val($g.trim(value));
        $g('.search-result-app-select input[type="hidden"]').val(app.edit.app);
        value = $g('.search-result-app-select li[data-value="'+app.edit.app+'"]').text();
        $g('.search-result-app-select input[readonly]').val($g.trim(value));
    }
    setTimeout(function(){
        $g('#recent-posts-settings-dialog').modal();
    }, 150);
}

$g('.search-result-select').on('customAction', function(){
    var value = this.querySelector('input[type="hidden"]').value;
    if (value) {
        $g('.search-result-app').css('display', '');
    } else {
        $g('.search-result-app').hide();
        app.edit.app = '';
        app.addHistory();
    }
    $g('.search-result-app-select input[type="hidden"]').val(app.edit.app);
    value = $g('.search-result-app-select li[data-value="'+app.edit.app+'"]').text();
    $g('.search-result-app-select input[readonly]').val($g.trim(value));
});

$g('.search-result-app-select').on('customAction', function(){
    app.edit.app = this.querySelector('input[type="hidden"]').value;
    app.addHistory();
});

function getPostNavigation()
{
    app.editor.$g(app.selector).attr('data-maximum', app.edit.maximum);
    $g.ajax({
        type: "POST",
        dataType: 'text',
        url: "index.php?option=com_gridbox&task=editor.getPostNavigation&tmpl=component",
        data: {
            id : app.editor.document.getElementById('grid_id').value,
            maximum : app.edit.maximum
        },
        complete: function(msg){
            app.editor.document.querySelector(app.selector+' .ba-blog-posts-wrapper').innerHTML = msg.responseText;
            app.editor.app.buttonsPrevent();
            app.addHistory();
        }
    });
}

function getRelatedPosts()
{
    app.editor.$g(app.selector).attr('data-app', app.edit.app).attr('data-count', app.edit.limit)
        .attr('data-related', app.edit.related).attr('data-maximum', app.edit.maximum);
    $g.ajax({
        type: "POST",
        dataType: 'text',
        url: "index.php?option=com_gridbox&task=editor.getRelatedPosts&tmpl=component",
        data: {
            id : app.editor.document.getElementById('grid_id').value,
            app : app.edit.app,
            limit : app.edit.limit,
            related : app.edit.related,
            maximum : app.edit.maximum
        },
        complete: function(msg){
            app.editor.document.querySelector(app.selector+' .ba-blog-posts-wrapper').innerHTML = msg.responseText;
            app.editor.app.buttonsPrevent();
            app.addHistory();
        }
    });
}

function getRecentPosts()
{
    var category = new Array();
    for (var key in app.edit.categories) {
        category.push(key);
    }
    category = category.join(',');
    app.editor.$g(app.selector).attr('data-app', app.edit.app).attr('data-count', app.edit.limit)
        .attr('data-sorting', app.edit.sorting).attr('data-maximum', app.edit.maximum).attr('data-category', category);
    $g.ajax({
        type: "POST",
        dataType: 'text',
        url: "index.php?option=com_gridbox&task=editor.getRecentPosts&tmpl=component",
        data: {
            id : app.edit.app,
            limit : app.edit.limit,
            sorting : app.edit.sorting,
            category : category,
            maximum : app.edit.maximum
        },
        complete: function(msg){
            app.editor.document.querySelector(app.selector+' .ba-blog-posts-wrapper').innerHTML = msg.responseText;
            app.editor.app.buttonsPrevent();
            app.addHistory();
        }
    });
}

if (!app.modules.draggable) {
    app.loadModule('draggable');
}
if (!app.modules.resizable) {
    app.loadModule('resizable');
}

app.modules.recentPostsEditor = true;
app.recentPostsEditor();