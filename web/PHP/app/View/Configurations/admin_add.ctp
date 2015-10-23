<div class="creatTol">
	<div class="configurations form">
	<?php echo $this->Form->create('Configuration'); ?>
		<fieldset>
			<legend><?php echo __('Configurations'); ?></legend>
		<?php
			$count = count($configuration);
			if($count>0){
				echo $this->Form->input('website_url',array('value'=>$configuration['Configuration']['website_url']));
				echo $this->Form->input('andversion',array('label'=>'Android Version','value'=>$configuration['Configuration']['andversion'],'min'=>'0'));
				echo $this->Form->input('iosversion',array('label'=>'IOS Version','value'=>$configuration['Configuration']['iosversion'],'min'=>'0'));
				
				echo $this->Form->input('fromemail', array('label'=>'Sending Email Id','value'=>$configuration['Configuration']['fromemail']));
				echo $this->Form->input('toemail', array('label'=>'Receiving Email Id','value'=>$configuration['Configuration']['toemail']));
				echo $this->Form->input('reclimit', array('label'=>'Record Limit','value'=>$configuration['Configuration']['reclimit'],'min'=>'0'));
				echo $this->Form->input('driverfindrange', array('label'=>'Driver Find Range(Meter)','value'=>$configuration['Configuration']['driverfindrange'],'min'=>'0'));
				
				//echo $this->Form->input('ride_later_limit',array('value'=>$configuration['Configuration']['ride_later_limit']));
				//echo $this->Form->input('promotion_value',array('value'=>$configuration['Configuration']['promotion_value']));
				//echo $this->Form->input('wait_time_charge',array('value'=>$configuration['Configuration']['wait_time_charge']));
				//echo $this->Form->input('ride_commission',array('value'=>$configuration['Configuration']['ride_commission']));
				//echo $this->Form->input('referal_percentage',array('value'=>$configuration['Configuration']['referal_percentage']));
				
				echo $this->Form->input('withdraw_limit',array('value'=>$configuration['Configuration']['withdraw_limit'],'min'=>'0'));
				
				echo $this->Form->input('minimumcreadit',array('label'=>'Minimun Credit Cost','value'=>$configuration['Configuration']['minimumcreadit'],'min'=>'0'));
				
				echo $this->Form->input('initial_earning',array('label'=>'New Driver Initial Earning','value'=>$configuration['Configuration']['initial_earning'],'min'=>'0'));
				
				echo $this->Form->input('buycreditwarning',array('label'=>'Buy Credit Warning','value'=>$configuration['Configuration']['buycreditwarning'],'min'=>'0'));
				
				echo $this->Form->input('googlekey',array('label'=>'Google Key','value'=>$configuration['Configuration']['googlekey']));
				echo $this->Form->input('andro_customer_push_key',array('value'=>$configuration['Configuration']['andro_customer_push_key']));
				echo $this->Form->input('andro_driver_push_key',array('value'=>$configuration['Configuration']['andro_driver_push_key']));
				
				
				
				echo $this->Form->input('payflow_username', array('type'=>'hidden','value'=>$configuration['Configuration']['payflow_username']));
				echo $this->Form->hidden('payflow_partner', array('value'=>$configuration['Configuration']['payflow_partner']));
				echo $this->Form->hidden('payflow_vendor', array('value'=>$configuration['Configuration']['payflow_vendor']));
				echo $this->Form->hidden('payflow_password', array('value'=>$configuration['Configuration']['payflow_password']));
				
				
				
				echo $this->Form->input('id',array('value'=>$configuration['Configuration']['id']));
			}else{
				echo $this->Form->input('website_url');
				echo $this->Form->input('andversion',array('label'=>'Android Version','min'=>'0'));
				echo $this->Form->input('iosversion',array('label'=>'IOS Version','min'=>'0'));
				
				echo $this->Form->input('fromemail', array('label'=>'Sending Email Id'));
				echo $this->Form->input('toemail', array('label'=>'Receiving Email Id'));
				echo $this->Form->input('reclimit', array('label'=>'Record Limit','min'=>'0'));
				echo $this->Form->input('driverfindrange', array('label'=>'Driver Find Range(Meter)','min'=>'0'));
				
				//echo $this->Form->input('ride_later_limit');
				//echo $this->Form->input('promotion_value');
				//echo $this->Form->input('wait_time_charge');
				//echo $this->Form->input('ride_commission');
				//echo $this->Form->input('referal_percentage');
				
				echo $this->Form->input('withdraw_limit',array('min'=>'0'));
				echo $this->Form->input('minimumcreadit',array('min'=>'0'));
				echo $this->Form->input('initial_earning',array('label'=>'New Driver Initial Earning','min'=>'0'));
				
				echo $this->Form->input('buycreditwarning',array('label'=>'Buy Credit Warning','min'=>'0'));
				
				// basicrefferelpoint
				echo $this->Form->input('googlekey',array('label'=>'Google Key'));
				echo $this->Form->input('andro_customer_push_key');
				echo $this->Form->input('andro_driver_push_key');
				
				echo $this->Form->hidden('payflow_username',array('value'=>'test'));
				echo $this->Form->hidden('payflow_partner',array('value'=>'test'));
				echo $this->Form->hidden('payflow_vendor',array('value'=>'test'));
				echo $this->Form->hidden('payflow_password',array('value'=>'test'));
			}
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>
