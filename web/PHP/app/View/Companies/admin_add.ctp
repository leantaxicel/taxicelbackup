<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
	<div class="form">
	<?php echo $this->Form->create('Company',array('type'=>'file')); ?>
		<fieldset>
			<legend><?php echo __('Add Company'); ?>
			<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass'))?>
			</legend>
		<?php
			echo $this->Form->input('company_name');
			echo $this->Form->input('company_address');
			echo $this->Form->input('company_logo',array('style'=>'border:none;','type'=>'file'));
			echo $this->Form->input('contact_no');
			echo $this->Form->input('email_address');
			echo $this->Form->input('website');
			echo $this->Form->input('details');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>


