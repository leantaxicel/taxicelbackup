<div class="vehicleDetails view">
<h2><?php  echo __('Vehicle Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vehicleDetail['VehicleDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vehicleDetail['User']['username'], array('controller' => 'users', 'action' => 'view', $vehicleDetail['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Car'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vehicleDetail['Car']['name'], array('controller' => 'cars', 'action' => 'view', $vehicleDetail['Car']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manufactureing Date'); ?></dt>
		<dd>
			<?php echo h($vehicleDetail['VehicleDetail']['manufactureing_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vehicle No'); ?></dt>
		<dd>
			<?php echo h($vehicleDetail['VehicleDetail']['vehicle_no']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vehicle Detail'), array('action' => 'edit', $vehicleDetail['VehicleDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vehicle Detail'), array('action' => 'delete', $vehicleDetail['VehicleDetail']['id']), null, __('Are you sure you want to delete # %s?', $vehicleDetail['VehicleDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicle Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cars'), array('controller' => 'cars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
	</ul>
</div>
