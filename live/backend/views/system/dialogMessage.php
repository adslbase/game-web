<?php

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialogMessage',
    'themeUrl' => YHtml::cssUrl('jui'),
    'theme' => 'Absolution',
    'options' => array(
        'modal' => 'true',
        'title' => $msg['title'],
        'autoOpen' => true,
        'close'=>$msg['url']?"js:function() { location.href = '" . $msg['url'] . "'}":false,
    ),
    
));

printf('<span class="dialog">%s</span>', $msg['content']);

$this->endWidget('zii.widgets.jui.CJuiDialog');

