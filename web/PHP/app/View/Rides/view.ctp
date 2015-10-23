<div class="rides view">
<h2><?php  echo __('Ride'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ride['User']['username'], array('controller' => 'users', 'action' => 'view', $ride['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pick Up'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['pick_up']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pick Lat'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['pick_lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pick Long'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['pick_long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Drop Off'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['drop_off']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Drop Lat'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['drop_lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Drop Long'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['drop_long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Distance Cost'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['distance_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Waiting Time Cost'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['waiting_time_cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Distance'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['total_distance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Time'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['total_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Time'); ?></dt>
		<dd>
			<?php echo h($ride['Ride']['date_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ride'), array('action' => 'edit', $ride['Ride']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ride'), array('action' => 'delete', $ride['Ride']['id']), null, __('Are you sure you want to delete # %s?', $ride['Ride']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rides'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ride'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
