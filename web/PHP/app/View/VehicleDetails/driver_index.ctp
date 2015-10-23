<?php
	$baseurls = FULL_BASE_URL.$this->base;
?>
<script type="text/javascript">
	var baseurl = "<?=$baseurls?>";
	var userid = "<?=$userid?>";
	$(document).ready(function(){
		$(".clsdflt").bind("click",makedefault);
	});
	function makedefault(e) {
		var rowid = $(e.currentTarget).attr('id');
		$.ajax({
			url:baseurl+"/Services/makedefaultcar",
			method:'post',
			type:'json',
			data:{device_type:1,driver_id:userid,vhcleid:rowid},
			success:function(response){
				//window.reload();
				console.log(response);
				if (response.status==1) {
					location.reload();
				}
			},
			error:function(response){
				
			}
		});
	}
</script>

<div class="creatTol">
	<h2>Vehicle Details</h2>
	
	<div class="actions" style="margin:20px 0 0 0;">
		<ul>
			<li><?php echo $this->Html->link(__('Add New Vehicle Details'), array('action' => 'add')); ?></li>
		</ul>
	</div>
	<div class="clr"></div>
	<div class="rides index">
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('car_id'); ?></th>
		<th><?php echo $this->Paginator->sort('car_model_id'); ?></th>
		<th><?php echo $this->Paginator->sort('Manufacturing Date'); ?></th>
		<th><?php echo $this->Paginator->sort('vehicle_no'); ?></th>
		<th><?php echo $this->Paginator->sort('isdefault','Is Default'); ?></th>
		<th><?php echo $this->Paginator->sort('isapproved','Admin Approved'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vehicleDetails as $vehicleDetail): ?>
	<tr>
		<td><?php echo h($vehicleDetail['VehicleDetail']['id']); ?>&nbsp;</td>
		<td>
			<?php
			echo h($vehicleDetail['Car']['name']);
			?>
		</td>
		<td>
			<?php
			echo h($vehicleDetail['CarModel']['name']);
			?>
		</td>
		<td><?php echo h($vehicleDetail['VehicleDetail']['manufactureing_date']); ?>&nbsp;</td>
		<td><?php echo h($vehicleDetail['VehicleDetail']['vehicle_no']); ?>&nbsp;</td>
		<td><a href="javascript:void(0)" style="color:#474747;" class="clsdflt" id="<?=h($vehicleDetail['VehicleDetail']['id'])?>"><?php
			if(h($vehicleDetail['VehicleDetail']['isdefault'])==1){
				echo "Yes";
			}
			else{
				echo "No";
			}
		?></a></td>
		<td><?php
			if(h($vehicleDetail['VehicleDetail']['isapproved'])==1){
				echo "Yes";
			}
			else{
				echo "No";
			}
		?></td>
		<td class="actions">
			<!--?php echo $this->Html->link(__('View'), array('action' => 'view', $vehicleDetail['VehicleDetail']['id'])); ?-->
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vehicleDetail['VehicleDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vehicleDetail['VehicleDetail']['id']), null, __('Are you sure you want to delete # %s?', $vehicleDetail['VehicleDetail']['id'])); ?>
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

