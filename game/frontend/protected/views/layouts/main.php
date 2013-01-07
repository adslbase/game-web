<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);
?>

<?php $this->renderPartial('//layouts/header', array('layout_asset' => $layout_asset)); ?>     
<body>
        <?php echo $content ?>
        

        
        
        
        <div style=" text-align: center; color: red; font-size:18px; font-weight: bold; margin-bottom: 15px;" class="wp">
                抵制不良游戏&nbsp; 拒绝盗版游戏 &nbsp;  注意自我保护&nbsp; 谨防受骗上当&nbsp; &nbsp; &nbsp; &nbsp; 
                适度游戏益脑&nbsp; 沉迷游戏伤身&nbsp; 合理安排时间&nbsp;  享受健康生活
                
        </div>
<div id="footer">
	<div id="footer_cont" class="wp">
    	<h3 id="footer_logo"></h3>
        <div id="copyright">
        	<ul>
                <li><a href="<?php echo  $this->createUrl('object/duty')?>" title="">免责声明</a></li>
                <li><a href="<?php echo  $this->createUrl('object/business')?>" title="">商务合作</a></li>
               
                <li><a href="<?php echo $this->createUrl('object/privacy') ?>" title="">用户协议</a></li>
                  <li><a href="<?php echo $this->createUrl('object/contact') ?>" title="">联系我们</a></li>
            </ul>
                <p>上海耀宇文化传媒有限公司版权所有&nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:;" title="">沪ICP备12001511号-1</a></p>
        </div>
    </div>
</div>
<!--footer end-->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fdc897021670515f24f6188b81be5a3c2' type='text/javascript'%3E%3C/script%3E"));
</script>

</body>
</html>
