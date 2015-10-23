<style>
	.fltrighr{
		float: right;
	}
</style>

<div class="creatTol">
	<div class="form">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend><?php echo __('Add Company Admin User'); ?>
			<?php echo $this->Html->link('Back',array('action'=>'index','admin'=>true),array('class'=>'bottonbackclass'));?>
			</legend>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('f_name',array('leble'=>'First Name'));
			echo $this->Form->input('l_name',array('leble'=>'First Name'));
			echo $this->Form->input('email');
			echo $this->Form->input('pass',array('leble'=>'Password'));
			echo $this->Form->input('mobile');
			echo $this->Form->hidden('company_id',array('value'=>$company_id));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>


