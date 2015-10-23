<div class="creatTol">
	<h2><?php echo __('Feedbacks'); ?></h2>
	<div class="clr"></div>
	<div class="userRideRatings index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('ride_id'); ?></th>
				<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
				<th><?php echo $this->Paginator->sort('driver_id'); ?></th>
				<th><?php echo $this->Paginator->sort('customer_rating'); ?></th>
				<th><?php echo $this->Paginator->sort('driver_rating'); ?></th>
				<th><?php echo $this->Paginator->sort('customer_comment'); ?></th>
				<th><?php echo $this->Paginator->sort('driver_comment'); ?></th>
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
			<td><?php echo h($userRideRating['UserRideRating']['customer_comment']); ?>&nbsp;</td>
			<td><?php echo h($userRideRating['UserRideRating']['driver_comment']); ?>&nbsp;</td>
			<td class="actions">
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
			echo $this->Paginator->first('<<' . __('First'), array(), null, array('class' => 'first disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->last(__('Last').' >>', array(), null, array('class' => 'last disabled'));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
</div>
