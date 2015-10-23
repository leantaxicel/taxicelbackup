<?php
	$config = Configure::read("TaxiCel"); // loading config	
?>

<div class="creatTol">
	<h2><?php echo __('Assign Company Owners'); ?></h2>
	<p><a href="<?=$config['BaseUrl']?>admin/AssignCompanyOwnners/add">Add Company Owners</a></p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th style="width:350px;"><?php echo $this->Paginator->sort('company_name'); ?></th>
			<th style="width:350px;"><?php echo $this->Paginator->sort('owner driver name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assignCompanyOwnners as $assignCompanyOwnner): ?>
	<tr>
		<td><?php echo h($assignCompanyOwnner['AssignCompanyOwnner']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assignCompanyOwnner['Company']['company_name'], array('controller' => 'companies', 'action' => 'view', $assignCompanyOwnner['Company']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($assignCompanyOwnner['User']['username'], array('controller' => 'users', 'action' => 'view', $assignCompanyOwnner['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $assignCompanyOwnner['AssignCompanyOwnner']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $assignCompanyOwnner['AssignCompanyOwnner']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $assignCompanyOwnner['AssignCompanyOwnner']['id']), null, __('Are you sure you want to delete # %s?', $assignCompanyOwnner['AssignCompanyOwnner']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Assign Company Ownner'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div-->
