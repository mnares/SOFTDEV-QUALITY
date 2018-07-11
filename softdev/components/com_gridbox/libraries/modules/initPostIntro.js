/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.initPostIntro = function(obj, key){
    if (document.body.classList.contains('gridbox')) {
        var item = document.getElementById(key),
            published = window.parent.document.getElementById('published_on'),
            settingsDialog = window.parent.document.getElementById('settings-dialog'),
            introImage = window.parent.document.querySelector('#settings-dialog .intro-image'),
            title = item.querySelector('.intro-post-title'),
            introTitle = window.parent.document.querySelector('#settings-dialog .page-title'),
            keyupDelay = null,
            month = new Array('January', 'February','March', 'April', 'May', 'June', 'July',
                'August', 'September', 'October', 'November', 'December');
        item.querySelector('.intro-post-image-wrapper .camera-container').addEventListener('mousedown', function(event){
            event.preventDefault();
            event.stopPropagation();
            window.parent.uploadMode = 'introImage';
            window.parent.checkIframe(window.parent.$g('#uploader-modal').attr('data-check', 'single'), 'uploader');
        });
        title.addEventListener('keydown', function(event){
            if (event.keyCode == 13) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            }
        });
        title.addEventListener('keyup', function(event){
            clearTimeout(keyupDelay);
            keyupDelay = setTimeout(function(){
                introTitle.value = title.textContent.trim();
                var button = window.parent.document.querySelector('.gridbox-save');
                if (!title.textContent.trim()) {
                    button.classList.add('disabled-button');
                    button.dataset.action = 'clicked';
                } else {
                    button.classList.remove('disabled-button');
                    button.dataset.action = 'enabled';
                }
            }, 300);
        });
        window.parent.$g(settingsDialog).on('hide', function(){
            title.textContent = introTitle.value;
            if (introImage.value) {
                item.querySelector('.intro-post-image').style.backgroundImage = 'url('+introImage.value+')';
            }
            var date = new Date(published.value.replace(/ /g, 'T')),
                str = date.getDate()+' '+month[date.getMonth()]+' '+date.getFullYear();
            item.querySelector('.intro-post-date').textContent = str;
        });
    }
    initItems();
}

app.initPostIntro(app.modules.initPostIntro.data, app.modules.initPostIntro.selector);