window.onload = function () {
    var oAside = document.getElementsByTagName('aside')[0];
    var oHeader = document.getElementsByTagName('header')[0];
    var clientY = document.documentElement.clientHeight;
    var oMain = document.getElementById("main");
    oMain.style.marginTop = clientY + 'px';
    // console.log(oMain.style.top);
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
        }
    }
}