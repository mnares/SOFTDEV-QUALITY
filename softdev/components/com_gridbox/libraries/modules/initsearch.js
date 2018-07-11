/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.initsearch = function(obj, key){
    var overlay = document.querySelector('.ba-search-result-modal[data-id="'+key+'"]'),
        title = overlay.querySelector('.search-result-title');
    if (document.querySelector('#'+key+' .ba-search-result-modal[data-id="'+key+'"]')) {
        document.body.appendChild(overlay);
    }
    if (overlay && title && title.localName == 'h5') {
        $g(title).replaceWith('<h6 class="search-result-title">'+title.textContent.trim()+'</h6>');
    }
    document.querySelector('#'+key+' .ba-search-wrapper input').addEventListener('keyup', function(event){
        if (event.keyCode == 13 && this.value.trim()) {
            openSearchModal(overlay);
        }
    });
    document.querySelector('.ba-search-result-modal[data-id="'+key+'"] > .zmdi-close').addEventListener('click', function(){
        var $this = this;
        document.querySelector('#'+key+' .ba-search-wrapper input').value = '';
        this.parentNode.classList.add('search-modal-out');
        setTimeout(function(){
            $this.parentNode.classList.remove('visible-section');
            $this.parentNode.classList.remove('search-modal-out');
            document.body.classList.remove('search-open');
            document.body.style.width = '';
        }, 300);
    });
    initItems();
}

function getSearchResult(search, start, app, limit, $this, maximum)
{
    $g.ajax({
        type:"POST",
        dataType:'text',
        url:"index.php?option=com_gridbox&task=editor.getSearchResult",
        data:{
            search : search,
            start : start,
            app : app,
            maximum : maximum,
            limit : limit
        },
        complete: function(msg){
            $this.scrollTop = 0;
            var div = document.createElement('div'),
                empty = null;
            div.innerHTML = msg.responseText;
            empty = div.querySelector('.empty-list');
            $g($this).find('.search-result-title, .ba-search-result-body h6').remove();
            $g($this).find('.ba-blog-posts-pagination-wrapper').remove();
            $g($this).find('.ba-search-result-body').prepend($g(div).find('.search-result-title'));
            $g($this).find('.ba-blog-posts-wrapper').html($g(div).find('.ba-blog-post'))
                .after($g(div).find('.ba-blog-posts-pagination-wrapper'));
            if (empty) {
                $g($this).find('.ba-blog-posts-wrapper').html(empty);
            }
            $this.querySelector('.ba-search-result-body').classList.remove('search-started');
            initSearchPagination($this, search, app, limit, maximum);
        }
    });
}

function initSearchPagination($this, search, app, limit, maximum)
{
    $g($this).find('.ba-blog-posts-pagination a').on('click', function(event){
        event.preventDefault();
        if (!this.parentNode.classList.contains('disabled') && !this.parentNode.classList.contains('active')) {
            $this.querySelector('.ba-search-result-body').classList.add('search-started');
            getSearchResult(search, this.dataset.page - 1, app, limit, $this, maximum);
        }
    });
}

function openSearchModal($this)
{
    if (themeData.page.view != 'gridbox') {
        var search = document.querySelector('#'+$this.dataset.id+' .ba-search-wrapper input').value,
            id = $this.querySelector('.ba-item-search-result').id;
        $this.querySelector('.ba-search-result-body').classList.add('search-started');
        $g($this).find('.search-result-title').remove();
        $g($this).find('.ba-blog-posts-pagination-wrapper').remove();
        $g($this).find('.ba-blog-posts-wrapper').empty();
        getSearchResult(search, 0, app.items[id].app, app.items[id].limit, $this, app.items[id].maximum);
    }
    var width = window.innerWidth - document.documentElement.clientWidth;
    document.body.style.width = 'calc(100% - '+width+'px)';
    $this.classList.add('visible-section');
    document.body.classList.add('search-open');
}

app.initsearch(app.modules.initsearch.data, app.modules.initsearch.selector);