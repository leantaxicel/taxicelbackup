<div class="heatZoneCordinets form">
<?php echo $this->Form->create('HeatZoneCordinet'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Heat Zone Cordinet'); ?></legend>
	<?php
		echo $this->Form->input('heat_zone_id');
		echo $this->Form->input('lat');
		echo $this->Form->input('long');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Heat Zone Cordinets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Heat Zones'), array('controller' => 'heat_zones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Heat Zone'), array('controller' => 'heat_zones', 'action' => 'add')); ?> </li>
	</ul>
</div>
