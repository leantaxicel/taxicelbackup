<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="cars form">
	<?php echo $this->Form->create('Car'); ?>
		<fieldset>
			<legend><?php echo __('Add Car'); ?>
			<?php echo $this->Html->link('Back',array('action'=>'index','admin'=>true),array('class'=>'bottonbackclass'));?>
			</legend>
		<?php
			echo $this->Form->hidden('model_id',array('value'=>'1'));
			echo $this->Form->input('name');
			//echo $this->Form->input('is_active');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
