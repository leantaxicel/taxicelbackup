<div class="rollmasters view">
<h2><?php  echo __('Rollmaster'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rollmaster['Rollmaster']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Roll Model'); ?></dt>
		<dd>
			<?php echo h($rollmaster['Rollmaster']['roll_model']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rollmaster'), array('action' => 'edit', $rollmaster['Rollmaster']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rollmaster'), array('action' => 'delete', $rollmaster['Rollmaster']['id']), null, __('Are you sure you want to delete # %s?', $rollmaster['Rollmaster']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rollmasters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rollmaster'), array('action' => 'add')); ?> </li>
	</ul>
</div>
