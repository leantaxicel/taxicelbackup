<div class="vehicleDetails form">
<?php echo $this->Form->create('VehicleDetail'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Vehicle Detail'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('car_id');
		echo $this->Form->input('manufactureing_date');
		echo $this->Form->input('vehicle_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Vehicle Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cars'), array('controller' => 'cars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
	</ul>
</div>
