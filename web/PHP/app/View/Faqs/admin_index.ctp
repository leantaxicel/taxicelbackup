<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>Support & Faq</h2>
    <p><a href="<?=$config['BaseUrl']?>admin/Faqs/add">Add Faq</a></p>
    <div class="clr"></div>
	<div class="faqs index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('question'); ?></th>
				<th><?php echo $this->Paginator->sort('answer'); ?></th>
				<!--th><?php echo $this->Paginator->sort('is_active'); ?></th-->
				<th class="actions" style="width:135px;"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($faqs as $faq): ?>
		<tr>
			<td><?php echo h($faq['Faq']['id']); ?>&nbsp;</td>
			<td><?php echo h($faq['Faq']['question']); ?>&nbsp;</td>
			<td><?php echo h($faq['Faq']['answer']); ?>&nbsp;</td>
			<!--td><?php echo h($faq['Faq']['is_active']); ?>&nbsp;</td-->
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $faq['Faq']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $faq['Faq']['id']), null, __('Are you sure you want to delete # %s?', $faq['Faq']['id'])); ?>
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
