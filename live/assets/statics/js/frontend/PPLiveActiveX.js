/**
 * PPLive ActiveX detection and embed
 *
 * file: PPLiveActiveX.js
 * version: 1.0.3.0
 * create: 2008-09-23
 * last modify: 2008-09-25
 * author: fdreamShi@pplive.com
 * 
 */

var PPLiveActiveX = function(options) {
    var _installed = false, _tipsIn = false, _hasBindInstallEvent = false;

    // 用来保存用户设置的宽和高
    var _width = '100%', _height = '100%';

    // related dom and html codes
    var _playerDom = null, _playerHtml = '', _installTips = '';

    // 获取用户设置
    var _onReady = options.ready ? options.ready : function() { };
    var _onInstall = options.installing ? options.installing : function() { };
    var _checkInterval = options.checkInterval ? options.checkInterval : 3000;
    var _readyInterval = options.readyInterval ? options.readyInterval : 200;

    // 内部类 Settings
    // 用来保存相关设置
    var Settings = function() {
        this.initSettings = {};

        this.set = function(name, value) {
            this.initSettings[name] = value;
            return this;
        };

        this.setProperties = function(options) {
            for (var p in options) {
                this.set(p, options[p]);
            }
        };

        this.get = function(name) {
            var ret = this.initSettings[name];
            ret = ret ? ret : '';
            return ret;
        };
    };

    // 设置默认属性
    var attributeMan = new Settings();
    attributeMan.setProperties({
        'id': 'PPLivePlayerActiveX',
        'width': '1px', 		// used to hide activeX
        'height': '1px', 	    // used to hide activeX
        'codebase': 'http://dl.pplive.com/PluginSetup.cab'
    });

    // 设置默认参数
    var paramMan = new Settings();
    paramMan.setProperties({
        'logourl': 'http://res.pplive.com/ikan/0529/player/ikan_logo.jpg',
        'dbclicktofullscreen': true,
        'showcontextmenu': true,
        'showstateinfo': true,
        'showchannelname': true,
        'showplayerbuffer': true,
        'showdownloadbuffer': true,
        'showdownloadrate': true,
        'showplaycontroller': true,
        'showplayprogress': true,
        'showloadingad': true,
        'showadcountdown': true,
        'adcfgurl': '',
        'enableupdate': 'true',
        'enableupdatetip': 'true',
        'updateurl': ''
    });

    // 初始化用户设置的参数
    if (options != null) {
        var props = options.properties;
        for (var p in props) {
            switch (p.toLowerCase()) {
                case 'id':
                    attributeMan.set('id', props[p]);
                case 'width':
                    _width = props[p];     // 保存用户设置值
                    //attributeMan.set('width', props[p]);
                    break;
                case 'height':
                    _height = props[p];     // 保存用户设置值
                    //attributeMan.set('height', props[p]);
                    break;
                case 'codebase':
                    attributeMan.set('codebase', props[p]);
                    break;
                default:
                    p = p.toLowerCase();
                    paramMan.set(p, props[p]);
                    break;
            }
        }

        var params = options.params;
        for (var p in params) {
            paramMan.set(p.toLowerCase(), params[p]);
        }
    }

    ///<summary>
    /// 单独设置播放器的属性（Attribute），返回当前对象（PPLiveActiveX）
    ///</summary>
    ///<param name="name" type="String">attribute的名称，例如：showcontextmenu</param>
    ///<param name="value" type="String">attribute的值，例如：true</param>
    ///<returns type="PPLiveActiveX" />
    this.setAttribute = function(name, value) {
        attributeMan.set(name.toLowerCase(), value);
        return this;
    };

    ///<summary>
    /// 批量设置播放器的属性（Attribute），返回当前对象（PPLiveActiveX）
    ///</summary>
    ///<param name="attributes" type="Object">一个对象，包含attribute的名称和值，例如{width: 400, height: 120}</param>
    ///<returns type="PPLiveActiveX" />
    this.setAttributes = function(attributes) {
        for (var a in attributes) {
            attributeMan.set(a.toLowerCase(), attributes[a]);
        }
        return this;
    };

    ///<summary>
    /// 单独设置播放器的参数（Param），返回当前对象（PPLiveActiveX）
    ///</summary>
    ///<param name="name" type="String">param的名称，例如：showcontextmenu</param>
    ///<param name="value" type="String">param的值，例如：true</param>
    ///<returns type="PPLiveActiveX" />
    this.setParam = function(name, value) {
        paramMan.set(name.toLowerCase(), value);
        return this;
    };

    ///<summary>
    /// 批量设置播放器的参数（Param），返回当前对象（PPLiveActiveX）
    ///</summary>
    ///<param name="params" type="Object">一个对象，包含param的名称和值，例如{showcontextmenu: true, showstateinfo: true}</param>
    ///<returns type="PPLiveActiveX" />
    this.setParams = function(params) {
        for (var p in params) {
            paramMan.set(p.toLowerCase(), params[p]);
        }
        return this;
    };

    /**********************************
    * 生成播放器的HTML代码
    * 由于不知道是IE还是OCX的bug
    * 不能隐藏OCX，必须让其一直显示，
    * 否则可能造成OCX被销毁的情况，
    * 只好讨巧设置OCX的宽和高为1px
    * 用来隐藏播放器，以显示安装提示
    **********************************/
    function getHtml() {
        var pplString = ['<object classid="CLSID:ef0d1a14-1033-41a2-a589-240c01edc078"'];
        // add attributes
        for (var a in attributeMan.initSettings) {
            pplString.push([' ', a, '="', attributeMan.get(a), '"'].join(''))
        }
        pplString.push('>');

        // add params
        for (var p in paramMan.initSettings) {
            pplString.push(['<param name="', p, '" value="', paramMan.get(p), '">'].join(''));
        }

        pplString.push('</object>');

        return pplString.join('');
    }

    ///<summary>
    /// 把播放器代码写入页面内，返回当前对象（PPLiveActiveX）
    ///</summary>
    ///<param name="dom" type="Object">要写入到的HTML DOM的ID或者HTML DOM对象</param>
    ///<returns type="PPLiveActiveX" />
    this.write = function(dom) {
        // get dom object
        if (typeof (dom) == 'string') {
            _playerDom = document.getElementById(dom);
        }
        else {
            _playerDom = dom;
        }

        // if is not IE, don't check activex
        if (navigator.userAgent.search('MSIE') <= 0) {
            _playerDom.innerHTML = '<p style="text-align:left;text-indent:2em;line-height:20px;">对不起，目前PPLive网页插件（98KB）暂不支持Firefox、Opera等浏览器，请使用IE观看，谢谢^_^</p>';

            return;
        }

        _installTips = _playerDom.innerHTML;
        _playerHtml = getHtml();

        _playerDom.innerHTML = _playerHtml;

        _checkInstalled();

        return this;
    };

    ///<summary>
    /// 获取播放器实例，返回Object
    ///</summary>
    ///<returns type="Object" />
    this.getPlayer = function() {
        return _player;
    };

    function _checkInstalled() {
        _player = document.getElementById(attributeMan.get('id'));
        //_player.style.display = 'none';

        if ((_player || 0).IsReady != undefined) {
            // show player
            this.installed = true;
            //_playerDom.innerHTML = _playerHtml;
            //_player = document.getElementById(attributeMan.get('id'));
            //_player.style.display = 'block';
            while (_playerDom.children.length > 1) {
                var temp = _playerDom.removeChild(_playerDom.children[0]);
                delete temp;
            }
            _player.style.width = _width;
            _player.style.height = _height;

            _checkReady();
        }
        else {
            // check it again
            if (!_tipsIn) {
                _playerDom.innerHTML = _installTips + _playerHtml;
                _tipsIn = true;
            }
            setTimeout(_checkInstalled, _checkInterval);
        }
    }

    // 检测播放器初始化情况
    function _checkReady() {
        if (_player.IsReady) {
            // fire ready event
            // with current player instance
            _onReady(_player);
        }
        else if (_player.IsReady != undefined && !_hasBindInstallEvent) {
            _player.onFrameInstall = _checkProgress;
            _hasBindInstallEvent = true;
            setTimeout(_checkReady, _readyInterval);
        }
        else {
            setTimeout(_checkReady, _readyInterval);
        }
    }

    // 安装进度控制
    function _checkProgress(status, percent) {
        try {
            // fire installing event
            // with status and percent
            _onInstall(status, percent);
        }
        catch (e) {
        }
    }

    return this;
};