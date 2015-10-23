<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="cities form">
	<?php echo $this->Form->create('CarModel'); ?>
		<fieldset>
			<legend><?php echo __('Add CarModel'); ?>
				<?php echo $this->Html->link('Back',array('action'=>'index','admin'=>true),array('class'=>'bottonbackclass'));?>
			</legend>
			
		<?php
			echo $this->Form->input('car_id');
			echo $this->Form->input('name');
		?>
		</fieldset>
		
	<?php echo $this->Form->end(__('Submit')); ?>
	
	</div>
</div>