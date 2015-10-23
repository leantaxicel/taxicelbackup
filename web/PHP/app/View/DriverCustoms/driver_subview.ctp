<div class="creatTol">
	<h2>Driver Details</h2>
	
	<?php //pr($options);?>
	<div class="dltotal">
		<dl>
			<dt class="dhleft">ID</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['id'] ; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">Name</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['f_name']." ".$options['User']['l_name']; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">User Name</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['username']; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">Password</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['pass']; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">Email</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['email']; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">Mobile No</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['mobile']; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">Address</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['address']; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">Reffered By</dt>
			<dd class="dhright">
				:&nbsp;<?php echo $options['User']['email']; ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft">Image</dt>
			<dd class="dhright">
				:&nbsp;<img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/userPic/thumb_<?=$options['DriverCustom']['user_pic']?>" width="80" height="80"/>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
		</dl>
	</div>
</div>



<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Driver Document'), array('action' => 'edit', $driverDocument['DriverDocument']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Driver Document'), array('action' => 'delete', $driverDocument['DriverDocument']['id']), null, __('Are you sure you want to delete # %s?', $driverDocument['DriverDocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Driver Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Driver Document'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div-->
