(function(){  
    var UNDEF = "undefined",
        win = window,
        doc = document;

    function addLoadEvent(fn) {
        if (typeof win.addEventListener != UNDEF) {
            win.addEventListener("load", fn, false);
        }
        else if (typeof doc.addEventListener != UNDEF) {
            doc.addEventListener("load", fn, false);
        }
        else if (typeof win.attachEvent != UNDEF) {
            win.attachEvent("onload", fn);
        }
        else if (typeof win.onload == "function") {
            var fnOld = win.onload;
            win.onload = function() {
                fnOld();
                fn();
            };
        }
        else {
            win.onload = fn;
        }
    }

    function on(elem, type, eventHandle) {
        if ( elem.addEventListener ) {
            elem.addEventListener( type, eventHandle, false );
        } else if ( elem.attachEvent ) {
            elem.attachEvent( "on" + type, eventHandle );
        }
    }

    var H_pop = function() {  
        var popuped = false;  
        var popAd = function() {  
            if (popuped) return;  
            popuped = true;
            var purl='http://www.cqq.com';  
            var w=760;  
            var h=480;  
            var adPopup = window.open('about:blank', '_blank','width='+w+',height='+h+', ...');  
            adPopup.blur();  
            adPopup.opener.focus();  
            adPopup.location = purl;
            on(document.body, 'click', arguments.callee);  
            return adPopup;  
        }  
        try {  
            popAd();  
        } catch (e) {  
            popuped = false;  
            on(document.body, 'click', popAd);  
        }  
    }
    addLoadEvent(H_pop);
})();
