/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

!function ($) {
    var instagram = function (element, options) {
        this.parent = $(element);
        this.options = options;
        this.url = 'https://api.instagram.com/v1';
        this.accessToken = this.options.accessToken;
    }
    instagram.prototype = {
        init : function(){
            this.getRecentMedia();
        },
        getRecentMedia: function() {
            if (!this.accessToken) {
                this.display(null);
            } else {
                if (themeData.page.view != 'gridbox') {
                    this.getSavedMedia();
                    return false;
                }
                var userID = this.accessToken.split('.'),
                    $this = this,
                    data = null,
                    url = 'https://api.instagram.com/v1/users/'+userID[0]+'/media/recent?access_token='+this.accessToken;
                $.ajax({
                    type: "GET",
                    dataType: "jsonp",
                    cache: false,
                    url: url
                }).done(function(results) {
                    if (results.data) {
                        data = results.data;
                        $this.images = new Array();
                    }
                    $this.display(data);
                });
            }
        },
        getSavedMedia:function(){
            var id = this.parent.closest('.ba-item-instagram').attr('id'),
                $this = this;
            $g.ajax({
                type:"POST",
                data:{
                    id: id
                },
                dataType:'text',
                url:"index.php?option=com_gridbox&task=editor.getsavedInstagramMedia",
                complete: function(msg){
                    $this.images = JSON.parse(msg.responseText);
                }
            });
        },
        display: function(data){
            this.parent.find('.ba-instagram-image').remove();
            if (data) {
                var str = '',
                    max = this.options.max < data.length ? this.options.max : data.length;
                for (var i = 0; i < max; i++) {
                    this.images[i] = data[i];
                    if (data[i].comments.count > 0) {
                        this.getComments(data[i].id, i);
                    } else {
                        this.images[i].comments.data = new Array();
                    }
                    str += '<div class="ba-instagram-image" style="background-image: url('+
                        data[i].images.standard_resolution.url+');" data-key="'+i+'"><img src="'+
                        data[i].images.standard_resolution.url+'"><a href="'+data[i].link+
                        '" target="_blank"></a><div class="ba-instagram-caption">'+
                        '<div class="instagram-icons-wrapper"><span><i class="zmdi zmdi-favorite"></i>'+
                        data[i].likes.count+'</span><span><i class="zmdi zmdi-comment-text-alt"></i>'+
                        data[i].comments.count+'</span></div></div></div>';
                }
                this.parent.prepend(str);
            }
        },
        getComments: function(id, ind){
            var $this = this,
                url = 'https://api.instagram.com/v1/media/'+id+'/comments?access_token='+this.accessToken;
                $.ajax({
                    type: "GET",
                    dataType: "jsonp",
                    cache: false,
                    url: url
                }).done(function(results) {
                    if (results.data) {
                        $this.images[ind].comments.data = results.data;
                    }
                });
        }
    }

    $.fn.instagram = function(option) {
        return this.each(function (){
            var $this = $(this),
                data = $this.data('instagram'),
                options = $.extend({}, $.fn.instagram.defaults, typeof option == 'object' && option);
            if (data) {
                $this.removeData();
            }
            $this.data('instagram', (data = new instagram(this, options)));
            data.init();
        });
    }
    
    $.fn.instagram.defaults = {
        accessToken: '',
        max: 10
    }
}(window.$g ? window.$g : window.jQuery);