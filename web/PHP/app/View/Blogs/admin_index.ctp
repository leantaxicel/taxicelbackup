<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>Blogs</h2>
    <p><a href="<?=$config['BaseUrl']?>admin/Blogs/add">Add Blog</a></p>
    <div class="clr"></div>
	<div class="blogs index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('image'); ?></th>
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th style="width:100px;"><?php echo $this->Paginator->sort('date_time'); ?></th>
				<th class="actions" style="width:135px;"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($blogs as $blog): ?>
		<tr>
			<td><?php echo h($blog['Blog']['id']); ?>&nbsp;</td>
			<td><img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/blogPic/thumb_<?=$blog['Blog']['image']?>" width="50" height="40"/>&nbsp;</td>
			<td><?php echo h($blog['Blog']['title']); ?>&nbsp;</td>
			<td><?php echo h($blog['Blog']['description']); ?>&nbsp;</td>
			<td><?php echo h($blog['Blog']['date_time']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blog['Blog']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $blog['Blog']['id']), null, __('Are you sure you want to delete # %s?', $blog['Blog']['id'])); ?>
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
</div>
<!--?php echo $this->element('sql_dump'); ?-->