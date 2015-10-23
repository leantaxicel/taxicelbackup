<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2><?php echo __('Companies'); ?></h2>
	<?
		if($this->Session->check('superadmin') && $this->Session->read('superadmin')==1){
	?>
	<p><a href="<?=$config['BaseUrl']?>admin/Companies/add">Add Companies</a></p>
	<?	
		}
	?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('company_name'); ?></th>
			<th><?php echo $this->Paginator->sort('company_address'); ?></th>
			<th><?php echo $this->Paginator->sort('company_logo'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_no'); ?></th>
			<th><?php echo $this->Paginator->sort('email_address'); ?></th>
			<th><?php echo $this->Paginator->sort('website'); ?></th>
			<th><?php echo $this->Paginator->sort('details'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	
	<?php foreach ($companies as $company): ?>
	<tr>
		<td><?php echo h($company['Company']['id']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['company_name']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['company_address']); ?>&nbsp;</td>
		<td><img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/companyLogo/thumb_<?php echo $company['Company']['company_logo']?>" width="50" height="50"/>&nbsp;</td>
		<td><?php echo h($company['Company']['contact_no']); ?>&nbsp;</td>
		
		<!--td><?php echo h($company['Company']['email_address']); ?>&nbsp;</td>
		<td><?php echo h($company['Company']['website']); ?>&nbsp;</td-->
		
		<td><?php echo (strlen($company['Company']['email_address'])>13)?substr($company['Company']['email_address'],0,13).' '.substr($company['Company']['email_address'],14,strlen($company['Company']['email_address'])):$company['Company']['email_address']; ?>&nbsp;</td>
		
		<td><?php echo (strlen($company['Company']['website'])>13)?substr($company['Company']['website'],0,13).' '.substr($company['Company']['website'],14,strlen($company['Company']['website'])):$company['Company']['website']; ?>&nbsp;</td>
		
		<td><?php echo h($company['Company']['details']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $company['Company']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $company['Company']['id'])); ?>
			<?php echo $this->Html->link(__('Add Admin'), array('action' => 'administrator', $company['Company']['id'])); ?>
			
			<?
			if($this->Session->check('superadmin') && $this->Session->read('superadmin')==1){
			?>
			<?php echo $this->Html->link(__('Take Control'), array('action' => 'administratorchange', $company['Company']['id'])); ?>
			<?php echo $this->Html->link(__('Leave Control'), array('action' => 'administratorchangenormal', $company['Company']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $company['Company']['id']), null, __('Are you sure you want to delete # %s?', $company['Company']['id'])); ?>
			<?	
				}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<!--<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->last(__('Last').' >>', array(), null, array('class' => 'last disabled'));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>-->
</div>

