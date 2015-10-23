<div class="appGalleries form">
<?php echo $this->Form->create('AppGallery'); ?>
	<fieldset>
		<legend><?php echo __('Edit App Gallery'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ios_image');
		echo $this->Form->input('android_image');
		echo $this->Form->input('gallery_text');
		echo $this->Form->input('is_background_image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AppGallery.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AppGallery.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List App Galleries'), array('action' => 'index')); ?></li>
	</ul>
</div>
