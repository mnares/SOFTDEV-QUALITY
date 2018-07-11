/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.openPageSettings = function(){
    setTimeout(function(){
        $g("#settings-dialog").modal();
    }, 150);
}

$g("#settings-dialog").on('hide', function(){
    var metaTags = $g('select.meta_tags option'),
        str = '';
    if (metaTags.length > 0) {
        metaTags.each(function(){
            str += '<a href="#" class="ba-btn-transition"><span>'+this.textContent+'</span></a>';
        });
        var items = app.editor.document.querySelectorAll('.ba-item-post-tags .ba-button-wrapper');
        for (var i = 0; i < items.length; i++) {
            items[i].innerHTML = str;
        }
    }
});

$g("#settings-dialog").on('shown', function(){
    $g('.alert-backdrop').addClass('active');
}).on('hide', function(){
    $g('.alert-backdrop').removeClass('active');
});

$g('div.alert-backdrop, #settings-dialog .modal-header-icon i').on('mousedown', function(event){
    event.preventDefault();
    event.stopPropagation();
    var title = $g('.page-title').val();
    title = $g.trim(title);
    if (title) {
        $g("#settings-dialog").modal('hide');
        $g('.alert-backdrop').removeClass('active');
    }
});

$g('.page-title').on('input', function(){
    var $this = $g(this),
        title = $this.val();
    title = $g.trim(title);
    if (!title) {
        $g('#settings-dialog i.zmdi-check').addClass('disabled-button');
        $this.parent().find('.ba-alert-container').show();
    } else {
        $g('#settings-dialog i.zmdi-check').removeClass('disabled-button');
        $this.parent().find('.ba-alert-container').hide();
    }
});

$g('.reset-page-intro-image').on('click', function(){
    $g('input.intro-image').val('');
});

if (!app.editor.themeData.edit_type) {
    var func = function(){
        setupCalendar('published_on', 'calendar-button');
        setupCalendar('published_down', 'calendar-end-button');
    }

    if (!app.modules.calendar) {
        if (!app.actionStack['calendar']) {
            app.actionStack['calendar'] = new Array();
        }
        app.actionStack['calendar'].push(func);
        app.loadModule('calendar');
    } else if (app.modules.calendar) {
        func();
    }

    $g('.select-intro-image').on('mousedown', function(event){
        event.preventDefault();
        uploadMode = 'introImage';
        checkIframe($g('#uploader-modal').attr('data-check', 'single'), 'uploader');
    });

    $g('.meta-tags .picked-tags .search-tag input').on('keydown', function(event){
        var title = $g(this).val().trim().toLowerCase();
        $g('ul.all-tags').css({
            'left': this.parentNode.offsetLeft
        });
        if (event.keyCode == 13) {
            if (!title) {
                this.value = '';
                return false;
            }
            var str = '<li class="tags-chosen"><span>',
                tagId = 'new$'+title;
            $g('.all-tags li').each(function(){
                var search = $g(this).text().trim().toLowerCase();
                if (title == search) {
                    this.classList.add('selected-tag');
                    tagId = this.dataset.id;
                    return false;
                }
            });
            if ($g('.picked-tags .tags-chosen i[data-remove="'+tagId+'"]').length > 0) {
                return false;
            }
            str += title+'</span><i class="zmdi zmdi-close" data-remove="'+tagId+'"></i></li>';
            $g('.picked-tags .search-tag').before(str);
            str = '<option value="'+tagId+'" selected>'+title+'</option>';
            $g('select.meta_tags').append(str);
            $g(this).val('');
            $g('.all-tags li').hide();
            event.stopPropagation();
            event.preventDefault();
            return false;
        } else {
            $g('.all-tags li').each(function(){
                var search = $g(this).text().trim().toLowerCase();
                if (search.indexOf(title) < 0 || title == '') {
                    $g(this).hide();
                } else {
                    $g(this).show();
                }
            });
        }
    });

    $g('.all-tags').on('click', 'li', function(){
        if (this.classList.contains('selected-tag')) {
            return false;
        }
        var title = $g(this).text().trim(),
            tagId = this.dataset.id;
        var str = '<li class="tags-chosen"><span>';
        str += title+'</span><i class="zmdi zmdi-close" data-remove="'+tagId+'"></i></li>';
        $g('.picked-tags .search-tag').before(str);
        str = '<option value="'+tagId+'" selected>'+title+'</option>';
        $g('select.meta_tags').append(str);
        $g('.meta-tags .picked-tags .search-tag input').val('');
        $g('.all-tags li').hide();
        this.classList.add('selected-tag');
    });

    $g('.meta-tags .picked-tags').on('click', '.zmdi.zmdi-close', function(){
        var del = this.dataset.remove;
        $g('select.meta_tags option[value="'+del+'"]').remove();
        $g(this).closest('li').remove();
        $g('.all-tags li[data-id="'+del+'"]').removeClass('selected-tag');
        $g('.all-tags li').hide();
    });
}

app.openPageSettings();
app.modules.openPageSettings = true;