<div class="rides form">
<?php echo $this->Form->create('Ride'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ride'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('pick_up');
		echo $this->Form->input('pick_lat');
		echo $this->Form->input('pick_long');
		echo $this->Form->input('drop_off');
		echo $this->Form->input('drop_lat');
		echo $this->Form->input('drop_long');
		echo $this->Form->input('distance_cost');
		echo $this->Form->input('waiting_time_cost');
		echo $this->Form->input('total_distance');
		echo $this->Form->input('total_time');
		echo $this->Form->input('date_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Ride.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Ride.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rides'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
