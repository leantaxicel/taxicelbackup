<div class="driverDocuments form">
<?php echo $this->Form->create('DriverDocument'); ?>
	<fieldset>
		<legend><?php echo __('Edit Driver Document'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('filename');
		echo $this->Form->input('expiry_date');
		echo $this->Form->input('status');
		echo $this->Form->input('filename_auth');
		echo $this->Form->input('expiry_date_auth');
		echo $this->Form->input('status_auth');
		echo $this->Form->input('filename_lic');
		echo $this->Form->input('expiry_date_lic');
		echo $this->Form->input('status_lic');
		echo $this->Form->input('filename_oper');
		echo $this->Form->input('expiry_date_oper');
		echo $this->Form->input('status_oper');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DriverDocument.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DriverDocument.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Driver Documents'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
