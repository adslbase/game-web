<?php if (isset($menus)): ?>
<ul>
         <?php if ($this->beginCache('menu-render-' . $this->menu_id, array('duration' => 7200)))
                { ?>
        <?php foreach ($menus as $menu) : ?>	
                <li><a href="<?php echo $menu['link']; ?>" <?php echo isset($_GET['slug']) && $_GET['slug'] == $menu['link'] ? 'class="active"' : ''; ?>><?php echo $menu['name']; ?></a>
                <?php endforeach; ?>
           <?php $this->endCache();
                } ?>
</ul>
  <?php endif; ?>