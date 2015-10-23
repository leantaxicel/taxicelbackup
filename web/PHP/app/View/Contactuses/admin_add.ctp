<div class="contactuses form">
<?php echo $this->Form->create('Contactus'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Contactus'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('contact_no');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contactuses'), array('action' => 'index')); ?></li>
	</ul>
</div>
