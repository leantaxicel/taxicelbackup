<div class="creatTol">
	<div class="faqs form">
	<?php echo $this->Form->create('Faq'); ?>
		<fieldset>
			<legend><?php echo __('Add Faq'); ?>
			<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass'))?>

			</legend>
		<?php
			echo $this->Form->input('question');
			echo $this->Form->input('answer');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
