/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
var $g = jQuery,
    uploadMode = '',
    delay = '',
    app = {
        view : 'desktop',
        itemDelete : null,
        messageData : '',
        modules : {},
        loading : {},
        actionStack : new Array(),
        checkModule : function(module){
            if (!app.modules[module] && !app.loading[module]) {
                app.loading[module] = true;
                app.loadModule(module);
            } else if (app.modules[module]) {
                app[module]();
            }
        },
        loadModule : function(module){
            if (module == 'helper') {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = JUri+'components/com_gridbox/libraries/modules/helper.js';
                document.getElementsByTagName('head')[0].appendChild(script);
                return false;
            }
            $g.ajax({
                type:"POST",
                dataType:'text',
                url:"index.php?option=com_gridbox&task=editor.loadModule",
                data:{
                    module : module
                },
                complete: function(msg){
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    document.getElementsByTagName('head')[0].appendChild(script);
                    script.innerHTML = msg.responseText;
                }
            });
        }
    };

document.addEventListener("DOMContentLoaded", function(){
    app.checkModule('editorLoaded');
});