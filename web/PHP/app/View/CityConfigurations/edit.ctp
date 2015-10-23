<div class="cityConfigurations form">
<?php echo $this->Form->create('CityConfiguration'); ?>
	<fieldset>
		<legend><?php echo __('Edit City Configuration'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('base_fare');
		echo $this->Form->input('base_distance');
		echo $this->Form->input('fare_per_meter');
		echo $this->Form->input('fare_per_minute');
		echo $this->Form->input('base_waiting_time');
		echo $this->Form->input('inter_fare_distance');
		echo $this->Form->input('inter_fare_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CityConfiguration.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CityConfiguration.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List City Configurations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
