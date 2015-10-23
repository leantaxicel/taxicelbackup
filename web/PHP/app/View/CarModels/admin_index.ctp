<?
	$config = Configure::read("TaxiCel"); // loading config
	$baseurls = FULL_BASE_URL.$this->base."/admin/";
?>
<script type="text/javascript">
	var baseurls = "<?=$baseurls?>";
	var carid = "<?=$carid?>";
	var currenancore='';
	$(document).ready(function(){
		$("#carselect").bind('change',filtermodelwithcars);
		$("#carselect").prepend("<option value='0'>-----</option>").val(carid);
		$(".cmactv").bind("click",changeactivestatus);
	});
	function filtermodelwithcars(e) {
		var scarid = $(e.currentTarget).val();
		if (scarid>0) {
			window.location = baseurls+"CarModels/index/"+scarid;
		}
		else{
			window.location = baseurls+"CarModels/";
		}
	}
	function changeactivestatus(e) {
		var modid = $(e.currentTarget).attr('id');
		var curstatus = $(e.currentTarget).attr('curval');
		currenancore = $(e.currentTarget);
		$.ajax({
			url:baseurls+'CarModels/modelactivechange',
			type:'POST',
			data:{id:modid,isactive:curstatus},
			dataType:'json',
			success:function(response){
				console.log(response);
				if (response.status=="1") {
					$(currenancore).attr('curval',response.rowstatus);
					$(currenancore).html(response.rowstatustxt);
				}
			},
			error:function(response){
				console.log(response);
			}
		});
	}
</script>
<div class="creatTol">
	<h2>Car Models</h2>
	<p><a href="<?=$config['BaseUrl']?>admin/CarModels/add">Add Car Model</a></p>
	
	<?php 
	echo $this->Form->input('car',array('options'=>$cars,'selected'=>'0','class'=>"mapDropdown",'id'=>'carselect','div'=>'mapDrop','label'=>'Choose Car'));	
	?>
	<div class="clr"></div>
	<div class="cars index">
		<table cellpadding="0" cellspacing="0">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th style="width:400px;"><?php echo $this->Paginator->sort('name'); ?></th>
					<th style="width:250px;"><?php echo $this->Paginator->sort('is_active'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($carModels as $carModel): ?>
			<tr>
				<td><?php echo h($carModel['CarModel']['id']); ?>&nbsp;</td>
				<td><?php echo h($carModel['CarModel']['name']); ?>&nbsp;</td>
				<td><a href="javascript:void(0)" style="color:#474747;" id="<?=$carModel['CarModel']['id']?>" class="cmactv" curval="<?=$carModel['CarModel']['is_active']?>">
					<?php echo (h($carModel['CarModel']['is_active'])==1)?"Yes":"No"; ?>
				</a>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $carModel['CarModel']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $carModel['CarModel']['id']), null, __('Are you sure you want to delete # %s?', $carModel['CarModel']['id'])); ?>
				</td>
			</tr>
			<?php
				endforeach; 
			?>
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
