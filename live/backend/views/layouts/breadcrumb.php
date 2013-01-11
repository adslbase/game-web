<?php foreach ( $data as $value ):?>
        <?php if ( $value[ 'link' ] !== '' ):?>
                <a href='<?php echo $value[ 'link' ]?>' ><?php echo $value[ 'name' ]?></a> 
        <?php else:?>
                <?php echo $value[ 'name' ]?>
        <?php endif;?>
        > 
<?php endforeach;?>