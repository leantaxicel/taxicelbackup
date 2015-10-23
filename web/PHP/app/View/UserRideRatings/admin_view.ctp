<div class="userRideRatings view">
<h2><?php  echo __('User Ride Rating'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userRideRating['UserRideRating']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userRideRating['Ride']['pick_up'], array('controller' => 'rides', 'action' => 'view', $userRideRating['Ride']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userRideRating['Customer']['username'], array('controller' => 'users', 'action' => 'view', $userRideRating['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Driver'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userRideRating['Driver']['username'], array('controller' => 'users', 'action' => 'view', $userRideRating['Driver']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Rating'); ?></dt>
		<dd>
			<?php echo h($userRideRating['UserRideRating']['customer_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Driver Rating'); ?></dt>
		<dd>
			<?php echo h($userRideRating['UserRideRating']['driver_rating']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Ride Rating'), array('action' => 'edit', $userRideRating['UserRideRating']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Ride Rating'), array('action' => 'delete', $userRideRating['UserRideRating']['id']), null, __('Are you sure you want to delete # %s?', $userRideRating['UserRideRating']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Ride Ratings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Ride Rating'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rides'), array('controller' => 'rides', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('controller' => 'rides', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
