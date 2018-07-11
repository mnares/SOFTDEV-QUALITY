/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

function createRules(obj)
{
    var str = "";
    app.itemType = null
    for (var key in obj) {
        if (key == 'padding') {
            str += "body {";
            for (var ind in obj[key]) {
                str += key+'-'+ind+" : "+obj[key][ind]+"px;";
            }
            str += "}";
            str += ".page-layout {left: calc(100% + "+(obj[key].right + 1);
            str += "px); left: -webkit-calc(100% + "+(obj[key].right + 1)+"px);}";
        } else if (key == 'links') {
            str += "body a {";
            str += "color : "+getCorrectColor(obj[key].color)+";";
            str += "}";
            str += "body a:hover {";
            str += "color : "+getCorrectColor(obj[key]['hover-color'])+";";
            str += "}";
        } else if (key != 'background' && key != 'overlay' && key != 'shadow') {
            str += ""+key;
            if (key == 'body') {
                str += ' , ul, ol, table, blockquote';
            }
            str += " {";
            str += getTypographyRule(obj[key]);
            str += "}";
        }
    }
    str += 'blockquote { border-color:'+getCorrectColor('@primary')+'; ';
    str += 'background-color: '+getCorrectColor('@bg-secondary')+';';
    str += '}';
    str += app.backgroundRule(obj, 'body');
    return str;
};

app.themeRules = function(){
    var str = createRules(app.theme.desktop);
    str += app.setMediaRules(app.theme, key, 'createRules');
    if (app.theme.desktop.background.type != 'video') {
        $g('body > .ba-video-background').remove();
    }
    this.style.text(str);
};
app.themeRules();