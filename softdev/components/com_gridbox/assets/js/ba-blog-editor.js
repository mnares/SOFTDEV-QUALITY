/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var $g = jQuery,
    delay = '',
    itemsInit = new Array(),
    app = {
        blogEditor : true,
        view : 'desktop',
        modules : {},
        loading : {},
        edit : {},
        checkModule : function(module, obj){
            if (typeof(obj) != 'undefined') {
                app.modules[module] = obj;
            }
            if (typeof(app[module]) == 'undefined' && !app.loading[module]) {
                app.loading[module] = true;
                app.loadModule(module);
            } else if (typeof(app[module]) != 'undefined') {
                if (typeof(obj) != 'undefined') {
                    app[module](obj.data, obj.selector);
                } else {
                    app[module]();
                }
            }
        },
        loadModule : function(module){
            if (module == 'themeRules' || module == 'sectionRules') {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = JUri+'components/com_gridbox/libraries/modules/'+module+'.js';
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
    app.checkModule('gridboxEditorLoaded');
});