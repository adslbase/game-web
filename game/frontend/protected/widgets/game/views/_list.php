	<div class="gcl_col">
            	<div class="gcl_pic">
                	<a href="<?php echo $this->createUrl('gamecenter/server',array('gameid'=>$data['object_id'])) ?>" title=""><img src="<?php echo $data['small_logo']?>" width="207" height="92" alt="" /><span><?php echo $data['object_name']?></span></a>
                </div>
                <div class="gcl_info">
                	<dl>
                    	<dt>类型：</dt>
                        <dd>角色扮演</dd>
                        <dt>状态：</dt>
                        <dd><a href="<?php echo $data['service_url']?>" title=""><?php echo $data['new_service']?></a></dd>
                    </dl>
                    <ul>
                    	<li><a href="<?php echo $this->createUrl('sign/up') ?>" title="">注册</a>|</li>
                        <li><a href="<?php echo $data['site_url'] ?>" title="">官网</a>|</li>
                        <li><a href="<?php echo $this->createUrl('payway/game', array('gameid' => $data['object_id'])); ?>" title="">充值</a></li>
                        <li><a href="<?php echo $data['service_url']?>" title="" class="gcl_in">进入游戏</a></li>
                    </ul>
                </div>
            </div>