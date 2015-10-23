<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="cities form">
	<?php echo $this->Form->create('DriverCommisionDistribution'); ?>
		<fieldset>
			<legend><?php echo __('Add Driver Commision Distribution'); ?>
				<?php echo $this->Html->link('Back',array('action'=>'index'),array('class'=>'bottonbackclass'));?>
			</legend>
			
		<?php
			echo $this->Form->input('min_range',array('label'=>'Minimum Number Of Referral User','min'=>'0'));
			echo $this->Form->input('max_range',array('label'=>'Maximun Number Of Referral User','min'=>'0'));
			echo $this->Form->input('commision_per',array('label'=>'Driver Get Commision(%)','min'=>'0'));
		?>
		</fieldset>
		
	<?php echo $this->Form->end(__('Submit')); ?>
	
	</div>
</div>