!function(e,t){"function"==typeof define&&define.amd?define(["exports"],t):t("object"==typeof exports&&"string"!=typeof exports.nodeName?exports:e.commonJsStrict={})}(this,function(e){function t(e){if(e in q)return e;for(var t=e[0].toUpperCase()+e.slice(1),n=T.length;n--;)if((e=T[n]+t)in q)return e}function n(e,t){e=e||{};for(var i in t)t[i]&&t[i].constructor&&t[i].constructor===Object?(e[i]=e[i]||{},n(e[i],t[i])):e[i]=t[i];return e}function i(e){if("createEvent"in document){var t=document.createEvent("HTMLEvents");t.initEvent("change",!1,!0),e.dispatchEvent(t)}else e.fireEvent("onchange")}function o(e,t,n){if("string"==typeof t){var i=t;(t={})[i]=n}for(var o in t)e.style[o]=t[o]}function r(e,t){e.classList?e.classList.add(t):e.className+=" "+t}function a(e,t){e.classList?e.classList.remove(t):e.className=e.className.replace(t,"")}function l(e,t){for(var n in t)e.setAttribute(n,t[n])}function s(e){return parseInt(e,10)}function u(e,t,n){var i=t||new Image;return i.style.opacity=0,new Promise(function(t){function o(){setTimeout(function(){t(i)},1)}i.src!==e?(i.exifdata=null,i.removeAttribute("crossOrigin"),e.match(/^https?:\/\/|^\/\//)&&i.setAttribute("crossOrigin","anonymous"),i.onload=function(){n?EXIF.getData(i,function(){o()}):o()},i.src=e):o()})}function c(e){var t=e.naturalWidth,n=e.naturalHeight;if(e.exifdata&&e.exifdata.Orientation>=5){var i=t;t=n,n=i}return{width:t,height:n}}function h(e){return e.exifdata.Orientation}function p(e,t,n){var i=t.width,o=t.height,r=e.getContext("2d");switch(e.width=t.width,e.height=t.height,r.save(),n){case 2:r.translate(i,0),r.scale(-1,1);break;case 3:r.translate(i,o),r.rotate(180*Math.PI/180);break;case 4:r.translate(0,o),r.scale(1,-1);break;case 5:e.width=o,e.height=i,r.rotate(90*Math.PI/180),r.scale(1,-1);break;case 6:e.width=o,e.height=i,r.rotate(90*Math.PI/180),r.translate(0,-o);break;case 7:e.width=o,e.height=i,r.rotate(-90*Math.PI/180),r.translate(-i,o),r.scale(1,-1);break;case 8:e.width=o,e.height=i,r.translate(0,i),r.rotate(-90*Math.PI/180)}r.drawImage(t,0,0,i,o),r.restore()}function d(){var e,t,n,i,a,s=this,u=s.options.viewport.type?"cr-vp-"+s.options.viewport.type:null;s.options.useCanvas=s.options.enableOrientation||m.call(s),s.data={},s.elements={},e=s.elements.boundary=document.createElement("div"),t=s.elements.viewport=document.createElement("div"),s.elements.img=document.createElement("img"),n=s.elements.overlay=document.createElement("div"),s.options.useCanvas?(s.elements.canvas=document.createElement("canvas"),s.elements.preview=s.elements.canvas):s.elements.preview=s.elements.img,r(e,"cr-boundary"),e.setAttribute("aria-dropeffect","none"),i=s.options.boundary.width,a=s.options.boundary.height,o(e,{width:i+(isNaN(i)?"":"px"),height:a+(isNaN(a)?"":"px")}),r(t,"cr-viewport"),u&&r(t,u),o(t,{width:s.options.viewport.width+"px",height:s.options.viewport.height+"px"}),t.setAttribute("tabindex",0),r(s.elements.preview,"cr-image"),l(s.elements.preview,{alt:"preview","aria-grabbed":"false"}),r(n,"cr-overlay"),s.element.appendChild(e),e.appendChild(s.elements.preview),e.appendChild(t),e.appendChild(n),r(s.element,"croppie-container"),s.options.customClass&&r(s.element,s.options.customClass),x.call(this),s.options.enableZoom&&g.call(s),s.options.enableResize&&f.call(s)}function m(){return this.options.enableExif&&window.EXIF}function f(){function e(e){if((void 0===e.button||0===e.button)&&(e.preventDefault(),!m)){var o=p.elements.overlay.getBoundingClientRect();if(m=!0,a=e.pageX,l=e.pageY,i=-1!==e.currentTarget.className.indexOf("vertical")?"v":"h",s=o.width,u=o.height,e.touches){var r=e.touches[0];a=r.pageX,l=r.pageY}window.addEventListener("mousemove",t),window.addEventListener("touchmove",t),window.addEventListener("mouseup",n),window.addEventListener("touchend",n),document.body.style[D]="none"}}function t(e){var t=e.pageX,n=e.pageY;if(e.preventDefault(),e.touches){var r=e.touches[0];t=r.pageX,n=r.pageY}var c=t-a,h=n-l,m=p.options.viewport.height+h,v=p.options.viewport.width+c;"v"===i&&m>=f&&m<=u?(o(d,{height:m+"px"}),p.options.boundary.height+=h,o(p.elements.boundary,{height:p.options.boundary.height+"px"}),p.options.viewport.height+=h,o(p.elements.viewport,{height:p.options.viewport.height+"px"})):"h"===i&&v>=f&&v<=s&&(o(d,{width:v+"px"}),p.options.boundary.width+=c,o(p.elements.boundary,{width:p.options.boundary.width+"px"}),p.options.viewport.width+=c,o(p.elements.viewport,{width:p.options.viewport.width+"px"})),C.call(p),B.call(p),b.call(p),E.call(p),l=n,a=t}function n(){m=!1,window.removeEventListener("mousemove",t),window.removeEventListener("touchmove",t),window.removeEventListener("mouseup",n),window.removeEventListener("touchend",n),document.body.style[D]=""}var i,a,l,s,u,c,h,p=this,d=document.createElement("div"),m=!1,f=50;r(d,"cr-resizer"),o(d,{width:this.options.viewport.width+"px",height:this.options.viewport.height+"px"}),this.options.resizeControls.height&&(r(c=document.createElement("div"),"cr-resizer-vertical"),d.appendChild(c)),this.options.resizeControls.width&&(r(h=document.createElement("div"),"cr-resizer-horisontal"),d.appendChild(h)),c&&c.addEventListener("mousedown",e),h&&h.addEventListener("mousedown",e),this.elements.boundary.appendChild(d)}function v(e){if(this.options.enableZoom){var t=this.elements.zoomer,n=F(e,4);t.value=Math.max(t.min,Math.min(t.max,n))}}function g(){function e(){w.call(n,{value:parseFloat(o.value),origin:new $(n.elements.preview),viewportRect:n.elements.viewport.getBoundingClientRect(),transform:K.parse(n.elements.preview)})}function t(t){var i,o;i=t.wheelDelta?t.wheelDelta/1200:t.deltaY?t.deltaY/1060:t.detail?t.detail/-60:0,o=n._currentZoom+i*n._currentZoom,t.preventDefault(),v.call(n,o),e.call(n)}var n=this,i=n.elements.zoomerWrap=document.createElement("div"),o=n.elements.zoomer=document.createElement("input");r(i,"cr-slider-wrap"),r(o,"cr-slider"),o.type="range",o.step="0.0001",o.value=1,o.style.display=n.options.showZoomer?"":"none",o.setAttribute("aria-label","zoom"),n.element.appendChild(i),i.appendChild(o),n._currentZoom=1,n.elements.zoomer.addEventListener("input",e),n.elements.zoomer.addEventListener("change",e),n.options.mouseWheelZoom&&(n.elements.boundary.addEventListener("mousewheel",t),n.elements.boundary.addEventListener("DOMMouseScroll",t))}function w(e){function t(){var e={};e[P]=i.toString(),e[N]=a.toString(),o(n.elements.preview,e)}var n=this,i=e?e.transform:K.parse(n.elements.preview),r=e?e.viewportRect:n.elements.viewport.getBoundingClientRect(),a=e?e.origin:new $(n.elements.preview);if(n._currentZoom=e?e.value:n._currentZoom,i.scale=n._currentZoom,n.elements.zoomer.setAttribute("aria-valuenow",n._currentZoom),t(),n.options.enforceBoundary){var l=y.call(n,r),s=l.translate,u=l.origin;i.x>=s.maxX&&(a.x=u.minX,i.x=s.maxX),i.x<=s.minX&&(a.x=u.maxX,i.x=s.minX),i.y>=s.maxY&&(a.y=u.minY,i.y=s.maxY),i.y<=s.minY&&(a.y=u.maxY,i.y=s.minY)}t(),Q.call(n),E.call(n)}function y(e){var t=this,n=t._currentZoom,i=e.width,o=e.height,r=t.elements.boundary.clientWidth/2,a=t.elements.boundary.clientHeight/2,l=t.elements.preview.getBoundingClientRect(),s=l.width,u=l.height,c=i/2,h=o/2,p=-1*(c/n-r),d=-1*(h/n-a),m=1/n*c,f=1/n*h;return{translate:{maxX:p,minX:p-(s*(1/n)-i*(1/n)),maxY:d,minY:d-(u*(1/n)-o*(1/n))},origin:{maxX:s*(1/n)-m,minX:m,maxY:u*(1/n)-f,minY:f}}}function b(){var e=this,t=e._currentZoom,n=e.elements.preview.getBoundingClientRect(),i=e.elements.viewport.getBoundingClientRect(),r=K.parse(e.elements.preview.style[P]),a=new $(e.elements.preview),l=i.top-n.top+i.height/2,s=i.left-n.left+i.width/2,u={},c={};u.y=l/t,u.x=s/t,c.y=(u.y-a.y)*(1-t),c.x=(u.x-a.x)*(1-t),r.x-=c.x,r.y-=c.y;var h={};h[N]=u.x+"px "+u.y+"px",h[P]=r.toString(),o(e.elements.preview,h)}function x(){function e(e,t){var n=d.elements.preview.getBoundingClientRect(),i=p.y+t,o=p.x+e;d.options.enforceBoundary?(h.top>n.top+t&&h.bottom<n.bottom+t&&(p.y=i),h.left>n.left+e&&h.right<n.right+e&&(p.x=o)):(p.y=i,p.x=o)}function t(e){d.elements.preview.setAttribute("aria-grabbed",e),d.elements.boundary.setAttribute("aria-dropeffect",e?"move":"none")}function n(t){var n={};e(t[0],t[1]),n[P]=p.toString(),o(d.elements.preview,n),C.call(d),document.body.style[D]="",b.call(d),E.call(d),c=0}function r(e){if((void 0===e.button||0===e.button)&&(e.preventDefault(),!m)){if(m=!0,s=e.pageX,u=e.pageY,e.touches){var n=e.touches[0];s=n.pageX,u=n.pageY}t(m),p=K.parse(d.elements.preview),window.addEventListener("mousemove",a),window.addEventListener("touchmove",a),window.addEventListener("mouseup",l),window.addEventListener("touchend",l),document.body.style[D]="none",h=d.elements.viewport.getBoundingClientRect()}}function a(t){t.preventDefault();var n=t.pageX,r=t.pageY;if(t.touches){var a=t.touches[0];n=a.pageX,r=a.pageY}var l=n-s,h=r-u,m={};if("touchmove"==t.type&&t.touches.length>1){var f=t.touches[0],g=t.touches[1],w=Math.sqrt((f.pageX-g.pageX)*(f.pageX-g.pageX)+(f.pageY-g.pageY)*(f.pageY-g.pageY));c||(c=w/d._currentZoom);var y=w/c;return v.call(d,y),void i(d.elements.zoomer)}e(l,h),m[P]=p.toString(),o(d.elements.preview,m),C.call(d),u=r,s=n}function l(){t(m=!1),window.removeEventListener("mousemove",a),window.removeEventListener("touchmove",a),window.removeEventListener("mouseup",l),window.removeEventListener("touchend",l),document.body.style[D]="",b.call(d),E.call(d),c=0}var s,u,c,h,p,d=this,m=!1;d.elements.overlay.addEventListener("mousedown",r),d.elements.viewport.addEventListener("keydown",function(e){var t=37,i=38,o=39,r=40;if(!e.shiftKey||e.keyCode!=i&&e.keyCode!=r){if(d.options.enableKeyMovement&&e.keyCode>=37&&e.keyCode<=40){e.preventDefault();var a=function(n){switch(e.keyCode){case t:return[1,0];case i:return[0,1];case o:return[-1,0];case r:return[0,-1]}}();p=K.parse(d.elements.preview),document.body.style[D]="none",h=d.elements.viewport.getBoundingClientRect(),n(a)}}else{var l=0;l=e.keyCode==i?parseFloat(d.elements.zoomer.value,10)+parseFloat(d.elements.zoomer.step,10):parseFloat(d.elements.zoomer.value,10)-parseFloat(d.elements.zoomer.step,10),d.setZoom(l)}}),d.elements.overlay.addEventListener("touchstart",r)}function C(){var e=this,t=e.elements.boundary.getBoundingClientRect(),n=e.elements.preview.getBoundingClientRect();o(e.elements.overlay,{width:n.width+"px",height:n.height+"px",top:n.top-t.top+"px",left:n.left-t.left+"px"})}function E(){var e=this,t=e.get();if(_.call(e))if(e.options.update.call(e,t),e.$&&"undefined"==typeof Prototype)e.$(e.element).trigger("update",t);else{var n;window.CustomEvent?n=new CustomEvent("update",{detail:t}):(n=document.createEvent("CustomEvent")).initCustomEvent("update",!0,!0,t),e.element.dispatchEvent(n)}}function _(){return this.elements.preview.offsetHeight>0&&this.elements.preview.offsetWidth>0}function L(){var e=this,t={},n=e.elements.preview,i=e.elements.preview.getBoundingClientRect(),r=new K(0,0,1),a=new $;_.call(e)&&!e.data.bound&&(e.data.bound=!0,t[P]=r.toString(),t[N]=a.toString(),t.opacity=1,o(n,t),e._originalImageWidth=i.width,e._originalImageHeight=i.height,e.options.enableZoom?B.call(e,!0):e._currentZoom=1,r.scale=e._currentZoom,t[P]=r.toString(),o(n,t),e.data.points.length?R.call(e,e.data.points):I.call(e),b.call(e),C.call(e))}function B(e){var t,n,o,r,a=this,l=0,s=1.5,u=a.elements.zoomer,c=parseFloat(u.value),h=a.elements.boundary.getBoundingClientRect(),p=a.elements.preview.getBoundingClientRect(),d=a.elements.viewport.getBoundingClientRect();a.options.enforceBoundary&&(o=d.width/(e?p.width:p.width/c),r=d.height/(e?p.height:p.height/c),l=Math.max(o,r)),l>=s&&(s=l+1),u.min=F(l,4),u.max=F(s,4),e&&(n=Math.max(h.width/p.width,h.height/p.height),t=null!==a.data.boundZoom?a.data.boundZoom:n,v.call(a,t)),i(u)}function R(e){if(4!=e.length)throw"Croppie - Invalid number of points supplied: "+e;var t=this,n=e[2]-e[0],i=t.elements.viewport.getBoundingClientRect(),r=t.elements.boundary.getBoundingClientRect(),a={left:i.left-r.left,top:i.top-r.top},l=i.width/n,s=e[1],u=e[0],c=-1*e[1]+a.top,h=-1*e[0]+a.left,p={};p[N]=u+"px "+s+"px",p[P]=new K(h,c,l).toString(),o(t.elements.preview,p),v.call(t,l),t._currentZoom=l}function I(){var e=this,t=e.elements.preview.getBoundingClientRect(),n=e.elements.viewport.getBoundingClientRect(),i=e.elements.boundary.getBoundingClientRect(),r=n.left-i.left,a=n.top-i.top,l=r-(t.width-n.width)/2,s=a-(t.height-n.height)/2,u=new K(l,s,e._currentZoom);o(e.elements.preview,P,u.toString())}function M(e){var t=this,n=t.elements.canvas,i=t.elements.img,o=n.getContext("2d"),r=m.call(t),e=t.options.enableOrientation&&e;o.clearRect(0,0,n.width,n.height),n.width=i.width,n.height=i.height,r&&!e?p(n,i,s(h(i)||0,10)):e&&p(n,i,e)}function Z(e){var t=this,n=e.points,i=s(n[0]),o=s(n[1]),r=s(n[2]),a=s(n[3]),l=r-i,u=a-o,c=e.circle,h=document.createElement("canvas"),p=h.getContext("2d"),d=l,m=u,f=0,v=0,g=d,w=m,y=1;return e.outputWidth&&e.outputHeight&&(g=e.outputWidth,w=e.outputHeight,y=g/d),h.width=g,h.height=w,e.backgroundColor&&(p.fillStyle=e.backgroundColor,p.fillRect(0,0,d,m)),t.options.enforceBoundary||(i<0&&(f=Math.abs(i),i=0),o<0&&(v=Math.abs(o),o=0),r>t._originalImageWidth&&(d=l=t._originalImageWidth-i),a>t._originalImageHeight&&(m=u=t._originalImageHeight-o)),1!==y&&(f*=y,v*=y,d*=y,m*=y),p.drawImage(this.elements.preview,i,o,Math.min(l,t._originalImageWidth),Math.min(u,t._originalImageHeight),f,v,d,m),c&&(p.fillStyle="#fff",p.globalCompositeOperation="destination-in",p.beginPath(),p.arc(d/2,m/2,d/2,0,2*Math.PI,!0),p.closePath(),p.fill()),h}function z(e){var t=e.points,n=document.createElement("div"),i=document.createElement("img"),a=t[2]-t[0],l=t[3]-t[1];return r(n,"croppie-result"),n.appendChild(i),o(i,{left:-1*t[0]+"px",top:-1*t[1]+"px"}),i.src=e.url,o(n,{width:a+"px",height:l+"px"}),n}function Y(e){return Z.call(this,e).toDataURL(e.format,e.quality)}function W(e){var t=this;return new Promise(function(n,i){Z.call(t,e).toBlob(function(e){n(e)},e.format,e.quality)})}function X(e,t){var n,i=this,o=[],r=null,a=m.call(i);if("string"==typeof e)n=e,e={};else if(Array.isArray(e))o=e.slice();else{if(void 0===e&&i.data.url)return L.call(i),E.call(i),null;n=e.url,o=e.points||[],r=void 0===e.zoom?null:e.zoom}return i.data.bound=!1,i.data.url=n||i.data.url,i.data.boundZoom=r,u(n,i.elements.img,a).then(function(n){if(o.length)i.options.relative&&(o=[o[0]*n.naturalWidth/100,o[1]*n.naturalHeight/100,o[2]*n.naturalWidth/100,o[3]*n.naturalHeight/100]);else{var r,a,l=c(n),s=i.elements.viewport.getBoundingClientRect(),u=s.width/s.height;l.width/l.height>u?r=(a=l.height)*u:a=(r=l.width)/u;var h=(l.width-r)/2,p=(l.height-a)/2,d=h+r,m=p+a;i.data.points=[h,p,d,m]}i.data.points=o.map(function(e){return parseFloat(e)}),i.options.useCanvas&&M.call(i,e.orientation||1),L.call(i),E.call(i),t&&t()})}function F(e,t){return parseFloat(e).toFixed(t||0)}function H(){var e=this,t=e.elements.preview.getBoundingClientRect(),n=e.elements.viewport.getBoundingClientRect(),i=n.left-t.left,o=n.top-t.top,r=(n.width-e.elements.viewport.offsetWidth)/2,a=(n.height-e.elements.viewport.offsetHeight)/2,l=i+e.elements.viewport.offsetWidth+r,s=o+e.elements.viewport.offsetHeight+a,u=e._currentZoom;(u===1/0||isNaN(u))&&(u=1);var c=e.options.enforceBoundary?0:Number.NEGATIVE_INFINITY;return i=Math.max(c,i/u),o=Math.max(c,o/u),l=Math.max(c,l/u),s=Math.max(c,s/u),{points:[F(i),F(o),F(l),F(s)],zoom:u}}function k(e){var t=this,i=H.call(t),o=n(G,n({},e)),r="string"==typeof e?e:o.type||"base64",a=o.size||"viewport",l=o.format,s=o.quality,u=o.backgroundColor,c="boolean"==typeof o.circle?o.circle:"circle"===t.options.viewport.type,h=t.elements.viewport.getBoundingClientRect(),p=h.width/h.height;return"viewport"===a?(i.outputWidth=h.width,i.outputHeight=h.height):"object"==typeof a&&(a.width&&a.height?(i.outputWidth=a.width,i.outputHeight=a.height):a.width?(i.outputWidth=a.width,i.outputHeight=a.width/p):a.height&&(i.outputWidth=a.height*p,i.outputHeight=a.height)),J.indexOf(l)>-1&&(i.format="image/"+l,i.quality=s),i.circle=c,i.url=t.data.url,i.backgroundColor=u,new Promise(function(e,n){switch(r.toLowerCase()){case"rawcanvas":e(Z.call(t,i));break;case"canvas":case"base64":e(Y.call(t,i));break;case"blob":W.call(t,i).then(e);break;default:e(z.call(t,i))}})}function j(){L.call(this)}function A(e){if(!this.options.useCanvas)throw"Croppie: Cannot rotate without enableOrientation";var t=this,n=t.elements.canvas,i=document.createElement("canvas"),o=1;i.width=n.width,i.height=n.height,i.getContext("2d").drawImage(n,0,0),90!==e&&-270!==e||(o=6),-90!==e&&270!==e||(o=8),180!==e&&-180!==e||(o=3),p(n,i,o),w.call(t),i=null}function S(){var e=this;e.element.removeChild(e.elements.boundary),a(e.element,"croppie-container"),e.options.enableZoom&&e.element.removeChild(e.elements.zoomerWrap),delete e.elements}function O(e,t){if(this.element=e,this.options=n(n({},O.defaults),t),"img"===this.element.tagName.toLowerCase()){var i=this.element;r(i,"cr-original-image"),l(i,{"aria-hidden":"true",alt:""});var o=document.createElement("div");this.element.parentNode.appendChild(o),o.appendChild(i),this.element=o,this.options.url=this.options.url||i.src}if(d.call(this),this.options.url){var a={url:this.options.url,points:this.options.points};delete this.options.url,delete this.options.points,X.call(this,a)}}"function"!=typeof Promise&&function(e){function t(e,t){return function(){e.apply(t,arguments)}}function n(e){if("object"!=typeof this)throw new TypeError("Promises must be constructed via new");if("function"!=typeof e)throw new TypeError("not a function");this._state=null,this._value=null,this._deferreds=[],s(e,t(o,this),t(r,this))}function i(e){var t=this;return null===this._state?void this._deferreds.push(e):void c(function(){var n=t._state?e.onFulfilled:e.onRejected;if(null!==n){var i;try{i=n(t._value)}catch(t){return void e.reject(t)}e.resolve(i)}else(t._state?e.resolve:e.reject)(t._value)})}function o(e){try{if(e===this)throw new TypeError("A promise cannot be resolved with itself.");if(e&&("object"==typeof e||"function"==typeof e)){var n=e.then;if("function"==typeof n)return void s(t(n,e),t(o,this),t(r,this))}this._state=!0,this._value=e,a.call(this)}catch(e){r.call(this,e)}}function r(e){this._state=!1,this._value=e,a.call(this)}function a(){for(var e=0,t=this._deferreds.length;t>e;e++)i.call(this,this._deferreds[e]);this._deferreds=null}function l(e,t,n,i){this.onFulfilled="function"==typeof e?e:null,this.onRejected="function"==typeof t?t:null,this.resolve=n,this.reject=i}function s(e,t,n){var i=!1;try{e(function(e){i||(i=!0,t(e))},function(e){i||(i=!0,n(e))})}catch(e){if(i)return;i=!0,n(e)}}var u=setTimeout,c="function"==typeof setImmediate&&setImmediate||function(e){u(e,1)},h=Array.isArray||function(e){return"[object Array]"===Object.prototype.toString.call(e)};n.prototype.catch=function(e){return this.then(null,e)},n.prototype.then=function(e,t){var o=this;return new n(function(n,r){i.call(o,new l(e,t,n,r))})},n.all=function(){var e=Array.prototype.slice.call(1===arguments.length&&h(arguments[0])?arguments[0]:arguments);return new n(function(t,n){function i(r,a){try{if(a&&("object"==typeof a||"function"==typeof a)){var l=a.then;if("function"==typeof l)return void l.call(a,function(e){i(r,e)},n)}e[r]=a,0==--o&&t(e)}catch(e){n(e)}}if(0===e.length)return t([]);for(var o=e.length,r=0;r<e.length;r++)i(r,e[r])})},n.resolve=function(e){return e&&"object"==typeof e&&e.constructor===n?e:new n(function(t){t(e)})},n.reject=function(e){return new n(function(t,n){n(e)})},n.race=function(e){return new n(function(t,n){for(var i=0,o=e.length;o>i;i++)e[i].then(t,n)})},n._setImmediateFn=function(e){c=e},"undefined"!=typeof module&&module.exports?module.exports=n:e.Promise||(e.Promise=n)}(this),"function"!=typeof window.CustomEvent&&function(){function e(e,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var n=document.createEvent("CustomEvent");return n.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),n}e.prototype=window.Event.prototype,window.CustomEvent=e}(),HTMLCanvasElement.prototype.toBlob||Object.defineProperty(HTMLCanvasElement.prototype,"toBlob",{value:function(e,t,n){for(var i=atob(this.toDataURL(t,n).split(",")[1]),o=i.length,r=new Uint8Array(o),a=0;a<o;a++)r[a]=i.charCodeAt(a);e(new Blob([r],{type:t||"image/png"}))}});var N,P,D,T=["Webkit","Moz","ms"],q=document.createElement("div").style;P=t("transform"),N=t("transformOrigin"),D=t("userSelect");var U={translate3d:{suffix:", 0px"},translate:{suffix:""}},K=function(e,t,n){this.x=parseFloat(e),this.y=parseFloat(t),this.scale=parseFloat(n)};K.parse=function(e){return e.style?K.parse(e.style[P]):e.indexOf("matrix")>-1||e.indexOf("none")>-1?K.fromMatrix(e):K.fromString(e)},K.fromMatrix=function(e){var t=e.substring(7).split(",");return t.length&&"none"!==e||(t=[1,0,0,1,0,0]),new K(s(t[4]),s(t[5]),parseFloat(t[0]))},K.fromString=function(e){var t=e.split(") "),n=t[0].substring(O.globals.translate.length+1).split(","),i=t.length>1?t[1].substring(6):1,o=n.length>1?n[0]:0,r=n.length>1?n[1]:0;return new K(o,r,i)},K.prototype.toString=function(){var e=U[O.globals.translate].suffix||"";return O.globals.translate+"("+this.x+"px, "+this.y+"px"+e+") scale("+this.scale+")"};var $=function(e){if(!e||!e.style[N])return this.x=0,void(this.y=0);var t=e.style[N].split(" ");this.x=parseFloat(t[0]),this.y=parseFloat(t[1])};$.prototype.toString=function(){return this.x+"px "+this.y+"px"};var Q=function(e,t,n){var i;return function(){var o=this,r=arguments,a=n&&!i;clearTimeout(i),i=setTimeout(function(){i=null,n||e.apply(o,r)},t),a&&e.apply(o,r)}}(C,500),G={type:"canvas",format:"png",quality:1},J=["jpeg","webp","png"];if(window.jQuery){var V=window.jQuery;V.fn.croppie=function(e){if("string"===typeof e){var t=Array.prototype.slice.call(arguments,1),n=V(this).data("croppie");return"get"===e?n.get():"result"===e?n.result.apply(n,t):"bind"===e?n.bind.apply(n,t):this.each(function(){var n=V(this).data("croppie");if(n){var i=n[e];if(!V.isFunction(i))throw"Croppie "+e+" method not found";i.apply(n,t),"destroy"===e&&V(this).removeData("croppie")}})}return this.each(function(){var t=new O(this,e);t.$=V,V(this).data("croppie",t)})}}O.defaults={viewport:{width:100,height:100,type:"square"},boundary:{},orientationControls:{enabled:!0,leftClass:"",rightClass:""},resizeControls:{width:!0,height:!0},customClass:"",showZoomer:!0,enableZoom:!0,enableResize:!1,mouseWheelZoom:!0,enableExif:!1,enforceBoundary:!0,enableOrientation:!1,enableKeyMovement:!0,update:function(){}},O.globals={translate:"translate3d"},n(O.prototype,{bind:function(e,t){return X.call(this,e,t)},get:function(){var e=H.call(this),t=e.points;return this.options.relative&&(t[0]/=this.elements.img.naturalWidth/100,t[1]/=this.elements.img.naturalHeight/100,t[2]/=this.elements.img.naturalWidth/100,t[3]/=this.elements.img.naturalHeight/100),e},result:function(e){return k.call(this,e)},refresh:function(){return j.call(this)},setZoom:function(e){v.call(this,e),i(this.elements.zoomer)},rotate:function(e){A.call(this,e)},destroy:function(){return S.call(this)}}),e.Croppie=window.Croppie=O,"object"==typeof module&&module.exports&&(module.exports=O)});