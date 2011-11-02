/*
build time: 2011-11-01 11:16:35.576
*/
(function(host, S, undef) {
var seed = (host && host[S]) || {};
host = seed.__HOST || (seed.__HOST = host || {});
S = host[S] = seed;
/******************************************************************************
 * 使用说明
 * ====================
 * 
 * * 用法:
 *   var _had = _had || [];
 *   _had.push(['site', '$SID']);
 * 
 *   (function() {
 *       var at = document.createElement('script'); at.type = 'text/javascript'; at.async = true;
 *       at.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.adtracker.com/at.js';
 *       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(at, s);
 *   })();
 * 
 * * 配置方式：
 * * ADTracker 使用 Javascript 全局变量 _had 来配置
 *   var _had = _had || [];
 * 
 * * * 一、定义站点
 *   _had.push(['site', '$SID']);
 * 
 * * * 二、订单跟踪（可选）
 *   _had.push(['order', '$ORDER_ID']);
 *   说明：
 *       如添加 $ORDER_ID 行代码，则页面加载完成之后会执行订单跟踪功能
 * 
 * * * 三、转化跟踪（可选）
 *   有两种用法：
 *   A: At.transform($TRANS_ID);
 *   说明：
 *       手动绑定 At.transform 函数到需要响应的 Javascript 事件上
 * 
 *   B: _had.push(['trans', '$TRANS_ID', '$TRANS_HOOK']);
 *   说明：
 *       自动绑定 At.transform 函数到 Javascript 函数 $TRANS_HOOK 上
 * 
 *   示例：
 *   HTML
 *       <a id="live800">接受800对话</a>
 * 
 *   JAVASCRIPT
 *       function accept800() {
 *         log('...');
 *       }
 *       $(function() {
 *         $('#live800').onclick(accept800);
 *       })
 * 
 *   方式 A：修改函数 accept800
 *       function accept800() {
 *         log('...');
 *         At.transform($TRANS_ID);
 *       }
 *   方式 B:
 *       _had.push(['trans', '$TRANS_ID', 'accept800']);
 *
 * 
 * * 参数说明
 *   ====================
 *   | od | 订单ID          |
 *   | tf | 转化ID          |
 *   
 *   | mc | 渠道ID          | adcad
 *   | sc | 子渠道ID        | adsub
 *   | ma | 推广人员ID      | aduid
 *   | st | 网站ID          | adsid
 *   
 *   | sw | 屏幕宽度        |
 *   | sh | 屏幕高度        |
 *   
 *   | ww | 窗口宽度        |
 *   | wh | 窗口高度        |
 *   
 *   | pw | 页面宽度        |
 *   | ph | 页面高度        |
 *   
 *   | co | 屏幕颜色        |
 *   | fl | 是否支持 Flash  |
 *   | ck | 是否支持 Cookie |
 *   | ja | 是否支持 JAVA   |
 *   | rf | 访问来源        |
 *   | pn | 插件数量        |
 *   | tz | 时区            |
 *   | ca | 页面编码        |
 *   
 *   | mx | 点击坐标-x      |
 *   | my | 点击坐标-y      |
 *   | sn | 第几屏          |
 * 
 ******************************************************************************/
var USRCFG = '_had',
    SITE = 'site',
    ORDER = 'order',
    TRANS = 'trans';

S.config = {
    host: 'http://192.168.1.100/adtracker/index.php',
    order_api: '/api/order',
    trans_api: '/api/transform'
};

(function() {
    var user_config = window[USRCFG] || [], cfg = S.config;
    if (user_config) {
        for (var i = 0, n = user_config.length; i < n; i++) {
            var list = user_config[i];
            if (list[0] == SITE) {
                cfg.site_id = list[1];
            } else if (list[0] == ORDER) {
                cfg.order = true;
                cfg.order_id = list[1];
            } else if (list[0] == TRANS) {
                cfg.trans = true;
                cfg.trans_id = list[1];
                cfg.trans_hook = list[2];
            } 
        }
    }
})();
var swfobject = function() {
    
    var UNDEF = "undefined",
        OBJECT = "object",
        SHOCKWAVE_FLASH = "Shockwave Flash",
        SHOCKWAVE_FLASH_AX = "ShockwaveFlash.ShockwaveFlash",
        FLASH_MIME_TYPE = "application/x-shockwave-flash",
        EXPRESS_INSTALL_ID = "SWFObjectExprInst",
        ON_READY_STATE_CHANGE = "onreadystatechange",
    
        win = window,
        doc = document,
        nav = navigator,
    
        plugin = false,
        domLoadFnArr = [main],
        regObjArr = [],
        objIdArr = [],
        listenersArr = [],
        storedAltContent,
        storedAltContentId,
        storedCallbackFn,
        storedCallbackObj,
        isDomLoaded = false,
        isExpressInstallActive = false,
        dynamicStylesheet,
        dynamicStylesheetMedia,
        autoHideShow = true,
    
    /* Centralized function for browser feature detection
     *  - User agent string detection is only used when no good alternative is possible
     *  - Is executed directly for optimal performance
     */
        ua = function() {
            var w3cdom = typeof doc.getElementById != UNDEF && typeof doc.getElementsByTagName != UNDEF && typeof doc.createElement != UNDEF,
                u = nav.userAgent.toLowerCase(),
                p = nav.platform.toLowerCase(),
                windows = p ? /win/.test(p) : /win/.test(u),
                mac = p ? /mac/.test(p) : /mac/.test(u),
                webkit = /webkit/.test(u) ? parseFloat(u.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : false, // returns either the webkit version or false if not webkit
                ie = !+"\v1", // feature detection based on Andrea Giammarchi's solution: http://webreflection.blogspot.com/2009/01/32-bytes-to-know-if-your-browser-is-ie.html
                playerVersion = [0,0,0],
                d = null;
            if (typeof nav.plugins != UNDEF && typeof nav.plugins[SHOCKWAVE_FLASH] == OBJECT) {
                d = nav.plugins[SHOCKWAVE_FLASH].description;
                if (d && !(typeof nav.mimeTypes != UNDEF && nav.mimeTypes[FLASH_MIME_TYPE] && !nav.mimeTypes[FLASH_MIME_TYPE].enabledPlugin)) { // navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin indicates whether plug-ins are enabled or disabled in Safari 3+
                    plugin = true;
                    ie = false; // cascaded feature detection for Internet Explorer
                    d = d.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
                    playerVersion[0] = parseInt(d.replace(/^(.*)\..*$/, "$1"), 10);
                    playerVersion[1] = parseInt(d.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
                    playerVersion[2] = /[a-zA-Z]/.test(d) ? parseInt(d.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0;
                }
            }
            else if (typeof win.ActiveXObject != UNDEF) {
                try {
                    var a = new ActiveXObject(SHOCKWAVE_FLASH_AX);
                    if (a) { // a will return null when ActiveX is disabled
                        d = a.GetVariable("$version");
                        if (d) {
                            ie = true; // cascaded feature detection for Internet Explorer
                            d = d.split(" ")[1].split(",");
                            playerVersion = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
                        }
                    }
                }
                catch(e) {}
            }
            return { w3:w3cdom, pv:playerVersion, wk:webkit, ie:ie, win:windows, mac:mac };
        }(),
        
        /* Cross-browser onDomLoad
                - Will fire an event as soon as the DOM of a web page is loaded
                - Internet Explorer workaround based on Diego Perini's solution: http://javascript.nwbox.com/IEContentLoaded/
                - Regular onload serves as fallback
        */ 
        onDomLoad = function() {
            if (!ua.w3) { return; }
            if ((typeof doc.readyState != UNDEF && doc.readyState == "complete") || (typeof doc.readyState == UNDEF && (doc.getElementsByTagName("body")[0] || doc.body))) { // function is fired after onload, e.g. when script is inserted dynamically 
                callDomLoadFunctions();
            }
            if (!isDomLoaded) {
                if (typeof doc.addEventListener != UNDEF) {
                    doc.addEventListener("DOMContentLoaded", callDomLoadFunctions, false);
                }               
                if (ua.ie && ua.win) {
                    doc.attachEvent(ON_READY_STATE_CHANGE, function() {
                        if (doc.readyState == "complete") {
                            doc.detachEvent(ON_READY_STATE_CHANGE, arguments.callee);
                            callDomLoadFunctions();
                        }
                    });
                    if (win == top) { // if not inside an iframe
                        (function(){
                            if (isDomLoaded) { return; }
                            try {
                                doc.documentElement.doScroll("left");
                            }
                            catch(e) {
                                setTimeout(arguments.callee, 0);
                                return;
                            }
                            callDomLoadFunctions();
                        })();
                    }
                }
                if (ua.wk) {
                    (function(){
                        if (isDomLoaded) { return; }
                        if (!/loaded|complete/.test(doc.readyState)) {
                            setTimeout(arguments.callee, 0);
                            return;
                        }
                        callDomLoadFunctions();
                    })();
                }
                addLoadEvent(callDomLoadFunctions);
            }
        }();
    
        function callDomLoadFunctions() {
            if (isDomLoaded) { return; }
            try { // test if we can really add/remove elements to/from the DOM; we don't want to fire it too early
                var t = doc.getElementsByTagName("body")[0].appendChild(createElement("span"));
                t.parentNode.removeChild(t);
            }
            catch (e) { return; }
            isDomLoaded = true;
            var dl = domLoadFnArr.length;
            for (var i = 0; i < dl; i++) {
                domLoadFnArr[i]();
            }
        }
    
        function addDomLoadEvent(fn) {
            if (isDomLoaded) {
                fn();
            }
            else { 
                domLoadFnArr[domLoadFnArr.length] = fn; // Array.push() is only available in IE5.5+
            }
        }
        
        /* Cross-browser onload
                - Based on James Edwards' solution: http://brothercake.com/site/resources/scripts/onload/
                - Will fire an event as soon as a web page including all of its assets are loaded 
         */
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
        
        /* Main function
                - Will preferably execute onDomLoad, otherwise onload (as a fallback)
        */
        function main() { 
            if (plugin) {
                testPlayerVersion();
            }
            else {
                matchVersions();
            }
        }
        
        /* Detect the Flash Player version for non-Internet Explorer browsers
                - Detecting the plug-in version via the object element is more precise than using the plugins collection item's description:
                  a. Both release and build numbers can be detected
                  b. Avoid wrong descriptions by corrupt installers provided by Adobe
                  c. Avoid wrong descriptions by multiple Flash Player entries in the plugin Array, caused by incorrect browser imports
                - Disadvantage of this method is that it depends on the availability of the DOM, while the plugins collection is immediately available
        */
        function testPlayerVersion() {
            var b = doc.getElementsByTagName("body")[0];
            var o = createElement(OBJECT);
            o.setAttribute("type", FLASH_MIME_TYPE);
            var t = b.appendChild(o);
            if (t) {
                var counter = 0;
                (function(){
                    if (typeof t.GetVariable != UNDEF) {
                        var d = t.GetVariable("$version");
                        if (d) {
                            d = d.split(" ")[1].split(",");
                            ua.pv = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
                        }
                    }
                    else if (counter < 10) {
                        counter++;
                        setTimeout(arguments.callee, 10);
                        return;
                    }
                    b.removeChild(o);
                    t = null;
                    matchVersions();
                })();
            }
            else {
                matchVersions();
            }
        }
        
        /* Perform Flash Player and SWF version matching; static publishing only
        */
        function matchVersions() {
            var rl = regObjArr.length;
            if (rl > 0) {
                for (var i = 0; i < rl; i++) { // for each registered object element
                        var id = regObjArr[i].id;
                        var cb = regObjArr[i].callbackFn;
                    var cbObj = {success:false, id:id};
                    if (ua.pv[0] > 0) {
                        var obj = getElementById(id);
                        if (obj) {
                            if (hasPlayerVersion(regObjArr[i].swfVersion) && !(ua.wk && ua.wk < 312)) { // Flash Player version >= published SWF version: Houston, we have a match!
                                setVisibility(id, true);
                                if (cb) {
                                    cbObj.success = true;
                                    cbObj.ref = getObjectById(id);
                                    cb(cbObj);
                                }
                            }
                            else if (regObjArr[i].expressInstall && canExpressInstall()) { // show the Adobe Express Install dialog if set by the web page author and if supported
                                var att = {};
                                att.data = regObjArr[i].expressInstall;
                                att.width = obj.getAttribute("width") || "0";
                                att.height = obj.getAttribute("height") || "0";
                                if (obj.getAttribute("class")) { att.styleclass = obj.getAttribute("class"); }
                                if (obj.getAttribute("align")) { att.align = obj.getAttribute("align"); }
                                // parse HTML object param element's name-value pairs
                                var par = {};
                                var p = obj.getElementsByTagName("param");
                                var pl = p.length;
                                for (var j = 0; j < pl; j++) {
                                    if (p[j].getAttribute("name").toLowerCase() != "movie") {
                                        par[p[j].getAttribute("name")] = p[j].getAttribute("value");
                                    }
                                }
                                showExpressInstall(att, par, id, cb);
                            }
                            else { // Flash Player and SWF version mismatch or an older Webkit engine that ignores the HTML object element's nested param elements: display alternative content instead of SWF
                                displayAltContent(obj);
                                if (cb) { cb(cbObj); }
                            }
                        }
                    }
                    else {      // if no Flash Player is installed or the fp version cannot be detected we let the HTML object element do its job (either show a SWF or alternative content)
                        setVisibility(id, true);
                        if (cb) {
                            var o = getObjectById(id); // test whether there is an HTML object element or not
                            if (o && typeof o.SetVariable != UNDEF) { 
                                cbObj.success = true;
                                cbObj.ref = o;
                            }
                            cb(cbObj);
                        }
                    }
                }
            }
        }
        
        function getObjectById(objectIdStr) {
            var r = null;
            var o = getElementById(objectIdStr);
            if (o && o.nodeName == "OBJECT") {
                if (typeof o.SetVariable != UNDEF) {
                    r = o;
                }
                else {
                    var n = o.getElementsByTagName(OBJECT)[0];
                    if (n) {
                        r = n;
                    }
                }
            }
            return r;
        }
        
        /* Functions to optimize JavaScript compression
        */
        function getElementById(id) {
            var el = null;
            try {
                el = doc.getElementById(id);
            }
            catch (e) {}
            return el;
        }
        
        function createElement(el) {
            return doc.createElement(el);
        }

        /* Filter to avoid XSS attacks
        */
        function urlEncodeIfNecessary(s) {
            var regex = /[\\\"<>\.;]/;
            var hasBadChars = regex.exec(s) != null;
            return hasBadChars && typeof encodeURIComponent != UNDEF ? encodeURIComponent(s) : s;
        }
        
        return {
            /* Public API
                        - Reference: http://code.google.com/p/swfobject/wiki/documentation
                */ 
            ua: ua,
            
            getFlashPlayerVersion: function() {
                return { major:ua.pv[0], minor:ua.pv[1], release:ua.pv[2] };
            },
            
            addDomLoadEvent: addDomLoadEvent,
            
            addLoadEvent: addLoadEvent,
            
            getQueryParamValue: function(param) {
                var q = doc.location.search || doc.location.hash;
                if (q) {
                    if (/\?/.test(q)) { q = q.split("?")[1]; } // strip question mark
                    if (param == null) {
                        return urlEncodeIfNecessary(q);
                    }
                    var pairs = q.split("&");
                    for (var i = 0; i < pairs.length; i++) {
                        if (pairs[i].substring(0, pairs[i].indexOf("=")) == param) {
                            return urlEncodeIfNecessary(pairs[i].substring((pairs[i].indexOf("=") + 1)));
                        }
                    }
                }
                return "";
            }
        };
}();
function log(msg) {
    window.atlog && window.atlog(msg);
}

function on(elem, type, eventHandle) {
    if ( elem.addEventListener ) {
        elem.addEventListener( type, eventHandle, false );

    } else if ( elem.attachEvent ) {
        elem.attachEvent( "on" + type, eventHandle );
    }
}

// getObjProp('globalInviteWindow.accept') => window['globalInviteWindow']['accept'];
function getObjProp(fs, root) {
    var props = fs.split('.'), env = root || window;
    while (props.length>1) {
        env = env[props.shift()];
    }
    return env[props[0]];
}

/* 
 * hookfunc('openChat', function() {
 *     adpConvert('NTE4',1);
 * });
 * */
function hookfunc(function_name, insert, bind) {
    bind = bind || window;
    func = getObjProp(function_name, bind);
    if (!func) {
        setTimeout(function() {
            hookfunc(function_name, insert, bind);
        }, 300);
    } else {
        var old = func;
        var new_func = function() {
            old.apply(bind, arguments);
            insert.apply(bind, arguments);
        };
        var change = "['" + function_name.split('.').join("']['") + "']";
        change = 'window' + change + ' = new_func;';
        // log(change);
        eval(change);
        // func = new_func;
    }
}

// Write/Read Cookie
function cookie(key, value, options) {
    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = options || {
            path: '/',
            expires: 1
        };
        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : encodeURIComponent(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

        // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
var args = location.search.match(/\??(.*)/)[1],
    tracker = new Image();

var ua = swfobject.ua, 
    cookie_prefix = '_at_',
    map = {
        mc: 'adcad', sc: 'adsub', ma: 'aduid', st: 'adsid'
    },

    meta = {
        sw: function() { return screen.width; },
        sh: function() { return screen.height; },

        ww: function() { 
            return findDimensions('Width'); 
        },
        wh: function() { return findDimensions('Height'); },

        // 页面宽度
        pw: function() { return document.body.scrollWidth; },
        // 页面高度
        ph: function() { return document.body.scrollHeight; },

        co: function() {
            return navigator.appName=="Netscape" 
                ? screen.pixelDepth 
                : screen.colorDepth;
        },
        fl: function() {
            return [ ua.pv[0], ua.pv[1], ua.pv[2] ].join('.');
        },
        ck: function() { 
            return navigator.cookieEnabled?'1':'0';
        },
        ja: function() { 
            return navigator.javaEnabled()?'1':'0';
        },
        rf: function() { 
            return document.referrer;
        },
        pn: function() { 
            var num = window.ActiveXObject ? window.ActiveXObject.length : navigator.plugins.length;
            return num;
        },
        ca: function() { 
            return document.charset || document.characterSet; 
        },

        sn: function() {
            var wh = getMeta('wh'), ph = getMeta('ph'), n = 0;
            if (wh > 0 && ph > 0) {
                n = Math.ceil(Math.ceil(ph / wh) * (meta.my / ph));
            }
            return n;
        },
        
        tz: -1 * (new Date().getTimezoneOffset() / 60)
    };

// 得到一个参数，先查找 url GET，然后查找 cookie。找到后存入 cookie
function getParm(key) {
    var value = swfobject.getQueryParamValue(map[key]), ck = cookie_prefix + key;
    if (!value) {
        value = cookie(ck);
    } else {
        cookie(ck, value);
    }
    return value;
}

// 得到通过点击广告过来的参数，包括渠道，推广，站点ID
function getADParms() {
    for(var key in map) {
        meta[key] = getParm(key);
    }
}

// 计算窗口尺寸
function findDimensions(dir) {
    var s = 0;
    if(window['inner'+dir])
        s = window['inner'+dir];
    else if((document.body)&&(document.body['client'+dir]))
        s = document.body['client'+dir];
    
    /*nasty hack to deal with doctype swith in IE*/
    if(document.documentElement && document.documentElement['client' + dir]) {
        s = document.documentElement['client' + dir];
    }
    return s;
}

// 从数据模型中得到指定值
function getMeta(key) {
    var val = meta[key],
        t = typeof val,
        value = (t === 'function' ? val() : val);
    return value;
}

// 从数据模型中查询到指定值并组成查询字符串
function query(words) {
    var keys = words.split(','), result = [];
    for (var i = 0, n = keys.length; i < n; i++) {
        var key = keys[i];
        result.push(key + '=' + encodeURIComponent(getMeta(key)));
    }
    return result.join('&');
}

// function serialize() {
//     var a = [];
//     for (key in meta) {
//         a.push(key + '=' + meta[key]);
//     }
//     return '?' + a.join('&') + (args.length ? '&' + args : '') + '&' + Math.random();
// }

function mxmy(x, y) {
    meta.mx = x;
    meta.my = y;
    // log(query('sw,sh,ww,wh,pw,ph,co,fl,ck,ja,rf,pn,ca,tz,mx,my,sn'));
}

on(document, 'mousemove', function(event) {
    if (event.pageX == null) {
        // IE case
        var d= (document.documentElement && 
                document.documentElement.scrollLeft != null) ?
            document.documentElement : document.body;
        docX= event.clientX + d.scrollLeft;
        docY= event.clientY + d.scrollTop;
        mxmy(docX, docY);
    } else {
        // all other browsers
        docX= event.pageX;
        docY= event.pageY;
        mxmy(docX, docY);
    }
});

// adpConvert('NTE4',1);
S.transform = function(tid) {
    var cfg = S.config;
    meta.st = cfg.site_id;
    meta.tf = tid;
    var url = cfg.host + cfg.trans_api + '?' + query('sw,sh,ww,wh,pw,ph,co,fl,ck,ja,rf,pn,ca,tz,mx,my,sn,st,tf');
    url += '&v=' + new Date().valueOf();
    log(url);
    // alert(url);
    tracker.src = url;
};

S.order = function(oid) {
    var cfg = S.config;
    meta.st = cfg.site_id;
    meta.od = oid;
    var url = cfg.host + cfg.order_api + '?' + query('od,mc,sc,ma,st');
    url += '&v=' + new Date().valueOf();
    log(url);
    tracker.src = url;
};

function main() {
    getADParms();
    var cfg = S.config;
    if (cfg.order) {
        S.order(cfg.order_id);
        log('订单模式开启');
    }
    if (cfg.trans && cfg.trans_hook) {
        hookfunc(cfg.trans_hook, function() {
            log('执行转化跟踪');
            S.transform(cfg.trans_id);
        });
        log('转化模式开启');
    }
}

swfobject.addLoadEvent(main);
window.atlog = function(msg) {
    // console && console.log && console.log(msg);
    var ac = document.getElementById('at-console');
    if(ac) ac.innerHTML += '<br />' + msg;
    // console.log(msg);
};

swfobject.addLoadEvent(function() {
    log(S.config);
    log(query('sw,sh,ww,wh,dw,dh,co,fl,ck,ja,rf,pn,ca,tz'));
    cookie('ad_test', 1);
    log(cookie('ad_test'));
});

S.hookfunc = hookfunc;
S.on = on;
})(this, 'At');
