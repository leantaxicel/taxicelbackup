<?php
	$config = Configure::read("TaxiCel"); // loading config
	$baseurls = FULL_BASE_URL.$this->base."/admin/";
?>
<div class="creatTol">
	<div class="driverDocuments form">
	<?php echo $this->Form->create('DriverDocument',array('type'=>'file')); ?>
		<fieldset>
			<legend><?php echo __('Driver Documents'); ?>
				<?php echo $this->Html->link('Back',array('action'=>'index','admin'=>true),array('class'=>'bottonbackclass'));?>
			</legend>
			<div style="position:relative;">	
				<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Policy of Insurance</h2>
				<div style="position: absolute; left: 50%; top: 0%; margin: 33px 0 0 0;">
					<p style="font-size:20px; font-weight:400; color:#444;">Driver Name : <?php echo $driverDocument['User']['username']?></p>
				</div>
			</div>
			<div style="background:#F7F8DA; padding:10px 10px 0 10px;  width: 100%; display: flex;">
				
				<div style="float:left; width:280px;">
					<img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename'];?>" alt="" width="250" height="250"/>
				</div>
				<div style="float:left; width:280px; margin:0 0 0 180px;">
					<h2 style="margin: 0; font-size: 24px; font-weight: 400; padding: 0 0 15px 0; width:100%;">Expiry Date</h2>
					<p style="font-size: 18px; font-weight:300;"><?php echo date('d-m-Y',strtotime($driverDocument['DriverDocument']['expiry_date'])); ?></p>
				</div>
				<div class="clr"></div>
			</div>
			
			<div style="position:relative;">	
				<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Driver Authority Card</h2>
			</div>
			<div style="background:#F7F8DA; padding:10px 10px 0 10px; width: 100%; display: flex;">
				
				<div style="float:left; width:280px;">
					<img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename_auth'];?>" alt="" width="250" height="250"/>
				</div>
				<div style="float:left; width:280px; margin:0 0 0 180px;">
					<h2 style="margin: 0; font-size: 24px; font-weight: 400; padding: 0 0 15px 0; width:100%;">Expiry Date</h2>
					<p style="font-size: 18px; font-weight:300;"><?php echo date('d-m-Y',strtotime($driverDocument['DriverDocument']['expiry_date_auth'])); ?></p>
				</div>
				<div class="clr"></div>
			</div>
			
			<div style="position:relative;">	
				<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Driver License Card</h2>
			</div>
			<div style="background:#F7F8DA; padding:10px 10px 0 10px; width: 100%; display: flex;">
				
				<div style="float:left; width:280px;">
					<img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename_lic'];?>" alt="" width="250" height="250"/>
				</div>
				<div style="float:left; width:280px; margin:0 0 0 180px;">
					<h2 style="margin: 0; font-size: 24px; font-weight: 400; padding: 0 0 15px 0; width:100%;">Expiry Date</h2>
					<p style="font-size: 18px; font-weight:300;"><?php echo date('d-m-Y',strtotime($driverDocument['DriverDocument']['expiry_date_lic'])); ?></p>
				</div>
				<div class="clr"></div>
			</div>
			
			<div style="position:relative;">	
				<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Private Hire Vehicle Operator Accreditation</h2>
			</div>
			<div style="background:#F7F8DA; padding:10px 10px 0 10px; width: 100%; display: flex;">
				
				<div style="float:left; width:280px;">
					<img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename_oper'];?>" alt="" width="250" height="250"/>
				</div>
				<div style="float:left; width:280px; margin:0 0 0 180px;">
					<h2 style="margin: 0; font-size: 24px; font-weight: 400; padding: 0 0 15px 0; width:100%;">Expiry Date</h2>
					<p style="font-size: 18px; font-weight:300;"><?php echo date('d-m-Y',strtotime($driverDocument['DriverDocument']['expiry_date_oper'])); ?></p>
				</div>
				<div class="clr"></div>
			</div>
		</fieldset>
	</div>
</div>



<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Driver Document'), array('action' => 'edit', $driverDocument['DriverDocument']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Driver Document'), array('action' => 'delete', $driverDocument['DriverDocument']['id']), null, __('Are you sure you want to delete # %s?', $driverDocument['DriverDocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Driver Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Driver Document'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div-->