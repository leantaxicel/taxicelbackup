<div class="creatTol">
	<div class="blogs form">
	<?php echo $this->Form->create('Blog',array('type'=>'file')); ?>
		<fieldset>
			<legend><?php echo __('Edit Blog'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('title');
			echo $this->Form->input('description');
			echo $this->Form->input('image',array('type'=>'file','style'=>'border:none;'));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>
