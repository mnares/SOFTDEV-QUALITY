/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.messageListener = function(){
	switch (uploadMode) {
        case 'fonts':
            var font = app.messageData.font.split(' '),
                callback = fontBtn.dataset.callback,
                subgroup = fontBtn.dataset.subgroup,
                group = fontBtn.dataset.group;
            if (!app.messageData.custom) {
                addFontLink(font);
            } else {
                addFontStyle(app.messageData);
            }
            fontBtn.value = font[0].replace(new RegExp('\\+','g'), ' ')+' '+font[1].replace('i', 'italic');
            if (!subgroup) {
                app.edit.desktop[group]['font-family'] = font[0];
                app.edit.desktop[group]['font-weight'] = font[1];
                app.edit.desktop[group]['custom'] = app.messageData.custom;
            } else {
                app.edit.desktop[group][subgroup]['font-family'] = font[0];
                app.edit.desktop[group][subgroup]['font-weight'] = font[1];
                app.edit.desktop[group][subgroup]['custom'] = app.messageData.custom;
            }
            $g('#fonts-editor-dialog').modal('hide');
            setTimeout(function(){
                app[callback]();
            }, 300);
            app.addHistory();
            break;
        case 'addNewSlides' : 
            var array = app.messageData,
                index = 1;
            for (var ind in app.edit.desktop.slides) {
                index++;
            }
            for (var i = 0; i < array.length; i++) {
                var obj = {
                        image : 'images'+array[i].path,
                        index : index++,
                        type : 'image',
                        video : null,
                        title : '',
                        description :'',
                        button : {
                            href : '#',
                            type : 'ba-btn-transition',
                            title : '',
                            target : '_blank'
                        }
                    },
                    str = getSlideHtml(obj),
                    dots = app.editor.document.querySelector('#'+app.editor.app.edit+' .ba-slideshow-dots'),
                    div = app.editor.document.querySelector('#'+app.editor.app.edit+' .slideshow-content');
                $g(div).append(str);
                str = '<div data-ba-slide-to="'+(obj.index - 1)+'" class="zmdi zmdi-circle"></div>';
                $g(dots).append(str);
                sortingList.push(obj);
                app.edit['desktop'].slides[obj.index] = {
                    image : obj.image,
                    type : obj.type,
                    link : "",
                    video : obj.video
                }
                $g('#slideshow-settings-dialog .sorting-container').append(addSlideSortingList(obj, sortingList.length - 1));
            }
            var object = {
                data : app.edit,
                selector : app.editor.app.edit
            }
            app.sectionRules();
            app.editor.app.checkModule('initItems', object);
            app.addHistory();
            $g('#uploader-modal').modal('hide');
            break;
        case 'addSimpleImages' :
            var array = app.messageData;
            for (var i = 0; i < array.length; i++) {
                var str = '<div class="ba-instagram-image" style="background-image: url(';
                str += 'images'+array[i].path+')"><img src="images'+array[i].path;
                str += '" data-src="images'+array[i].path+'"></div>';
                app.editor.$g(app.selector+' .instagram-wrapper .empty-list').before(str);
            }
            var images = app.editor.document.querySelectorAll('#'+app.editor.app.edit+' .ba-instagram-image img');
            sortingList = [];
            $g('#item-settings-dialog .sorting-container').html('');
            for (var i = 0; i < images.length; i++) {
                sortingList.push(images[i].dataset.src);
                $g('#item-settings-dialog .sorting-container').append(addSimpleSortingList(sortingList[i], i));
            }
            app.addHistory();
            $g('#uploader-modal').modal('hide');
            break;
        case 'reselectSimpleImage':
            var children = app.editor.document.querySelector('#'+app.editor.app.edit+' .instagram-wrapper').children,
                image = children[app.itemDelete].querySelector('img'),
                img = 'images'+app.messageData.path;
            children[app.itemDelete].style.backgroundImage = 'url('+img+')';
            image.src = img;
            image.dataset.src = img;
            sortingList[app.itemDelete] = img;
            $g('#item-settings-dialog .sorting-container').html('');
            sortingList.forEach(function(el, ind){
                $g('#item-settings-dialog .sorting-container').append(addSimpleSortingList(sortingList[ind], ind));
            });
            app.addHistory();
            $g('#uploader-modal').modal('hide');
            break;
        case 'selectFile' :
            var img = 'images'+app.messageData.path;
            $g(fontBtn).val(img).trigger('input');
            $g('#uploader-modal').modal('hide');
            break;
        case 'slideImage' :
            var img = 'images'+app.messageData.path;
            $g('#uploader-modal').modal('hide');
            fontBtn.value = img;
            $g(fontBtn).trigger('input');
            break;
        case 'reselectLibraryImage':
            var obj = {
                    id: app.itemDelete,
                    image: 'images'+app.messageData.path
                };
            $g('.camera-container[data-id="'+obj.id+'"]').parent().css('background-image', 'url('+obj.image+')')
            $g.ajax({
                type: "POST",
                dataType: 'text',
                url: "index.php?option=com_gridbox&task=editor.setLibraryImage",
                data:{
                    object: JSON.stringify(obj)
                },
                complete: function(msg){
                    
                }
            });
            $g('#uploader-modal').modal('hide');
            break;
        case 'itemSimpleGallery' :
            var array = app.messageData,
                obj = {
                    data : 'simple-gallery',
                    selector : new Array()
                }
            for (var i = 0; i < array.length; i++) {
                obj.selector.push('images'+array[i].path)
            }
            app.editor.app.checkModule('loadPlugin' , obj);
            $g('#uploader-modal').modal('hide');
            break;
        case 'itemSlideshow' :
        case 'itemSlideset' :
        case 'itemCarousel' :
            var array = app.messageData,
                obj = {
                    data : uploadMode.replace('item', '').toLowerCase(),
                    selector : new Array()
                }
            for (var i = 0; i < array.length; i++) {
                obj.selector.push('images'+array[i].path)
            }
            app.editor.app.checkModule('loadPlugin' , obj);
            $g('#uploader-modal').modal('hide');
            break;
        case 'itemImage' :
            var obj = {
                    data : 'image',
                    selector : 'images'+app.messageData.path,
                }
            app.editor.app.checkModule('loadPlugin' , obj);
            $g('#uploader-modal').modal('hide');
            break;
        case 'itemLogo' :
            var obj = {
                    data : 'logo',
                    selector : 'images'+app.messageData.path,
                }
            app.editor.app.checkModule('loadPlugin' , obj);
            $g('#uploader-modal').modal('hide');
            break;
        case 'reselectSocialIcon':
            fontBtn.value = app.messageData.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '')
            fontBtn.dataset.icon = app.messageData;
            $g(fontBtn).trigger('change');
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'addSocialIcon':
            var obj = {
                    "icon" : app.messageData,
                    "title": app.messageData.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', ''),
                    "link" : {
                        "link" : "",
                        "target" : "_blank"
                    }
                },
                i = 0;
            for (var ind in app.edit.icons) {
                i++;
            }
            app.edit.icons[i] = obj;
            getSocialIconsHtml(app.edit.icons);
            sortingList.push(app.edit.icons[i]);
            $g('#social-icons-settings-dialog .sorting-container').append(addSortingList(app.edit.icons[i], i));
            $g('#icon-upload-dialog').modal('hide');
            app.addHistory();
            break;
        case 'itemIcon' :
            var obj = {
                    data : 'icon',
                    selector : app.messageData,
                };
            app.editor.app.checkModule('loadPlugin' , obj);
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'scrolltopIcon' :
            var i = app.editor.document.getElementById(app.editor.app.edit),
                classList;
            i = i.querySelector('i.ba-btn-transition');
            classList = app.edit.icon;
            $g(i).removeClass(classList);
            classList = app.messageData;
            $g(i).addClass(classList);
            app.edit.icon = app.messageData;
            fontBtn.value = classList.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '');
            app.addHistory();
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'smoothScrollingIcon' :
            var item = app.editor.document.querySelector('#'+app.editor.app.edit+' a'),
                i = item.querySelector('a i');
            if (i) {
                i.className = app.messageData;
            } else {
                i = document.createElement('i');
                i.className = app.messageData;
                item.appendChild(i);
            }
            app.edit.icon = app.messageData;
            fontBtn.value = app.messageData.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '');
            app.addHistory();
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'selectItemIcon' :
            fontBtn.value = app.messageData.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '');
            fontBtn.dataset.value = app.messageData;
            $g(fontBtn).trigger('input');
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'reselectIcon' :
            var i = app.editor.document.getElementById(app.editor.app.edit),
                classList;
            i = i.querySelector('.ba-icon-wrapper i');
            classList = i.dataset.icon;
            $g(i).removeClass(classList);
            classList = app.messageData;
            $g(i).addClass(classList);
            i.dataset.icon = app.messageData;
            fontBtn.value = classList.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '');
            app.addHistory();
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'addSearchIcon':
            var item = app.editor.document.getElementById(app.editor.app.edit),
                classList,
                i = item.querySelector('.ba-search-wrapper i');
            if (i) {
                classList = i.className;
                $g(i).removeClass(classList);
                classList = app.messageData;
                $g(i).addClass(classList);
            } else {
                i = document.createElement('i');
                i.className = app.messageData;
                item = item.querySelector('.ba-search-wrapper');
                item.appendChild(i);
            }
            app.edit.icon.icon = app.messageData;
            fontBtn.value = app.messageData.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '');
            app.addHistory();
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'addButtonIcon' :
            var item = app.editor.document.getElementById(app.editor.app.edit),
                classList,
                i = item.querySelector('a i');
            if (i) {
                classList = i.className;
                $g(i).removeClass(classList);
                classList = app.messageData;
                $g(i).addClass(classList);
            } else {
                i = document.createElement('i');
                i.className = app.messageData;
                item = item.querySelector('a');
                item.appendChild(i);
            }
            fontBtn.value = app.messageData.replace('zmdi zmdi-', '').replace('fa fa-', '').replace('flaticon-', '');
            app.addHistory();
            $g('#icon-upload-dialog').modal('hide');
            break;
        case 'selectMarker' :
            fontBtn.value = 'images'+app.messageData.path;
            $g(fontBtn).trigger('input change')
            $g('#uploader-modal').modal('hide');
        case 'selectStarRatingsImage' :
            fontBtn.value = 'images'+app.messageData.path;
            $g(fontBtn).trigger('input');
            $g('#uploader-modal').modal('hide');
            break;
        case 'reselectImage' :
            var img = app.editor.document.getElementById(app.editor.app.edit);
            app.edit.image = 'images'+app.messageData.path;
            img = img.querySelector('img');
            img.src = app.messageData.url;
            fontBtn.value = app.edit.image;
            app.addHistory();
            $g('#uploader-modal').modal('hide');
            break;
        case 'image':
            var group = fontBtn.dataset.group,
                option = fontBtn.dataset.option,
                action  = fontBtn.dataset.action;
            setValue('images'+app.messageData.path, 'background', 'image', 'image');
            if (app.edit.type) {
                setValue('images'+app.messageData.path, 'image', 'image');
            }
            app.edit[app.view].background.type = 'image';
            app[action]();
            fontBtn.value = 'images'+app.messageData.path;
            $g('#uploader-modal').modal('hide');
            app.addHistory();
            break;
        case 'ckeImage':
            var url = app.messageData.url;
            $g('.cke-upload-image').val(url);
            $g('#add-cke-image').addClass('active-button');
            $g('#uploader-modal').modal('hide');
            break;
        case 'introImage':
            var img = 'images'+app.messageData.path,
                meta = app.editor.document.querySelector('meta[property="og:image"]'),
                intro = app.editor.document.querySelector('.ba-item-post-intro .intro-post-image');
            if (intro) {
                intro.style.backgroundImage = 'url('+img+')';
            }
            $g("#blog-content-dialog .img-thumbnail").css('background-image', 'url('+img+')');
            $g('.intro-image').val(img);
            $g('#uploader-modal').modal('hide');
            meta.content = $g('#juri-root').val()+img;
            break;
        case 'videoSource':
            var file = 'images'+app.messageData.path,
                ext = file.split('.');
            ext = ext[ext.length - 1];
            if (ext == 'mp4') {
                fontBtn.value = file;
                $g(fontBtn).trigger('change');
            } else {
                app.showNotice(gridboxLanguage['NOT_SUPPORTED_FILE'], 'ba-alert');
            }
            $g('#uploader-modal').modal('hide');
            break;
        case 'favicon' :
            var img = 'images'+app.messageData.path,
                ext = img.split('.');
            ext = ext[ext.length - 1];
            if (ext == 'ico') {
                $g('input.favicon').val(img);
            } else {
                app.showNotice($g('input.favicon-error').val(), 'ba-alert');
            }
            $g('#uploader-modal').modal('hide');
            break;
        case 'LibraryImage':
            $g('.library-item-image').val('images'+app.messageData.path);
            $g('#uploader-modal').modal('hide');
            break;
    }
}

app.modules.messageListener = true;
app.messageListener();