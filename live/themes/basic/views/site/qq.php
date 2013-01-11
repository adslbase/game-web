<?php if(empty($stream)):?>
<p>暂未开通</p>
<?php else :?>
<script language="javascript" src="http://live.marstv.com/qqlive.min.js" charset="utf-8"></script>
<script language="javascript">

    var qqliveobj = new QQLiveObject(<?php echo $width; ?>, <?php echo $height ;?>); //宽度,高度 
	//qqliveobj.addParam("url", "qqlive://sso/vbarid=d7rzdcj99cfb83c&videoid=8RfiEQXqHTY"); //点播播放视频地址
	qqliveobj.addParam("url", "qqlive://sso/projectid=<?php echo $stream ?>"); //直播播放频道地址
	qqliveobj.addParam("autoplay", "1"); //是否自动播放
	qqliveobj.addParam("type", "1"); //播放类别 1是直播 2是点播
	//qqliveobj.addParam("appendpausebtn", "0"); //暂停时是否在播放画面上显示暂停按钮
	//qqliveobj.addParam("hidectrl", "0"); //是否隐藏控制栏
	//qqliveobj.addParam("mute", "0"); //是否默认静音
	//qqliveobj.addParam("WebSkin", "local://webskin/bbweb.xml"); //皮肤设置为白色皮肤
	//qqliveobj.addParam("PreviewPic", "http://live.qq.com/demo/player/cover.jpg"); //默认预览图片（autoplay设置为true时无效）
	//qqliveobj.addParam("loadingurl","http://imgcache.qq.com/liveportal_v1/swf/video_loading.swf"); //默认的loading动画
	//qqliveobj.addParam("ctrlbar","http://imgcache.qq.com/liveportal_v1/swf/vodCtrl_TencentPlayer.swf");
	qqliveobj.play("play");

	//qqliveobj.bindCall(QQLiveSetup.DEFINE.EVENT.LOADSTART,function(v){alert("当前播放节目的id是:"+v)});
	//无刷新切换播放节目的demo
	function playmoive(url) {
		qqliveobj.getCtrl().Play(url);
	}
</script>
    
    <?php endif ;?>
