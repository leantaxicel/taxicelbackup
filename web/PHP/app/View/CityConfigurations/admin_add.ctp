<div class="creatTol">
<?php echo $this->Form->create('CityConfiguration'); ?>
	<fieldset>
		<legend><?php echo __('Add City Price Configuration'); ?></legend>
	<?php
		echo $this->Form->input('city_id');
		echo $this->Form->input('base_fare');
		echo $this->Form->input('base_wait_time');
		echo $this->Form->input('base_distance');
		echo $this->Form->input('fare_per_kilometer');
		echo $this->Form->input('fare_per_minute');
		echo $this->Form->input('inter_fare_distance',array('label'=>'Inter Fare Distance (In meter)'));
		echo $this->Form->input('inter_fare_time',array('label'=>'Inter Fare Time (In Second)'));
		echo $this->Form->input('additional_wait_time',array('label'=>'Additional Waiting Time (In Second)'));
		echo $this->Form->input('additional_wait_amount',array('label'=>'Additional waiting amount  (In Rs/Dollar)'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List City Configurations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div-->
