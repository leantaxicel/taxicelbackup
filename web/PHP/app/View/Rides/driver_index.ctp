<div class="creatTol">
	<h2>Rides</h2>
	<div class="clr"></div>
	<div class="rides index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('user_id'); ?></th>
				<th style="width:160px;"><?php echo $this->Paginator->sort('pick_up'); ?></th>
				<th style="width:160px;"><?php echo $this->Paginator->sort('drop_off'); ?></th>
				<th><?php echo $this->Paginator->sort('distance_cost','Ride Cost($)'); ?></th>
				<th><?php echo $this->Paginator->sort('date_time'); ?></th>
				<th><?php echo $this->Paginator->sort('commission_cost','Ride Commision($)'); ?></th>
				<th>You Earn($)</th>
				<!--<th><?php echo $this->Paginator->sort('commission_paid'); ?></th>-->
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($rides as $ride): ?>
		<tr>
			<td><?php echo h($ride['Ride']['id']); ?>&nbsp;</td>
			<td>
				<?php echo h($ride['User']['f_name']);?>
			</td>
			<td><?php echo h($ride['Ride']['pick_up']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['drop_off']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['distance_cost']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['date_time']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['commission_cost']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['distance_cost'] - $ride['Ride']['commission_cost']); ?>&nbsp;</td>
			<!--<td>
				<?php
					if(h($ride['Ride']['commission_paid'])==1){
						echo "Yes";
					}
					else{
						echo "No";
					}
				?>
			</td>-->
			<td><?php
				$status = h($ride['Ride']['status']);
				if($status==2){
					echo "Go To PickUp";
				}
				elseif($status==3){
					echo "Trip Started";	
				}
				elseif($status==4){
					echo "Completed";
				}
				elseif($status==5){
					echo "Cancelled";
				}
				else{
					echo "Accepted";
				}
			?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ride['Ride']['id']), null, __('Are you sure you want to delete # %s?', $ride['Ride']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>
		<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->prev('<< ' . __('First'), array(), null, array('class' => 'first disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('Last') . ' >>', array(), null, array('class' => 'last disabled'));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
</div>
