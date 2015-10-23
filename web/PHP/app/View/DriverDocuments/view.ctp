<div class="driverDocuments view">
<h2><?php  echo __('Driver Document'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($driverDocument['User']['username'], array('controller' => 'users', 'action' => 'view', $driverDocument['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['expiry_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename Auth'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['filename_auth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date Auth'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['expiry_date_auth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status Auth'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['status_auth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename Lic'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['filename_lic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date Lic'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['expiry_date_lic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status Lic'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['status_lic']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename Oper'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['filename_oper']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date Oper'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['expiry_date_oper']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status Oper'); ?></dt>
		<dd>
			<?php echo h($driverDocument['DriverDocument']['status_oper']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Driver Document'), array('action' => 'edit', $driverDocument['DriverDocument']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Driver Document'), array('action' => 'delete', $driverDocument['DriverDocument']['id']), null, __('Are you sure you want to delete # %s?', $driverDocument['DriverDocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Driver Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Driver Document'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
