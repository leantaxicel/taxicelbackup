<div class="cupons form">
<?php echo $this->Form->create('Cupon'); ?>
	<fieldset>
		<legend><?php echo __('Edit Cupon'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cupon_code');
		echo $this->Form->input('discount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cupon.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Cupon.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cupons'), array('action' => 'index')); ?></li>
	</ul>
</div>
