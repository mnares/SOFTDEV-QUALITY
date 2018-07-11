/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

var ckeImage = '',
    $g = jQuery,
    CKE = CKEDITOR.replace('editor'),
    ckeImageModal = window.parent.document.getElementById('cke-image-modal'),
    app = {
        setContent : function(data){
            CKE.setData(data);
        },
        getContent : function(){
            var data = CKE.getData();

            return data;
        }
    };

function addImage(obj)
{
    var doc = $g('.ba-editor-wrapper iframe')[0].contentDocument,
        img = '';
    if (obj.width) {
        obj.width += 'px';
    }
    if (obj.height) {
        obj.height += 'px';
    }
    if (ckeImage) {
        ckeImage.src = obj.url;
        ckeImage.alt = $g.trim(obj.alt);
        ckeImage.style.width = obj.width;
        ckeImage.style.height = obj.height;
        ckeImage.style.float = obj.align;
    } else {
        img = document.createElement('img');
        img.src = obj.url;
        img.alt = $g.trim(obj.alt);
        img.style.width = obj.width;
        img.style.height = obj.height;
        img.style.float = obj.align;
        if (doc.getSelection().rangeCount > 0) {
            var range = doc.getSelection().getRangeAt(0);
            range.insertNode(img);
        } else {
            var data = CKE.getData();
            data += img.outerHTML;
            CKE.setData(data);
        }
    }
}

function getCSSrulesString()
{
    var str = 'body.cke_editable';
    str += ' {font-family: sans-serif, Arial, Verdana, "Trebuchet MS";}';
    str += ' body.cke_editable img {max-width: 100%;}';
    str += 'a { text-decoration: none; } :focus { outline: none; }';
    return str;
}

ckeImageModal = $g(ckeImageModal);

$g('.ba-custom-select > i, div.ba-custom-select input').on('click', function(event){
    event.stopPropagation()
    var $this = $g(this),
        parent = $this.parent();
    $g('.visible-select').removeClass('visible-select');
    parent.find('ul').addClass('visible-select');
    parent.find('li').off('click').one('click', function(){
        var text = $g.trim($g(this).text()),
            val = $g(this).attr('data-value');
        parent.find('input[type="text"]').val(text);
        parent.find('input[type="hidden"]').val(val).trigger('change');
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
});
if ($g('html').attr('dir') == 'rtl') {
    CKEDITOR.config.contentsLangDirection = 'rtl';
}
CKE.setUiColor('#fafafa');
CKE.config.allowedContent = true;
CKEDITOR.dtd.$removeEmpty.span = 0;
CKEDITOR.dtd.$removeEmpty.i = 0;
CKE.config.toolbar_Basic =
[
    { name: 'document',    items : [ 'Source' ] },
    { name: 'styles',      items : [ 'Styles','Format' ] },
    { name: 'colors',      items : [ 'TextColor' ] },
    { name: 'clipboard',   items : [ 'Undo','Redo' ] },            
    { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
    { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent',
                                    'Indent','-','Blockquote','-','JustifyLeft',
                                    'JustifyCenter','JustifyRight','JustifyBlock','-' ] },
    { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
    { name: 'insert',      items : [ 'myImage','Table','HorizontalRule'] }
];
CKE.config.toolbar = 'Basic';
CKEDITOR.config.removePlugins = 'image';
CKE.addCommand("imgComand", {
    exec: function(edt) {
        var align = src = w = h = alt = label = '',
            selected = CKE.getSelection().getSelectedElement()
        if (selected && selected.$.localName == 'img') {
            ckeImage = selected.$;
            src = ckeImage.src;
            alt = ckeImage.alt;
            w = ckeImage.style.width.replace('px', '');
            h = ckeImage.style.height.replace('px', '');
            align = ckeImage.style.float;
            label = ckeImageModal.find('.cke-image-select li[data-value="'+align+'"]').text();
            label = $g.trim(label);
        } else {
            ckeImage = '';
        }
        ckeImageModal.find('.cke-upload-image').val(src);
        ckeImageModal.find('.cke-image-alt').val(alt);
        ckeImageModal.find('.cke-image-width').val(w);
        ckeImageModal.find('.cke-image-height').val(h);
        ckeImageModal.find('#cke-image-align').val(align);
        ckeImageModal.find('.cke-image-align').val(label);
        window.parent.app.checkModule('ckeImage');
    }
});
CKE.ui.addButton('myImage', {
    label: "Image",
    command: 'imgComand',
    toolbar: 'insert',
    icon: 'image'
});

var font = '//fonts.googleapis.com/css?family=Roboto:400';
CKEDITOR.config.contentsCss = [getCSSrulesString(), font];