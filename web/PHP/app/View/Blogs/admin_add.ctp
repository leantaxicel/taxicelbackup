<div class="creatTol">
	<div class="blogs form">
	<?php echo $this->Form->create('Blog',array('type'=>'file')); ?>
		<fieldset>
			<legend><?php echo __('Add Blog'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('description');
			echo $this->Form->input('image',array('type'=>'file','style'=>'border:none;'));
			echo $this->Form->hidden('date_time');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
