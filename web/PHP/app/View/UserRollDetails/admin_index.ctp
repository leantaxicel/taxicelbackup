<?php 
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2><?php echo __('User Roll Details'); ?></h2>
	 <p><a href="<?=$config['BaseUrl']?>admin/UserRollDetails/add">Add User Rolls</a></p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('roll_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_name'); ?></th>
			<th><?php echo $this->Paginator->sort('pass'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	
	<?php foreach ($userRollDetails as $userRollDetail):
	//pr($userRollDetail);
	//die();
	?>
	
	<tr>
		<td><?php echo h($userRollDetail['UserRollDetail']['id']); ?>&nbsp;</td>
		<td><?php echo h($userRollDetail['UserRollDetail']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($userRollDetail['UserRollDetail']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($userRollDetail['Rollmaster']['roll_model']); ?>&nbsp;</td>
		<td><?php echo h($userRollDetail['UserRollDetail']['user_name']); ?>&nbsp;</td>
		<td><?php echo h($userRollDetail['UserRollDetail']['pass']); ?>&nbsp;</td>
		<td><?php echo h($userRollDetail['UserRollDetail']['email']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userRollDetail['UserRollDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userRollDetail['UserRollDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userRollDetail['UserRollDetail']['id']), null, __('Are you sure you want to delete # %s?', $userRollDetail['UserRollDetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User Roll Detail'), array('action' => 'add')); ?></li>
	</ul>
</div-->