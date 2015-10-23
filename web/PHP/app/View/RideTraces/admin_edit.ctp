<div class="rideTraces form">
<?php echo $this->Form->create('RideTrace'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Ride Trace'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ride_id');
		echo $this->Form->input('lat');
		echo $this->Form->input('long');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RideTrace.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RideTrace.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ride Traces'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rides'), array('controller' => 'rides', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('controller' => 'rides', 'action' => 'add')); ?> </li>
	</ul>
</div>
