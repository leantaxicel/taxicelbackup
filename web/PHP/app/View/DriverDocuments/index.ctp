<div class="driverDocuments index">
	<h2><?php echo __('Driver Documents'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('filename_auth'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date_auth'); ?></th>
			<th><?php echo $this->Paginator->sort('status_auth'); ?></th>
			<th><?php echo $this->Paginator->sort('filename_lic'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date_lic'); ?></th>
			<th><?php echo $this->Paginator->sort('status_lic'); ?></th>
			<th><?php echo $this->Paginator->sort('filename_oper'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date_oper'); ?></th>
			<th><?php echo $this->Paginator->sort('status_oper'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($driverDocuments as $driverDocument): ?>
	<tr>
		<td><?php echo h($driverDocument['DriverDocument']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($driverDocument['User']['username'], array('controller' => 'users', 'action' => 'view', $driverDocument['User']['id'])); ?>
		</td>
		<td><?php echo h($driverDocument['DriverDocument']['filename']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['expiry_date']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['status']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['filename_auth']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['expiry_date_auth']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['status_auth']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['filename_lic']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['expiry_date_lic']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['status_lic']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['filename_oper']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['expiry_date_oper']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['status_oper']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $driverDocument['DriverDocument']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $driverDocument['DriverDocument']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $driverDocument['DriverDocument']['id']), null, __('Are you sure you want to delete # %s?', $driverDocument['DriverDocument']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Driver Document'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
