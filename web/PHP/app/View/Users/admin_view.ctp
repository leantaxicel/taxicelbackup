<?php
	$baseurls = FULL_BASE_URL.$this->base;
	//echo $titalridedone;
	//pr($user);
?>
<div class="creatTol">
	<h2>
	<?php
		if($user_type==1){
			echo "Driver";
		}
		else{
			echo "Customer";	
		}
	?>
	 Details</h2>
	 <?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass2'))?>
	 
	<div class="techerTable dltotal">
		<h3>Basic Info</h3>
		<dl>
			<dt class="dhleft"><?php echo __('Username'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($user['User']['username']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Full Name'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($user['User']['f_name'])." ".h($user['User']['l_name']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Email'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($user['User']['email']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Phone No'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($user['User']['mobile']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Address'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($user['User']['address']); ?>
				&nbsp;
			</dd>
			
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Number Of Booked Ride'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($titalridedone); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Refferal Code'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($user['User']['my_refferal_code']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Current Credit'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo '$'.h($user['User']['currentcredit']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Reg. Date'); ?></dt>
			<dd class="dhright">
				<span style="padding: 0  10px 0 0;">:</span><?php echo h($user['User']['reg_date']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<?
				if($user_type==1){
					$image = (isset($user['DriverCustom']['user_pic']))?$user['DriverCustom']['user_pic']:'';
					$cityname = (isset($user['DriverCustom']['City']['name']))?$user['DriverCustom']['City']['name']:'';
				?>
				<dt class="dhleft"><?php echo __('Driving City'); ?></dt>
				<dd class="dhright">
					<span style="padding: 0  10px 0 0;">:</span><?php echo h($cityname); ?>
					&nbsp;
				</dd>
				<div class="clr"></div>	
				<?
				}
				else{
					$image = (isset($user['CustomerCustom']['user_image']))?$user['CustomerCustom']['user_image']:'';
				}
			?>
			<dt class="dhleft"><?php echo __('Profile Image'); ?></dt>
			<dd class="dhright">
				&nbsp;&nbsp;&nbsp;&nbsp;<?php
					if(isset($image) && $image!=''){
						echo "<img width='100' height='100' src='".$baseurls."/userPic/".$image."'/>";	
					}
					else{
						echo "<img width='100' height='100' src='".$baseurls."/img/noimg.png'/>";
					}
				?>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
		<h3>Credit Card Details</h3>
		<dl>
		<?php
			if(isset($user['UserCreditDetail']) && count($user['UserCreditDetail'])>0){
				foreach($user['UserCreditDetail'] as $creaditcard){
				?>
					<dt class="dhleft"><?php echo __($creaditcard['holdername']); ?></dt>
					<dd class="dhright">
						<span style="padding: 0  10px 0 0;">:</span><?php echo h($creaditcard['credit_card_no'])." , ".h("Exp. On :".$creaditcard['expirydate']); ?>
						&nbsp;
					</dd>
					<div class="clr"></div>
				<?	
				
				}	
			}
			else{
		?>
			<dt class="dhleft">This User does not save any credit card </dt>
			<dd class="dhright"></dd>
			<div class="clr"></div>
		<?
			}
		?>
		</dl>
		<dl>
		<?php
			if($user_type==1){
			?>
				<h3>Vehicle List</h3>
			<?
				if(isset($user['VehicleDetail']) && count($user['VehicleDetail'])>0){
					foreach($user['VehicleDetail'] as $vehicle){
						$carname = isset($vehicle['Car']['name'])?$vehicle['Car']['name']:'';
						?>
							<dt class="dhleft"><?php echo h($carname);?></dt>
							<dd class="dhright"><span style="padding: 0  10px 0 0;">:</span><?php echo h("Plate No : ".$vehicle['vehicle_no'])." , ".h("Made On : ".$vehicle['manufactureing_date']);?></dd>
							<div class="clr"></div>
						<?
					}
				}
				else{
			?>
				<dt class="dhleft">This User does not save any Vehicle </dt>
				<dd class="dhright"></dd>
				<div class="clr"></div>
			<?
				}
			}
		?>
		</dl>
	</div>
</div>