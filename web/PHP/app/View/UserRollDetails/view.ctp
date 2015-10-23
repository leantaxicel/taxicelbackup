<div class="userRollDetails view">
<h2><?php  echo __('User Roll Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userRollDetail['UserRollDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($userRollDetail['UserRollDetail']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($userRollDetail['UserRollDetail']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Roll'); ?></dt>
		<dd>
			<?php echo h($userRollDetail['UserRollDetail']['roll']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Name'); ?></dt>
		<dd>
			<?php echo h($userRollDetail['UserRollDetail']['user_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pass'); ?></dt>
		<dd>
			<?php echo h($userRollDetail['UserRollDetail']['pass']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($userRollDetail['UserRollDetail']['email']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Roll Detail'), array('action' => 'edit', $userRollDetail['UserRollDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Roll Detail'), array('action' => 'delete', $userRollDetail['UserRollDetail']['id']), null, __('Are you sure you want to delete # %s?', $userRollDetail['UserRollDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Roll Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Roll Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
