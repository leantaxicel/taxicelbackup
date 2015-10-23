<?php
	//pr($driverdoccument);
	$config = Configure::read("TaxiCel");
?>
<div class="creatTol">
	<div class="driverDocuments form">
	<?php echo $this->Form->create('DriverDocument',array('type'=>'file')); ?>
		<fieldset>
			<legend><?php echo __('Documents'); ?></legend>
			
		<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Policy of Insurance</h2>
		<div style="background:#F7F8DA; padding:10px;">
			<?php
				
				echo $this->Form->hidden('user_id',array('value'=>$this->Session->read('driver_id')));
				echo $this->Form->input('filename',array('type'=>'file','style'=>'border:none;','label'=>'File'));
				if(isset($driverdoccument['DriverDocument']['expiry_date'])){
					echo $this->Form->input('expiry_date',array('selected'=>$driverdoccument['DriverDocument']['expiry_date']));	
				}
				else{
					echo $this->Form->input('expiry_date');
				}

				if(isset($driverdoccument['DriverDocument']['filename']) && $driverdoccument['DriverDocument']['filename']!=''){
					$path = $config['BaseUrl']."/userDoc/".$driverdoccument['DriverDocument']['filename'];
				?>
					<div style="width: 100px; height: 100px;">
						<img src="<?=$path?>" alt="" width="100" height="100"/>
					</div>
				<?	
				}
				else{
				?>
					<div style="width: inherit; height: inherit;color:#FFA5A5;">
						<span style="color:red; font-size:16px;">* </span>Please Upload the document
					</div>
				<?
				}
			?>
		
		</div>
		
		<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Driver Authority Card</h2>
		<div style="background:#F7F8DA; padding:10px;">
			<?php	
				echo $this->Form->input('filename_auth',array('type'=>'file','style'=>'border:none;','label'=>'File'));
				if(isset($driverdoccument['DriverDocument']['expiry_date_auth'])){
					echo $this->Form->input('expiry_date_auth',array('label'=>'Expiry Date','selected'=>$driverdoccument['DriverDocument']['expiry_date_auth']));
				}
				else{
					echo $this->Form->input('expiry_date_auth',array('label'=>'Expiry Date'));
				}
				
				if(isset($driverdoccument['DriverDocument']['filename_auth']) && $driverdoccument['DriverDocument']['filename_auth']!=''){
					$path = $config['BaseUrl']."/userDoc/".$driverdoccument['DriverDocument']['filename_auth'];
				?>
					<div style="width: 100px; height: 100px; ">
						<img src="<?=$path?>" alt="" width="100" height="100"/>
					</div>
				<?	
				}
				else{
				?>
					<div style="width: inherit; height: inherit; color:#FFA5A5;">
						<span style="color:red; font-size:16px;">* </span>Please Upload the document
					</div>
				<?
				}
			?>
		</div>
		
		<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Driver License Card</h2>
		<div style="background:#F7F8DA; padding:10px;">
			<?php
				echo $this->Form->input('filename_lic',array('type'=>'file','style'=>'border:none;','label'=>'File'));
				if(isset($driverdoccument['DriverDocument']['expiry_date_lic'])){
					echo $this->Form->input('expiry_date_lic',array('label'=>'Expiry Date','selected'=>$driverdoccument['DriverDocument']['expiry_date_lic']));
				}
				else{
					echo $this->Form->input('expiry_date_lic',array('label'=>'Expiry Date'));
				}
				
				
				if(isset($driverdoccument['DriverDocument']['filename_lic']) && $driverdoccument['DriverDocument']['filename_lic']!=''){
					$path = $config['BaseUrl']."/userDoc/".$driverdoccument['DriverDocument']['filename_lic'];
				?>
					<div style="width: 100px; height: 100px;">
						<img src="<?=$path?>" alt="" width="100" height="100"/>
					</div>
				<?	
				}
				else{
				?>
					<div style="width: inherit; height: inherit; color:#FFA5A5;">
						<span style="color:red; font-size:16px;">* </span>Please Upload the document
					</div>
				<?
				}
			?>
		</div>
		
		<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Private Hire Vehicle Operator Accreditation</h2>
		<div style="background:#F7F8DA; padding:10px;">
			<?php	
				echo $this->Form->input('filename_oper',array('type'=>'file','style'=>'border:none;','label'=>'File'));
				if(isset($driverdoccument['DriverDocument']['expiry_date_oper'])){
					echo $this->Form->input('expiry_date_oper',array('label'=>'Expiry Date','selected'=>$driverdoccument['DriverDocument']['expiry_date_oper']));
				}
				else{
					echo $this->Form->input('expiry_date_oper',array('label'=>'Expiry Date'));
				}
				
				
				if(isset($driverdoccument['DriverDocument']['filename_oper']) && $driverdoccument['DriverDocument']['filename_oper']!=''){
					$path = $config['BaseUrl']."/userDoc/".$driverdoccument['DriverDocument']['filename_oper'];
				?>
					<div style="width: 100px; height: 100px;">
						<img src="<?=$path?>" alt="" width="100" height="100"/>
					</div>
				<?	
				}
				else{
				?>
					<div style="width: inherit; height: inherit; color:#FFA5A5;">
						<span style="color:red; font-size:16px;">* </span>Please Upload the document
					</div>
				<?
				}
			?>
		</div>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>
