<?php $this->widget('frontwidgets.artdialog.MArtdialog'); ?>
<script>
        var timer;
        art.dialog({
                content: '<?php echo $message;?>',
                lock: true,
                background: '#000', // 背景色
                opacity: 0.87,	// 透明度
                init: function () {
                        var that = this, i = <?php echo isset($time)?$time:5;?>;
                        var fn = function () {
                                that.title(i + '秒后进行跳转');
                                        !i && that.close();
                                i --;
                        };
                        timer = setInterval(fn, 1000);
                        fn();
                },
                close: function () {
                        clearInterval(timer);
                        location.href = "<?php echo $this->createUrl($route) ?>";
                }
        }).show();
</script>