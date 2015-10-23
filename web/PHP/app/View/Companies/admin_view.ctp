<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
<h2><?php  echo __('Company'); ?></h2>
	<div><?php echo $this->Html->link('Back',array('action'=>'index','admin'=>true),array('class'=>'bottonbackclass2'));?></div>
	<div class="dltotal">
		<dl>
			<dt class="dhleft"><?php echo __('Id'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($company['Company']['id']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Company Name'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($company['Company']['company_name']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Company Address'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($company['Company']['company_address']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			<dt class="dhleft"><?php echo __('Contact No'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($company['Company']['contact_no']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Email Address'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($company['Company']['email_address']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Website'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($company['Company']['website']); ?>
				&nbsp;
			</dd>
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Details'); ?></dt>
			<dd class="dhright">
				:&nbsp;<?php echo h($company['Company']['details']); ?>
				&nbsp;
			</dd>	
			<div class="clr"></div>
			
			<dt class="dhleft"><?php echo __('Company Logo'); ?></dt>
			<dd class="dhright">
				:&nbsp;<img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/companyLogo/thumb_<?=$company['Company']['company_logo']?>" width="80" height="80"/>
				&nbsp;
			</dd>
			<div class="clr"></div>
		</dl>
	</div>	
</div>
