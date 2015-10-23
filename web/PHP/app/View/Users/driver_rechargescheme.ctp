<?php
	$baseurls = FULL_BASE_URL.$this->base;
?>
<div class="creatTol">
	<h2>Account Recharges </h2>
	<div class="clr"></div>
	<div class="rides index">
		<table cellpadding="0" cellspacing="0">
			<tr>
				
				<th>Scheme Name</th>
				<th>Cost</th>
				<!--th>Points</th-->
				<th>Recharge Date</th>
				<!--th class="actions"><?php echo __('Actions'); ?></th-->
			</tr>
			<?php foreach ($recharge as $recharg): ?>
			<tr>
				<td><?php
					if(h($recharg['CommissionPayment']['scheme_id'])==0){
						echo "Admin Offer";
					}
					else{
						echo h($recharg['RechargeScheme']['name']);
					}
					
				?>&nbsp;</td>
				<td><?php echo h($recharg['CommissionPayment']['paying_cost']); ?>&nbsp;</td>
				<!--td><?php echo h($recharg['RechargeScheme']['point']); ?>&nbsp;</td-->
				<td><?php echo h($recharg['CommissionPayment']['paying_date']); ?>&nbsp;</td>
				
				<!--td class="actions">
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vehicleDetail['VehicleDetail']['id']), null, __('Are you sure you want to delete # %s?', $vehicleDetail['VehicleDetail']['id'])); ?>
				</td-->
			</tr>
			<?php endforeach; ?>
		</table>
	
	</div>
</div>
