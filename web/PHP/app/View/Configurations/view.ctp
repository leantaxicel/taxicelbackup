<div class="configurations view">
<h2><?php  echo __('Configuration'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Andversion'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['andversion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iosversion'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['iosversion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ride Later Limit'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['ride_later_limit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promotion Value'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['promotion_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Googlekey'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['googlekey']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wait Time Charge'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['wait_time_charge']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Withdraw Limit'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['withdraw_limit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Websiteurl'); ?></dt>
		<dd>
			<?php echo h($configuration['Configuration']['websiteurl']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Configuration'), array('action' => 'edit', $configuration['Configuration']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Configuration'), array('action' => 'delete', $configuration['Configuration']['id']), null, __('Are you sure you want to delete # %s?', $configuration['Configuration']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Configurations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Configuration'), array('action' => 'add')); ?> </li>
	</ul>
</div>
