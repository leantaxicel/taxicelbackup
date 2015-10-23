<div class="creatTol">
	<h2><?php echo __('Payments From Drivers'); ?></h2>
	<div class="driverCommissions index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('ride_id'); ?></th>
				<th><?php echo $this->Paginator->sort('commission_rate'); ?></th>
				<th><?php echo $this->Paginator->sort('amount_paid'); ?></th>
				<th><?php echo $this->Paginator->sort('is_paid'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($driverCommissions as $driverCommission): ?>
		<tr>
			<td><?php echo h($driverCommission['DriverCommission']['id']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($driverCommission['Ride']['pick_up'], array('controller' => 'rides', 'action' => 'view', $driverCommission['Ride']['id'])); ?>
			</td>
			<td><?php echo h($driverCommission['DriverCommission']['commission_rate']); ?>&nbsp;</td>
			<td><?php echo h($driverCommission['DriverCommission']['amount_paid']); ?>&nbsp;</td>
			<td><?php echo h($driverCommission['DriverCommission']['is_paid']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $driverCommission['DriverCommission']['id']), null, __('Are you sure you want to delete # %s?', $driverCommission['DriverCommission']['id'])); ?>
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
</div>
