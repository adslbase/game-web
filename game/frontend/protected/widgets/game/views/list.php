<?php

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_'.$template,
    'itemsTagName' => 'div',
    'template' => '{items} {pager}'
));
?>          

