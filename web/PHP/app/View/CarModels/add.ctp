<div class="carModels form">
<?php echo $this->Form->create('CarModel'); ?>
	<fieldset>
		<legend><?php echo __('Add Car Model'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Car Models'), array('action' => 'index')); ?></li>
	</ul>
</div>
