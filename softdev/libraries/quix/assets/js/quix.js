jQuery(function(t){"use strict";if(t(".qx-image--lightbox").length>0&&t(".qx-image--lightbox").magnificPopup({type:"image",removalDelay:500,mainClass:"mfp-fade",zoom:{enabled:!0,duration:500,opener:function(t){return t.find("img")}}}),function(){var i=t(".qx-section--stretch");if(i.length){var e=0,n=0,o=jQuery("html").attr("dir");window.onload=window.onresize=function(){i.attr("style",""),n=jQuery(window).width(),e=i.offset().left,i.css({position:"relative",width:n}),"rtl"===o?i.css({marginRight:e}):i.css({marginLeft:-e})}}}(),t(window).load(function(){if(t(".qx-fg-items").length){var i=t(".qx-fg-items");i.isotope({itemSelector:".qx-fg-item",layoutMode:"fitRows",percentPosition:!0});var e=t(".qx-fg-filter>li>a");e.on("click",function(){e.removeClass("active"),t(this).addClass("active");var n=t(this).attr("data-filter");return i.isotope({filter:n}),!1})}}),t("#confetti").length>0){var i=75,e=[[76,175,80],[33,150,243],[219,56,83],[244,67,54],[255,193,7]],n=2*Math.PI,o=document.getElementById("confetti"),r=o.getContext("2d"),s=0,a=0,h=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||function(t){window.setTimeout(t,1e3/60)}}(),u=function(t,i,e){return t<i||t>e?0:Math.abs(t===i?1:(t-e)/(i-e))},c=function(t,i,e){var n,o=!1;t=t[0]||t;var r=function(t){n=t,s()},s=function(){o||(h(a),o=!0)},a=function(){e.call(t,n),o=!1};try{t.addEventListener(i,r,!1)}catch(u){}return r},m=function(){s=o.width=window.innerWidth,a=o.height=window.innerHeight},f=function(i){t(o).css("opacity",u(window.scrollY,0,a))};c(window,"resize",m),c(window,"scroll",f),setTimeout(m,0);var w=function(t,i){return(i-t)*Math.random()+t},d=function(t,i,e,o){return r.beginPath(),r.arc(t,i,e,0,n,!1),r.fillStyle=o,r.fill()},l=.5;t(document).on("mousemove",function(t){return l=t.pageX/s}),window.requestAnimationFrame=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(t){return window.setTimeout(t,1e3/60)}}();var p=function(){function t(){this.style=e[~~w(0,5)],this.rgb="rgba("+this.style[0]+","+this.style[1]+","+this.style[2],this.r=~~w(2,6),this.r2=2*this.r,this.replace()}return t.prototype.replace=function(){return this.opacity=0,this.dop=.03*w(1,4),this.x=w(-this.r2,s-this.r2),this.y=w(-20,a-this.r2),this.xmax=s-this.r,this.ymax=a-this.r,this.vx=w(0,2)+8*l-5,this.vy=.7*this.r+w(-1,1)},t.prototype.draw=function(){var t;return this.x+=this.vx,this.y+=this.vy,this.opacity+=this.dop,this.opacity>1&&(this.opacity=1,this.dop*=-1),(this.opacity<0||this.y>this.ymax)&&this.replace(),0<(t=this.x)&&t<this.xmax||(this.x=(this.x+this.xmax)%this.xmax),d(~~this.x,~~this.y,this.r,this.rgb+","+this.opacity+")")},t}(),y=function(){var t,e,n,o;for(n=[],o=t=1,e=i;1<=e?t<=e:t>=e;o=1<=e?++t:--t)n.push(new p);return n}();window.step=function(){var t,i,e,n;for(requestAnimationFrame(step),r.clearRect(0,0,s,a),n=[],i=0,e=y.length;i<e;i++)t=y[i],n.push(t.draw());return n},step()}});