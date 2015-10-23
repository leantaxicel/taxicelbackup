<div class="priceSettings view">
<h2><?php  echo __('Price Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($priceSetting['City']['name'], array('controller' => 'cities', 'action' => 'view', $priceSetting['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Fare'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting']['base_fare']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Distance'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting']['base_distance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fare Per Meter'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting']['fare_per_meter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fare Per Minute'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting']['fare_per_minute']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Waiting Time'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting']['base_waiting_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inter Fare Distance'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting']['inter_fare_distance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __(' Inter Fare Time'); ?></dt>
		<dd>
			<?php echo h($priceSetting['PriceSetting'][' inter_fare_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Price Setting'), array('action' => 'edit', $priceSetting['PriceSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Price Setting'), array('action' => 'delete', $priceSetting['PriceSetting']['id']), null, __('Are you sure you want to delete # %s?', $priceSetting['PriceSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Price Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price Setting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
