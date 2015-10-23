<div class="paymentSettings index">
	<h2><?php echo __('Payment Settings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('ride_commision'); ?></th>
			<th><?php echo $this->Paginator->sort('ride_later_booking_after'); ?></th>
			<th><?php echo $this->Paginator->sort('ride_now_canceled_in'); ?></th>
			<th><?php echo $this->Paginator->sort('ride_now_cancellation_fee'); ?></th>
			<th><?php echo $this->Paginator->sort('no_fee_before'); ?></th>
			<th><?php echo $this->Paginator->sort('full_fee_after'); ?></th>
			<th><?php echo $this->Paginator->sort('cancellation_charge_apply_after'); ?></th>
			<th><?php echo $this->Paginator->sort('cancellation_charge'); ?></th>
			<th><?php echo $this->Paginator->sort('payflow_username'); ?></th>
			<th><?php echo $this->Paginator->sort('payflow_partner'); ?></th>
			<th><?php echo $this->Paginator->sort('payflow_vendor'); ?></th>
			<th><?php echo $this->Paginator->sort('payflow_password'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($paymentSettings as $paymentSetting): ?>
	<tr>
		<td><?php echo h($paymentSetting['PaymentSetting']['id']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['ride_commision']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['ride_later_booking_after']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['ride_now_canceled_in']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['ride_now_cancellation_fee']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['no_fee_before']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['full_fee_after']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['cancellation_charge_apply_after']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['cancellation_charge']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['payflow_username']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['payflow_partner']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['payflow_vendor']); ?>&nbsp;</td>
		<td><?php echo h($paymentSetting['PaymentSetting']['payflow_password']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $paymentSetting['PaymentSetting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paymentSetting['PaymentSetting']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paymentSetting['PaymentSetting']['id']), null, __('Are you sure you want to delete # %s?', $paymentSetting['PaymentSetting']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment Setting'), array('action' => 'add')); ?></li>
	</ul>
</div>
