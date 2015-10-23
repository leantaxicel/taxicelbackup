<?
	$config = Configure::read("TaxiCel"); // loading config
	$baseurls = FULL_BASE_URL.$this->base."/admin/";
?>
<script type="text/javascript">
	var baseurls = "<?=$baseurls?>";
	var currenancore='';
	$(document).ready(function(){
		$(".cmactv").bind("click",changeactivestatus);
	});
	function changeactivestatus(e) {
		var carid = $(e.currentTarget).attr('id');
		var curstatus = $(e.currentTarget).attr('curval');
		currenancore = $(e.currentTarget);
		$.ajax({
			url:baseurls+'Cars/caractivechange',
			type:'POST',
			data:{id:carid,isactive:curstatus},
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
	<h2>Cars</h2>
	<p><a href="<?=$config['BaseUrl']?>admin/Cars/add">Add Car</a></p>
	<div class="clr"></div>
	<div class="cars index">
		<table cellpadding="0" cellspacing="0">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<!--th><?php echo $this->Paginator->sort('model_id'); ?></th-->
					<th style="width:400px;"><?php echo $this->Paginator->sort('name'); ?></th>
					<th style="width:250px;"><?php echo $this->Paginator->sort('is_active'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($cars as $car): ?>
			<tr>
				<td><?php echo h($car['Car']['id']); ?>&nbsp;</td>
				<!--td>
					<?php echo $this->Html->link($car['CarModel']['name'], array('controller' => 'car_models', 'action' => 'view', $car['CarModel']['id'])); ?>
				</td-->
				<td><?php echo h($car['Car']['name']); ?>&nbsp;</td>
				<td><a href="javascript:void(0)" style="color:#474747;" id="<?=$car['Car']['id']?>" class="cmactv" curval="<?=$car['Car']['is_active']?>">
					<?php echo (h($car['Car']['is_active'])==1)?"Yes":"No"; ?>
				</a>&nbsp;</td>
				<td class="actions">
					<!--?php echo $this->Html->link(__('View'), array('action' => 'view', $car['Car']['id'])); ?-->
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $car['Car']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $car['Car']['id']), null, __('Are you sure you want to delete # %s?', $car['Car']['id'])); ?>
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
