<div class="creatTol">
	<div class="paymentSettings form">
	<?php echo $this->Form->create('PaymentSetting'); ?>
		<fieldset>
			<legend><?php echo __('Ride Payment Settings'); ?></legend>
			<?
				$count = count($paymentSetting);
				if($count>0){
			?>
			
				<?php
					echo $this->Form->input('wait_time_charge',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['wait_time_charge'],
						      'label'=>"Wait Time Charge ($/Second)",'min'=>'0'
						)
					);
					
					echo $this->Form->input('ride_commision',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['ride_commision'],
						      'label'=>"Ride Commision (%)",'min'=>'0'
						)
					);
					echo $this->Form->input('referal_percentage',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['referal_percentage'],
						      'label'=>"Referral Distribution (%)",'min'=>'0'
						)
					);
					echo $this->Form->input('customer_referral_per',array('label'=>'Customer Referral Earning (%)','value'=>$paymentSetting['PaymentSetting']['customer_referral_per'],'min'=>'0'));
					
					echo $this->Form->input('ride_later_booking_after',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['ride_later_booking_after'],
						      'label'=>"Ride Later Booking After (Minute)",'min'=>'0'
						)
					);
					echo $this->Form->input('ride_now_canceled_in',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['ride_now_canceled_in'],
						      'label'=>"Ride Now Canceled In (Minute)",'min'=>'0'
						)
					);
					echo $this->Form->input('ride_now_cancellation_fee',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['ride_now_cancellation_fee'],
						      'label'=>"Ride Now Cancellation Fee ($)",'min'=>'0'
						)
					);
				?>
				<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Ride Later Cancellation Charged Setting</h2>
				<?php
					echo $this->Form->input('no_fee_before',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['no_fee_before'],
						      'label'=>"No Fee Before Ride Start (Hour)",'min'=>'0'
						)
					);
					/*echo $this->Form->input('full_fee_after',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['full_fee_after'],
						      'label'=>"Full Fee After (Minute)"
						)
					);
					echo $this->Form->input('cancellation_charge_apply_after',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['cancellation_charge_apply_after'],
						      'label'=>"Cancellation Charge Apply After (Minute)"
						)
					);*/
					echo $this->Form->input('cancellation_charge',
						array(
						      'value'=>$paymentSetting['PaymentSetting']['cancellation_charge'],
						      'label'=>"Cancellation Charge ($)",'min'=>'0'
						)
					);
					
					echo $this->Form->input('id', array('value'=>$paymentSetting['PaymentSetting']['id']));
				?>
			
			<?}else{?>
			
				<?php
					echo $this->Form->input('wait_time_charge',array('label'=>"Wait Time Charge ($/Second)",'min'=>'0'));
					echo $this->Form->input('ride_commision',array('label'=>"Ride Commision (%)",'min'=>'0'));
					echo $this->Form->input('referal_percentage',array('label'=>"Referral Distributon (%)",'min'=>'0'));
					echo $this->Form->input('customer_referral_per',array('label'=>'Customer Referral Earning (%)','min'=>'0'));
					echo $this->Form->input('ride_later_booking_after',array('label'=>'Ride Later Booking After (Minute)','min'=>'0'));
					echo $this->Form->input('ride_now_canceled_in',array('label'=>'Ride Now Canceled In (Minute)','min'=>'0'));
					echo $this->Form->input('ride_now_cancellation_fee',array('label'=>'Ride Now Cancellation Fee ($)','min'=>'0'));
				?>
				<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Ride Later Cancellation Charged Setting</h2>
				<?php
					echo $this->Form->input('no_fee_before',array('label'=>'No Fee Before Ride Start (Hour)'));
					//echo $this->Form->input('full_fee_after',array('label'=>'Full Fee After (Minute)'));
					//echo $this->Form->input('cancellation_charge_apply_after',array('label'=>'Cancellation Charge Apply After (Minute)'));
					echo $this->Form->input('cancellation_charge',array('label'=>'Cancellation Charge ($)','min'=>'0'));
					
				?>
				
			<? }?>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>
