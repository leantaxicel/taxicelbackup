<div class="creatTol">
	<div class="appGalleries form">
	<?php echo $this->Form->create('AppGallery',array('type'=>'file')); ?>
		<fieldset>
			<legend><?php echo __('Add New Gallery Content'); ?>
			<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass'))?>
			</legend>
		<?php
			echo $this->Form->input('ios_image',array('style'=>'border:none;','type'=>'file','label'=>'IOS Image'));
			echo $this->Form->input('android_image',array('style'=>'border:none;','type'=>'file'));
			echo $this->Form->input('gallery_text');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
