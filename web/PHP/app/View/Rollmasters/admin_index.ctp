<?php 
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>Roll Masters Table</h2>
	 <p><a href="<?=$config['BaseUrl']?>admin/Rollmasters/add">Add Rolls</a></p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('roll_model'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rollmasters as $rollmaster): ?>
	<tr>
		<td><?php echo h($rollmaster['Rollmaster']['id']); ?>&nbsp;</td>
		<td style="width:700px;"><?php echo h($rollmaster['Rollmaster']['roll_model']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rollmaster['Rollmaster']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rollmaster['Rollmaster']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rollmaster['Rollmaster']['id']), null, __('Are you sure you want to delete # %s?', $rollmaster['Rollmaster']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rollmaster'), array('action' => 'add')); ?></li>
	</ul>
</div-->
