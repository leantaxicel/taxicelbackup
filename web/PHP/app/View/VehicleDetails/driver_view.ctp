<div class="creatTol">
<h2><?php  echo __('Vehicle Detail'); ?></h2><br/><br/><br/><br/><br/><br/>
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
