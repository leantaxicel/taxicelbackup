<div class="userCreditDetails view">
<h2><?php  echo __('User Credit Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userCreditDetail['UserCreditDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userCreditDetail['User']['username'], array('controller' => 'users', 'action' => 'view', $userCreditDetail['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Credit Card No'); ?></dt>
		<dd>
			<?php echo h($userCreditDetail['UserCreditDetail']['credit_card_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($userCreditDetail['UserCreditDetail']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Credit Detail'), array('action' => 'edit', $userCreditDetail['UserCreditDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Credit Detail'), array('action' => 'delete', $userCreditDetail['UserCreditDetail']['id']), null, __('Are you sure you want to delete # %s?', $userCreditDetail['UserCreditDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Credit Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Credit Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
