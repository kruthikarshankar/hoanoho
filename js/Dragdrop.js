/**
* This Javascript package implements drag-n-drop functionality in a browser.
*
* Supports:
* - Moving an element horizontally, vertically and in both directions
* - Snap to grid functionality
* - Limitation of moving distance
* - Registering of user-defined function on start, move and stop
*
* Tested in the following browsers: IE 6.0, FF 17, Chrome 22, Safari 5.1.1
*
* Dragdrop.js requires Event.js package, which can be acquired at the following links:
* Github - https://github.com/mark-rolich/Event.js
* JS Classes - http://www.jsclasses.org/package/212-JavaScript-Handle-events-in-a-browser-independent-manner.html
*
* @author Mark Rolich <mark.rolich@gmail.com>
*/
var Dragdrop = function (evt) {
    "use strict";
    var elem        = null,
        started     = 0,
        self        = this,
        moveHandler = null,
        gWidth      = (document.body.scrollWidth > document.documentElement.clientWidth)
                      ? document.body.scrollWidth
                      : document.documentElement.clientWidth,
        gHeight     = (document.body.scrollHeight > document.documentElement.clientHeight)
                      ? document.body.scrollHeight
                      : document.documentElement.clientHeight,
        move        = function (e) {
            var xDiff   = e.clientX - elem.posX,
                yDiff   = e.clientY - elem.posY,
                x       = xDiff - (xDiff % elem.snap) + 'px',
                y       = yDiff - (yDiff % elem.snap) + 'px';

            if (started === 1) {
                switch (elem.mode) {
                case 0:
                    elem.style.top = y;
                    elem.style.left = x;
                    break;
                case 1:
                    elem.style.left = x;
                    break;
                case 2:
                    elem.style.top = y;
                    break;
                }

                if (elem.mode !== 2) {
                    if (xDiff <= elem.minX) {
                        elem.style.left = elem.minX + 'px';
                    }

                    if (elem.offsetLeft + elem.offsetWidth >= elem.maxX) {
                        elem.style.left = (elem.maxX - elem.offsetWidth) + 'px';
                    }
                }

                if (elem.mode !== 1) {
                    if (yDiff <= elem.minY) {
                        elem.style.top = elem.minY + 'px';
                    }

                    if (elem.offsetTop + elem.offsetHeight >= elem.maxY) {
                        elem.style.top = (elem.maxY - elem.offsetHeight) + 'px';
                    }
                }

                elem.onMove(elem);
            }
        },
        start       = function (e, src) {
            if (src.id.indexOf("device") !== -1) {
                //alert("left:"+src.offsetLeft+"top:"+src.offsetTop);
                evt.prevent(e);

                moveHandler = evt.attach('mousemove', document, move, true);
                started = 1;

                elem = src;
                elem.posX = e.clientX - elem.offsetLeft;
                elem.posY = e.clientY - elem.offsetTop;
                //elem.posX = e.clientX;
                //elem.posY = e.clientY;

                if (elem.mode === undefined) {
                    self.set(elem);
                }

                elem.onStart(elem);

                if (elem.setCapture) {
                    elem.setCapture();
                }
            }
        },
        stop        = function () {
            if (started === 1) {
                started = 0;

                // do mysql update elem.style.left elem.style.top on elem.id
                var mygetrequest = new ajaxRequest();
                mygetrequest.onreadystatechange=function()
                {
                    if (mygetrequest.readyState == 4) 
                    {
                        if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) 
                        {
                            var thisdoc = document.getElementById("result")
                            if(thisdoc != null)
                                thisdoc.innerHTML = mygetrequest.responseText;
                        }
                    }
                }

                var save_xpos = elem.style.left.substr(0,elem.style.left.length-2);
                var save_ypos = elem.style.top.substr(0,elem.style.top.length-2);

                //mygetrequest.open("GET", "./helper-client/update_device.php?id=" + elem.id.substr(6,elem.id.length-6) + "&pos_x=" + elem.style.left + "&pos_y=" + elem.style.top, true);
                mygetrequest.open("GET", "./helper-client/update_device.php?id=" + elem.id.substr(6,elem.id.length-6) + "&pos_x=" + save_xpos + "&pos_y=" + save_ypos, true);
                mygetrequest.send(null);

                elem.onStop(elem);
                evt.detach('mousemove', document, moveHandler);

                if (elem.releaseCapture) {
                    elem.releaseCapture();
                }
            }
        };

    evt.attach('mousedown', document, start, false);
    evt.attach('mouseup', document, stop, false);

    this.set = function (element, elemOptions) {
        var options = elemOptions       || {};

        elem = (typeof element === 'string')
                ? document.getElementById(element)
                : element;

        if(elem != null)
        {
            elem.mode           = options.mode      || 0;
            elem.minX           = options.minX      || 0;
            elem.maxX           = options.maxX      || gWidth;
            elem.minY           = options.minY      || 0;
            elem.maxY           = options.maxY      || gHeight;
            elem.snap           = options.snap      || 1;
            elem.onStart        = options.onstart   || function () {};
            elem.onMove         = options.onmove    || function () {};
            elem.onStop         = options.onstop    || function () {};

            elem.style.left     = elem.offsetLeft + 'px';
            elem.style.top      = elem.offsetTop + 'px';

            elem.unselectable   = 'on';
        }
    };
};


function ajaxRequest(){
 var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
 if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
  for (var i=0; i<activexmodes.length; i++){
   try{
    return new ActiveXObject(activexmodes[i])
   }
   catch(e){
    //suppress error
   }
  }
 }
 else if (window.XMLHttpRequest) // if Mozilla, Safari etc
  return new XMLHttpRequest()
 else
  return false
}