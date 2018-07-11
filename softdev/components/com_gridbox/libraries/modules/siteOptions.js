/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.siteOptions = function(){
    if (app.editor.disableResponsive) {
        $g('#mobile-options .ba-options-group').last().hide().prev().hide();
    } else {
        $g('#mobile-options .ba-options-group').last().css('display', '').prev().css('display', '');
    }
    setTimeout(function(){
        $g("#site-dialog").modal();
    }, 150);
}

$g('.date-format-select').on('customAction', function(){
    var value = this.querySelector('input[type="hidden"]').value,
        custom = document.querySelector('.ba-custom-date-format');
    custom.querySelector('input[type="text"]').value = value;
    if (!value) {
        custom.style.display = '';
    } else {
        custom.style.display = 'none';
    }
});
$g('.website-container').on('input', function(){
    var $this = this;
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.editor.app.checkModule('sectionRules');
        app.editor.app.checkModule('themeRules');
        app.editor.app.checkModule('siteRules');
    }, 300);
});
$g('.breakpoints-container input[data-breakpoint]').on('input', function(){
    var $this = this;
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.editor.breakpoints[$this.dataset.breakpoint] = $this.value * 1;
        document.querySelector('.responsive-context-menu [data-view="'+$this.dataset.breakpoint+'"]').dataset.width = $this.value;
        app.editor.app.checkModule('sectionRules');
        app.editor.app.checkModule('themeRules');
        app.editor.app.checkModule('siteRules');
        if (app.view == $this.dataset.breakpoint) {
            document.querySelector('.editor-iframe').style.width = $this.value+'px';
        }
    }, 300);
});
$g('.menu-breakpoint').on('input', function(){
    var $this = this;
    clearTimeout(delay);
    delay = setTimeout(function(){
        app.editor.menuBreakpoint = $this.value * 1;
        app.editor.app.checkModule('sectionRules');
        app.editor.app.checkModule('themeRules');
        app.editor.app.checkModule('siteRules');
    }, 300);
});
$g('.disable-responsive').on('change', function(){
    var $this = $g('.responsive-context-menu span[data-view="desktop"]'),
        className = $this.find('i')[0].className,
        text = $this.find('span').text().trim(),
        button = $g('div[data-context="responsive-context-menu"]');
    button.find('i').first()[0].className = className;
    button.find('span').text(text);
    $g('body').removeClass(app.view).addClass('desktop');
    app.view = 'desktop';
    $g('.editor-iframe').css('width', '100%');
    app.editor.disableResponsive = this.checked;
    app.editor.app.checkModule('sectionRules');
    app.editor.app.checkModule('themeRules');
    app.editor.app.checkModule('siteRules');
    if (app.editor.disableResponsive) {
        $g('.ba-toolbar-element[data-context="responsive-context-menu"]').addClass('disable-button');
        $g('#mobile-options .ba-options-group').last().hide().prev().hide();
    } else {
        $g('#mobile-options .ba-options-group').last().css('display', '').prev().css('display', '');
        $g('.ba-toolbar-element[data-context="responsive-context-menu"]').removeClass('disable-button');
    }
});

app.siteOptions();
app.modules.siteOptions = true;