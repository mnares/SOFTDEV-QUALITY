function trimTrailingSlash(string)
{
  return string.replace(/\/+$/, '');
}
if (!String.prototype.trim) {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, '');
  };
}
ctrHref = trimTrailingSlash('http://www.casino10top.com/'.trim());

eInDoc = function(e) {
  while (e=e.parentNode) {
   if (e==document) {
      return true;
    }
   }
   return false;
};
lCheck = function(l) {
  if (null != l && null != l.getAttribute('href') && (ctrHref === '' || trimTrailingSlash(l.getAttribute('href').trim()) == ctrHref)) {
    return true;
  }
  else {
    return false;
  }
};

linkfound = false;
els = document.getElementsByTagName('a');
l = els.length;
for (i = 0; i < l; i++) {
   el = els[i];
   if (trimTrailingSlash(el.href) === ctrHref) {
    linkfound = true;
    if(el.getAttribute('rel')=='nofollow' || !eInDoc(el) || !lCheck(el)) {
      linkfound = false;
    }
    linktext = el.innerHTML;
    if(linktext == undefined) {
      linkfound = false;
    }
    else if(linktext.trim() == '') {
      linkfound = false;
    }
    if(el.offsetHeight != undefined && el.offsetHeight < 8) {
      linkfound = false;
    }
    break;
  }
}
if(linkfound) {
  linkToHide = el;
  linkToHide.innerHTML = '';
}