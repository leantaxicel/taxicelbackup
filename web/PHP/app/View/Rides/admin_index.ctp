<?php
	$baseurls = FULL_BASE_URL.$this->base."/admin";
?>
<script type="text/javascript">
	var baseurl = "<?=$baseurls?>";
	var ridetype = "<?=$ridetype?>";
	$(document).ready(function(){
		$("#drvchoose").bind("change",filtrwithdriver);
		addblankdata();
		//$(".firstshow").
		//scrolling
		
		$(".creatTol").scroll( function() {
			var scrpos = $("#creatTol").scrollTop();
			var divheight = parseInt($("#creatTol").height());
			
			/*var tableheight = parseInt($("#tabls").height());
			var scrolend = tableheight-divheight;
			
			if(scrolend == scrpos && pageloading==false && cityName!=''){
			}*/
		});
	});
	function addblankdata(){
		$("#drvchoose").val(ridetype);
	}
	function filtrwithdriver(e) {
		var user_id = $(e.currentTarget).val();
		//alert(user_id);
		if (user_id!='-1') {
			window.location = baseurl+"/Rides/index/"+user_id;
		}
		else{
			window.location = baseurl+"/Rides";
		}
	}
</script>
<div class="creatTol">
	<h2>Rides</h2>
	<?php
	echo $this->Form->input('ride_type',array('options'=>array('-1'=>'-----','0'=>'Ride Now','1'=>'Ride Later'),'class'=>"mapDropdown",'div'=>'mapDrop','label'=>'Ride Type','id'=>"drvchoose",'selected'=>$ridetype));
	?>
	<div class="clr"></div>	
	<div class="rides index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('user_id'); ?></th>
				<th style="width:134px;"><?php echo $this->Paginator->sort('driver_id'); ?></th>
				
				<th><?php echo $this->Paginator->sort('pick_up'); ?></th>
				<th><?php echo $this->Paginator->sort('drop_off'); ?></th>
				<th><?php echo $this->Paginator->sort('distance_cost','Distance Cost ($)'); ?></th>
				<!--<th><?php echo $this->Paginator->sort('total_distance'); ?></th>
				<th><?php echo $this->Paginator->sort('total_time'); ?></th>-->
				<th><?php echo $this->Paginator->sort('payment_option'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('date_time'); ?></th>
				<th><?php echo $this->Paginator->sort('ride_type'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($rides as $ride): ?>
		<tr>
			<td><?php echo h($ride['Ride']['id']); ?>&nbsp;</td>
			<!--td>
				<?php echo $this->Html->link($ride['User']['f_name'], array('controller' => 'users', 'action' => 'view', $ride['User']['id'])); ?>
			</td-->
			<td>
				<?php echo h($ride['User']['f_name']);?>
			</td>
			<td>
				<?php
					if(isset($ride['Driver']['email'])){
						$email = (strlen($ride['Driver']['email'])>10)?substr($ride['Driver']['email'],0,10).' '.substr($ride['Driver']['email'],11,strlen($ride['Driver']['email'])):$ride['Driver']['email'];
						echo $this->Html->link($email, array('controller' => 'users', 'action' => 'view', $ride['Driver']['id']));
					}
					else{
						echo "Not Assign";
					}
				?>
			</td>
			<td><?php echo h($ride['Ride']['pick_up']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['drop_off']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['distance_cost']); ?>&nbsp;</td>
			<!--<td><?php echo h($ride['Ride']['total_distance']); ?>&nbsp;</td>
			<td><?php echo h($ride['Ride']['total_time']); ?>&nbsp;</td> -->
			<td>
				<?php echo ($ride['Ride']['payment_option']==1)?"Credit Card":"Cash";?>
			</td>
			<td> <?php
				$status = h($ride['Ride']['status']);
				if($status==1){
					echo "Driver Assign";
				}
				elseif($status==2){
					echo "Driver On Way";
				}
				elseif($status==3){
					echo "Trip Started";
				}
				elseif($status==4){
					echo "Trip Completed";
				}
				elseif($status==5){
					echo "Trip Cancelled";
				}
				else{
					echo "Driver Not Assign";
				}
			?></td>
			<td><?php echo h($ride['Ride']['date_time']); ?>&nbsp;</td>
			<td><?=h(($ride['Ride']['ride_type']==1)?"Ride Later":"Ride Now")?></td>
			<td class="actions">
				<!--?php echo $this->Html->link(__('View'), array('action' => 'view', $ride['Ride']['id'])); ?-->
				<!--?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ride['Ride']['id'])); ?-->
				<?php
					if($ride['Ride']['user_id']==0){
						echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ride['Ride']['id']), array('class'=>'deletedcls'), __('Are you sure you want to delete # %s?', $ride['Ride']['id']));
					}
					if($ride['Ride']['ride_type']==1 && $ride['Ride']['user_id']>0 && $ride['Ride']['status']==0){
						echo $this->Html->link(__('Dispatch'), array('action' => 'onlinedrivers', $ride['Ride']['id']),array('class'=>'dispatchecls'));
					}
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
			
			
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->first('<<' . __('First'), array(), null, array('class' => 'first disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->last(__('Last').' >>', array(), null, array('class' => 'last disabled'));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
			
		?>
		</div>
	</div>
</div>
