<div class="vehicleDetails index">
	<h2><?php echo __('Vehicle Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('car_id'); ?></th>
			<th><?php echo $this->Paginator->sort('manufactureing_date'); ?></th>
			<th><?php echo $this->Paginator->sort('vehicle_no'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vehicleDetails as $vehicleDetail): ?>
	<tr>
		<td><?php echo h($vehicleDetail['VehicleDetail']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vehicleDetail['User']['username'], array('controller' => 'users', 'action' => 'view', $vehicleDetail['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($vehicleDetail['Car']['name'], array('controller' => 'cars', 'action' => 'view', $vehicleDetail['Car']['id'])); ?>
		</td>
		<td><?php echo h($vehicleDetail['VehicleDetail']['manufactureing_date']); ?>&nbsp;</td>
		<td><?php echo h($vehicleDetail['VehicleDetail']['vehicle_no']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $vehicleDetail['VehicleDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vehicleDetail['VehicleDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vehicleDetail['VehicleDetail']['id']), null, __('Are you sure you want to delete # %s?', $vehicleDetail['VehicleDetail']['id'])); ?>
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
		echo $this->Paginator->first('<<' . __('First'), array(), null, array('class' => 'first disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->last(__('Last').' >>', array(), null, array('class' => 'last disabled'));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Vehicle Detail'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cars'), array('controller' => 'cars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
	</ul>
</div>
