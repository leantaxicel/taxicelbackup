<div class="creatTol">
	<div class="contactuses form">
	<?php echo $this->Form->create('Contactus'); ?>
		<fieldset>
			<legend><?php echo __('Admin Edit Contactus'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name');
			echo $this->Form->input('email');
			echo $this->Form->input('contact_no');
			echo $this->Form->input('message');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
