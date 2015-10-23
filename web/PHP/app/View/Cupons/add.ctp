<div class="cupons form">
<?php echo $this->Form->create('Cupon'); ?>
	<fieldset>
		<legend><?php echo __('Add Cupon'); ?></legend>
	<?php
		echo $this->Form->input('cupon_code');
		echo $this->Form->input('discount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cupons'), array('action' => 'index')); ?></li>
	</ul>
</div>
