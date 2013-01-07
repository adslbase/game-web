  <li>
     <span class="date"><?php echo date('m-d',$data['object_date'])?></span>
	 <span class="leis">
	      [游戏]
	 </span>
	 <a href="<?php echo $this->createUrl('dxz/view',array('id'=>$data['object_id']))?>" class="zw" >
	     <?php echo $data['object_name']?>
     </a>
  </li>