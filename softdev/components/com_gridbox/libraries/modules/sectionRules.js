/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.sectionRules = function(){
    var str = '';
    for (var key in app.items) {
        app.items[key] = app.items[key];
        str += getPageCSS(app.items[key], key);
    }
    if (app.setNewFont) {
        getFontUrl();
    }
    app.pageCss.innerHTML = str;
    if (app.blogEditor && !window.parent.$g("#blog-content-dialog").hasClass('in')) {
        window.parent.$g("#blog-content-dialog").modal();
    }
}

function getPageCSS(obj, key)
{
    var str = '';
    app.itemType = key;
    window.parent.comparePresets(obj);
    switch (obj.type) {
        case 'search':
            str += createSearchRules(obj, key);
            break;
        case 'logo' :
            str += createLogoRules(obj, key);
            break;
        case 'slideshow' :
            str += createSlideshowRules(obj, key);
            break;
        case 'carousel' :
        case 'slideset' :
            str += createCarouselRules(obj, key);
            break;
        case 'recent-posts-slider':
            str += createRecentSliderRules(obj, key);
            break;
        case 'menu' :
            str += createMenuRules(obj, key);
            break;
        case 'one-page' :
            str += createOnePageRules(obj, key);
            break;
        case 'map' :
            str += createMapRules(obj, key);
            break;
        case 'weather' :
            str += createWeatherRules(obj, key);
            break;
        case 'scroll-to-top' :
            str += createScrollTopRules(obj, key);
            break;
        case 'image' :
            str += createImageRules(obj, key);
            break;
        case 'video':
            str += createVideoRules(obj, key);
            break;
        case 'tabs' :
            str += createTabsRules(obj, key);
            break;
        case 'accordion' :
            str += createAccordionRules(obj, key);
            break;
        case 'icon' :
        case 'social-icons':
            str += createIconRules(obj, key);
            break;
        case 'button' :
        case 'tags' :
        case 'post-tags' :
        case 'overlay-button' :
        case 'scroll-to' :
            str += createButtonRules(obj, key);
            break;
        case 'countdown' :
            str += createCountdownRules(obj, key);
            break;
        case 'counter' :
            str += createCounterRules(obj, key);
            break;
        case 'text':
        case 'headline':
            str += createTextRules(obj, key);
            break;
        case 'progress-bar' :
            str += createProgressBarRules(obj, key);
            break;
        case 'progress-pie' :
            str += createProgressPieRules(obj, key);
            break;
        case 'social' :
            str += createSocialRules(obj, key);
            break;
        case 'disqus' :
        case 'vk-comments' :
        case 'hypercomments' :
        case 'facebook-comments' :
        case 'modules' :
        case 'custom-html' :
        case 'gallery' :
        case 'forms' :
            str += createModulesRules(obj, key);
            break;
        case 'blog-posts' :
        case 'search-result':
        case 'recent-posts' :
        case 'post-navigation' :
        case 'related-posts' :
            str += createBlogPostsRules(obj, key);
            break;
        case 'star-ratings' :
            str += createStarRatingsRules(obj, key);
            break;
        case 'post-intro' :
        case 'category-intro' :
            str += createPostIntroRules(obj, key);
            break;
        case 'categories' :
            str += createCategoriesRules(obj, key);
            break;
        case 'instagram':
        case 'simple-gallery':
            str += createInstagramRules(obj, key);
            break;
        case 'blog-content' :
            break;
        case 'mega-menu-section' :
            str += createMegaMenuSectionRules(obj, key);
            break;
        case 'flipbox' :
            str += createFlipboxRules(obj, key);
            break;
        case 'error-message':
            str += createErrorRules(obj, key);
            break;
        default :
            str += createSectionRules(obj, key);
    }
    
    return str;
}

function setItemsVisability(disable, display)
{
    var str = '';
    if ($g('body').hasClass('show-hidden-elements')) {
        if (disable == 1) {
            str += "opacity : 0.3;";
        } else {
            str += "opacity : 1;";
        }
        str += "display : "+display+";";
    } else {
        if (disable == 1) {
            str += "display : none;";
        } else {
            str += "display : "+display+";";
        }
    }
    

    return str;
}

function setBoxModel(obj, selector)
{
    var str = '';
    if (obj.margin) {
        if (obj.margin.top) {
            str += "#"+selector+" > .ba-box-model:before {";
            str += "height: "+obj.margin.top+"px;";
            if (obj.border && obj.border.width) {
                if ((obj.border.top && obj.border.top == 1) || !obj.border.top) {
                    str += "top: -"+obj.border.width+"px;";
                } else {
                    str += "top: 0;";
                }
            }
            str += "}";
        }
        if (obj.margin.bottom) {
            str += "#"+selector+" > .ba-box-model:after {";
            str += "height: "+obj.margin.bottom+"px;";
            if (obj.border && obj.border.width) {
                if ((obj.border.bottom && obj.border.bottom == 1) || !obj.border.bottom) {
                    str += "bottom: -"+obj.border.width+"px;";
                } else {
                    str += "bottom: 0";
                }
            }
            str += "}";
        }
    }
    for (var ind in obj.padding) {
        str += "#"+selector+" > .ba-box-model .ba-bm-"+ind+" {";
        str += "width: "+obj.padding[ind]+"px; height: "+obj.padding[ind]+"px;}";
    }

    return str;
}

function createCategoriesRules(obj, key)
{
    var str = getCategoriesRules(obj.desktop, key);
    str += "#"+key+" li a:hover {";
    str += "color : "+getCorrectColor(obj.desktop['nav-hover'].color)+";";
    str += "}";
    str += app.setMediaRules(obj, key, 'getCategoriesRules');

    return str;
}

function createOnePageRules(obj, key)
{
    if (!obj.desktop.nav) {
        var $nav = '{"padding":{"bottom":"15","left":"15","right":"15","top":"15"},"margin":{"left":"0","right":"0"}';
        $nav += ',"icon":{"size":24},"border":{"bottom":"0","left":"0","right":"0","top":"0","color":"#000000",';
        $nav += '"style":"solid","radius":"0","width":"0"},"normal":{"color":"color","background":"rgba(0,0,0,';
        $nav += '0)"},"hover":{"color":"color","background":"rgba(0,0,0,0)"}}';
        obj.desktop.nav = JSON.parse($nav);
        obj.desktop.nav.normal.color = obj.desktop['nav-typography'].color;
        obj.desktop.nav.hover.color = obj.desktop['nav-hover'].color;
    }
    var str = getOnePageRules(obj.desktop, key);
    str += "#"+key+" .main-menu li a:hover {";
    str += "color : "+getCorrectColor(obj.desktop.nav.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.desktop.nav.hover.background)+";";
    str += "}";
    if (!disableResponsive) {
        str += "@media (max-width: "+menuBreakpoint+"px) {"
        str += "#"+key+" .ba-hamburger-menu .main-menu {";
        str += "background-color : "+getCorrectColor(obj.hamburger.background)+";";
        str += "}"
        str += "#"+key+" .ba-hamburger-menu .open-menu {";
        str += "color : "+getCorrectColor(obj.hamburger.open)+";";
        str += "text-align : "+obj.hamburger['open-align']+";";
        str += "}";
        str += "#"+key+" .ba-hamburger-menu .close-menu {";
        str += "color : "+getCorrectColor(obj.hamburger.close)+";";
        str += "text-align : "+obj.hamburger['close-align']+";";
        str += "}";
        str += "}";
    }
    str += app.setMediaRules(obj, key, 'getOnePageRules');
    $g('#'+key).removeClass('side-navigation-menu').addClass(obj.layout.type).find('.ba-menu-wrapper').each(function(){
        $g(this).removeClass('vertical-menu ba-menu-position-left ba-hamburger-menu ba-menu-position-center');
        if (obj.hamburger.enable) {
            $g(this).addClass('ba-hamburger-menu');
        }
    }).addClass(obj.layout.layout).addClass(obj.hamburger.position);

    return str;
}

function createMenuRules(obj, key)
{
    if (!obj.desktop.nav) {
        var $nav = '{"padding":{"bottom":"15","left":"15","right":"15","top":"15"},"margin":{"left":"0","right":"0"}';
        $nav += ',"icon":{"size":24},"border":{"bottom":"0","left":"0","right":"0","top":"0","color":"#000000",';
        $nav += '"style":"solid","radius":"0","width":"0"},"normal":{"color":"color","background":"rgba(0,0,0,';
        $nav += '0)"},"hover":{"color":"color","background":"rgba(0,0,0,0)"}}';
        obj.desktop.nav = JSON.parse($nav);
        obj.desktop.nav.normal.color = obj.desktop['nav-typography'].color;
        obj.desktop.nav.hover.color = obj.desktop['nav-hover'].color;
        var sub = '{"padding":{"bottom":"10","left":"20","right":"20","top":"10"},"icon":{"size":24},"border":{';
        sub += '"bottom":"0","left":"0","right":"0","top":"0","color":"#000000","style":"solid","radius":"0",';
        sub += '"width":"0"},"normal":{"color":"color","background":"rgba(0,0,0,0)"},"hover":{"color":"color",';
        sub += '"background":"rgba(0,0,0,0)"}}';
        obj.desktop.sub = JSON.parse(sub);
        obj.desktop.sub.normal.color = obj.desktop['sub-typography'].color;
        obj.desktop.sub.hover.color = obj.desktop['sub-hover'].color;
        sub = '{"width":250,"animation":{"effect":"fadeInUp","duration":"0.2"},"padding":{"bottom":"10",';
        sub += '"left":"0","right":"0","top":"10"}}';
        obj.desktop.dropdown = JSON.parse(sub);
    }
    var str = getMenuRules(obj.desktop, key);
    str += "#"+key+" > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a:hover,#";
    str += key+" .main-menu li > span:hover {";
    str += "color : "+getCorrectColor(obj.desktop.nav.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.desktop.nav.hover.background)+";";
    str += "}";
    str += "#"+key+" .main-menu .nav-child li a:hover,#"+key+" .main-menu .nav-child li span:hover {";
    str += "color : "+getCorrectColor(obj.desktop.sub.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.desktop.sub.hover.background)+";";
    str += "}"
    str += "#"+key+" ul.nav-child {";
    str += "width: "+obj.desktop.dropdown.width+"px;";
    str += "background-color : "+getCorrectColor(obj.desktop.background.color)+";";
    str += "box-shadow: 0 "+(obj.desktop.shadow.value * 10);
    str += "px "+(obj.desktop.shadow.value * 20)+"px 0 "+getCorrectColor(obj.desktop.shadow.color)+";";
    str += "animation-duration: "+obj.desktop.dropdown.animation.duration+"s;"
    str += "}";
    str += "#"+key+" li.megamenu-item > .tabs-content-wrapper > .ba-section {";
    str += "box-shadow: 0 "+(obj.desktop.shadow.value * 10);
    str += "px "+(obj.desktop.shadow.value * 20)+"px 0 "+getCorrectColor(obj.desktop.shadow.color)+";";
    str += "animation-duration: "+obj.desktop.dropdown.animation.duration+"s;"
    str += "}";
    str += "#"+key+" .nav-child > .deeper:hover > .nav-child {";
    str += "top : -"+obj.desktop.dropdown.padding.top+"px;";
    str += "}";
    if (!disableResponsive) {
        str += "@media (max-width: "+menuBreakpoint+"px) {"
        str += "#"+key+" .ba-hamburger-menu .main-menu {";
        str += "background-color : "+getCorrectColor(obj.hamburger.background)+";";
        str += "}"
        str += "#"+key+" .ba-hamburger-menu .open-menu {";
        str += "color : "+getCorrectColor(obj.hamburger.open)+";";
        str += "text-align : "+obj.hamburger['open-align']+";";
        str += "}";
        str += "#"+key+" .ba-hamburger-menu .close-menu {";
        str += "color : "+getCorrectColor(obj.hamburger.close)+";";
        str += "text-align : "+obj.hamburger['close-align']+";";
        str += "}";
        str += "}";
    }
    $g('#'+key).find('> .ba-menu-wrapper').each(function(){
        $g(this).removeClass('vertical-menu ba-menu-position-left ba-hamburger-menu ba-collapse-submenu ba-menu-position-center');
        if (obj.hamburger.enable) {
            $g(this).addClass('ba-hamburger-menu');
        }
        if (obj.hamburger.collapse) {
            $g(this).addClass('ba-collapse-submenu');
        }
    }).addClass(obj.layout.layout).addClass(obj.hamburger.position);
    str += app.setMediaRules(obj, key, 'getMenuRules');

    return str;
}

function createLogoRules(obj, key)
{
    var str = getLogoRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getLogoRules');

    return str;
}

function createWeatherRules(obj, key)
{
    var str = getWeatherRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getWeatherRules');

    return str;
}

function createScrollTopRules(obj, key)
{
    var str = getScrollTopRules(obj.desktop, key);
    str += "#"+key+" i.ba-btn-transition:hover {";
    str += "color : "+getCorrectColor(obj.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.hover['background-color'])+";";
    str += "}";
    str += app.setMediaRules(obj, key, 'getScrollTopRules');
    if (obj.type == 'scroll-to-top') {
        $g("#"+key).removeClass('scroll-btn-left scroll-btn-right').addClass('scroll-btn-'+obj.text.align);
    }

    return str;
}

function createCarouselRules(obj, key)
{
    var str = getCarouselRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getCarouselRules');
    $g('#'+key+' ul').removeClass('caption-over caption-hover')
        .addClass(obj.desktop.caption.position).addClass(obj.desktop.caption.hover);

    return str;
}

function createRecentSliderRules(obj, key)
{
    var str = getRecentSliderRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getRecentSliderRules');
    $g('#'+key+' ul').removeClass('caption-over caption-hover')
        .addClass(obj.desktop.caption.position).addClass(obj.desktop.caption.hover);

    return str;
}

function createSlideshowRules(obj, key)
{
    var str = getSlideshowRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getSlideshowRules');

    return str;
}

function createAccordionRules(obj, key)
{
    var str = getAccordionRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getAccordionRules');

    return str;
}

function createTabsRules(obj, key)
{
    var str = getTabsRules(obj.desktop, key);
    str += "#"+key+" ul.nav.nav-tabs li a:hover {";
    str += "color : "+getCorrectColor(obj.desktop.hover.color)+";";
    str += "}";
    if (obj.desktop.icon.position == 'icon-position-left') {
        str += '#'+key+' .ba-tabs-wrapper li a > span {direction: rtl;display: inline-flex;'
        str += 'display: -webkit-inline-flex;flex-direction: row;-webkit-flex-direction: row;}';
        str += '#'+key+' .ba-tabs-wrapper li a > span i {margin-bottom:0;}';
    } else if (obj.desktop.icon.position == 'icon-position-top') {
        str += '#'+key+' .ba-tabs-wrapper li a > span {display: inline-flex;display: -webkit-inline-flex;';
        str += 'flex-direction: column-reverse;-webkit-flex-direction: column-reverse;}';
        str += '#'+key+' .ba-tabs-wrapper li a > span i {margin-bottom:10px;}';
    } else {
        str += '#'+key+' .ba-tabs-wrapper li a > span {direction: ltr;display: inline-flex;'
        str += 'display: -webkit-inline-flex;flex-direction: row;-webkit-flex-direction: row;}';
        str += '#'+key+' .ba-tabs-wrapper li a > span i {margin-bottom:0;}';
    }
    str += app.setMediaRules(obj, key, 'getTabsRules');

    return str;
}

function createMapRules(obj, key)
{
    var str = getMapRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getMapRules');

    return str;
}

function createCounterRules(obj, key)
{
    var str = getCounterRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getCounterRules');

    return str;
}

function createCountdownRules(obj, key)
{
    var str = getCountdownRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getCountdownRules');

    return str;
}

function createSearchRules(obj, key)
{
    var str = getSearchRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getSearchRules');
    $g('#'+key).find('.ba-search-wrapper').removeClass('after').addClass(obj.desktop.icons.position);

    return str;
}

function createButtonRules(obj, key)
{
    var str = getButtonRules(obj.desktop, key);
    str += "#"+key+" .ba-button-wrapper a:hover {";
    str += "color : "+getCorrectColor(obj.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.hover['background-color'])+";";
    str += "}";
    if (typeof(obj.icon) == 'object') {
        str += "#"+key+" .ba-button-wrapper a {";
        if (obj.icon.position == '') {
            str += 'flex-direction: row-reverse; -webkit-flex-direction: row-reverse;';
        } else {
            str += 'flex-direction: row; -webkit-flex-direction: row;';
        }
        str += "}";
        if (obj.icon.position == '') {
            str += "#"+key+" .ba-button-wrapper a i {";
            str += 'margin: 0 10px 0 0;';
            str += "}";
        } else {
            str += "#"+key+" .ba-button-wrapper a i {";
            str += 'margin: 0 0 0 10px;';
            str += "}";
        }
    }
    str += app.setMediaRules(obj, key, 'getButtonRules');

    return str;
}

function createBlogPostsRules(obj, key)
{
    var str = getBlogPostsRules(obj.desktop, key, obj.type);
    str += "#"+key+" .ba-blog-post-title a:hover {";
    str += "color: "+getCorrectColor(obj.desktop.title.hover.color)+";";
    str += "}";
    str += "#"+key+" .ba-blog-post-info-wrapper > span a:hover {";
    str += "color: "+getCorrectColor(obj.desktop.info.hover.color)+";";
    str += "}";
    $g('#'+key).find('.ba-blog-posts-wrapper').removeClass('ba-classic-layout ba-grid-layout ba-cover-layout').addClass(obj.layout.layout);
    str += app.setMediaRules(obj, key, 'getBlogPostsRules');

    return str;
}

function createPostIntroRules(obj, key)
{
    var str = getPostIntroRules(obj.desktop, key);
    str += "#"+key+" .intro-post-wrapper .intro-post-info > span a:hover {";
    str += "color: "+getCorrectColor(obj.desktop.info.hover.color)+";";
    str += "}";
    str += app.setMediaRules(obj, key, 'getPostIntroRules');
    $g('#'+key).find('.intro-post-wrapper').removeClass('fullscreen-post').addClass(obj.layout.layout);

    return str;
}

function createIconRules(obj, key)
{
    var str = getIconRules(obj.desktop, key);
    str += "#"+key+" .ba-icon-wrapper i:hover {";
    str += "color : "+getCorrectColor(obj.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.hover['background-color'])+";";
    str += "}";
    str += app.setMediaRules(obj, key, 'getIconRules');

    return str;
}

function createStarRatingsRules(obj, key)
{
    var str = getStarRatingsRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getStarRatingsRules');

    return str;
}

function createInstagramRules(obj, key)
{
    var str = getInstagramRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getInstagramRules');
    if (obj.type == 'simple-gallery' || obj.popup.enable) {
        str += '#'+key+' .ba-instagram-image a {display: none;} #'+key+' .ba-instagram-image {';
        str += 'cursor: zoom-in;}';
    } else {
        str += '#'+key+' .ba-instagram-image a {display: block;} #'+key+' .ba-instagram-image {';
        str += 'cursor: default;}';
    }

    return str;
}

function createErrorRules(obj, key)
{
    var str = getErrorRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getErrorRules');

    return str;
}

function createTextRules(obj, key)
{
    var array = new Array('h1' ,'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'links');
    if (obj.global) {
        delete(obj.global);
        array.forEach(function(el){
            delete(obj.desktop[el]);
            for (var ind in breakpoints) {
                delete(obj[ind][el]);
            }
        });
    }
    if (!obj.desktop.p) {
        array.forEach(function(el){
            if (el != 'links') {
                obj.desktop[el] = {
                    "font-family" : "@default",
                    "font-weight" : "@default"
                };
                for (var ind in breakpoints) {
                    if (!obj[ind]) {
                        obj[ind] = {};
                    }
                    obj[ind][el] = {};
                }
            }
        });
    }
    if (!obj.desktop.links) {
        obj.desktop.links = {};
    }
    var str = getTextRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getTextRules');

    return str;
}

function createProgressPieRules(obj, key)
{
    var str = getProgressPieRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getProgressPieRules');

    return str;
}

function createProgressBarRules(obj, key)
{
    var str = getProgressBarRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getProgressBarRules');

    return str;
}

function createSocialRules(obj, key)
{
    var str = getModulesRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getModulesRules');
    str += '#'+key+' .social-counter {display:'+(obj.view.counters ? 'inline-block' : 'none')+'}';
    $g('#'+key).removeClass('ba-social-sidebar').each(function(){
        if (obj.view.layout == 'ba-social-sidebar') {
            if (this.parentNode.localName != 'body') {
                obj.parent = this.parentNode.id;
                document.body.appendChild(this);
            }
        } else {
            if (this.parentNode.localName == 'body') {
                var parent = document.getElementById(obj.parent);
                if (!parent) {
                    parent = document.querySelector('.ba-grid-column');
                    if (!parent) {
                        return false;
                    }
                }
                obj.parent = parent.id;
                $g(parent).find(' > .empty-item').before(this);
            }
        }
    }).addClass(obj.view.layout).find('.ba-social').removeClass('ba-social-sm ba-social-md ba-social-lg')
        .addClass(obj.view.size).removeClass('ba-social-classic ba-social-flat ba-social-circle').addClass(obj.view.style);

    return str;
}

function createModulesRules(obj, key)
{
    var str = getModulesRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getModulesRules');

    return str;
}

function createImageRules(obj, key)
{
    var str = getImageRules(obj.desktop, key);
    if (obj.link.link) {
        str += '#'+key+' .ba-image-wrapper img { cursor: pointer; }';
    } else if (obj.popup) {
        str += '#'+key+' .ba-image-wrapper img { cursor: zoom-in; }';
    } else {
        str += '#'+key+' .ba-image-wrapper img { cursor: default; }';
    }
    str += app.setMediaRules(obj, key, 'getImageRules');

    return str;
}

function createVideoRules(obj, key)
{
    var str = getVideoRules(obj.desktop, key);
    str += app.setMediaRules(obj, key, 'getVideoRules');

    return str;
}

function createHeaderRules(obj, view)
{
    var str = "body header.header {";
    str += "position:"+obj.position+";";
    str += "}";
    str += "body.com_gridbox.gridbox header.header {";
    if (obj.position == 'fixed') {
        if (view == 'desktop') {
            str += "width: calc(100% - 103px);width: -webkit-calc(100% - 103px);";
            str += "left: 52px;";
        } else {
            str += "width: 100%;";
            str += "left: 0;";    
        }
        str += "top: 40px;";
    } else {
        str += "width: 100%;";
        str += "left: 0;";
        str += "top: 0;";
    }
    if (obj.position == 'relative') {
        str += "z-index: 2;";
    } else {
        str += "z-index: 20;";
    }
    str += "}";
    if (obj.position == 'fixed') {
        str += ".ba-container .header {margin-left: calc((100vw - 1280px)/2);";
        str += "margin-left: -webkit-calc((100vw - 1280px)/2);max-width: 1170px;}";
    } else {
        str += ".ba-container .header {margin-left:0;max-width: none;}";
    }

    return str;
}

function createMegaMenuSectionRules(obj, key)
{
    if (!obj.desktop.full) {
        obj.desktop.full = {
            fullscreen: obj.desktop.fullscreen == '1'
        };
        if (obj['max-width']) {
            obj.desktop.full.fullwidth = obj['max-width'] == '100%';
            delete(obj['max-width']);
        }
        delete(obj.desktop.fullscreen);
        for (var ind in breakpoints) {
            if (obj[ind] && obj[ind].fullscreen) {
                obj[ind].full = {
                    fullscreen: obj[ind].fullscreen == '1'
                };
                delete(obj[ind].fullscreen);
            }
        }
        obj.view = {
            width: obj.width,
            position: obj.position
        }
        delete(obj.width);
        delete(obj.position);
    }
    var str = createMegaMenuRules(obj.desktop, key);
    if (obj.parallax) {
        var pHeight = 100 + obj.parallax.offset * 2 * 200,
            pTop = obj.parallax.offset * 2 * -100;
        str += "#"+key+" > .parallax-wrapper.scroll .parallax {";
        str += "height: "+pHeight+"%;"
        str += "top: "+pTop+"%;"
        str += "}";
    }
    str += "#"+key+" {width: "+obj.view.width+"px; }";
    str += app.setMediaRules(obj, key, 'createMegaMenuRules');
    if (obj.desktop.background && obj.desktop.background.type != 'video') {
        $g('#'+key+' > .ba-video-background').remove();
    }
    if (!obj.desktop.full.fullwidth) {
        $g('#'+key).parent().addClass('ba-container');
    } else {
        $g('#'+key).parent().removeClass('ba-container');
    }
    $g('#'+key).parent().removeClass('megamenu-center').addClass(obj.view.position);
    
    return str;
}

function setFlipboxSide(obj, side)
{
    var array = new Array('background', 'overlay', 'image', 'video');
    obj.parallax = obj.sides[side].parallax;
    for (var i = 0; i < array.length; i++) {
        obj.desktop[array[i]] = obj.sides[side].desktop[array[i]];
    }
    for (var ind in breakpoints) {
        if (obj[ind]) {
            for (var i = 0; i < array.length; i++) {
                if (obj.sides[side][ind][array[i]]) {
                    obj[ind][array[i]] = obj.sides[side][ind][array[i]];
                } else if (obj[ind][array[i]]) {
                    delete(obj[ind][array[i]]);
                }
            }
        }
    }
}

function createFlipboxRules(obj, key)
{
    setFlipboxSide(obj, obj.side);
    var str = getFlipboxRules(obj.desktop, key),
        object = $g.extend(true, {}, obj);
    str += app.setMediaRules(obj, key, 'getFlipboxRules');
    setFlipboxSide(object, 'frontside');
    var key1 = key+' > .ba-flipbox-wrapper > .ba-flipbox-frontside > .ba-grid-column-wrapper > .ba-grid-column';
    if (object.parallax) {
        var pHeight = 100 + object.parallax.offset * 2 * 200,
            pTop = object.parallax.offset * 2 * -100;
        str += "#"+key1+" > .parallax-wrapper.scroll .parallax {";
        str += "height: "+pHeight+"%;"
        str += "top: "+pTop+"%;"
        str += "}";
    }
    str += getFlipsidesRules(object.desktop, key1);
    str += app.setMediaRules(object, key1, 'getFlipsidesRules');
    if (object.desktop.background && object.desktop.background.type != 'video') {
        $g('#'+key1+' > .ba-video-background').remove();
    }
    setFlipboxSide(object, 'backside');
    key1 = key+' > .ba-flipbox-wrapper > .ba-flipbox-backside > .ba-grid-column-wrapper > .ba-grid-column';
    if (object.parallax) {
        var pHeight = 100 + object.parallax.offset * 2 * 200,
            pTop = object.parallax.offset * 2 * -100;
        str += "#"+key1+" > .parallax-wrapper.scroll .parallax {";
        str += "height: "+pHeight+"%;"
        str += "top: "+pTop+"%;"
        str += "}";
    }
    str += getFlipsidesRules(object.desktop, key1);
    str += app.setMediaRules(object, key1, 'getFlipsidesRules');
    if (object.desktop.background && object.desktop.background.type != 'video') {
        $g('#'+key1+' > .ba-video-background').remove();
    }
    
    return str;
}

function createSectionRules(obj, key)
{
    if (obj.type == 'row' && !obj.desktop.view) {
        obj.desktop.view = {
            gutter: obj.desktop.gutter == '1'
        }
        delete(obj.desktop.gutter);
        for (var ind in breakpoints) {
            if (obj[ind] && obj[ind].gutter) {
                obj[ind].view = {
                    gutter: obj[ind].gutter == '1'
                };
                delete(obj[ind].gutter);
            }
        }
    }
    if (!obj.desktop.full) {
        obj.desktop.full = {
            fullscreen: obj.desktop.fullscreen == '1'
        };
        if (obj['max-width']) {
            obj.desktop.full.fullwidth = obj['max-width'] == '100%';
            delete(obj['max-width']);
        }
        delete(obj.desktop.fullscreen);
        obj.desktop.image = {
            image: obj.desktop.background.image.image
        };
        for (var ind in breakpoints) {
            if (obj[ind]) {
                if (obj[ind].fullscreen) {
                    obj[ind].full = {
                        fullscreen: obj[ind].fullscreen == '1'
                    };
                    delete(obj[ind].fullscreen);
                }
                if (obj[ind].background && obj[ind].background.image && obj[ind].background.image.image) {
                    obj[ind].image = {
                        image: obj[ind].background.image.image
                    };
                }
            }
        }
        if (obj.type == 'column') {
            for (var ind in breakpoints) {
                if (obj[ind] && obj[ind]['column-width']) {
                    obj[ind].span = {
                        width: obj[ind]['column-width']
                    }
                    delete(obj[ind]['column-width']);
                }
            }
        } else if (obj.type == 'overlay-section') {
            obj.lightbox = {
                layout: obj.layout,
                background: obj['background-overlay']
            }
            delete(obj.layout);
            delete(obj['background-overlay']);
        } else if (obj.type == 'lightbox') {
            obj.lightbox = {
                layout: obj.position,
                background: obj['background-overlay']
            }
            delete(obj.position);
            delete(obj['background-overlay']);
        } else if (obj.type == 'cookies') {
            obj.lightbox = {
                layout: obj.layout,
                position: obj.position
            }
            delete(obj.layout);
            delete(obj.position);
        }
        if (obj.desktop.width) {
            obj.desktop.view = {
                width: obj.desktop.width
            };
            delete(obj.desktop.width);
            if (obj.desktop.height) {
                obj.desktop.view.height = obj.desktop.height;
                delete(obj.desktop.height);
            }
            for (var ind in breakpoints) {
                if (obj[ind]) {
                    obj[ind].view = {};
                    if (obj[ind].width) {
                        obj[ind].view.width = obj[ind].width;
                        delete(obj[ind].width);
                    }
                    if (obj[ind].height) {
                        obj[ind].view.height = obj[ind].height;
                        delete(obj[ind].height);
                    }
                }
            }
        }
    }
    app.cssRulesFlag = 'desktop';
    var str = createPageRules(obj.desktop, key, obj.type);
    if (obj.type == 'footer') {
        app.footer = obj;
    }
    if (obj.type == 'lightbox') {
        str += ".ba-lightbox-backdrop[data-id="+key+"] .close-lightbox {";
        str += "color: "+getCorrectColor(obj.close.color)+";";
        str += "text-align: "+obj.close['text-align']+";";
        str += "}";
        str += "body.gridbox .ba-lightbox-backdrop[data-id="+key+"] > .ba-lightbox-close {";
        str += "background-color: "+getCorrectColor(obj.lightbox.background)+";";
        str += "}";
        str += "body:not(.gridbox) .ba-lightbox-backdrop[data-id="+key+"] {";
        str += "background-color: "+getCorrectColor(obj.lightbox.background)+";";
        str += "}";
        $g('#'+key).closest('.ba-lightbox-backdrop')
            .removeClass('lightbox-top-left lightbox-top-right lightbox-center lightbox-bottom-left lightbox-bottom-right')
            .addClass(obj.lightbox.layout);
    } else if (obj.type == 'overlay-section') {
        str += ".ba-overlay-section-backdrop[data-id="+key+"] .close-overlay-section {";
        str += "color: "+getCorrectColor(obj.close.color)+";";
        str += "text-align: "+obj.close['text-align']+";";
        str += "}";
        str += "body.gridbox .ba-overlay-section-backdrop[data-id="+key+"] > .ba-overlay-section-close {";
        str += "background-color: "+getCorrectColor(obj.lightbox.background)+";";
        str += "}";
        str += "body:not(.gridbox) .ba-overlay-section-backdrop[data-id="+key+"] {";
        str += "background-color: "+getCorrectColor(obj.lightbox.background)+";";
        str += "}";
        $g('#'+key).closest('.ba-overlay-section-backdrop')
            .removeClass('vertical-right vertical-left horizontal-top horizontal-bottom lightbox').addClass(obj.lightbox.layout);
    } else if (obj.type == 'cookies') {
        $g('#'+key).closest('.ba-lightbox-backdrop')
            .removeClass('notification-bar-top notification-bar-bottom lightbox-top-left lightbox-top-right lightbox-bottom-left')
            .removeClass('lightbox-bottom-right').addClass(obj.lightbox.position);
    }
    if (obj.parallax) {
        var pHeight = 100 + obj.parallax.offset * 2 * 200,
            pTop = obj.parallax.offset * 2 * -100;
        str += "#"+key+" > .parallax-wrapper.scroll .parallax {";
        str += "height: "+pHeight+"%;"
        str += "top: "+pTop+"%;"
        str += "}";
    }
    app.cssRulesFlag = 'tablet';
    str += app.setMediaRules(obj, key, 'createPageRules');
    if (obj.desktop.background && obj.desktop.background.type != 'video') {
        $g('#'+key+' > .ba-video-background').remove();
    }

    if (obj.type != 'column' && 'fullwidth' in obj.desktop.full) {
        if (!obj.desktop.full.fullwidth) {
            $g('#'+key).parent().addClass('ba-container');
        } else {
            $g('#'+key).parent().removeClass('ba-container');
        }
    }
    if (obj.type == 'row') {
        if (obj.desktop.view.gutter) {
            $g('#'+key).removeClass('no-gutter-desktop');
        } else {
            $g('#'+key).addClass('no-gutter-desktop');
        }
    } else if (obj.type == 'column') {
        var parent = $g('#'+key).parent();
        for (var ind in breakpoints) {
            if (obj[ind] && obj[ind].span && obj[ind].span.width) {
                var name = ind.replace('tablet-portrait', 'ba-tb-pt-').replace('tablet', 'ba-tb-la-')
                    .replace('phone-portrait', 'ba-sm-pt-').replace('phone', 'ba-sm-la-');
                for (var i = 1; i <= 12; i++) {
                    parent.removeClass(name+i);
                }
                parent.addClass(name+obj[ind].span.width);
            }
        }
    }
    
    return str;
}

function createFooterStyle(obj)
{
    var str = "";
    for (var key in obj) {
        switch(key) {
            case 'links' : 
                str += "body footer a {";
                str += "color : "+getCorrectColor(obj[key].color)+";";
                str += "}";
                str += "body footer a:hover {";
                str += "color : "+getCorrectColor(obj[key]['hover-color'])+";";
                str += "}";
                break;
            case 'body':
                str += "body footer, footer ul, footer ol, footer table, footer blockquote";
                str += " {";
                str += getTypographyRule(obj[key]);
                str += "}";
                break;
            case 'p' :
            case 'h1' :
            case 'h2' :
            case 'h3' :
            case 'h4' :
            case 'h5' :
            case 'h6' :
                str += "footer "+key;
                str += " {";
                str += getTypographyRule(obj[key]);
                str += "}";
                break;
        }
    }
    return str;
}

function createMegaMenuRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += "min-height: 50px;";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.padding) {
        str += 'padding-'+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "border-bottom-width : "+(obj.border.width * obj.border.bottom)+"px;";
    str += "border-color : "+getCorrectColor(obj.border.color)+";";
    str += "border-left-width : "+(obj.border.width * obj.border.left)+"px;";
    str += "border-right-width : "+(obj.border.width * obj.border.right)+"px;";
    str += "border-style : "+obj.border.style+";";
    str += "border-top-width : "+(obj.border.width * obj.border.top)+"px;";
    str += "}";
    str += 'li.deeper > .tabs-content-wrapper[data-id="'+selector+'"] + a > i.zmdi-caret-right {';
    str += setItemsVisability(obj.disable, "inline-block");
    str += "}";
    if (obj.background.image.image) {
        str += "#"+selector+" > .parallax-wrapper .parallax {";
        if (obj.background.image.image.indexOf('balbooa.com') != -1) {
            str += "background-image: url("+obj.background.image.image+");";
        } else {
            str += "background-image: url("+JUri+encodeURI(obj.background.image.image)+");";
        }
        str += "}";
    } else {
        str += "#"+selector+" > .parallax-wrapper .parallax {";
        str += "background-image: none;";
        str += "}";
    }
    str += app.backgroundRule(obj, '#'+selector);
    str += setBoxModel(obj, selector);

    return str;
}

function getFlipboxRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += 'margin-'+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" > .ba-flipbox-wrapper {"
    str += "height: "+obj.view.height+"px;";
    str += "}";
    str += "#"+selector+" > .ba-flipbox-wrapper > .column-wrapper > .ba-grid-column-wrapper > .ba-grid-column {"
    if (obj.full.fullscreen) {
        str += "justify-content: center;";
        str += "-webkit-justify-content: center;";
        str += "min-height: 100vh;";
    } else {
        str += "min-height: 50px;";
    }
    str += "}";
    str += "#"+selector+" > .ba-flipbox-wrapper > .column-wrapper {"
    str += "transition-duration: "+obj.animation.duration+"s;"
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}


function getFlipsidesRules(obj, selector)
{
    var str = '#'+selector+" {"
    str += "border-bottom-width : "+(obj.border.width * obj.border.bottom)+"px;";
    str += "border-color : "+getCorrectColor(obj.border.color)+";";
    str += "border-left-width : "+(obj.border.width * obj.border.left)+"px;";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "border-right-width : "+(obj.border.width * obj.border.right)+"px;";
    str += "border-style : "+obj.border.style+";";
    str += "border-top-width : "+(obj.border.width * obj.border.top)+"px;";
    for (var ind in obj.padding) {
        str += 'padding-'+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "}";
    str += app.backgroundRule(obj, '#'+selector);

    return str;
}

function createPageRules(obj, selector, type)
{
    var str = "#"+selector+" {";
    for (var key in obj) {
        switch (key) {
            case 'border' : 
                if (obj[key].bottom == 1 && obj[key].width) {
                    str += key+"-bottom-width : "+obj[key].width+"px;";
                } else if (obj[key].bottom == 0) {
                    str += key+"-bottom-width : 0;";
                }
                if (obj[key].color) {
                    str += key+"-color : "+getCorrectColor(obj[key].color)+";";
                }
                if (obj[key].left == 1 && obj[key].width) {
                    str += key+"-left-width : "+obj[key].width+"px;";
                } else if (obj[key].left == 0) {
                    str += key+"-left-width : 0;";
                }
                str += key+"-radius : "+obj[key].radius+"px;";
                if (obj[key].right == 1 && obj[key].width) {
                    str += key+"-right-width : "+obj[key].width+"px;";
                } else if (obj[key].right == 0) {
                    str += key+"-right-width : 0;";
                }
                if (obj[key].style) {
                    str += key+"-style : "+obj[key].style+";";
                }
                if (obj[key].top == 1 && obj[key].width) {
                    str += key+"-top-width : "+obj[key].width+"px;";
                } else if (obj[key].top == 0) {
                    str += key+"-top-width : 0;";
                }
                break;
            case 'animation':
                str += "animation-duration: "+obj.animation.duration+"s;"
                str += "animation-delay: "+obj.animation.delay+"s;"
                if (obj.animation.effect) {
                    str += "opacity: 0;";
                } else {
                    str += "opacity: 1;";
                }
                break;
            case 'full' :
                if (obj[key].fullscreen) {
                    if (type != 'column') {
                        str += "align-items: center;-webkit-align-items: center;";;
                    }
                    str += "justify-content: center;";
                    str += "-webkit-justify-content: center;";
                    if (type != 'lightbox') {
                        str += "min-height: 100vh;";
                    } else {
                        str += "min-height: calc(100vh - 50px);min-height: -webkit-calc(100vh - 50px);";
                    }
                } else {
                    if (obj.view && obj.view.height) {
                        str += "min-height: "+obj.view.height+"px;";
                    } else {
                        str += "min-height: 50px;";
                    }
                }
                break;
            case 'disable' :
                if (obj.full.fullscreen) {
                    str += setItemsVisability(obj[key], "flex;display: -webkit-flex;");
                } else {
                    str += setItemsVisability(obj[key], "block");
                }
                break;
            case 'view' :
                if (obj.view.width) {
                    str += "width: "+obj.view.width+"px;";
                }
                break;
            case 'margin' :
            case 'padding' :
                for (var ind in obj[key]) {
                    str += key+'-'+ind+" : "+obj[key][ind]+"px;";
                }
                break;
        }
    }
    str += "}";
    if ($g('body').hasClass('show-hidden-elements')) {
        if (obj.disable == 1) {
            str += "#"+selector+".visible {opacity : 0.3;}";
        } else {
            str += "#"+selector+".visible {opacity : 1;}";
        }
    } else {
        str += "#"+selector+".visible {opacity: 1;}";
    }
    if (obj.background.image.image) {
        str += "#"+selector+" > .parallax-wrapper .parallax {";
        var image = obj.background.image.image;
        if (obj.image) {
            image = obj.image.image;
        }
        if (image.indexOf('balbooa.com') != -1) {
            str += "background-image: url("+image+");";
        } else {
            str += "background-image: url("+JUri+encodeURI(image)+");";
        }
        str += "}";
    } else {
        str += "#"+selector+" > .parallax-wrapper .parallax {";
        str += "background-image: none;";
        str += "}";
    }
    if (obj.shape) {
        str += getShapeRules(selector, obj.shape.bottom, 'bottom');
        str += getShapeRules(selector, obj.shape.top, 'top');
    }
    str += app.backgroundRule(obj, '#'+selector);
    str += setBoxModel(obj, selector);
    if (type == 'header') {
        str += createHeaderRules(obj, app.cssRulesFlag);
    }
    if (type == 'footer') {
        str += createFooterStyle(obj);
    }

    return str;
}

function getShapeRules(selector, obj, type)
{
    str = "#"+selector+" > .ba-shape-divider.ba-shape-divider-"+type+" {";
    if (obj.effect == 'arrow') {
        var arrow = '';
        arrow += "clip-path: polygon(100% "+(100 - obj.value);
        arrow += "%, 100% 100%, 0 100%, 0 "+(100 - obj.value);
        arrow += "%, "+(50 - obj.value / 2)+"% "+(100 - obj.value)+"%, 50% 100%, "+(50 + obj.value / 2)+"% ";
        arrow += (100 - obj.value)+"%);";
        str += arrow;
        str += "-webkit-"+arrow;
    } else if (obj.effect == 'zigzag') {
        var pyramids = "clip-path: polygon(",
            delta = 0,
            delta2 = 100 / (obj.value * 2);
        for (var i = 0; i < obj.value; i++) {
            if (i != 0) {
                pyramids += ",";
            }
            pyramids += delta+"% 100%,";
            pyramids += delta2+"% calc(100% - 15px),";
            delta += 100 / obj.value;
            delta2 += 100 / obj.value;
            pyramids += delta+"% 100%";
        }
        pyramids += ");";
        str += pyramids;
        str += "-webkit-"+pyramids;
    } else if (obj.effect == 'circle') {
        str += "clip-path: circle("+obj.value+"% at 50% 100%);";
        str += "-webkit-clip-path: circle("+obj.value+"% at 50% 100%);";
    } else if (obj.effect == 'vertex') {
        str += "clip-path: polygon(20% calc("+(100 - obj.value)+"% + 15%), 35%  calc("+(100 - obj.value);
        str += "% + 45%), 65%  "+(100 - obj.value)+"%, 100% 100%, 100% 100%, 0% 100%, 0  calc(";
        str += (100 - obj.value)+"% + 10%), 10%  calc("+(100 - obj.value)+"% + 30%));";
    } else if (obj.effect != 'arrow' && obj.effect != 'zigzag' &&
        obj.effect != 'circle' && obj.effect != 'vertex') {
        str += "clip-path: none;";
        str += "background: none;";
        str += "color: "+getCorrectColor(obj.color)+";";
    }
    if (obj.effect == 'arrow' || obj.effect == 'zigzag' ||
        obj.effect == 'circle' || obj.effect == 'vertex') {
        str += "background-color: "+getCorrectColor(obj.color)+";";
    }
    if (!obj.effect) {
        str += 'display: none;';
    } else {
        str += 'display: block;';
    }
    str += "}";
    str += "#"+selector+" > .ba-shape-divider.ba-shape-divider-"+type+" svg:not(.shape-divider-"+obj.effect+") {";
    str += "display: none;";
    str += "}";
    str += "#"+selector+" > .ba-shape-divider.ba-shape-divider-"+type+" svg.shape-divider-"+obj.effect+" {";
    str += "display: block;";
    str += "height: "+(obj.value * 10)+"px;";
    str += "}";

    return str;
}

function getOnePageRules(obj, selector)
{
    var str = "#"+selector+" {";
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += setItemsVisability(obj.disable, "block");
    str += "}";
    str += "#"+selector+" .integration-wrapper > ul > li {";
    for (var ind in obj.nav.margin) {
        str += "margin-"+ind+" : "+obj.nav.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" i.ba-menu-item-icon {";
    str += "font-size: "+obj.nav.icon.size+"px;";
    str += "}";
    str += "#"+selector+" .main-menu li a {";
    str += getTypographyRule(obj['nav-typography']);
    str += "color : "+getCorrectColor(obj.nav.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.nav.normal.background)+";";
    for (var ind in obj.nav.padding) {
        str += "padding-"+ind+" : "+obj.nav.padding[ind]+"px;";
    }
    str += "border-bottom-width : "+(obj.nav.border.width * obj.nav.border.bottom)+"px;";
    str += "border-color : "+getCorrectColor(obj.nav.border.color)+";";
    str += "border-left-width : "+(obj.nav.border.width * obj.nav.border.left)+"px;";
    str += "border-radius : "+obj.nav.border.radius+"px;";
    str += "border-right-width : "+(obj.nav.border.width * obj.nav.border.right)+"px;";
    str += "border-style : "+obj.nav.border.style+";";
    str += "border-top-width : "+(obj.nav.border.width * obj.nav.border.top)+"px;";
    str += "}"
    if (obj.nav.border.left == 1 && obj.nav.border.right == 1 && obj.nav.margin.left == 0 && obj.nav.margin.right == 0) {
        str += "#"+selector+" > .ba-menu-wrapper:not(.vertical-menu) > .main-menu:not(.visible-menu)";
        str += " > .integration-wrapper > ul > li:not(:last-child) > a, #"+selector+"> .ba-menu-wrapper:not(.vertical-menu)";
        str += " > .main-menu:not(.visible-menu) .integration-wrapper > ul > li:not(:last-child) > span {";
        str += "border-right: none";
        str += "}";
    }
    if (obj.nav.border.top == 1 && obj.nav.border.bottom == 1) {
        str += "#"+selector+" > .ba-menu-wrapper.vertical-menu > .main-menu";
        str += " > .integration-wrapper > ul > li:not(:last-child) > a, #"+selector+"> .ba-menu-wrapper.vertical-menu";
        str += " > .main-menu .integration-wrapper > ul > li:not(:last-child) > span, #";
        str += selector+" > .ba-menu-wrapper > .main-menu.visible-menu";
        str += " > .integration-wrapper > ul > li:not(:last-child) > a, #"+selector+"> .ba-menu-wrapper";
        str += " > .main-menu.visible-menu .integration-wrapper > ul > li:not(:last-child) > span {";
        str += "border-bottom: none";
        str += "}";
    }
    str += "#"+selector+" .main-menu li > a:hover {";
    str += "color : "+getCorrectColor(obj.nav.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.nav.normal.background)+";";
    str += "}";
    str += "#"+selector+" ul {";
    str += "text-align : "+obj['nav-typography']['text-align']+";";
    str += "}"
    str += "#"+selector+" .main-menu li.active > a {";
    str += "color : "+getCorrectColor(obj.nav.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.nav.hover.background)+";";
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getMenuRules(obj, selector)
{
    var str = "#"+selector+" {";
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += setItemsVisability(obj.disable, "block");
    str += "}";
    str += "#"+selector+" > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li {";
    for (var ind in obj.nav.margin) {
        str += "margin-"+ind+" : "+obj.nav.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a > i.ba-menu-item-icon, #";
    str += selector+" .integration-wrapper > ul > li > span > i.ba-menu-item-icon {";
    str += "font-size: "+obj.nav.icon.size+"px;";
    str += "}";
    str += "#"+selector+" > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a, #";
    str += selector+" .integration-wrapper > ul > li > span {";
    str += getTypographyRule(obj['nav-typography']);
    str += "color : "+getCorrectColor(obj.nav.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.nav.normal.background)+";";
    for (var ind in obj.nav.padding) {
        str += "padding-"+ind+" : "+obj.nav.padding[ind]+"px;";
    }
    str += "border-bottom-width : "+(obj.nav.border.width * obj.nav.border.bottom)+"px;";
    str += "border-color : "+getCorrectColor(obj.nav.border.color)+";";
    str += "border-left-width : "+(obj.nav.border.width * obj.nav.border.left)+"px;";
    str += "border-radius : "+obj.nav.border.radius+"px;";
    str += "border-right-width : "+(obj.nav.border.width * obj.nav.border.right)+"px;";
    str += "border-style : "+obj.nav.border.style+";";
    str += "border-top-width : "+(obj.nav.border.width * obj.nav.border.top)+"px;";
    str += "}";
    if (obj.nav.border.left == 1 && obj.nav.border.right == 1 && obj.nav.margin.left == 0 && obj.nav.margin.right == 0) {
        str += "#"+selector+" > .ba-menu-wrapper:not(.vertical-menu) > .main-menu:not(.visible-menu)";
        str += " > .integration-wrapper > ul > li:not(:last-child) > a, #"+selector+"> .ba-menu-wrapper:not(.vertical-menu)";
        str += " > .main-menu:not(.visible-menu) .integration-wrapper > ul > li:not(:last-child) > span {";
        str += "border-right: none";
        str += "}";
    }
    if (obj.nav.border.top == 1 && obj.nav.border.bottom == 1) {
        str += "#"+selector+" > .ba-menu-wrapper.vertical-menu > .main-menu";
        str += " > .integration-wrapper > ul > li:not(:last-child) > a, #"+selector+"> .ba-menu-wrapper.vertical-menu";
        str += " > .main-menu .integration-wrapper > ul > li:not(:last-child) > span, #";
        str += selector+" > .ba-menu-wrapper > .main-menu.visible-menu";
        str += " > .integration-wrapper > ul > li:not(:last-child) > a, #"+selector+"> .ba-menu-wrapper";
        str += " > .main-menu.visible-menu .integration-wrapper > ul > li:not(:last-child) > span {";
        str += "border-bottom: none";
        str += "}";
    }
    str += "#"+selector+" .main-menu .nav-child li i.ba-menu-item-icon {";
    str += "font-size: "+obj.sub.icon.size+"px;";
    str += "}";
    str += "#"+selector+" .main-menu .nav-child li a,#"+selector+" .main-menu .nav-child li span {";
    str += getTypographyRule(obj['sub-typography']);
    str += "color : "+getCorrectColor(obj.sub.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.sub.normal.background)+";";
    for (var ind in obj.sub.padding) {
        str += "padding-"+ind+" : "+obj.sub.padding[ind]+"px;";
    }
    str += "border-bottom-width : "+(obj.sub.border.width * obj.sub.border.bottom)+"px;";
    str += "border-color : "+getCorrectColor(obj.sub.border.color)+";";
    str += "border-left-width : "+(obj.sub.border.width * obj.sub.border.left)+"px;";
    str += "border-radius : "+obj.sub.border.radius+"px;";
    str += "border-right-width : "+(obj.sub.border.width * obj.sub.border.right)+"px;";
    str += "border-style : "+obj.sub.border.style+";";
    str += "border-top-width : "+(obj.sub.border.width * obj.sub.border.top)+"px;";
    str += "}"
    if (obj.sub.border.top == 1 && obj.sub.border.bottom == 1) {
        str += "#"+selector+" .main-menu .nav-child li:not(:last-child) > a,#";
        str += selector+" .main-menu .nav-child li:not(:last-child) > span {";
        str += "border-bottom: none";
        str += "}";
    }
    str += "#"+selector+" > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li > a:hover,#";
    str += selector+" .main-menu li > span:hover {";
    str += "color : "+getCorrectColor(obj.nav.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.nav.normal.background)+";";
    str += "}";
    str += "#"+selector+" .main-menu .nav-child li a:hover,#"+selector+" .main-menu .nav-child li span:hover {";
    str += "color : "+getCorrectColor(obj.sub.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.sub.normal.background)+";";
    str += "}"
    str += "#"+selector+" > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul {";
    str += "text-align : "+obj['nav-typography']['text-align']+";";
    str += "}"
    str += "#"+selector+" > .ba-menu-wrapper > .main-menu > .integration-wrapper > ul > li.active > a,#";
    str += selector+" .main-menu li.active > span {";
    str += "color : "+getCorrectColor(obj.nav.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.nav.hover.background)+";";
    str += "}";
    str += "#"+selector+" .main-menu .nav-child li.active > a,#"+selector+" .main-menu .nav-child li.active > span {";
    str += "color : "+getCorrectColor(obj.sub.hover.color)+";";
    str += "background-color : "+getCorrectColor(obj.sub.hover.background)+";";
    str += "}";
    str += "#"+selector+" ul.nav-child {";
    for (var ind in obj.dropdown.padding) {
        str += "padding-"+ind+" : "+obj.dropdown.padding[ind]+"px;";
    }
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getWeatherRules(obj, selector)
{
    var str = "#"+selector+" {";
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += setItemsVisability(obj.disable, "block");
    str += "}";
    str += "#"+selector+" .weather .city {";
    str += getTypographyRule(obj.city);
    str += "}";
    str += "#"+selector+" .weather .condition {";
    str += getTypographyRule(obj.condition);
    str += "}";
    str += "#"+selector+" .weather-info > div,#"+selector+" .weather .date {";
    str += getTypographyRule(obj.info);
    str += "}";
    str += "#"+selector+" .forecast > span {";
    str += getTypographyRule(obj.forecasts);
    str += "}";
    str += "#"+selector+" .weather-info .wind {";
    if (obj.view.wind) {
        str += "display : inline;";
    } else {
        str += "display : none;";
    }
    str += "}";
    str += "#"+selector+" .weather-info .humidity {";
    if (obj.view.humidity) {
        str += "display : inline-block;";
    } else {
        str += "display : none;";
    }
    str += "}";
    str += "#"+selector+" .weather-info .pressure {";
    if (obj.view.pressure) {
        str += "display : inline-block;";
    } else {
        str += "display : none;";
    }
    str += "}";
    str += "#"+selector+" .weather-info .sunrise-wrapper {";
    if (obj.view['sunrise-wrapper']) {
        str += "display : block;";
    } else {
        str += "display : none;";
    }
    str += "}";
    if (obj.view.layout == 'forecast-block') {
        str += '#'+selector+' .forecast > span {display: block;width: initial;}';
        str += '#'+selector+' .weather-info + div {text-align: center;}';
        str += '#'+selector+' .ba-weather div.forecast {margin: 0 20px 0 10px;}';
        str += '#'+selector+' .ba-weather div.forecast .day-temp,';
        str += '#'+selector+' .ba-weather div.forecast .night-temp {margin: 0 5px;}';
        str += '#'+selector+' .ba-weather div.forecast span.night-temp,';
        str += '#'+selector+' .ba-weather div.forecast span.day-temp {padding-right: 0;width: initial;}';
    } else {
        str += '#'+selector+' .forecast > span {display: inline-block;width: 33.3%;}';
        str += '#'+selector+' .weather-info + div {text-align: left;}';
        str += '#'+selector+' .ba-weather div.forecast .day-temp,';
        str += '#'+selector+' .ba-weather div.forecast .night-temp {margin: 0;}';
        str += '#'+selector+' .ba-weather div.forecast {margin: 0;}';
        str += '#'+selector+' .ba-weather div.forecast span.night-temp,';
        str += '#'+selector+' .ba-weather div.forecast span.day-temp {padding-right: 1.5%;width: 14%;}';
    }
    str += "#"+selector+" .forecast:nth-child(n) {";
    str += "display : none;";
    str += "}";
    for (var i = 0; i < obj.view.forecast; i++) {
        str += "#"+selector+" .forecast:nth-child("+(i + 1)+")";
        if (i != obj.view.forecast - 1 ){
            str += ","
        }
    }
    str += " {";
    if (obj.view.layout == 'forecast-block') {
        str += "display: inline-block;";
    } else {
        str += "display: block;";
    }
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getAccordionRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .accordion-group, #"+selector+" .accordion-inner {";
    str += "border-color: "+getCorrectColor(obj.border.color)+";"; 
    str += "}";
    str += "#"+selector+" .accordion-inner {";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "background-color: "+getCorrectColor(obj.background.color)+";";
    str += "}";
    str += "#"+selector+" .accordion-heading a {";
    str += getTypographyRule(obj.typography, 'text-decoration');
    str += "}";
    if (obj.typography['text-decoration']) {
        str += "#"+selector+" .accordion-heading span.accordion-title {";
        str += "text-decoration: "+obj.typography['text-decoration']+";";
        str += "}";
    }
    str += "#"+selector+" .accordion-heading a i {";
    str += "font-size: "+obj.icon.size+"px;";
    str += "}";
    str += "#"+selector+" .accordion-heading {";
    str += "background-color: "+getCorrectColor(obj.header.color)+";";
    str += "}";
    if (obj.icon.position == 'icon-position-left') {
        str += "#"+selector+' .accordion-toggle > span { flex-direction: row-reverse; -webkit-flex-direction: row-reverse; }';
    } else {
        str += "#"+selector+' .accordion-toggle > span { flex-direction: row; -webkit-flex-direction: row; }';
    }
    str += setBoxModel(obj, selector);

    return str;
}

function getInstagramRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-instagram-image {"
    if (obj.gutter) {
        str += "width: calc((100% / "+obj.count+") - 21px);";
        str += "width: -webkit-calc((100% / "+obj.count+") - 21px);";
        str += "margin: 0 5px 10px;";
    } else {
        str += "width: calc(100% / "+obj.count+");";
        str += "width: -webkit-calc(100% / "+obj.count+");";
        str += "margin: 0;";
    }
    str += "height: "+obj.view.height+"px;";
    str += "}";
    str += "#"+selector+" .instagram-wrapper {"
    if (obj.gutter) {
        str += 'margin-left: -10px; margin-right: -10px;width: calc(100% + 20px);width: -webkit-calc(100% + 20px);';
    } else {
        str += 'margin-left: 0; margin-right: 0;width: 100%;';
    }
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getErrorRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" h1.ba-error-code {";
    str += getTypographyRule(obj.code.typography, '');
    for (var ind in obj.code.margin) {
        str += "margin-"+ind+" : "+obj.code.margin[ind]+"px;";
    }
    str += "display: "+(obj.view.code ? "block" : "none")+";";
    str += "}";
    str += "#"+selector+" p.ba-error-message {";
    str += getTypographyRule(obj.message.typography, '');
    for (var ind in obj.message.margin) {
        str += "margin-"+ind+" : "+obj.message.margin[ind]+"px;";
    }
    str += "display: "+(obj.view.message ? "block" : "none")+";";
    str += "}";    
    str += setBoxModel(obj, selector);

    return str;
}

function getTextRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    var array = new Array('p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
    array.forEach(function(el){
        if (obj[el]['font-style'] && obj[el]['font-style'] == '@default') {
            delete(obj[el]['font-style']);
        }
        str += "#"+selector+" "+el+" {";
        str += getTypographyRule(obj[el], '', el);
        if (obj.animation) {
            str += 'animation-duration: '+obj.animation.duration+'s;';
        }
        str += "}";
    });
    if (obj.links && obj.links.color) {
        str += "#"+selector+' a {';
        str += 'color:'+getCorrectColor(obj.links.color)+';'
        str += '}';
    }
    if (obj.links && obj.links['hover-color']) {
        str += "#"+selector+' a:hover {';
        str += 'color:'+getCorrectColor(obj.links['hover-color'])+';'
        str += '}';
    }
    str += setBoxModel(obj, selector);

    return str;
}

function getProgressPieRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-progress-pie {";
    str += 'width: '+obj.view.width+'px;';
    str += getTypographyRule(obj.typography);
    str += "}";
    str += "#"+selector+" .ba-progress-pie canvas {";
    str += 'width: '+obj.view.width+'px;';
    str += "}";
    str += "#"+selector+" .progress-pie-number {display: ";
    if (obj.display.target) {
        str += 'inline-block;';
    } else {
        str += 'none;';
    }
    str += "}";

    str += setBoxModel(obj, selector);

    return str;
}

function getProgressBarRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-progress-bar {";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "box-shadow: 0 "+(obj.shadow.value * 10);
    str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
    str += 'height: '+obj.view.height+'px;';
    str += "background-color: "+getCorrectColor(obj.view.background)+";";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "}";
    str += "#"+selector+" .ba-animated-bar {";
    str += "background-color: "+getCorrectColor(obj.view.bar)+";";
    str += getTypographyRule(obj.typography);
    str += "}";
    str += "#"+selector+" .progress-bar-title {display: ";
    if (obj.display.label) {
        str += 'inline-block;';
    } else {
        str += 'none;';
    }
    str += "}";
    str += "#"+selector+" .progress-bar-number {display: ";
    if (obj.display.target) {
        str += 'inline-block;';
    } else {
        str += 'none;';
    }
    str += "}";

    str += setBoxModel(obj, selector);

    return str;
}

function getModulesRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getCategoriesRules(obj, selector)
{
    var str = "#"+selector+" {";
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += setItemsVisability(obj.disable, "block");
    str += "}";
    str += "#"+selector+" li {";
    str += "text-align: "+obj['nav-typography']['text-align']+';';
    str += "}";
    str += "#"+selector+" li a {";
    str += getTypographyRule(obj['nav-typography'], 'text-align');
    str += "}";
    str += "#"+selector+" li a span {";
    if (obj.view.counter) {
        str += "display: inline;"
    } else {
        str += "display: none;"
    }
    str += "}";
    str += "#"+selector+" ul ul {";
    if (obj.view.sub) {
        str += "display: block;"
    } else {
        str += "display: none;"
    }
    str += "}";
    str += setBoxModel(obj, selector);
    
    return str;
}

function getTabsRules(obj, selector)
{
    var str = "#"+selector+" {",
        align = obj.typography['text-align'].replace('left', 'flex-start').replace('right', 'flex-end');
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .tab-content {";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "background-color: "+getCorrectColor(obj.background.color)+";";
    str += "}";
    str += "#"+selector+" ul.nav.nav-tabs li a {";
    str += getTypographyRule(obj.typography, 'text-decoration');
    str += 'align-items:'+align+'; -webkit-align-items:'+align+';';
    str += "border-color: "+getCorrectColor(obj.header.border)+";";
    str += "}";
    if (obj.typography['text-decoration']) {
        str += "#"+selector+" li span.tabs-title {";
        str += "text-decoration : "+obj.typography['text-decoration']+";";
        str += "}";
    }
    str += "#"+selector+" ul.nav.nav-tabs li a i {";
    str += "font-size: "+obj.icon.size+"px;";
    str += "}";
    str += "#"+selector+" ul.nav.nav-tabs li.active a {";
    str += "color : "+getCorrectColor(obj.hover.color)+";";
    str += "}";
    str += "#"+selector+" ul.nav.nav-tabs li.active a:before {";
    str += "background-color : "+getCorrectColor(obj.hover.color)+";";
    str += "}";
    str += "#"+selector+" ul.nav.nav-tabs {";
    str += "background-color: "+getCorrectColor(obj.header.color)+";";
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getCounterRules(obj, selector)
{
    var str = "#"+selector+" .ba-counter span.counter-number {";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "background-color: "+getCorrectColor(obj.background.color)+";";
    str += "box-shadow: 0 "+(obj.shadow.value * 10);
    str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
    str += getTypographyRule(obj.counter, 'text-align');
    str += "width : "+obj.counter['line-height']+"px;";
    str += "}";
    str += "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "text-align : "+obj.counter['text-align']+";"
    str += "}";
    str += setBoxModel(obj, selector);
    
    return str;
}

function getCountdownRules(obj, selector)
{
    var str = "#"+selector+" .ba-countdown > span {";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "background-color: "+getCorrectColor(obj.background.color)+";";
    str += "}";
    str += "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += 'margin-'+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .countdown-time {";
    str += getTypographyRule(obj.counter);
    str += "}";
    str += "#"+selector+" .countdown-label {";
    str += getTypographyRule(obj.label);
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getSearchRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}"
    str += "#"+selector+" .ba-search-wrapper input::-webkit-input-placeholder {";
    str += getTypographyRule(obj.typography);
    str += "}";
    str += "#"+selector+" .ba-search-wrapper input::-moz-placeholder {";
    str += getTypographyRule(obj.typography);
    str += "}";
    str += "#"+selector+" .ba-search-wrapper input {";
    str += getTypographyRule(obj.typography);
    str += "height : "+obj.typography['line-height']+"px;";
    str += "}";
    str += "#"+selector+" .ba-search-wrapper {";
    if (obj.border.bottom == 1) {
        str += "border-bottom-width : "+obj.border.width+"px;";
    } else {
        str += "border-bottom-width : 0;";
    }
    str += "border-color : "+getCorrectColor(obj.border.color)+";";
    if (obj.border.left == 1) {
        str += "border-left-width : "+obj.border.width+"px;";
    } else {
        str += "border-left-width : 0;";
    }
    str += "border-radius : "+obj.border.radius+"px;";
    if (obj.border.right == 1) {
        str += "border-right-width : "+obj.border.width+"px;";
    } else {
        str += "border-right-width : 0;";
    }
    str += "border-style : "+obj.border.style+";";
    if (obj.border.top == 1) {
        str += "border-top-width : "+obj.border.width+"px;";
    } else {
        str += "border-top-width : 0;";
    }
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "}";
    if (obj.icons && obj.icons.size) {
        str += "#"+selector+" .ba-search-wrapper i {";
        str += "color: "+getCorrectColor(obj.typography.color)+";";
        str += "font-size : "+obj.icons.size+"px;";
        str += "}";
    }
    str += setBoxModel(obj, selector);
    
    return str;
}

function getButtonRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += "text-align: "+obj.typography['text-align']+";";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}"
    str += "#"+selector+" .ba-button-wrapper a span {";
    str += getTypographyRule(obj.typography);
    str += "}"
    str += "#"+selector+" .ba-button-wrapper a {";
    str += "color : "+getCorrectColor(obj.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.normal['background-color'])+";";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "box-shadow: 0 "+(obj.shadow.value * 10);
    str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "}";
    if (obj.icons && obj.icons.size) {
        str += "#"+selector+" .ba-button-wrapper a i {";
        str += "font-size : "+obj.icons.size+"px;"
        str += "}";
    }
    if (obj.icons && ('position' in obj.icons)) {
        str += "#"+selector+" .ba-button-wrapper a {";
        if (obj.icons.position == '') {
            str += 'flex-direction: row-reverse; -webkit-flex-direction: row-reverse;';
        } else {
            str += 'flex-direction: row; -webkit-flex-direction: row;';
        }
        str += "}";
        if (obj.icons.position == '') {
            str += "#"+selector+" .ba-button-wrapper a i {";
            str += 'margin: 0 10px 0 0;';
            str += "}";
        } else {
            str += "#"+selector+" .ba-button-wrapper a i {";
            str += 'margin: 0 0 0 10px;';
            str += "}";
        }
    }
    str += setBoxModel(obj, selector);
    
    return str;
}

function getBlogPostsRules(obj, selector, type)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-grid-layout .ba-blog-post {";
    str += "width: calc((100% / "+obj.view.count+") - 21px);";
    str += "width: -webkit-calc((100% / "+obj.view.count+") - 21px);";
    str += "}";
    if (obj.view.gutter) {
        str += "#"+selector+" .ba-cover-layout .ba-blog-post {";
        str += "margin-left: 10px;margin-right: 10px;margin-bottom: 30px;";
        str += "width: calc((100% / "+obj.view.count+") - 21px);";
        str += "width: -webkit-calc((100% / "+obj.view.count+") - 21px);";
        str += "}";
        str += "#"+selector+" .ba-cover-layout {margin-left: -10px;margin-right: -10px;}";
    } else {
        str += "#"+selector+" .ba-cover-layout .ba-blog-post {";
        str += "margin: 0;";
        str += "width: calc(100% / "+obj.view.count+");";
        str += "width: -webkit-calc(100% / "+obj.view.count+");";
        str += "}";
        str += "#"+selector+" .ba-cover-layout {margin-left: 0;margin-right: 0;}";
    }
    str += "#"+selector+" .ba-overlay {";
    str += "background-color: "+getCorrectColor(obj.overlay.color)+";";
    str += "}";
    if (obj.background) {
        str += "#"+selector+" .ba-blog-post {";
        str += "background-color:"+getCorrectColor(obj.background.color)+';';
        str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
        str += "border-radius : "+obj.border.radius+"px;";
        str += "box-shadow: 0 "+(obj.shadow.value * 10);
        str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
        str += "}";
    }
    if (obj.image.border) {
        str += "#"+selector+" .ba-blog-post-image {";
        str += "border : "+obj.image.border.width+"px "+obj.image.border.style+" "+getCorrectColor(obj.image.border.color)+";";
        str += "border-radius : "+obj.image.border.radius+"px;";
        str += "}";
    }
    str += "#"+selector+" .ba-blog-post-image {";
    str += "display:"+(obj.view.image ? "block" : "none")+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-title-wrapper {";
    str += "display:"+(obj.view.title ? "block" : "none")+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-date {";
    str += "display:"+(obj.view.date ? "inline-block" : "none")+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-category {";
    str += "display:"+(obj.view.category ? "inline-block" : "none")+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-views {";
    str += "display:"+(obj.view.hits ? "inline-block" : "none")+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-intro-wrapper {";
    str += "display:"+(obj.view.intro ? "block" : "none")+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-button-wrapper {";
    str += "display:"+(obj.view.button ? "block" : "none")+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-image {";
    str += "width :"+obj.image.width+"px;";
    str += "height :"+obj.image.height+"px;";
    str += "}";
    str += "#"+selector+" .ba-cover-layout .ba-blog-post {";
    str += "height :"+obj.image.height+"px;";
    str += "}";
    str += "#"+selector+" .ba-blog-post-title {";
    if (type == 'post-navigation' && obj.title.typography['text-align'] == 'left') {
        str += "text-align :right;";
    } else if (type == 'post-navigation' && obj.title.typography['text-align'] == 'right') {
        str += "text-align :left;";
    } else {
        str += "text-align :"+obj.title.typography['text-align']+";";
    }
    str += "}";
    if (type == 'post-navigation') {
        str += "#"+selector+" i + .ba-blog-post .ba-blog-post-title {";
        str += "text-align :"+obj.title.typography['text-align']+";";
        str += "}";
    }
    str += "#"+selector+" .ba-blog-post-title a {";
    str += getTypographyRule(obj.title.typography, 'text-align');
    for (var ind in obj.title.margin) {
        str += "margin-"+ind+" : "+obj.title.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-blog-post-info-wrapper {";
    for (var ind in obj.info.margin) {
        str += "margin-"+ind+" : "+obj.info.margin[ind]+"px;";
    }
    if (type == 'post-navigation' && obj.info.typography['text-align'] == 'left') {
        str += "text-align :right;";
    } else if (type == 'post-navigation' && obj.info.typography['text-align'] == 'right') {
        str += "text-align :left;";
    } else {
        str += "text-align :"+obj.info.typography['text-align']+";";
    }
    str += "}";
    if (type == 'post-navigation') {
        str += "#"+selector+" i + .ba-blog-post .ba-blog-post-info-wrapper {";
        str += "text-align :"+obj.info.typography['text-align']+";";
        str += "}";
    }
    str += "#"+selector+" .ba-blog-post-info-wrapper > * {";
    str += getTypographyRule(obj.info.typography, 'text-align');
    str += "}";
    str += "#"+selector+" .ba-blog-post-intro-wrapper {";
    str += getTypographyRule(obj.intro.typography, 'text-align');
    for (var ind in obj.intro.margin) {
        str += "margin-"+ind+" : "+obj.intro.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-blog-post-intro-wrapper {";
    if (type == 'post-navigation' && obj.intro.typography['text-align'] == 'left') {
        str += "text-align :right;";
    } else if (type == 'post-navigation' && obj.intro.typography['text-align'] == 'right') {
        str += "text-align :left;";
    } else {
        str += "text-align :"+obj.intro.typography['text-align']+";";
    }
    str += "}";
    if (type == 'post-navigation') {
        str += "#"+selector+" i + .ba-blog-post .ba-blog-post-intro-wrapper {";
        str += "text-align :"+obj.intro.typography['text-align']+";";
        str += "}";
    }
    str += "#"+selector+" .ba-blog-post-button-wrapper {";
    if (type == 'post-navigation' && obj.button.typography['text-align'] == 'left') {
        str += "text-align :right;";
    } else if (type == 'post-navigation' && obj.button.typography['text-align'] == 'right') {
        str += "text-align :left;";
    } else {
        str += "text-align :"+obj.button.typography['text-align']+";";
    }
    str += "}";
    if (type == 'post-navigation') {
        str += "#"+selector+" i + .ba-blog-post .ba-blog-post-button-wrapper {";
        str += "text-align :"+obj.button.typography['text-align']+";";
        str += "}";
    }
    str += "#"+selector+" .ba-blog-post-button-wrapper a {";
    for (var ind in obj.button.margin) {
        str += "margin-"+ind+" : "+obj.button.margin[ind]+"px;";
    }
    str += getTypographyRule(obj.button.typography, 'text-align');
    str += "border : "+obj.button.border.width+"px "+obj.button.border.style+" "+getCorrectColor(obj.button.border.color)+";";
    str += "border-radius : "+obj.button.border.radius+"px;";
    str += "box-shadow: 0 "+(obj.button.shadow.value * 10);
    str += "px "+(obj.button.shadow.value * 20)+"px 0 "+getCorrectColor(obj.button.shadow.color)+";";
    str += "background-color: "+getCorrectColor(obj.button.normal.background)+";";
    str += "color: "+getCorrectColor(obj.button.normal.color)+";";
    for (var ind in obj.button.padding) {
        str += "padding-"+ind+" : "+obj.button.padding[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-blog-post-button-wrapper a:hover {";
    str += "background-color: "+getCorrectColor(obj.button.hover.background)+";";
    str += "color: "+getCorrectColor(obj.button.hover.color)+";";
    str += "}";
    if (obj.pagination) {
        str += "#"+selector+" .ba-blog-posts-pagination span a {";
        str += "color: "+getCorrectColor(obj.pagination.color)+";";
        str += "}";
        str += "#"+selector+" .ba-blog-posts-pagination span.active a,#"+selector;
        str += " .ba-blog-posts-pagination span:hover a {";
        str += "color: "+getCorrectColor(obj.pagination.hover)+";";
        str += "}";
    }
    str += setBoxModel(obj, selector);

    return str;
}

function getPostIntroRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .intro-post-wrapper.fullscreen-post {";
    str += "height :"+obj.image.height+"px;";
    if (obj.image.fullscreen) {
        str += "min-height: 100vh;";
    } else {
        str += "min-height: auto;";
    }
    str += "}"
    str += "#"+selector+" .intro-post-wrapper:not(.fullscreen-post) {";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .fullscreen-post .intro-post-title-wrapper,#"+selector;
    str += " .fullscreen-post .intro-post-info {";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-overlay {background-color:"
    if (!obj.image.type || obj.image.type == 'color') {
        str += getCorrectColor(obj.image.color)+";";
        str += 'background-image: none;';
    } else if (obj.image.type == 'none') {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: none;';
    } else {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: '+obj.image.gradient.effect+'-gradient(';
        if (obj.image.gradient.effect == 'linear') {
            str += obj.image.gradient.angle+'deg';
        } else {
            str += 'circle';
        }
        str += ', '+getCorrectColor(obj.image.gradient.color1)+' ';
        str += obj.image.gradient.position1+'%, '+getCorrectColor(obj.image.gradient.color2);
        str += ' '+obj.image.gradient.position2+'%);';
        str += 'background-attachment: scroll;';
    }
    str += '}';
    str += "#"+selector+" .intro-post-image {";
    str += "height :"+obj.image.height+"px;";
    str += "background-attachment: "+obj.image.attachment+";";
    str += "background-position: "+obj.image.position+";";
    str += "background-repeat: "+obj.image.repeat+";";
    str += "background-size: "+obj.image.size+";";
    if (obj.image.fullscreen) {
        str += "min-height: 100vh;";
    } else {
        str += "min-height: auto;";
    }
    str += "}";
    str += "#"+selector+" .intro-post-title-wrapper {";
    str += "text-align :"+obj.title.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .intro-post-title {";
    str += getTypographyRule(obj.title.typography, 'text-align');
    for (var ind in obj.title.margin) {
        str += "margin-"+ind+" : "+obj.title.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .intro-post-info {";
    str += "text-align :"+obj.info.typography['text-align']+";";
    for (var ind in obj.info.margin) {
        str += "margin-"+ind+" : "+obj.info.margin[ind]+"px;";
    }
    if (typeof(obj.info.show) != 'undefined') {
        str += 'display:'+(obj.info.show ? 'block' : 'none')+';';
    }
    str += "}";
    str += "#"+selector+" .intro-post-info *:not(i) {";
    if (typeof(obj.info.show) != 'undefined') {
        str += 'display:'+(obj.info.show ? 'block' : 'none')+';';
    }
    str += getTypographyRule(obj.info.typography, 'text-align');
    str += "}";
    str += "#"+selector+" .intro-post-image-wrapper {";
    str += 'display:'+(obj.image.show ? 'block' : 'none')+';';
    str += "}";
    str += "#"+selector+" .intro-post-title-wrapper {";
    str += 'display:'+(obj.title.show ? 'block' : 'none')+';';
    str += "}";
    str += "#"+selector+" .intro-post-date {";
    str += 'display:'+(obj.view.date ? 'inline-block' : 'none')+';';
    str += "}";
    str += "#"+selector+" .intro-post-category {";
    str += 'display:'+(obj.view.category ? 'inline-block' : 'none')+';';
    str += "}";
    str += "#"+selector+" .intro-post-views {";
    str += 'display:'+(obj.view.hits ? 'inline-block' : 'none')+';';
    str += "}";
    str += setBoxModel(obj, selector);
    
    return str;
}

function getStarRatingsRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .star-ratings-wrapper {";
    str += "text-align: "+obj.icon['text-align']+";";
    str += "}";
    str += "#"+selector+" .rating-wrapper {";
    str += setItemsVisability(!obj.view.rating, "inline");
    str += "}";
    str += "#"+selector+" .votes-wrapper {";
    str += setItemsVisability(!obj.view.votes, "inline");
    str += "}";
    str += "#"+selector+" .stars-wrapper {";
    str += "color:"+getCorrectColor(obj.icon.color)+";";
    str += "}";
    str += "#"+selector+" .star-ratings-wrapper i {";
    str += "font-size:"+obj.icon.size+"px;";
    str += "}";
    str += "#"+selector+" .star-ratings-wrapper i.active,#"+selector+" .star-ratings-wrapper i.active + i:after";
    str += ",#"+selector+" .stars-wrapper:hover i {";
    str += "color:"+getCorrectColor(obj.icon.hover)+";";
    str += "}";
    str += "#"+selector+" .info-wrapper * {";
    str += getTypographyRule(obj.info, 'text-align');
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getIconRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += "text-align: "+obj.icon['text-align']+";";
    if (obj.inline) {
        str += setItemsVisability(obj.disable, "inline-block");
        str += "margin : 0 10px;";
        str += "width: auto;";
    } else {
        str += setItemsVisability(obj.disable, "block");
        str += "margin : 0;";
    }
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}"
    str += "#"+selector+" .ba-icon-wrapper i {";
    str += "width : "+obj.icon.size+"px;";
    str += "height : "+obj.icon.size+"px;";
    str += "font-size : "+obj.icon.size+"px;";
    str += "color : "+getCorrectColor(obj.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.normal['background-color'])+";";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    if (obj.shadow) {
        str += "box-shadow: 0 "+(obj.shadow.value * 10);
        str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
    }
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "}";
    str += setBoxModel(obj, selector);
    
    return str;
}

function getRecentSliderRules(obj, selector)
{
    var str = "#"+selector+" {",
        margin = obj.gutter ? 30 : 0;
    margin = margin * (obj.slideset.count - 1);
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    if (obj.overflow) {
        str += "#"+selector+" .slideshow-content {";
        str += "width: calc(100% + (100% / "+obj.slideset.count+") * 2);";
        str += "width: -webkit-calc(100% + (100% / "+obj.slideset.count+") * 2);";
        str += "margin-left: calc((100% / "+obj.slideset.count+") * -1);";
        str += "margin-left: -webkit-calc((100% / "+obj.slideset.count+") * -1);";
        str += "min-height: "+obj.view.height+"px;";
        str += "}";
    } else {
        str += "#"+selector+" .slideshow-content {";
        str += "width: 100%;";
        str += "margin-left: auto;";
        str += "min-height: "+obj.view.height+"px;";
        str += "}";
    }
    str += "#"+selector+" li {"
    str += "width: calc((100% - "+margin+"px) / "+obj.slideset.count+");";
    str += "width: -webkit-calc((100% - "+margin+"px) / "+obj.slideset.count+");";
    str += "}";
    str += "#"+selector+" ul:not(.slideset-loaded) li {";
    str += "position: relative; float:left;";
    str += "}";
    str += "#"+selector+" ul:not(.slideset-loaded) li.item.active:not(:first-child) {";
    str += "margin-left: "+(obj.gutter ? 30 : 0)+"px;";
    str += "}";
    str += "#"+selector+" .ba-slideshow-img {";
    str += "background-size :"+obj.view.size+";";
    str += "height:"+obj.view.height+"px;";
    str += "}";
    str += "#"+selector+" .ba-slideshow-caption > * {";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-slideshow-caption {background-color :";
    if (!obj.overlay.type || obj.overlay.type == 'color') {
        str += getCorrectColor(obj.overlay.color)+";";
        str += 'background-image: none;';
    } else if (obj.overlay.type == 'none') {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: none;';
    } else {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: '+obj.overlay.gradient.effect+'-gradient(';
        if (obj.overlay.gradient.effect == 'linear') {
            str += obj.overlay.gradient.angle+'deg';
        } else {
            str += 'circle';
        }
        str += ', '+getCorrectColor(obj.overlay.gradient.color1)+' ';
        str += obj.overlay.gradient.position1+'%, '+getCorrectColor(obj.overlay.gradient.color2);
        str += ' '+obj.overlay.gradient.position2+'%);';
        str += 'background-attachment: scroll;';
    }
    str += "}";
    str += "#"+selector+" .ba-blog-post-title {";
    str += getTypographyRule(obj.title.typography);
    for (var ind in obj.title.margin) {
        str += "margin-"+ind+" : "+obj.title.margin[ind]+"px;";
    }
    str += 'display:'+(obj.view.title ? 'block' : 'none')+';';
    str += "}";
    str += "#"+selector+" .ba-blog-post-title:hover {";
    str += "color: "+getCorrectColor(obj.title.hover.color)+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-info-wrapper {";
    str += "text-align :"+obj.info.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-info-wrapper span {";
    str += getTypographyRule(obj.info.typography, 'text-align');
    for (var ind in obj.info.margin) {
        str += "margin-"+ind+" : "+obj.info.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-blog-post-info-wrapper span.ba-blog-post-date {";
    str += 'display:'+(obj.view.date ? 'inline-block' : 'none')+';';
    str += "}";
    str += "#"+selector+" .ba-blog-post-info-wrapper span.ba-blog-post-category {";
    str += 'display:'+(obj.view.category ? 'inline-block' : 'none')+';';
    str += "}";
    str += "#"+selector+" .ba-blog-post-info-wrapper span.ba-blog-post-category:hover {";
    str += "color: "+getCorrectColor(obj.info.hover.color)+";";
    str += "}";
    str += "#"+selector+" .slideshow-button {";
    str += "text-align :"+obj.button.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-intro-wrapper {";
    str += getTypographyRule(obj.intro.typography);
    for (var ind in obj.intro.margin) {
        str += "margin-"+ind+" : "+obj.intro.margin[ind]+"px;";
    }
    str += 'display:'+(obj.view.intro ? 'block' : 'none')+';'
    str += "}";
    str += "#"+selector+" .ba-blog-post-button-wrapper {";
    str += "text-align :"+obj.button.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .ba-blog-post-button-wrapper a {";
    for (var ind in obj.button.margin) {
        str += "margin-"+ind+" : "+obj.button.margin[ind]+"px;";
    }
    str += 'display:'+(obj.view.button ? 'inline-block' : 'none')+';';
    str += getTypographyRule(obj.button.typography, 'text-align');
    str += "border : "+obj.button.border.width+"px "+obj.button.border.style+" "+getCorrectColor(obj.button.border.color)+";";
    str += "border-radius : "+obj.button.border.radius+"px;";
    str += "box-shadow: 0 "+(obj.button.shadow.value * 10);
    str += "px "+(obj.button.shadow.value * 20)+"px 0 "+getCorrectColor(obj.button.shadow.color)+";";
    str += "background-color: "+getCorrectColor(obj.button.normal.background)+";";
    str += "color: "+getCorrectColor(obj.button.normal.color)+";";
    for (var ind in obj.button.padding) {
        str += "padding-"+ind+" : "+obj.button.padding[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .ba-blog-post-button-wrapper a:hover {";
    str += "background-color: "+getCorrectColor(obj.button.hover.background)+";";
    str += "color: "+getCorrectColor(obj.button.hover.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideset-nav {";
    str += setItemsVisability(!obj.view.arrows, "block");
    str += "}";
    str += "#"+selector+" .ba-slideset-nav a {";
    str += "font-size: "+obj.arrows.size+"px;";
    str += "width: "+obj.arrows.size+"px;";
    str += "height: "+obj.arrows.size+"px;";
    str += "background-color: "+getCorrectColor(obj.arrows.normal.background)+";";
    str += "color: "+getCorrectColor(obj.arrows.normal.color)+";";
    str += "padding : "+obj.arrows.padding+"px;";
    str += "box-shadow: 0 "+(obj.arrows.shadow.value * 10);
    str += "px "+(obj.arrows.shadow.value * 20)+"px 0 "+getCorrectColor(obj.arrows.shadow.color)+";";
    str += "border : "+obj.arrows.border.width+"px "+obj.arrows.border.style+" "+getCorrectColor(obj.arrows.border.color)+";";
    str += "border-radius : "+obj.arrows.border.radius+"px;";
    str += "}";
    str += "#"+selector+" .ba-slideset-nav a:hover {";
    str += "background-color: "+getCorrectColor(obj.arrows.hover.background)+";";
    str += "color: "+getCorrectColor(obj.arrows.hover.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideset-dots {";
    str += setItemsVisability(!obj.view.dots, "flex;display: -webkit-flex;");
    str += "}";
    str += "#"+selector+" .ba-slideset-dots > div {";
    str += "font-size: "+obj.dots.size+"px;";
    str += "width: "+obj.dots.size+"px;";
    str += "height: "+obj.dots.size+"px;";
    str += "color: "+getCorrectColor(obj.dots.normal.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideset-dots > div:hover,#"+selector+" .ba-slideset-dots > div.active {";
    str += "color: "+getCorrectColor(obj.dots.hover.color)+";";
    str += "}";
    str += setBoxModel(obj, selector);
    
    return str;
}

function getCarouselRules(obj, selector)
{
    var str = "#"+selector+" {",
        margin = obj.gutter ? 30 : 0;
    margin = margin * (obj.slideset.count - 1);
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    if (obj.overflow) {
        str += "#"+selector+" .slideshow-content {";
        str += "width: calc(100% + (100% / "+obj.slideset.count+") * 2);";
        str += "width: -webkit-calc(100% + (100% / "+obj.slideset.count+") * 2);";
        str += "margin-left: calc((100% / "+obj.slideset.count+") * -1);";
        str += "margin-left: -webkit-calc((100% / "+obj.slideset.count+") * -1);";
        str += "min-height: "+obj.view.height+"px;";
        str += "}";
    } else {
        str += "#"+selector+" .slideshow-content {";
        str += "width: 100%;";
        str += "margin-left: auto;";
        str += "min-height: "+obj.view.height+"px;";
        str += "}";
    }
    str += "#"+selector+" li {"
    str += "width: calc((100% - "+margin+"px) / "+obj.slideset.count+");";
    str += "width: -webkit-calc((100% - "+margin+"px) / "+obj.slideset.count+");";
    str += "}";
    str += "#"+selector+" ul:not(.slideset-loaded) li {";
    str += "position: relative; float:left;";
    str += "}";
    str += "#"+selector+" ul:not(.slideset-loaded) li.item.active:not(:first-child) {";
    str += "margin-left: "+(obj.gutter ? 30 : 0)+"px;";
    str += "}";
    for (var ind in obj.slides) {
        if (obj.slides[ind].image) {
            str += "#"+selector+" li.item:nth-child("+ind+") .ba-slideshow-img {background-image: url(";
            if (obj.slides[ind].image.indexOf('balbooa.com') != -1) {
                str += obj.slides[ind].image+");";
            } else {
                str += JUri+encodeURI(obj.slides[ind].image)+");";
            }
            str += "}"; 
        }
    }
    str += "#"+selector+" .ba-slideshow-img {";
    str += "background-size :"+obj.view.size+";";
    str += "height:"+obj.view.height+"px;";
    str += "}";
    str += "#"+selector+" .ba-slideshow-caption {background-color :";
    if (!obj.overlay.type || obj.overlay.type == 'color') {
        str += getCorrectColor(obj.overlay.color)+";";
        str += 'background-image: none;';
    } else if (obj.overlay.type == 'none') {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: none;';
    } else {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: '+obj.overlay.gradient.effect+'-gradient(';
        if (obj.overlay.gradient.effect == 'linear') {
            str += obj.overlay.gradient.angle+'deg';
        } else {
            str += 'circle';
        }
        str += ', '+getCorrectColor(obj.overlay.gradient.color1)+' ';
        str += obj.overlay.gradient.position1+'%, '+getCorrectColor(obj.overlay.gradient.color2);
        str += ' '+obj.overlay.gradient.position2+'%);';
        str += 'background-attachment: scroll;';
    }
    str += "}";
    str += "#"+selector+" .slideshow-title-wrapper {";
    str += "text-align :"+obj.title.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .ba-slideshow-title {";
    str += getTypographyRule(obj.title.typography, 'text-align');
    for (var ind in obj.title.margin) {
        str += "margin-"+ind+" : "+obj.title.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .slideshow-description-wrapper {";
    str += "text-align :"+obj.description.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .ba-slideshow-description {";
    str += getTypographyRule(obj.description.typography, 'text-align');
    for (var ind in obj.description.margin) {
        str += "margin-"+ind+" : "+obj.description.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .slideshow-button {";
    str += "text-align :"+obj.button.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .slideshow-button:not(.empty-content) a {";
    for (var ind in obj.button.margin) {
        str += "margin-"+ind+" : "+obj.button.margin[ind]+"px;";
    }
    str += getTypographyRule(obj.button.typography, 'text-align');
    str += "border : "+obj.button.border.width+"px "+obj.button.border.style+" "+getCorrectColor(obj.button.border.color)+";";
    str += "border-radius : "+obj.button.border.radius+"px;";
    str += "box-shadow: 0 "+(obj.button.shadow.value * 10);
    str += "px "+(obj.button.shadow.value * 20)+"px 0 "+getCorrectColor(obj.button.shadow.color)+";";
    str += "background-color: "+getCorrectColor(obj.button.normal.background)+";";
    str += "color: "+getCorrectColor(obj.button.normal.color)+";";
    for (var ind in obj.button.padding) {
        str += "padding-"+ind+" : "+obj.button.padding[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .slideshow-button a:hover {";
    str += "background-color: "+getCorrectColor(obj.button.hover.background)+";";
    str += "color: "+getCorrectColor(obj.button.hover.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideset-nav {";
    str += setItemsVisability(!obj.view.arrows, "block");
    str += "}";
    str += "#"+selector+" .ba-slideset-nav a {";
    str += "font-size: "+obj.arrows.size+"px;";
    str += "width: "+obj.arrows.size+"px;";
    str += "height: "+obj.arrows.size+"px;";
    str += "background-color: "+getCorrectColor(obj.arrows.normal.background)+";";
    str += "color: "+getCorrectColor(obj.arrows.normal.color)+";";
    str += "padding : "+obj.arrows.padding+"px;";
    str += "box-shadow: 0 "+(obj.arrows.shadow.value * 10);
    str += "px "+(obj.arrows.shadow.value * 20)+"px 0 "+getCorrectColor(obj.arrows.shadow.color)+";";
    str += "border : "+obj.arrows.border.width+"px "+obj.arrows.border.style+" "+getCorrectColor(obj.arrows.border.color)+";";
    str += "border-radius : "+obj.arrows.border.radius+"px;";
    str += "}";
    str += "#"+selector+" .ba-slideset-nav a:hover {";
    str += "background-color: "+getCorrectColor(obj.arrows.hover.background)+";";
    str += "color: "+getCorrectColor(obj.arrows.hover.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideset-dots {";
    str += setItemsVisability(!obj.view.dots, "flex;display: -webkit-flex;");
    str += "}";
    str += "#"+selector+" .ba-slideset-dots > div {";
    str += "font-size: "+obj.dots.size+"px;";
    str += "width: "+obj.dots.size+"px;";
    str += "height: "+obj.dots.size+"px;";
    str += "color: "+getCorrectColor(obj.dots.normal.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideset-dots > div:hover,#"+selector+" .ba-slideset-dots > div.active {";
    str += "color: "+getCorrectColor(obj.dots.hover.color)+";";
    str += "}";
    str += setBoxModel(obj, selector);
    
    return str;
}

function getSlideshowRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    for (var ind in obj.slides) {
        if (obj.slides[ind].image) {
            str += "#"+selector+" li.item:nth-child("+ind+") .ba-slideshow-img {background-image: url(";
            if (obj.slides[ind].image.indexOf('balbooa.com') != -1) {
                str += obj.slides[ind].image+");";
            } else {
                str += JUri+encodeURI(obj.slides[ind].image)+");";
            }
            str += obj.slides[ind].image+");";
            str += "}"; 
        }
    }
    str += "#"+selector+" .slideshow-wrapper {";
    if (obj.view.fullscreen) {
        str += "min-height: 100vh;";
    } else {
        str += "min-height: auto;";
    }
    str += "height:"+obj.view.height+"px;";
    str += "}";
    str += "#"+selector+" .ba-slideshow-img {";
    str += "background-size :"+obj.view.size+";";
    str += "}";
    str += "#"+selector+" .ba-overlay {background-color:";
    if (!obj.overlay.type || obj.overlay.type == 'color') {
        str += getCorrectColor(obj.overlay.color)+";";
        str += 'background-image: none;';
    } else if (obj.overlay.type == 'none') {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: none;';
    } else {
        str += 'rgba(0, 0, 0, 0);';
        str += 'background-image: '+obj.overlay.gradient.effect+'-gradient(';
        if (obj.overlay.gradient.effect == 'linear') {
            str += obj.overlay.gradient.angle+'deg';
        } else {
            str += 'circle';
        }
        str += ', '+getCorrectColor(obj.overlay.gradient.color1)+' ';
        str += obj.overlay.gradient.position1+'%, '+getCorrectColor(obj.overlay.gradient.color2);
        str += ' '+obj.overlay.gradient.position2+'%);';
        str += 'background-attachment: scroll;';
    }
    str += "}";
    str += "#"+selector+" .slideshow-title-wrapper {";
    str += "text-align :"+obj.title.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .ba-slideshow-title {";
    str += "animation-duration :"+obj.title.animation.duration+"s;";
    str += getTypographyRule(obj.title.typography, 'text-align');
    str += "}";
    str += "#"+selector+" .slideshow-description-wrapper {";
    str += "text-align :"+obj.description.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .ba-slideshow-description {";
    str += "animation-duration :"+obj.description.animation.duration+"s;";
    str += getTypographyRule(obj.description.typography, 'text-align');
    for (var ind in obj.description.margin) {
        str += "margin-"+ind+" : "+obj.description.margin[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .slideshow-button {";
    str += "text-align :"+obj.button.typography['text-align']+";";
    str += "}";
    str += "#"+selector+" .slideshow-button:not(.empty-content) a {";
    str += "animation-duration :"+obj.button.animation.duration+"s;";
    for (var ind in obj.button.margin) {
        str += "margin-"+ind+" : "+obj.button.margin[ind]+"px;";
    }
    str += getTypographyRule(obj.button.typography, 'text-align');
    str += "border : "+obj.button.border.width+"px "+obj.button.border.style+" "+getCorrectColor(obj.button.border.color)+";";
    str += "border-radius : "+obj.button.border.radius+"px;";
    str += "box-shadow: 0 "+(obj.button.shadow.value * 10);
    str += "px "+(obj.button.shadow.value * 20)+"px 0 "+getCorrectColor(obj.button.shadow.color)+";";
    str += "background-color: "+getCorrectColor(obj.button.normal.background)+";";
    str += "color: "+getCorrectColor(obj.button.normal.color)+";";
    for (var ind in obj.button.padding) {
        str += "padding-"+ind+" : "+obj.button.padding[ind]+"px;";
    }
    str += "}";
    str += "#"+selector+" .slideshow-button a:hover {";
    str += "background-color: "+getCorrectColor(obj.button.hover.background)+";";
    str += "color: "+getCorrectColor(obj.button.hover.color)+";";
    str += "}";
    
    str += "#"+selector+" .ba-slideshow-nav {";
    str += setItemsVisability(!obj.view.arrows, "block");
    str += "}";
    str += "#"+selector+" .ba-slideshow-nav a {";
    str += "font-size: "+obj.arrows.size+"px;";
    str += "width: "+obj.arrows.size+"px;";
    str += "height: "+obj.arrows.size+"px;";
    str += "background-color: "+getCorrectColor(obj.arrows.normal.background)+";";
    str += "color: "+getCorrectColor(obj.arrows.normal.color)+";";
    str += "padding : "+obj.arrows.padding+"px;";
    str += "box-shadow: 0 "+(obj.arrows.shadow.value * 10);
    str += "px "+(obj.arrows.shadow.value * 20)+"px 0 "+getCorrectColor(obj.arrows.shadow.color)+";";
    str += "border : "+obj.arrows.border.width+"px "+obj.arrows.border.style+" "+getCorrectColor(obj.arrows.border.color)+";";
    str += "border-radius : "+obj.arrows.border.radius+"px;";
    str += "}";
    str += "#"+selector+" .ba-slideshow-nav a:hover {";
    str += "background-color: "+getCorrectColor(obj.arrows.hover.background)+";";
    str += "color: "+getCorrectColor(obj.arrows.hover.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideshow-dots {";
    str += setItemsVisability(!obj.view.dots, "flex;display: -webkit-flex;");
    str += "}";
    str += "#"+selector+" .ba-slideshow-dots > div {";
    str += "font-size: "+obj.dots.size+"px;";
    str += "width: "+obj.dots.size+"px;";
    str += "height: "+obj.dots.size+"px;";
    str += "color: "+getCorrectColor(obj.dots.normal.color)+";";
    str += "}";
    str += "#"+selector+" .ba-slideshow-dots > div:hover,#"+selector+" .ba-slideshow-dots > div.active {";
    str += "color: "+getCorrectColor(obj.dots.hover.color)+";";
    str += "}";
    str += setBoxModel(obj, selector);
    
    return str;
}

function getVideoRules(obj, selector)
{
    var str = "#"+selector+" .ba-video-wrapper {";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "box-shadow: 0 "+(obj.shadow.value * 10);
    str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
    str += "padding-bottom: calc(56.24% - "+obj.border.width+"px);";
    str += "}";
    str += "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += 'margin-'+ind+": "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getImageRules(obj, selector)
{
    var str = "#"+selector+" img {";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "box-shadow: 0 "+(obj.shadow.value * 10);
    str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
    str += "width: "+obj.style.width+"px;}";
    str += "#"+selector+" .ba-image-wrapper {";
    str += "text-align: "+obj.style.align+";}";
    str += "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += 'margin-'+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getScrollTopRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    if (obj.icons.align) {
        str += "text-align : "+obj.icons.align+";";
    }
    str += "}";
    str += "#"+selector+" i.ba-btn-transition {";
    for (var ind in obj.padding) {
        str += "padding-"+ind+" : "+obj.padding[ind]+"px;";
    }
    str += "box-shadow: 0 "+(obj.shadow.value * 10);
    str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
    str += "border : "+obj.border.width+"px "+obj.border.style+" "+getCorrectColor(obj.border.color)+";";
    str += "border-radius : "+obj.border.radius+"px;";
    str += "font-size : "+obj.icons.size+"px;";
    str += "width : "+obj.icons.size+"px;";
    str += "height : "+obj.icons.size+"px;";
    str += "color : "+getCorrectColor(obj.normal.color)+";";
    str += "background-color : "+getCorrectColor(obj.normal['background-color'])+";";
    str += "}";
    str += setBoxModel(obj, selector);

    return str;
}

function getLogoRules(obj, selector)
{
    var str = "#"+selector+" {";
    str += setItemsVisability(obj.disable, "block");
    for (var ind in obj.margin) {
        str += "margin-"+ind+" : "+obj.margin[ind]+"px;";
    }
    str += "text-align: "+obj['text-align']+";";
    str += "}";
    str += "#"+selector+" img {";
    str += "width: "+obj.width+"px;}";
    str += setBoxModel(obj, selector);

    return str;
}

function getMapRules(obj, selector)
{
    var str = "#"+selector+" {";
    for (var key in obj) {
        switch (key) {
            case 'disable' :
                str += setItemsVisability(obj.disable, "block");
                break;
            case 'margin' :
                for (var ind in obj[key]) {
                    str += key+'-'+ind+" : "+obj[key][ind]+"px;";
                }
                break;
            case 'shadow' : 
                str += "box-shadow: 0 "+(obj.shadow.value * 10);
                str += "px "+(obj.shadow.value * 20)+"px 0 "+getCorrectColor(obj.shadow.color)+";";
                break;
        }
    }
    str += "}";
    str += "#"+selector+" .ba-map-wrapper {";
    str += "height: "+obj.height+"px;}";
    str += setBoxModel(obj, selector);

    return str;
}

app.sectionRules();