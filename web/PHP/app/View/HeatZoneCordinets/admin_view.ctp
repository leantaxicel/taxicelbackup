<div class="heatZoneCordinets view">
<h2><?php  echo __('Heat Zone Cordinet'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($heatZoneCordinet['HeatZoneCordinet']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Heat Zone'); ?></dt>
		<dd>
			<?php echo $this->Html->link($heatZoneCordinet['HeatZone']['name'], array('controller' => 'heat_zones', 'action' => 'view', $heatZoneCordinet['HeatZone']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($heatZoneCordinet['HeatZoneCordinet']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Long'); ?></dt>
		<dd>
			<?php echo h($heatZoneCordinet['HeatZoneCordinet']['long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($heatZoneCordinet['HeatZoneCordinet']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Heat Zone Cordinet'), array('action' => 'edit', $heatZoneCordinet['HeatZoneCordinet']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Heat Zone Cordinet'), array('action' => 'delete', $heatZoneCordinet['HeatZoneCordinet']['id']), null, __('Are you sure you want to delete # %s?', $heatZoneCordinet['HeatZoneCordinet']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Heat Zone Cordinets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Heat Zone Cordinet'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Heat Zones'), array('controller' => 'heat_zones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Heat Zone'), array('controller' => 'heat_zones', 'action' => 'add')); ?> </li>
	</ul>
</div>
