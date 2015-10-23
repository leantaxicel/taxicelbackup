<div class="heatZones form">
<?php echo $this->Form->create('HeatZone'); ?>
	<fieldset>
		<legend><?php echo __('Add Heat Zone'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('create_time');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Heat Zones'), array('action' => 'index')); ?></li>
	</ul>
</div>
