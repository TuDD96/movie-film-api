// detect Platform
const is_OSX = /(Mac|iPhone|iPod|iPad)/i.test(navigator.platform);
const is_iOS = /(iPhone|iPod|iPad)/i.test(navigator.platform);
const is_Mac = navigator.platform.toUpperCase().indexOf("MAC") >= 0;
const is_iPhone = navigator.platform == "iPhone";
const is_iPod = navigator.platform == "iPod";
const is_iPad = navigator.platform == "iPad";

// detect Browser
const isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
const isFirefox = typeof InstallTrigger !== 'undefined';
const isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && window['safari'].pushNotification));
const isIE = /*@cc_on!@*/false || !!document.documentMode;
const isEdge = !isIE && !!window.StyleMedia;
const isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
const isEdgeChromium = isChrome && (navigator.userAgent.indexOf("Edg") != -1);
const isBlink = (isChrome || isOpera) && !!window.CSS;

var mMedia = window.matchMedia("(max-width: 767px)");
function resizeCardChangPasswordSafari(mMedia) {
    const cardChangePassword = document.querySelector(".card-change-password");
    if (mMedia.matches) {
        cardChangePassword.style.height = cardChangePassword.clientHeight + 60 + "px";
    } else {
        cardChangePassword.style.height = cardChangePassword.clientHeight - 60 + "px";
    }
}


if (!is_OSX) {
    console.log("This NOT a Mac or an iOS Device!");
}
if (is_Mac) {
    const btnRej = document.querySelectorAll(".btn.btn-danger.reject");
    console.log(isSafari);
    if (isSafari) {
        btnRej.forEach(element => {
            element.style.marginBottom = "-2px";
        });
        if ($(window).width() <= 767) {
            resizeCardChangPasswordSafari(mMedia);
        }
        mMedia.addListener(resizeCardChangPasswordSafari);
        $("table td .btn__pri-custom").attr("style", "line-height: 18px !important");
    } else {
        const btnRejInden = document.querySelectorAll(".rej-inden");
        btnRejInden.forEach(element => {
            element.style.marginBottom = "1px";
        });
    }
}
if (is_iOS) {
    console.log("You're using an iOS Device!\n");
}
if (is_iPhone) {
    console.log("This is an iPhone!");
}
if (is_iPod) {
    console.log("This is an iPod Touch!");
}
if (is_iPad) {
    console.log("This is an iPad!");
}
