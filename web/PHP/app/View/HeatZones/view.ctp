<div class="heatZones view">
<h2><?php  echo __('Heat Zone'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($heatZone['HeatZone']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($heatZone['HeatZone']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Create Time'); ?></dt>
		<dd>
			<?php echo h($heatZone['HeatZone']['create_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($heatZone['HeatZone']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Heat Zone'), array('action' => 'edit', $heatZone['HeatZone']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Heat Zone'), array('action' => 'delete', $heatZone['HeatZone']['id']), null, __('Are you sure you want to delete # %s?', $heatZone['HeatZone']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Heat Zones'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Heat Zone'), array('action' => 'add')); ?> </li>
	</ul>
</div>
