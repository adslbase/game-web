Tools = {
    extend: function (target, src) {
        for (var it in src) {
            target[it] = src[it];
        }
        return target;
    },
    cloneArray: function (array) {
        var new_array = array.slice(0);
        return new_array;
    },
    getObjByID: function (list, id) {
        var index;
        $.each(list, function (i, data) {
            if (data.id == id) { index = i; return false }
        })
        return list[index]
    },
    getObjIndexByID: function (list, id) {
        var index;
        $.each(list, function (i, data) {
            if (data.id == id) { index = i; return false }
        })
        return index
    },
    getObjByUrl: function (list, url) {
        url = url.toLowerCase();
        var index;
        $.each(list, function (i, data) {
            url = url.replace("http://", "").replace("https://", "");
            if (url.indexOf(data.url.toLowerCase().replace("http://", "").replace("https://", "")) == 0) {
                index = i;
                return false;
            }
        })
        return list[index];
    },
    delObjByID: function (list, id) {
        var index = Desktop.Tools.getObjIndexByID(list, id);
        list.splice(index, 1);
    },
    getWinPos: function (obj) {
        var pos = {}
        pos.width = $(obj).width();
        pos.height = $(obj).height();
        return pos;
    },
    queryString: function (key) {
        var re = new RegExp("[?&]" + key + "=([^&$]*)", "i");
        var offset = window.location.search.search(re);
        if (offset == -1) return "";
        return RegExp.$1;
    },
    queryUrlString: function (url, key) {
        var re = new RegExp("[?&]" + key + "=([^&$]*)", "i");
        var offset = url.search(re);
        if (offset == -1) return "";
        return RegExp.$1;
    },
    getStringKey: function (url, key) {
        if (key == "url" && url.indexOf("url=") >= 0) {
            return url.substring(url.indexOf("url=") + 4);
        }
        else {
            var re = new RegExp("[\W]?" + key + "=([^&$]*)", "i");
            var offset = url.search(re);
            if (offset == -1) return "";
            return RegExp.$1;
        }
    },
    getTypeByAppId: function (id) {
        var strArray = id.split('__');
        if (strArray.length >= 2) {
            return strArray[1];
        }
        else {
            return "";
        }
    },
    getSiteHost: function () {
        return window.location.protocol + "//" + window.location.host;
    },
    getSiteHome: function () {
        var sitehost = Desktop.Tools.getSiteHost();
        return sitehost + "/home.aspx";
    },
    isLocalTransfer: function (urlreferer) {
        urlreferer = urlreferer.toLowerCase();
        var sitehome = Desktop.Tools.getSiteHome();
        if (urlreferer == sitehome ||
                urlreferer == sitehome + "?referrer=client" ||
                urlreferer.indexOf("/login.aspx") > 0)
            return true;
        else
            return false;
    },
    Game_Online: function(gameAbb){
        if ($.cookie("AID")) {
            var value = gameAbb + "_" + Tools.queryString("server");
            window.setTimeout(function () {
                ubsLogger.clickLog("Game_Online", value);
            }, 15 * 1000);
            window.setInterval(function () {
                ubsLogger.clickLog("Game_Online", value);
            }, 15 * 60 * 1000);
        }
    }
}