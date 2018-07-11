document.addEventListener("DOMContentLoaded", function(){
    var $g = jQuery;

    function loadPage(url)
    {
        url += ' #workspace-wrapper > div';
        $g('#workspace-wrapper').load(url, paginationAction);
    }

    function callback()
    {
        var url = window.location.href;
        loadPage(url);
    }

    function empty()
    {
        
    }

    function paginationAction()
    {
        $g('.pagination-list a').on('click', function(event){
            event.preventDefault();
            if (!$g(this).parent().hasClass('disabled') && !$g(this).parent().hasClass('active')) {
                setCookie('start', this.dataset.page, callback, true);
            }
        });
    }

    function setCookie(key, value, callback, async)
    {
        $g.ajax({
            type:"POST",
            async : async,
            dataType:'text',
            url:"index.php?option=com_gridbox&task=pages.setCookie",
            data : {
                key : "pages_"+key,
                value : value
            },
            complete: callback
        });
    }
    
    $g('input[data-pages]').on('customChange', function(){
        var key = this.dataset.pages,
            value = this.value;
        if (key != 'ordering' && key != 'direction') {
            setCookie('start', 0, empty, true);
        }
        setCookie(key, value, callback, true);
    });

    $g('.ba-custom-select > i, div.ba-custom-select input').on('click', function(event){
        event.stopPropagation();
        var $this = $g(this),
            parent = $this.parent();
        $g('.visible-select').removeClass('visible-select');
        parent.find('ul').addClass('visible-select');
        parent.find('li').off('click').one('click', function(){
            var text = $g.trim($g(this).text()),
                val = $g(this).attr('data-value');
            parent.find('input[type="text"]').val(text).attr('size', text.length);
            parent.find('input[type="hidden"]').val(val).trigger('change');
            parent.trigger('customAction');
        });
        parent.trigger('show');
        setTimeout(function(){
            $g('body').one('click', function(){
                $g('.visible-select').parent().trigger('customHide');
                $g('.visible-select').removeClass('visible-select');
            });
        }, 50);
    });

    $g('div.ba-custom-select').on('show', function(){
        var $this = $g(this),
            ul = $this.find('ul'),
            value = $this.find('input[type="hidden"]').val();
        ul.find('i').remove();
        ul.find('.selected').removeClass('selected');
        ul.find('li[data-value="'+value+'"]').addClass('selected').prepend('<i class="zmdi zmdi-check"></i>');
    }).on('customAction', function(){
        $g(this).find('[data-pages]').trigger('customChange');
    });

    $g('input[data-pages="search"]').on('keyup', function(){
        if (event.keyCode == 13) {
            $g(this).trigger('customChange');
        }
    });

    $g('.ba-folder-tree a').on('click', function(event){
        event.preventDefault();
        var url = this.href;
        window.history.pushState(null, null, url);
        $g('.ba-folder-tree li.active').removeClass('active');
        $g(this).parent().addClass('active');
        setCookie('start', 0, empty, false);
        loadPage(url);
    });

    $g('.ba-folder-tree i.zmdi-chevron-right').on('mousedown', function(){
        if ($g(this).parent().hasClass('visible-branch')) {
            $g(this).parent().removeClass('visible-branch');
        } else {
            $g(this).parent().addClass('visible-branch');
        }
    });

    $g('.media-fullscrean').on('click', function(){
        var wind = window.parent.document.getElementById('pages-list-modal');
        if (!$g(wind).hasClass('fullscrean')) {
            $g(wind).addClass('fullscrean');
            $g(this).removeClass('zmdi-fullscreen').addClass('zmdi-fullscreen-exit');
        } else {
            $g(wind).removeClass('fullscrean');
            $g(this).addClass('zmdi-fullscreen').removeClass('zmdi-fullscreen-exit');
        }        
    });

    $g('.close-media').on('click', function(){
        var wind = window.parent.document.getElementById('pages-list-modal');
        $g(wind).find('[data-dismiss="modal"]').trigger('click');
    });

    paginationAction();
});