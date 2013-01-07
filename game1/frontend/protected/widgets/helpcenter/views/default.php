
        <ul class="mgB10">

                <?php foreach ($news as $new): ?>

                        <li><a href="<?php echo  $this->createUrl('object/view', array('id' => $new['object_id']),array()) ?>" target="_blank"><?php echo $new['object_name'] ?></a></li>

                <?php endforeach; ?>
        </ul>
