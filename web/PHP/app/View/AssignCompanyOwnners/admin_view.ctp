<div class="creatTol">
<h2><?php  echo __('Company Ownner'); ?></h2>
	<div class="dltotal">
		<dl>
			<dt class="dhleft"><?php echo __('Id'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($assignCompanyOwnner['AssignCompanyOwnner']['id']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Company'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo $this->Html->link($assignCompanyOwnner['Company']['company_name'], array('controller' => 'companies', 'action' => 'view', $assignCompanyOwnner['Company']['id'])); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('User'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo $this->Html->link($assignCompanyOwnner['User']['username'], array('controller' => 'users', 'action' => 'view', $assignCompanyOwnner['User']['id'])); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
	</div>
</div>
<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assign Company Ownner'), array('action' => 'edit', $assignCompanyOwnner['AssignCompanyOwnner']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assign Company Ownner'), array('action' => 'delete', $assignCompanyOwnner['AssignCompanyOwnner']['id']), null, __('Are you sure you want to delete # %s?', $assignCompanyOwnner['AssignCompanyOwnner']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assign Company Ownners'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assign Company Ownner'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div-->
