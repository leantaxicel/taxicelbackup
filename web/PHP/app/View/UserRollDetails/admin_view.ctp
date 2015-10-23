<div class="creatTol">
<h2><?php  echo __('User Roll Details'); ?></h2>
	<div class="dltotal">
		<dl>
			<dt class="dhleft"><?php echo __('Id'); ?></dt>
			<dd class="dhright">
				<?php echo h($userRollDetail['UserRollDetail']['id']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('First Name'); ?></dt>
			<dd class="dhright">
				<?php echo h($userRollDetail['UserRollDetail']['first_name']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Last Name'); ?></dt>
			<dd class="dhright">
				<?php echo h($userRollDetail['UserRollDetail']['last_name']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Roll'); ?></dt>
			<dd class="dhright">
				<?php echo h($userRollDetail['Rollmaster']['roll_model']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('User Name'); ?></dt>
			<dd class="dhright">
				<?php echo h($userRollDetail['UserRollDetail']['user_name']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Pass'); ?></dt>
			<dd class="dhright">
				<?php echo h($userRollDetail['UserRollDetail']['pass']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Email'); ?></dt>
			<dd class="dhright">
				<?php echo h($userRollDetail['UserRollDetail']['email']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
	</div>	
</div>

<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Roll Detail'), array('action' => 'edit', $userRollDetail['UserRollDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Roll Detail'), array('action' => 'delete', $userRollDetail['UserRollDetail']['id']), null, __('Are you sure you want to delete # %s?', $userRollDetail['UserRollDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Roll Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Roll Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div-->
