<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="priceSettings form">
	<?php echo $this->Form->create('PriceSetting'); ?>
		<fieldset>
			<legend><?php echo __('Price Setting'); ?>
			<?php echo $this->Html->link('Back',array('action'=>'index'),array('class'=>'bottonbackclass'));?>
			</legend>
			<?php
			echo $this->Form->input('city_id');
			echo $this->Form->input('base_fare',array('min="0"'));
			echo $this->Form->input('base_distance',array('label'=>'Base Distance(Km)','min'=>'0'));
			echo $this->Form->input('fare_per_meter',array('min="0"'));
			echo $this->Form->input('fare_per_minute',array('min="0"'));
			echo $this->Form->input('base_waiting_time',array('min="0"'));
			echo $this->Form->input('inter_fare_distance',array('min="0"'));
			echo $this->Form->input('inter_fare_time',array('min="0"'));
			echo $this->Form->input('additional_wait_time',array('min="0"'));
			echo $this->Form->input('additional_wait_amount',array('min="0"'));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>