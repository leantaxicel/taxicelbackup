<div class="creatTol">
	<div class="assignCompanyOwnners form">
	<?php echo $this->Form->create('AssignCompanyOwnner'); ?>
		<fieldset>
			<legend><?php echo __('Edit Assign Company Owner'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('company_id');
			echo $this->Form->input('user_id');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AssignCompanyOwnner.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AssignCompanyOwnner.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assign Company Ownners'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div-->
