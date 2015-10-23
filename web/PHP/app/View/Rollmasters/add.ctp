<div class="rollmasters form">
<?php echo $this->Form->create('Rollmaster'); ?>
	<fieldset>
		<legend><?php echo __('Add Rollmaster'); ?></legend>
	<?php
		echo $this->Form->input('roll_model');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rollmasters'), array('action' => 'index')); ?></li>
	</ul>
</div>
