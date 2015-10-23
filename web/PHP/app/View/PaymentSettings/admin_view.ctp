<div class="paymentSettings view">
<h2><?php  echo __('Payment Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride Commision'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['ride_commision']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride Later Booking After'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['ride_later_booking_after']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride Now Canceled In'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['ride_now_canceled_in']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride Now Cancellation Fee'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['ride_now_cancellation_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No Fee Before'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['no_fee_before']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Fee After'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['full_fee_after']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cancellation Charge Apply After'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['cancellation_charge_apply_after']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cancellation Charge'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['cancellation_charge']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payflow Username'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['payflow_username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payflow Partner'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['payflow_partner']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payflow Vendor'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['payflow_vendor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payflow Password'); ?></dt>
		<dd>
			<?php echo h($paymentSetting['PaymentSetting']['payflow_password']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment Setting'), array('action' => 'edit', $paymentSetting['PaymentSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Payment Setting'), array('action' => 'delete', $paymentSetting['PaymentSetting']['id']), null, __('Are you sure you want to delete # %s?', $paymentSetting['PaymentSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Setting'), array('action' => 'add')); ?> </li>
	</ul>
</div>
