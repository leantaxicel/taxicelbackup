<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="cities form">
	<?php echo $this->Form->create('RechargeScheme'); ?>
		<fieldset>
			<legend><?php echo __('Add Recharge Scheme'); ?>
				<?php echo $this->Html->link('Back',array('action'=>'index','admin'=>true),array('class'=>"bottonbackclass"));?>
			</legend>
			
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name',array('required',));
			echo $this->Form->input('amount',array('label'=>'amount ($)','required'=>'true','min'=>'0'));
			echo $this->Form->input('point',array('required','min'=>'0'));
			//echo $this->Form->input('isactive',array('label'=>'Is Active','id'=>"isactive"));
		?>
		</fieldset>
		
	<?php echo $this->Form->end(__('Submit')); ?>
	
	</div>
</div>