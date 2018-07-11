/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.editItem = function(obj, key){
    var parent = window.parent.app,
        type = app.items[app.edit].type;
    parent.edit = app.items[app.edit];
    if (type == 'row' && $g('#'+app.edit).parent().parent().hasClass('ba-grid-column')) {
        type = 'nested-row';
    }
    var title = getItemTitle(type),
        modals = window.parent.$g('.ba-modal-cp.draggable-modal-cp').not('#theme-settings-dialog');
    modals.find('.ba-dialog-title').text(title);
    modals.find('.modal-header > span.status-icons').remove();
    if (app.items[app.edit].preset) {
        var str = '<span class="status-icons"><i class="zmdi zmdi-roller"></i><span class="ba-tooltip ba-top">'+
            window.parent.gridboxLanguage['PRESET']+'</span></span>';
        modals.find('.ba-dialog-title').after(str);
    }
    if (document.getElementById(app.edit).dataset.global) {
        var str = '<span class="status-icons"><i class="zmdi zmdi-globe"></i><span class="ba-tooltip ba-top">'+
            window.parent.gridboxLanguage['GLOBAL_ITEM']+'</span></span>';
        modals.find('.ba-dialog-title').after(str);
    }
    modals.find('.modal-header > span.status-icons .ba-tooltip').each(function(){
        window.parent.app.initTooltip($g(this).parent());
    });
    switch (app.items[app.edit].type) {
        case 'search':
            parent.checkModule('searchEditor');
            break;
        case 'recent-posts' :
        case 'search-result' :
        case 'related-posts' :
        case 'post-navigation' :
            parent.checkModule('recentPostsEditor');
            break;
        case 'blog-posts' :
            parent.checkModule('blogPostsEditor');
            break;
        case 'star-ratings' :
            parent.checkModule('starRatingsEditor');
            break;
        case 'post-intro' :
        case 'category-intro' :
            parent.checkModule('introPostEditor');
            break;
        case 'blog-content' :
            parent.checkModule('blogContentEditor');
            break;
        case 'disqus' :
        case 'vk-comments' :
        case 'hypercomments' :
        case 'facebook-comments' :
        case 'gallery' :
        case 'modules' :
        case 'forms' :
        case 'logo' :
        case 'instagram':
        case 'simple-gallery':
            parent.checkModule('itemEditor');
            break;
        case 'video':
            parent.checkModule('imageEditor');
            break;
        case 'accordion' :
        case 'tabs' :
            parent.checkModule('tabsEditor');
            break;
        case 'image' :
        case 'text' :
        case 'map' :
        case 'social' :
        case 'slideshow' :
        case 'categories' :
        case 'headline' :
            parent.checkModule(app.items[app.edit].type+'Editor');
            break;
        case 'weather':
        case 'error-message':
            parent.checkModule('weatherEditor');
            break;
        case 'slideset' :
        case 'carousel' :
        case 'recent-posts-slider':
            parent.checkModule('slideshowEditor');
            break;
        case 'one-page' :
        case 'menu' :
            parent.checkModule('menuEditor');
            break;
        case 'social-icons' :
            parent.checkModule('socialIconsEditor');
            break;
        case 'icon' :
        case 'button' :
        case 'tags' :
        case 'post-tags' :
        case 'overlay-button' :
        case 'scroll-to-top' :
        case 'scroll-to' :
        case 'countdown' :
        case 'counter' :
            parent.checkModule('countdownEditor');
            break;
        case 'progress-bar' :
        case 'progress-pie' :
            parent.checkModule('progressBarEditor');
            break;
        case 'custom-html' :
            parent.checkModule('editCustomHtml');
            break;
        default :
            parent.checkModule('sectionEditor');
    }
}

function getItemTitle(type)
{
    var title = type.toUpperCase().replace(/-/g, '_');
    if (title == 'SOCIAL') {
        title = 'SOCIAL_SHARE';
    } else if (title == 'SEARCH_RESULT') {
        title = 'SEARCH';
    } else if (title == 'OVERLAY_BUTTON') {
        title = 'OVERLAY_SECTION'
    } else if (title == 'SCROLL_TO') {
        title = 'SMOOTH_SCROLLING';
    } else if (title == 'ONE_PAGE') {
        title = 'ONE_PAGE_MENU';
    } else if (title == 'FORMS' || title == 'GALLERY') {
        title = 'BALBOOA_'+title;
    } else if (title == 'MODULES') {
        title = 'JOOMLA_MODULES'
    } else if (title == 'MEGA_MENU_SECTION') {
        title = 'MEGAMENU';
    }

    return window.parent.gridboxLanguage[title];
}

app.editItem();