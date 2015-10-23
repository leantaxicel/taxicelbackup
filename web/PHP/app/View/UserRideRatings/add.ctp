<div class="userRideRatings form">
<?php echo $this->Form->create('UserRideRating'); ?>
	<fieldset>
		<legend><?php echo __('Add User Ride Rating'); ?></legend>
	<?php
		echo $this->Form->input('ride_id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('driver_id');
		echo $this->Form->input('customer_rating');
		echo $this->Form->input('driver_rating');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Ride Ratings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rides'), array('controller' => 'rides', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('controller' => 'rides', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
