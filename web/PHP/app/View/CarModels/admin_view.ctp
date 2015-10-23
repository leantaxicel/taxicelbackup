<div class="carModels view">
<h2><?php  echo __('Car Model'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($carModel['CarModel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($carModel['CarModel']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($carModel['CarModel']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Car Model'), array('action' => 'edit', $carModel['CarModel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Car Model'), array('action' => 'delete', $carModel['CarModel']['id']), null, __('Are you sure you want to delete # %s?', $carModel['CarModel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Car Models'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car Model'), array('action' => 'add')); ?> </li>
	</ul>
</div>
