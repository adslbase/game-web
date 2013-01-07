//设为首页
jQuery("#setHomepage").live("click", function () {
    if (document.all) {
        document.body.style.behavior = 'url(#default#homepage)';
        document.body.setHomePage(window.location.href);
    } else if (window.sidebar) {
        if (window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            } catch (e) {
                alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config，然后将项signed.applets.codebase_principal_support值该为true");
                return false;
            }
        }
        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
        prefs.setCharPref('browser.startup.homepage', window.location.href);
    } else {
        alert("您的浏览器不支持自动自动设置首页, 请使用浏览器菜单手动设置！");
    }
    return false;
    //event.preventDefault();
});

//加入收藏
jQuery("#addFavorite").live("click", function () {
    var sURL = encodeURI(window.location);
    var sTitle = document.title;
    try {
        window.external.addFavorite(sURL, sTitle);
    } catch (e) {
        try {
            window.sidebar.addPanel(sTitle, sURL, "");
        } catch (e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置。");
        }
    }
    return false;
});


function TimeFormat(jsondate, format) {
    var d = new Date(parseInt(jsondate.replace("/Date(", "").replace(")/", ""), 10));
    var themonth = d.getMonth() + 1 < 10 ? '0' + (d.getMonth()+1) : (d.getMonth() + 1);
    var thedate = d.getDate() < 10 ? '0' + d.getDate() : d.getDate();
    var thehour = d.getHours() < 10 ? '0' + d.getHours() : d.getHours();
    var themin = d.getMinutes() < 10 ? '0' + d.getMinutes() : d.getMinutes();
    var themsec = d.getSeconds() < 10 ? '0' + d.getSeconds() : d.getSeconds();
    var pubtime = themonth + '-' + thedate;
    switch (format) {
        case 'mm-dd':
            pubtime = themonth + '-' + thedate;
            break;
        case 'hh:mm':
            pubtime = thehour + ':' + themin;
            break;
        case 'yyyy-mm-dd':
            pubtime = d.getFullYear() + '-' + themonth + '-' + thedate;
            break;
        default:
            pubtime = d.getFullYear() + '-' + themonth + '-' + thedate + ' ' + thehour + ':' + themin + ':' + themsec;
            break;
    }
    return pubtime;
}


function setCookie(name, value) {
    var argv = setCookie.arguments;
    var argc = setCookie.arguments.length;
    var expires = (argc > 2) ? argv[2] : null;
    if (expires != null) {
        var LargeExpDate = new Date();
        LargeExpDate.setTime(LargeExpDate.getTime() + (expires * 1000 * 3600 * 24));
    }
    document.cookie = name + "=" + escape(value) + ((expires == null) ? "" : ("; expires=" + LargeExpDate.toGMTString())) + "; path=" + "/";
}

function getCookie(Name) {
    var search = Name + "=";
    if (document.cookie.length > 0) {
        offset = document.cookie.indexOf(search)
        if (offset != -1) {
            offset += search.length
            end = document.cookie.indexOf(";", offset)
            if (end == -1) end = document.cookie.length
            return unescape(document.cookie.substring(offset, end))
        }
        else return "";
    } else return "";
}

function delCookie(name) {
    var expdate = new Date();
    expdate.setTime(expdate.getTime() - (86400 * 1000 * 1));
    setCookie(name, "", expdate);
}


function getQueryString(name) { var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); var r = window.location.search.substr(1).match(reg); if (r != null) return unescape(r[2]); return null; }