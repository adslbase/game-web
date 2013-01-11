<!DOCTYPE html PUBLIC
    "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>错误 <?php echo $data['code']; ?></title>

        <style type="text/css">
            html,body {font-family:"Verdana";font-weight:normal;height: 100%;margin: 0; padding: 0;overflow: hidden; position: relative}
            h5{ color: red}
            #bg{ clear: both; height: 100%; position: absolute; z-index: 0; width: 100%}
            .col{  float: left; height: 100%; }
            .white{ background: white; width: 13%;}
            .yellow{ background: yellow; width: 13%;}
            .turquoise{background: turquoise; width: 13%;}
            .green{background: green; width: 13%;}
            .magenta{background:  magenta;width:12%;}
            .red{ background: red;width:12%;}
            .blue{background: blue;width:12%;}
            .black{background: black;width:12%;}
            #content{ position: absolute; top: 30%; left: 25%;height: 40%; z-index: 1000; clear: both;}
            .info{ float:left; border: 3px solid #000; border-right:0;background: #fff;height: 274px; padding: 10px;}
            img{width: 300px; height: 300px; float: left}
        </style>
    </head>

    <body>
        <div id ="content">
            <div class="info">
                <h4>错误 <?php echo $data['code'],' :' ?></h4>
                <h5><?php echo nl2br(CHtml::encode($data['message'])); ?></h5>
                <p>
                    当网页服务器处理您的请求时, 发生以上错误.
                </p>
                <p>
                    请与管理员联系 <?php echo $data['admin']; ?>.
                </p>
                <p>
                    谢谢.
                </p>
                <small><?php echo '错误页模板路径：<br>', __FILE__; ?></small>
            </div>
            <img src="style/images/error/404.gif" />
        </div>
        <div id ="bg">
            <div class="col white"></div>
            <div class="col yellow"></div>
            <div class="col turquoise"></div>
            <div class="col green"></div>
            <div class="col magenta"></div>
            <div class="col red"></div>
            <div class="col blue"></div>
            <div class="col black"></div>
        </div>
    </body>
</html>