<?php
	$baseurls = FULL_BASE_URL.$this->base;
	//pr($ride);
	
?>
<div class="creatTol">
	<h2>Ride Details</h2>
	<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass2'))?>

	<div class="techerTable dltotal">
		<h3>Basic Info</h3>
		<dl>
			<dt class="dhleft"><?php echo __('Pickup Address'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['Ride']['pick_up']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Dropoff Address'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['Ride']['drop_off']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Ride Now Or Later'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php
					if($ride['Ride']['ride_type']==1){
						echo "Later";
					}
					else{
						echo "Now";
					}
				?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Date & Time'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['Ride']['date_time']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Payment Mode'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php
					if($ride['Ride']['payment_option']==1){
						echo "Credit Card";
					}
					else{
						echo "Cash";
					}
				?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Ride Cost'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo "$".h($ride['Ride']['distance_cost']);?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Current Status'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php
					$status = h($ride['Ride']['status']);
					if($status==1){
						echo "Driver Assign";
					}
					elseif($status==2){
						echo "Driver On Way";
					}
					elseif($status==3){
						echo "Trip Started";
					}
					elseif($status==4){
						echo "Trip Completed";
					}
					elseif($status==5){
						echo "Trip Cancelled";
					}
					else{
						echo "Driver Not Assign";
					}
				?>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
		
		<h3>Customer Info</h3>
		<dl>
			<dt class="dhleft"><?php echo __('Username'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['User']['username']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Full Name'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['User']['f_name']).' '.h($ride['User']['l_name']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Profile Image'); ?></dt>
			<dd class="dhright">
				&nbsp;<?php
					if(isset($ride['User']['CustomerCustom']['user_image']) && $ride['User']['CustomerCustom']['user_image']!=''){
						echo "<img width='100' height='100' src='".$baseurls."/userPic/".$ride['User']['CustomerCustom']['user_image']."'/>";	
					}
					else{
						echo "<img width='100' height='100' src='".$baseurls."/img/noimg.png'/>";
					}
				?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Email'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['User']['email']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Reg Date'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['User']['reg_date']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
		<h3>Driver Info</h3>
		<dl>
			<dt class="dhleft"><?php echo __('Username'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['Driver']['username']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Full Name'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['Driver']['f_name']).' '.h($ride['Driver']['l_name']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Profile Image'); ?></dt>
			<dd class="dhright">
				&nbsp;<?php
					if(isset($ride['Driver']['DriverCustom']['user_pic']) && $ride['Driver']['DriverCustom']['user_pic']!=''){
						echo "<img width='100' height='100' src='".$baseurls."/userPic/".$ride['Driver']['DriverCustom']['user_pic']."'/>";	
					}
					else{
						echo "<img width='100' height='100' src='".$baseurls."/img/noimg.png'/>";
					}
				?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Email'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['Driver']['email']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Reg Date'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['Driver']['reg_date']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
		<h3>Transaction Info</h3>
			<?php
				if($ride['Ride']['payment_option']==1){
			?>
		<dl>
			<dt class="dhleft"><?php echo __('Card Number'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['CreditCard']['credit_card_no']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Name On Card'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($ride['CreditCard']['holdername']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Expiry On'); ?></dt>
			<dd class="dhright">
				&nbsp;<?php echo h($ride['CreditCard']['expirydate']);?>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
			<?
				}
				else{
			?>
		<dl>
			<dt class="dhleft"><?php echo __('Mode'); ?></dt>
			<dd class="dhright">: Cash</dd>
			<div class="clr"></div>
		</dl>
			<?
				}
			?>
		<h3>Vehicle Info</h3>
			<?php
				if($ride['Ride']['status']==4){
					
					echo ($ride['Ride']['vehicleinfo']!='')?$ride['Ride']['vehicleinfo']:'NA';
				}
				else{
					$vdtls = '';
					if(isset($ride['Driver']['VehicleDetail']['id'])){
						$vdetails = $ride['Driver']['VehicleDetail'];
						$vdtls = $vdetails['id']."-".$vdetails['vehicle_no'];
					}
					echo $vdtls;
				}
			?>
	</div>
</div>

