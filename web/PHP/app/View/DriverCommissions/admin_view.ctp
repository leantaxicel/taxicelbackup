<div class="driverCommissions view">
<h2><?php  echo __('Driver Commission'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($driverCommission['DriverCommission']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride'); ?></dt>
		<dd>
			<?php echo $this->Html->link($driverCommission['Ride']['pick_up'], array('controller' => 'rides', 'action' => 'view', $driverCommission['Ride']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commission Rate'); ?></dt>
		<dd>
			<?php echo h($driverCommission['DriverCommission']['commission_rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount Paid'); ?></dt>
		<dd>
			<?php echo h($driverCommission['DriverCommission']['amount_paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Paid'); ?></dt>
		<dd>
			<?php echo h($driverCommission['DriverCommission']['is_paid']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Driver Commission'), array('action' => 'edit', $driverCommission['DriverCommission']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Driver Commission'), array('action' => 'delete', $driverCommission['DriverCommission']['id']), null, __('Are you sure you want to delete # %s?', $driverCommission['DriverCommission']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Driver Commissions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Driver Commission'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rides'), array('controller' => 'rides', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('controller' => 'rides', 'action' => 'add')); ?> </li>
	</ul>
</div>
