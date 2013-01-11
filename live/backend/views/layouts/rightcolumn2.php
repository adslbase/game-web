<?php
    $cs = Ycms::app()->getClientScript();
 
    $cs->registerCssFile(YHtml::cssUrl('reset.css'));
    $cs->registerCssFile(YHtml::cssUrl('backend/content.css'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>

    <body>
        <div id="main" class="col2 clearfix">
            <div id="branding" class="clearfix">
                <div class="breadcrumb">
                    <?php $this->renderPartial('//layouts/breadcrumb', array('data' => $this->getBreadcrumb())); ?>
                </div>              
            </div>

            <div class="f-left aside">
                <?php echo $content ?>
            </div>
            <div class="content">
                <iframe name="right" id="rightMain" src="<?php echo $this->createUrl('link/list', array('mid' => $_GET['mid'])) ?>" width="100%" allowtransparency="true" height="100%"></iframe>
            </div>
        </div>
    </body>
</html>