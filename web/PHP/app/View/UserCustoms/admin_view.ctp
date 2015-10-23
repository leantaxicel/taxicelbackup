<div class="userCustomers view">
<h2><?php  echo __('User Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userCustomer['UserCustomer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userCustomer['User']['username'], array('controller' => 'users', 'action' => 'view', $userCustomer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Pic'); ?></dt>
		<dd>
			<?php echo h($userCustomer['UserCustomer']['user_pic']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Customer'), array('action' => 'edit', $userCustomer['UserCustomer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Customer'), array('action' => 'delete', $userCustomer['UserCustomer']['id']), null, __('Are you sure you want to delete # %s?', $userCustomer['UserCustomer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Customer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
