<div class="heatZoneCordinets index">
	<h2><?php echo __('Heat Zone Cordinets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('heat_zone_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lat'); ?></th>
			<th><?php echo $this->Paginator->sort('long'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($heatZoneCordinets as $heatZoneCordinet): ?>
	<tr>
		<td><?php echo h($heatZoneCordinet['HeatZoneCordinet']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($heatZoneCordinet['HeatZone']['name'], array('controller' => 'heat_zones', 'action' => 'view', $heatZoneCordinet['HeatZone']['id'])); ?>
		</td>
		<td><?php echo h($heatZoneCordinet['HeatZoneCordinet']['lat']); ?>&nbsp;</td>
		<td><?php echo h($heatZoneCordinet['HeatZoneCordinet']['long']); ?>&nbsp;</td>
		<td><?php echo h($heatZoneCordinet['HeatZoneCordinet']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $heatZoneCordinet['HeatZoneCordinet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $heatZoneCordinet['HeatZoneCordinet']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $heatZoneCordinet['HeatZoneCordinet']['id']), null, __('Are you sure you want to delete # %s?', $heatZoneCordinet['HeatZoneCordinet']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Heat Zone Cordinet'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Heat Zones'), array('controller' => 'heat_zones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Heat Zone'), array('controller' => 'heat_zones', 'action' => 'add')); ?> </li>
	</ul>
</div>
