<div class="driverCommissions form">
<?php echo $this->Form->create('DriverCommission'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Driver Commission'); ?></legend>
	<?php
		echo $this->Form->input('ride_id');
		echo $this->Form->input('commission_rate');
		echo $this->Form->input('amount_paid');
		echo $this->Form->input('is_paid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Driver Commissions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rides'), array('controller' => 'rides', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('controller' => 'rides', 'action' => 'add')); ?> </li>
	</ul>
</div>
