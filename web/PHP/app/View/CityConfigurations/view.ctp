<div class="cityConfigurations view">
<h2><?php  echo __('City Configuration'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cityConfiguration['City']['name'], array('controller' => 'cities', 'action' => 'view', $cityConfiguration['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Fare'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['base_fare']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Distance'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['base_distance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fare Per Meter'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['fare_per_meter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fare Per Minute'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['fare_per_minute']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Waiting Time'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['base_waiting_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inter Fare Distance'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['inter_fare_distance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inter Fare Time'); ?></dt>
		<dd>
			<?php echo h($cityConfiguration['CityConfiguration']['inter_fare_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit City Configuration'), array('action' => 'edit', $cityConfiguration['CityConfiguration']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete City Configuration'), array('action' => 'delete', $cityConfiguration['CityConfiguration']['id']), null, __('Are you sure you want to delete # %s?', $cityConfiguration['CityConfiguration']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List City Configurations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City Configuration'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
