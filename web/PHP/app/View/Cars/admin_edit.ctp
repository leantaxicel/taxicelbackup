<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="cars form">
	<?php echo $this->Form->create('Car'); ?>
		<fieldset>
			<legend><?php echo __('Edit Car'); ?>
			<?php echo $this->Html->link('Back',array('action'=>'index','admin'=>true),array('class'=>'bottonbackclass'));?>
			</legend>
		<?php
			echo $this->Form->input('id');
			//echo $this->Form->input('model_id');
			echo $this->Form->input('name');
			//echo $this->Form->input('is_active');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>