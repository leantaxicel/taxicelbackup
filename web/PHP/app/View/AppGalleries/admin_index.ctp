<?php
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>App Galleries</h2>
	<p><a href="<?=$config['BaseUrl']?>admin/AppGalleries/add">Add New Gallery Content</a></p>
	<div class="clr"></div>
	<div class="appGalleries index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('ios_image'); ?></th>
				<th><?php echo $this->Paginator->sort('android_image'); ?></th>
				<th><?php echo $this->Paginator->sort('gallery_text'); ?></th>
				<th><?php echo $this->Paginator->sort('is_background_image'); ?></th>
				<th class="actions" style="width:320px;"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($appGalleries as $appGallery): ?>
		<tr>
			<td><?php echo h($appGallery['AppGallery']['id']); ?>&nbsp;</td>
			<td><img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/appPic/thumb_<?=$appGallery['AppGallery']['ios_image']?>" width="50" height="40"/>&nbsp;</td>
			<td><img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/appPic/thumb_<?=$appGallery['AppGallery']['android_image']?>" width="50" height="40"/>&nbsp;</td>
			<td><?php echo h($appGallery['AppGallery']['gallery_text']); ?>&nbsp;</td>
			<td>
				<? if($appGallery['AppGallery']['is_background_image']=='1'){
					echo "Yes";
				}else{
					echo "No";
				}?>&nbsp;
			</td>
			<td class="actions">
				<!--?php echo $this->Html->link(__('View'), array('action' => 'view', $appGallery['AppGallery']['id'])); ?-->
				<?php 
					if($appGallery['AppGallery']['is_background_image']=='1'){
						echo $this->Html->link(__('Not a background Image'), array('action' => 'isbackground', $appGallery['AppGallery']['id'])); 
					}else{
						echo $this->Html->link(__('Background Image'), array('action' => 'isbackground', $appGallery['AppGallery']['id'])); 
					}
				?>
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
			echo $this->Paginator->first('<<' . __('First'), array(), null, array('class' => 'first disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->last(__('Last').' >>', array(), null, array('class' => 'last disabled'));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
</div>