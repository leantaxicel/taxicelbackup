<div class="rideTraces view">
<h2><?php  echo __('Ride Trace'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rideTrace['RideTrace']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rideTrace['Ride']['pick_up'], array('controller' => 'rides', 'action' => 'view', $rideTrace['Ride']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($rideTrace['RideTrace']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Long'); ?></dt>
		<dd>
			<?php echo h($rideTrace['RideTrace']['long']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ride Trace'), array('action' => 'edit', $rideTrace['RideTrace']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ride Trace'), array('action' => 'delete', $rideTrace['RideTrace']['id']), null, __('Are you sure you want to delete # %s?', $rideTrace['RideTrace']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ride Traces'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride Trace'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rides'), array('controller' => 'rides', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('controller' => 'rides', 'action' => 'add')); ?> </li>
	</ul>
</div>
