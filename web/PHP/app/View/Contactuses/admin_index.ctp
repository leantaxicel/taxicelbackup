<?php
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>Enquiries</h2>
	<div class="clr"></div>
	<div class="contactuses index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th><?php echo $this->Paginator->sort('contact_no'); ?></th>
				<th><?php echo $this->Paginator->sort('message'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($contactuses as $contactus): ?>
		<tr>
			<td><?php echo h($contactus['Contactus']['id']); ?>&nbsp;</td>
			<td><?php echo h($contactus['Contactus']['name']); ?>&nbsp;</td>
			<td><?php echo h($contactus['Contactus']['email']); ?>&nbsp;</td>
			<td><?php echo h($contactus['Contactus']['contact_no']); ?>&nbsp;</td>
			<td><?php echo h($contactus['Contactus']['message']); ?>&nbsp;</td>
			<td class="actions">
				
				<!--a href="<?=$config['BaseUrl']?>driver/Users/edit/<?=$this->Session->read('driver_id')?>" class="viewProfilebtn">Edit Infomation</a-->
				
				<a href="<?=$config['BaseUrl']?>admin/Contactuses/replay/<?=$contactus['Contactus']['id'];?>">Reply</a>
				
				<!--?php echo $this->Html->link(__('Reply'), array('action' => 'reply', $contactus['Contactus']['id'])); ?-->
				
				<!--?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contactus['Contactus']['id'])); ?-->
				
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contactus['Contactus']['id']), null, __('Are you sure you want to delete # %s?', $contactus['Contactus']['id'])); ?>
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


