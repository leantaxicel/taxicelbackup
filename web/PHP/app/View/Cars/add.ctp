<div class="cars form">
<?php echo $this->Form->create('Car'); ?>
	<fieldset>
		<legend><?php echo __('Add Car'); ?></legend>
	<?php
		echo $this->Form->input('model_id');
		echo $this->Form->input('name');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cars'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Car Models'), array('controller' => 'car_models', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car Model'), array('controller' => 'car_models', 'action' => 'add')); ?> </li>
	</ul>
</div>
