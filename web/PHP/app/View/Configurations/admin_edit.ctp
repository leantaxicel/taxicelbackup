<div class="configurations form">
<?php echo $this->Form->create('Configuration'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Configuration'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('andversion');
		echo $this->Form->input('iosversion');
		echo $this->Form->input('ride_later_limit');
		echo $this->Form->input('promotion_value');
		echo $this->Form->input('googlekey');
		echo $this->Form->input('wait_time_charge');
		echo $this->Form->input('withdraw_limit');
		echo $this->Form->input('websiteurl');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Configuration.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Configuration.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Configurations'), array('action' => 'index')); ?></li>
	</ul>
</div>
