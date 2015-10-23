<div class="contactuses view">
<h2><?php  echo __('Contactus'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contactus['Contactus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contactus['Contactus']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($contactus['Contactus']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact No'); ?></dt>
		<dd>
			<?php echo h($contactus['Contactus']['contact_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($contactus['Contactus']['message']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contactus'), array('action' => 'edit', $contactus['Contactus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contactus'), array('action' => 'delete', $contactus['Contactus']['id']), null, __('Are you sure you want to delete # %s?', $contactus['Contactus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contactuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contactus'), array('action' => 'add')); ?> </li>
	</ul>
</div>
