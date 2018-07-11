/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.initfacebookcomments = function(obj){
    jQuery('#fb-jssdk').remove();
    delete(window.FB);
    var comments = '<div class="fb-comments" data-numposts="'+obj.options.limit,
        url = window.location.href.replace(window.location.hash, '');
    comments += '" data-width="100%"></div>';
    jQuery('#fb-root').replaceWith('<div id="fb-root" data-href="'+url+'"></div>');
    jQuery('.fb-comments').replaceWith(comments);
    if (obj.app_id) {
        var js = document.createElement('script');
        js.id = 'fb-jssdk';
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId='+obj.app_id+'&autoLogAppEvents=1';
        document.head.appendChild(js);
    } else {
        jQuery('.fb-comments').addClass('empty-content');
    }
    initItems();
}

app.initfacebookcomments(app.modules.initfacebookcomments.data);