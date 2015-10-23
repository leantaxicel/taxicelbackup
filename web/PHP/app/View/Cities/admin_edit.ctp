<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="cities form">
	<?php echo $this->Form->create('City'); ?>
		<fieldset>
			<legend><?php echo __('Edit City'); ?>
				<?php echo $this->Html->link('Back',array('action'=>'index'),array('class'=>'bottonbackclass'));?>
			</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name');
			echo $this->Form->input('heatmap_visible_distance',array('label'=>'Heat Map Visible Distance (In meter)','min'=>'0'));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>
