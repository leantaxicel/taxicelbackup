<div class="cars view">
<h2><?php  echo __('Car'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($car['Car']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Car Model'); ?></dt>
		<dd>
			<?php echo $this->Html->link($car['CarModel']['name'], array('controller' => 'car_models', 'action' => 'view', $car['CarModel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($car['Car']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($car['Car']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Car'), array('action' => 'edit', $car['Car']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Car'), array('action' => 'delete', $car['Car']['id']), null, __('Are you sure you want to delete # %s?', $car['Car']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Car Models'), array('controller' => 'car_models', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car Model'), array('controller' => 'car_models', 'action' => 'add')); ?> </li>
	</ul>
</div>
