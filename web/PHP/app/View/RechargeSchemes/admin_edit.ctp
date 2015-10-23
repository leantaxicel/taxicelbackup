<?php
	//$baseurls = FULL_BASE_URL.$this->base."/admin";
?>
<style>
	.fltrighr{
		float: right;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#isactive").bind('keyup',validatevalue);
	});
	function validatevalue(e) {
		var val  = $(e.currentTarget).val();
		if (val<0) {
			$(e.currentTarget).val('0');
		}
		if (val>1) {
			$(e.currentTarget).val('1');
		}
	}
</script>
<div class="creatTol">
	
	<div class="cities form">
	<?php echo $this->Form->create('RechargeScheme'); ?>
		<fieldset>
			<legend><?php echo __('Edit Recharge Scheme'); ?>
				<?php echo $this->Html->link('Back',array('action'=>'index'),array('class'=>"bottonbackclass"));?>
			</legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name',array('required'));
			echo $this->Form->input('amount',array('label'=>'amount ($)','required'=>'true','min'=>'0'));
			echo $this->Form->input('point',array('required','min'=>'0'));
			//echo $this->Form->input('isactive',array('label'=>'Is Active','id'=>"isactive"));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>
