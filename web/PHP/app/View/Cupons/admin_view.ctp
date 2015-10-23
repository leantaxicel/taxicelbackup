<div class="cupons view">
<h2><?php  echo __('Cupon'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cupon['Cupon']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cupon Code'); ?></dt>
		<dd>
			<?php echo h($cupon['Cupon']['cupon_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discount'); ?></dt>
		<dd>
			<?php echo h($cupon['Cupon']['discount']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cupon'), array('action' => 'edit', $cupon['Cupon']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cupon'), array('action' => 'delete', $cupon['Cupon']['id']), null, __('Are you sure you want to delete # %s?', $cupon['Cupon']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cupons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cupon'), array('action' => 'add')); ?> </li>
	</ul>
</div>
