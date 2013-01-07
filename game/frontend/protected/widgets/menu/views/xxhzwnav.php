<?php if (isset($menus)): ?>
        <ul>
                <?php if ($this->beginCache('menu-render-' . $this->menu_id, array('duration' => 7200))): ?>
                        <?php $i = 1; ?>
                        <?php foreach ($menus as $menu) : ?>	
                                <li><a href="<?php echo $menu['link']; ?>" class="i<?php echo $i ?> text_td">><?php echo $menu['name']; ?></a>
                                 <?php $i++; ?>
                                        
                                <?php endforeach; ?>
                                        
                                <?php $this->endCache(); ?> 
                        <?php endif; ?>
        </ul>
<?php endif; ?>