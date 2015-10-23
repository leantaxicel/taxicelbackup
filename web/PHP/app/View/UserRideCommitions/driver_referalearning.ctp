<?php
	$baseurls = FULL_BASE_URL.$this->base;
?>
<div class="creatTol">
	<div class="referalactions">
		<h2>Referral Earning</h2>
		<p class="referalactions2">
		<?php $totalEarning=0;?>
		
		<?php foreach ($commition as $commitions){ 
		
			$totalEarning = $totalEarning + $commitions['UserRideCommition']['amount'];
		}?>
		
			Total Earning Points :<?php echo $totalEarning;?> 
		</p>
		<div class="clr"></div>
	</div>
	
	<div class="rides index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>ID</th>
			<th>Ride ID</th>
			<th>Amount</th>
			<th>Date</th>
			<!--th class="actions"><?php echo __('Actions'); ?></th-->
	</tr>
	<?php foreach ($commition as $commitions): ?>
	<tr>
		<td><?php echo h($commitions['UserRideCommition']['id']); ?>&nbsp;</td>
		<td><?php echo h($commitions['UserRideCommition']['ride_id']); ?>&nbsp;</td>
		<td><?php echo h($commitions['UserRideCommition']['amount']); ?>&nbsp;</td>
		<td><?php echo h($commitions['UserRideCommition']['crt_date']); ?>&nbsp;</td>
		
		<!--td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userRideRating['UserRideRating']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userRideRating['UserRideRating']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userRideRating['UserRideRating']['id']), null, __('Are you sure you want to delete # %s?', $userRideRating['UserRideRating']['id'])); ?>
		</td-->
	</tr>
<?php endforeach; ?>
	</table>
</div>
