<div class="appGalleries index">
	<h2><?php echo __('App Galleries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('ios_image'); ?></th>
			<th><?php echo $this->Paginator->sort('android_image'); ?></th>
			<th><?php echo $this->Paginator->sort('gallery_text'); ?></th>
			<th><?php echo $this->Paginator->sort('is_background_image'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($appGalleries as $appGallery): ?>
	<tr>
		<td><?php echo h($appGallery['AppGallery']['id']); ?>&nbsp;</td>
		<td><?php echo h($appGallery['AppGallery']['ios_image']); ?>&nbsp;</td>
		<td><?php echo h($appGallery['AppGallery']['android_image']); ?>&nbsp;</td>
		<td><?php echo h($appGallery['AppGallery']['gallery_text']); ?>&nbsp;</td>
		<td><?php echo h($appGallery['AppGallery']['is_background_image']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $appGallery['AppGallery']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $appGallery['AppGallery']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $appGallery['AppGallery']['id']), null, __('Are you sure you want to delete # %s?', $appGallery['AppGallery']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New App Gallery'), array('action' => 'add')); ?></li>
	</ul>
</div>