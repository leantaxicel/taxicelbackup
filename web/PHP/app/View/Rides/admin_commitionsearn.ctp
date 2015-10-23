<?php
	$baseurls = FULL_BASE_URL.$this->base."/admin";
	//$param = $this->params;
	//pr($param);
?>
<script type="text/javascript">
	var baseurl = "<?=$baseurls?>";
	var userid = "<?=$selectusers?>";
	$(document).ready(function(){
		$("#drvchoose").bind("change",filtrwithdriver);
		addblankdata();
	});
	function addblankdata(){
		$("#drvchoose").prepend("<option value='0'>-------</option>").val(userid);
	}
	function filtrwithdriver(e) {
		var user_id = $(e.currentTarget).val();
		if (user_id>0) {
			window.location = baseurl+"/Rides/commitionsearn/"+user_id;
		}
		else{
			window.location = baseurl+"/Rides/commitionsearn";
		}
	}
</script>
<div class="creatTol">
	<h2>Rides Commisions</h2>
	<?php
	echo $this->Form->input('driver',array('options'=>$drivers,'class'=>"mapDropdown",'div'=>'mapDrop','label'=>'Choose Driver','id'=>"drvchoose",'selected'=>$selectusers));
	?>
	<div class="clr"></div>
	<div class="rides index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('driver_id'); ?></th>
				<th><?php echo $this->Paginator->sort('distance_cost','Ride Cost ($)'); ?></th>
				<th><?php echo $this->Paginator->sort('comision_per','Commision Apply(%)'); ?></th>
				<th>Ride Commision ($)</th>
				<th><?php echo $this->Paginator->sort('commission_cost','Taxicel Earn ($)'); ?></th>
				<th>Referral Distribution ($)</th>
				<th><?php echo $this->Paginator->sort('commission_paid','Commision Satatus'); ?></th>
				
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($rides as $ride): ?>
		<tr>
			<td><?php echo h($ride['Ride']['id']); ?>&nbsp;</td>
			<td>
				<?php
					if(isset($ride['Driver']['email'])){
						echo $this->Html->link($ride['Driver']['email'], array('controller' => 'users', 'action' => 'view', $ride['Driver']['id']));
					}
					else{
						echo "Not Assign";
					}
				?>
			</td>
			
			<td><?php echo '$'.h($ride['Ride']['distance_cost']); ?>&nbsp;</td>
			<td>
				<?php echo h($ride['Ride']['comision_per']);?>
			</td>
			<!--<td><?php echo '$'.(h($ride['Ride']['commission_cost'])+h($ride['Ride']['refferal_cost']));?></td>-->
			<td><?php echo '$'.(h($ride['Ride']['commission_cost']));?></td>
			<td><?php echo '$'.(h($ride['Ride']['commission_cost'])-h($ride['Ride']['refferal_cost'])); ?>&nbsp;</td>
			<td><?php echo '$'.(h($ride['Ride']['refferal_cost']));?></td>
			<td><?php
				$status = h($ride['Ride']['commission_paid']);
				if($status==1){
					echo "Paid";
				}
				else{
					echo "Not Paid";
				}
			?></td>
			
			<td class="actions">
				<?php
					echo $this->Html->link(__('Details'), array('action' => 'view', $ride['Ride']['id']));
				?>
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
			echo $this->Paginator->prev('< ' . __('previous'), array('driver_id'=>'1'), null, array('class' => 'prev disabled'));
			echo $this->Paginator->first('<<' . __('First'), array(), null, array('class' => 'first disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->last(__('Last').' >>', array(), null, array('class' => 'last disabled'));
			echo $this->Paginator->next(__('next') . ' >', array('driver'=>'1'), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
</div>
