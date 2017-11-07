window.onload = function () {
    var oAside = document.getElementsByTagName('aside')[0];
    var oHeader = document.getElementsByTagName('header')[0];
    var clientY = document.documentElement.clientHeight;
    console.log(document.documentElement.clientHeight);
    var oMain = document.getElementById("main");
    var oBaseInfo = document.getElementById("base_info");
    var scrollTarget = clientY - (oBaseInfo.children.length + 1) * 23 - 34;
    var timer = null;
    oMain.style.marginTop = clientY + 'px';
    oAside.timer = null;
    window.onmousewheel = function (e) {
        e = e || event;
        if (parseInt(getComputedStyle(oAside).top) == 0 && e.wheelDelta < 0) {
            oHeader.getElementsByTagName('h1')[0].style.display = 'block';
            if (oAside.timer === null) {
                var go = function go() {
                    oAside.style.top = parseInt(getComputedStyle(oAside).top) * 10 / 8 - 1 + 'px';
                    clearTimeout(oAside.timer);
                    oAside.timer = null;
                    if (parseInt(getComputedStyle(oAside).top) <= -clientY) {
                        oAside.style.top = -clientY + 'px';
                        return;
                    }
                    oAside.timer = setTimeout(go, 10);
                }
                oAside.timer = setTimeout(go, 10);
            }
            if (timer === null && document.documentElement.scrollTop == 0) {
                var scrollTemp = scrollTarget;
                var scrollNow = 0;
                var scroll = function scroll() {
                    scrollNow = (scrollTarget - scrollNow) * 0.05 + 1;                    
                    document.documentElement.scrollTop += scrollNow;
                    console.log(document.documentElement.scrollTop);
                    clearTimeout(timer);
                    timer = null;
                    if (document.documentElement.scrollTop >= scrollTarget) {
                        document.documentElement.scrollTop = scrollTarget;
                        return false;
                    }
                    timer = setTimeout(scroll, 10);
                    return false;
                }
                timer = setTimeout(scroll, 10);
            }
            return false;
        } else if (parseInt(getComputedStyle(oAside).top) == -clientY && e.wheelDelta > 0) {
            if (oAside.timer === null) {
                var go = function go() {
                    oAside.style.top = parseInt(getComputedStyle(oAside).top) * 0.8 + 1 + 'px';
                    clearTimeout(oAside.timer);
                    oAside.timer = null;
                    if (parseInt(getComputedStyle(oAside).top) >= 0) {
                        oAside.style.top = 0 + 'px';
                        oHeader.getElementsByTagName('h1')[0].style.display = 'none';
                        return;
                    }
                    oAside.timer = setTimeout(go, 10);
                }
                oAside.timer = setTimeout(go, 10);
            }
            return false;
        }
    }
}