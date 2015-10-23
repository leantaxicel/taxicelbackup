<div class="creatTol">
	<div class="rollmasters form">
	<?php echo $this->Form->create('Rollmaster'); ?>
		<fieldset>
			<legend><?php echo __('Edit Rollmaster'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('roll_model');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rollmaster.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Rollmaster.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rollmasters'), array('action' => 'index')); ?></li>
	</ul>
</div-->
