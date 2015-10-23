<?php 
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>Sub Driver Table</h2>
		<?php 
		$isactive = $userinfo['DriverCustom']['is_owner']; 
		if($isactive > 0){
		?>
	<p><a href="<?=$config['BaseUrl']?>driver/DriverCustoms/subadd">Add Driver</a></p>
	<?php }?>
	 <!--
		<?php
			if($stat==3){
		?>
		<div class="opps" style="display:none;">
			<p><span>Oh snap!</span> Password doesnt match, please try again.</p>
			<div class="clr"></div>
		</div>
		<?php }?>
		<?php
			if($stat==2){
		?>
		<div class="opps" style="display:none;">
			<p><span>Oh snap!</span> The driver could not be saved. Please, try again.</p>
			<div class="clr"></div>
		</div>
		<?php }?>
		<?php
			if($stat==1){
		?>
		
		<div class="opps oppsact" style="padding:0 10px;">
			<p>You have been successfully registered.</p>
			<div class="clr"></div>
		</div>
		<?php }?>
	 -->
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th>First Name</th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th>Image</th>
			<th class="actions" style="width:200px;"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($users as $driverCustom):?>
		<tr>
			<td><?php echo h($driverCustom['User']['id']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($driverCustom['User']['username'], array('controller' => 'Users', 'action' => 'view', $driverCustom['User']['id'])); ?></td>
			<td><?php echo h($driverCustom['User']['f_name']); ?>&nbsp;</td>
			<td><?php echo h($driverCustom['User']['email']); ?>&nbsp;</td>
			<td><?php echo h($driverCustom['User']['mobile']); ?>&nbsp;</td>
			<td><?php echo h($driverCustom['User']['address']); ?>&nbsp;</td>
			<td><img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/userPic/thumb_<?=$driverCustom['DriverCustom']['user_pic']?>" width="80" height="80"/></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'subview', $driverCustom['User']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'subedit', $driverCustom['User']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'subdelete', $driverCustom['User']['id']), null, __('Are you sure you want to delete # %s?', $driverCustom['User']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>
	</p>
	<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>

<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Driver Document'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div-->
