<style>
        .order-content span{ float: left; width: 200px; text-align: right; margin-right: 10px;}

</style>

<div class="order-content">
        <p>
                <span>订单号：</span><?php echo $order->trade_sn; ?>
        </p>

        <p>
                <span> 用户名：</span><?php echo $order->username; ?>
        </p>

        <p>
                <span>  订单添加时间：</span><?php echo date('Y-m-d H:i:s', $order->addtime); ?>
        </p>

        <p>
                <span>  订单状态变更时间：</span><?php echo date('Y-m-d H:i:s', $order->paytime); ?>
        </p>

        <p>
                <span>  支付手段：</span><?php echo $order->payname; ?>
        </p>

        <p>
                <span> 游戏名：</span><?php echo $order->gamename; ?>
        </p>

        <p>
                <span> 服务器：</span><?php echo $order->servername; ?>
        </p>
        <p>
                <span> 支付IP：</span><?php echo $order->ip; ?>
        </p>
        
              <p>
                <span> 当前订单状态：</span><?php echo ConstantDefine::getOrderStatus($order->status); ?>
                
                
        </p>
        
        
        
        <?php echo CHtml::form()?>
         <p>
                 <span>修改订单状态：</span>
                <?php echo CHtml::dropDownList('status', $order->status, ConstantDefine::getOrderStatus());?>
                 
                 <?php echo CHtml::hiddenField('oldstatus', $order->status);?>
                 
                 请不要随便修改订单状态，后果自负！你的修改将会记录在后台数据中！
          </p>
         
          <p>
                  <span><?php echo CHtml::submitButton('提交')?></span>
          </p>
          
        <?php echo CHtml::endForm()?>
        
        
        
</div>