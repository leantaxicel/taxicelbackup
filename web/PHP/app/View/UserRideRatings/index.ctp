<div class="userRideRatings index">
	<h2><?php echo __('User Ride Ratings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('ride_id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('driver_id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_rating'); ?></th>
			<th><?php echo $this->Paginator->sort('driver_rating'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userRideRatings as $userRideRating): ?>
	<tr>
		<td><?php echo h($userRideRating['UserRideRating']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userRideRating['Ride']['pick_up'], array('controller' => 'rides', 'action' => 'view', $userRideRating['Ride']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userRideRating['Customer']['username'], array('controller' => 'users', 'action' => 'view', $userRideRating['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userRideRating['Driver']['username'], array('controller' => 'users', 'action' => 'view', $userRideRating['Driver']['id'])); ?>
		</td>
		<td><?php echo h($userRideRating['UserRideRating']['customer_rating']); ?>&nbsp;</td>
		<td><?php echo h($userRideRating['UserRideRating']['driver_rating']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userRideRating['UserRideRating']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userRideRating['UserRideRating']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userRideRating['UserRideRating']['id']), null, __('Are you sure you want to delete # %s?', $userRideRating['UserRideRating']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User Ride Rating'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Rides'), array('controller' => 'rides', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('controller' => 'rides', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
