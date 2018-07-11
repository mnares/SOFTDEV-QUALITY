/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

app.initaccordion = function(obj, key){
    $g('#'+key+' .accordion').on('click', '.accordion-toggle', function(e){
        var $this = this;
        if (this.dataset.clicked != 'true') {
            this.dataset.clicked = true;
            setTimeout(function(){
                $this.dataset.clicked = false;
            }, 500);
            if (this.classList.contains('active')) {
                this.classList.remove('active');
            } else {
                $g(this).closest('.accordion').find('> .accordion-group > .accordion-heading .active').removeClass('active');
                this.classList.add('active');
                $g(this.hash).find('.ba-item-slideshow, .ba-item-slideset, .ba-item-carousel, .ba-item-map').each(function(){
                    var object = {
                        data : app.items[this.id],
                        selector : this.id
                    };
                    app.checkModule('initItems', object);
                });
            }
        }
    });
    initItems();
}

app.initaccordion(app.modules.initaccordion.data, app.modules.initaccordion.selector);