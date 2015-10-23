<div class="creatTol">
	<h2>Drivers</h2>
	<div class="clr"></div>
	<div class="users index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('username'); ?></th>
				<th><?php echo $this->Paginator->sort('f_name'); ?></th>
				<th><?php echo $this->Paginator->sort('l_name'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<!--th><?php echo $this->Paginator->sort('address'); ?></th-->
				<th><?php echo $this->Paginator->sort('reg_date'); ?></th>
				<th class="actions" style="width:140px;"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['f_name']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['l_name']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
			<!--td><?php echo h($user['User']['address']); ?>&nbsp;</td-->
			<td><?php echo h($user['User']['reg_date']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'],1)); ?>
				
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
				
				<?php echo $this->Html->link(__('Add Vehicle'), array('controller'=>'VehicleDetails','action' => 'addvehicle/'.$user['User']['id'],1)); ?>
				
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
			echo $this->Paginator->first('<<' . __('First'), array(), null, array('class' => 'first disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->last(__('Last').' >>', array(), null, array('class' => 'last disabled'));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		
		?>
		</div>
	</div>
</div>
