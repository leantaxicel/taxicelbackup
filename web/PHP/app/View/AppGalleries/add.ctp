<div class="appGalleries form">
<?php echo $this->Form->create('AppGallery'); ?>
	<fieldset>
		<legend><?php echo __('Add App Gallery'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List App Galleries'), array('action' => 'index')); ?></li>
	</ul>
</div>
