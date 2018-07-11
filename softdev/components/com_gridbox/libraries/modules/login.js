/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.login = function(){
    setTimeout(function(){
        $g('#login-modal').modal();
    }, 50);
}

$g('.ba-username, .ba-password').on('keyup', function(event){
    if (event.keyCode == 13 && $g('.ba-password').val() != '') {
        $g('.login-button').trigger('click');
    }
});

function uploadPageBlock(blocks, plugins)
{
    if (blocks.length > 0) {
        var XHR = new XMLHttpRequest(),
            block = blocks.shift();
        XHR.onreadystatechange = function(e) {
            if (XHR.readyState == 4) {
                var n = app.notification.find('.installed-page-block-count').text();
                app.notification.find('.installed-page-block-count').text(++n);
                $g('.ba-page-block-item[data-id="'+block.title+'"]').removeClass('disabled');
                uploadPageBlock(blocks, plugins)
            }
        };
        XHR.open("POST", 'index.php?option=com_gridbox&task=editor.getBlocksLicense', true);
        XHR.send(JSON.stringify(block));
    } else {
        $g('.ba-page-block-item.disabled').removeClass('disabled');
        uploadPlugins(plugins);
        app.showNotice(gridboxLanguage['BLOCKS_INSTALLED']);
    }
}

function uploadPlugins(plugins)
{
    $g.ajax({
        type:"POST",
        dataType:'text',
        url: 'index.php?option=com_gridbox&task=editor.getPluginLicense',
        data : {
            data : JSON.stringify(plugins)
        },
        complete: function(msg){
            $g('#add-plugin-dialog .ba-plugin.disable-plugin').removeClass('disable-plugin');
            $g('.login-button')[0].dataset.clicked = 'disabled';
        }
    });
}

$g('.login-button').on('click', function(event){
    event.preventDefault();
    if (this.dataset.clicked == 'disabled') {
    	return false;
    }
    this.dataset.clicked = 'disabled';
    var task = "getPluginLicense",
        url = 'https://www.balbooa.com/demo/index.php?',
        $this = this;
    if (this.dataset.type != 'plugins') {
        task = "getBlocksLicense";
    }
    url += 'option=com_baupdater&task=gridbox.'+task;
    url += '&login='+window.btoa($g('.ba-username').val().trim());
    url += '&password='+window.btoa($g('.ba-password').val().trim());
    var script = document.createElement('script');
    script.src = url;
    script.onload = function(){
        if (typeof(gridboxResponse) == 'string') {
            app.showNotice(gridboxLanguage[gridboxResponse], 'ba-alert');
            $this.dataset.clicked = 'disabled';
        } else {
        	$g('#login-modal').modal('hide');
            var str = '<span>'+gridboxLanguage['INSTALLING'];
            if ($this.dataset.type != 'plugins') {
                var blocks = new Array();
                for (var key in gridboxResponse.blocks) {
                    for (var ind in gridboxResponse.blocks[key]) {
                        gridboxResponse.blocks[key][ind].type = key;
                        blocks.push(gridboxResponse.blocks[key][ind]);
                    }
                }
                str += ' <span class="installed-page-block-count">0</span> / '+blocks.length;
                str +='</span><img src="'+JUri+'components/com_gridbox/assets/images/reload.svg"></img>';
                app.notification.find('p').html(str);
                app.notification.removeClass('animation-out').addClass('notification-in');
                uploadPageBlock(blocks, gridboxResponse.plugins);
            } else {
                str += '</span><img src="'+JUri+'components/com_gridbox/assets/images/reload.svg"></img>';
                app.notification.find('p').html(str);
                app.notification.removeClass('animation-out').addClass('notification-in');
                uploadPlugins(gridboxResponse)
                app.showNotice(gridboxLanguage['PLUGIN_INSTALLED']);
            }
        }
    }
    document.head.appendChild(script);
})

app.modules.login = true;
app.login();