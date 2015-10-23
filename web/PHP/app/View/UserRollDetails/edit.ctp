<div class="userRollDetails form">
<?php echo $this->Form->create('UserRollDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Roll Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('roll');
		echo $this->Form->input('user_name');
		echo $this->Form->input('pass');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserRollDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserRollDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Roll Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
