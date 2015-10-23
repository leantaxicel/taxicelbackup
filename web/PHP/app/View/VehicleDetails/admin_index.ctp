<?php
	$config = Configure::read("TaxiCel"); // loading config
	$baseurls = FULL_BASE_URL.$this->base."/admin/";
?>
<script type="text/javascript">
	var baseurls = "<?=$baseurls?>";
	var userid = "<?=$selecteduser?>";
	var currenancore='';
	var currenancores='';
	$(document).ready(function(){
		$("#userselect").bind('change',filtermodelwithcars);
		$("#userselect").prepend("<option value='0'>-----</option>").val(userid);
		$(".admactv").bind("click",changeactivestatus);
		$(".admactvee").bind("click",changeactivestatusAdmactvee);
	});
	function filtermodelwithcars(e) {
		var suserid = $(e.currentTarget).val();
		if (suserid>0) {
			window.location = baseurls+"VehicleDetails/index/"+suserid;
		}
		else{
			window.location = baseurls+"VehicleDetails/";
		}
	}
	function changeactivestatus(e) {
		var modid = $(e.currentTarget).attr('id');
		var curstatus = $(e.currentTarget).attr('curstatus');
		currenancore = $(e.currentTarget);
		$.ajax({
			url:baseurls+'VehicleDetails/vehicleapproved',
			type:'POST',
			data:{id:modid,isapproved:curstatus},
			dataType:'json',
			success:function(response){
				console.log(response);
				if (response.status=="1") {
					$(currenancore).attr('curstatus',response.rowstatus);
					$(currenancore).html(response.rowstatustxt);
				}
			},
			error:function(response){
				console.log(response);
			}
		});
	}
	function changeactivestatusAdmactvee(e) {
		var modid3 = $(e.currentTarget).attr('id');
		var curstatuss = $(e.currentTarget).attr('curstatuss');
		currenancores = $(e.currentTarget);
		$.ajax({
			url:baseurls+'VehicleDetails/vehicleisdefault',
			type:'POST',
			data:{id:modid3,isdefault :curstatuss},
			dataType:'json',
			success:function(response){
				console.log(response);
				if (response.status=="1") {
					$(currenancores).attr('curstatuss',response.rowstatus);
					$(currenancores).html(response.rowstatustxt2);
				}
			},
			error:function(response){
				console.log(response);
			}
		});
	}
</script>
<div class="creatTol">
	<h2>Driver Vehicles</h2>
	<?php
	echo $this->Form->input('user_id',array('options'=>$users,'selected'=>$selecteduser,'class'=>"mapDropdown",'id'=>'userselect','div'=>'mapDrop','label'=>'Choose Driver'));	
	?>
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
		<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
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
		<td>
				<a href="javascript:void(0)" class="admactvee" style="color:#474747;" id="<?=h($vehicleDetail['VehicleDetail']['id'])?>" curstatuss="<?=h($vehicleDetail['VehicleDetail']['isdefault'])?>"><?php
		
		
			if(h($vehicleDetail['VehicleDetail']['isdefault'])==1){
				echo "Yes";
			}
			else{
				echo "No";
			}
		?></td>
		<td><a href="javascript:void(0)" class="admactv" style="color:#474747;" id="<?=h($vehicleDetail['VehicleDetail']['id'])?>" curstatus="<?=h($vehicleDetail['VehicleDetail']['isapproved'])?>"><?php
			if(h($vehicleDetail['VehicleDetail']['isapproved'])==1){
				echo "Yes";
			}
			else{
				echo "No";
			}
		?></a></td>
		<!--
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vehicleDetail['VehicleDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vehicleDetail['VehicleDetail']['id']), null, __('Are you sure you want to delete # %s?', $vehicleDetail['VehicleDetail']['id'])); ?>
		</td>-->
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

