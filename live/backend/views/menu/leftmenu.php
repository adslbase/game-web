 <ul>
<?php foreach ( $tree as $item ): ?>
     <li><a href="<?php echo Menu::getLink($item['route'], $item['param'], $item['external']) ?>" ><?php echo $item['name'] ?></a></li>
<?php endforeach ; ?>
</ul>

