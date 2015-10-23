<div class="userCreditDetails form">
<?php echo $this->Form->create('UserCreditDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Credit Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('credit_card_no');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserCreditDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserCreditDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Credit Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
