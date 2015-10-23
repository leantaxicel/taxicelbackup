<div class="priceSettings form">
<?php echo $this->Form->create('PriceSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Price Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('base_fare');
		echo $this->Form->input('base_distance');
		echo $this->Form->input('fare_per_meter');
		echo $this->Form->input('fare_per_minute');
		echo $this->Form->input('base_waiting_time');
		echo $this->Form->input('inter_fare_distance');
		echo $this->Form->input(' inter_fare_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PriceSetting.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PriceSetting.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Price Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
