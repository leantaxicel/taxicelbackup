<div class="paymentSettings form">
<?php echo $this->Form->create('PaymentSetting'); ?>
	<fieldset>
		<legend><?php echo __('Add Payment Setting'); ?></legend>
	<?php
		echo $this->Form->input('ride_commision');
		echo $this->Form->input('ride_later_booking_after');
		echo $this->Form->input('ride_now_canceled_in');
		echo $this->Form->input('ride_now_cancellation_fee');
		echo $this->Form->input('no_fee_before');
		echo $this->Form->input('full_fee_after');
		echo $this->Form->input('cancellation_charge_apply_after');
		echo $this->Form->input('cancellation_charge');
		echo $this->Form->input('payflow_username');
		echo $this->Form->input('payflow_partner');
		echo $this->Form->input('payflow_vendor');
		echo $this->Form->input('payflow_password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Payment Settings'), array('action' => 'index')); ?></li>
	</ul>
</div>
