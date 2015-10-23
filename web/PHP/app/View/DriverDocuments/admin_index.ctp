<?php
	 $config = Configure::read("TaxiCel"); // loading config
	 $baseurls = FULL_BASE_URL.$this->base."/admin/";
?>

<div class="creatTol">
	<h2>Driver Documents</h2>
	<div class="clr"></div>
	<div class="rides index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th>Policy of Insurance</th>
			
			<!--th><?php echo $this->Paginator->sort('expiry_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th-->
			
			<th>Driver Authority Card</th>
			
			<!--th><?php echo $this->Paginator->sort('expiry_date_auth'); ?></th>
			<th><?php echo $this->Paginator->sort('status_auth'); ?></th-->
			
			<th>Driver License Card</th>
			<th><?php echo $this->Paginator->sort('expiry_date_lic'); ?></th>
			
			<!--th><?php echo $this->Paginator->sort('status_lic'); ?></th-->
			
			<th>Operator Accreditation</th>
			
			<!--th><?php echo $this->Paginator->sort('expiry_date_oper'); ?></th>
			<th><?php echo $this->Paginator->sort('status_oper'); ?></th-->
			
			
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($driverDocuments as $driverDocument): ?>
	<tr>
		<td><?php echo h($driverDocument['DriverDocument']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($driverDocument['User']['username'], array('controller' => 'users', 'action' => 'view', $driverDocument['User']['id'])); ?>
		</td>
		
		<td><img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename'];?>" alt="" width="100" height="100"/></td>
		
		
		<!--td><?php echo h($driverDocument['DriverDocument']['expiry_date']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['status']); ?>&nbsp;</td-->
		
		<td><img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename_auth'];?>" alt="" width="100" height="100"/></td>
		
		
		<!--td><?php echo h($driverDocument['DriverDocument']['expiry_date_auth']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['status_auth']); ?>&nbsp;</td-->
		
		<td><img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename_lic'];?>" alt="" width="100" height="100"/></td>
		<td><?php echo h($driverDocument['DriverDocument']['expiry_date_lic']); ?>&nbsp;</td>
		
		<!--td><?php echo h($driverDocument['DriverDocument']['status_lic']); ?>&nbsp;</td-->
		
		<td><img src="<?php echo $config['BaseUrl']."/userDoc/".$driverDocument['DriverDocument']['filename_oper'];?>" alt="" width="100" height="100"/></td>
		
		<!--td><?php echo h($driverDocument['DriverDocument']['expiry_date_oper']); ?>&nbsp;</td>
		<td><?php echo h($driverDocument['DriverDocument']['status_oper']); ?>&nbsp;</td-->
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $driverDocument['DriverDocument']['id'])); ?>
			
			<!--?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $driverDocument['DriverDocument']['id'])); ?-->
			<!--?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $driverDocument['DriverDocument']['id']), null, __('Are you sure you want to delete # %s?', $driverDocument['DriverDocument']['id'])); ?-->
		
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
<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Driver Document'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div-->
