<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

?>
<div class="ba-editor-wrapper">
<?php
if (!empty($this->jce) && $this->jce * 1 === 1) {
    echo $this->form->getInput('editor');
?>
    <script type="text/javascript">
        var app = {
                setContent : function(data){
                    WFEditor.setContent('editor', data);
                },
                getContent : function(){
                    var data = WFEditor.getContent('editor');

                    return data;
                }
            }
    </script>
<?php
} else {
?>
    <textarea id="editor"></textarea>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo JURI::root(); ?>components/com_gridbox/assets/js/ba-text-editor.js"></script>
<?php
}
?>
</div>