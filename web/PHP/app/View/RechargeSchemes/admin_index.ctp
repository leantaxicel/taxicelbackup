<?php
	$baseurls = FULL_BASE_URL.$this->base."/admin";
?>
<script type="text/javascript">
	var baseurl = "<?=$baseurls?>";
	var curtd='';
	$(document).ready(function(){
		$(".statuschange").bind('click',schemestatuschange);
	});
	function schemestatuschange(e){
		var rowid = $(e.currentTarget).attr('id');
		var curstatus = $(e.currentTarget).attr('currstatus');
		curtd = $(e.currentTarget);
		if (rowid>0){
			$.ajax({
				url:baseurl+"/RechargeSchemes/schemestatuschange",
				method:'post',
				type:'json',
				data:{id:rowid,curstatus:curstatus},
				success:function(response){
					console.log(response);
					if (response.status=="1") {
						console.log(response.rowstatustxt);
						$(curtd).attr('currstatus',response.rowstatus);
						$(curtd).html(response.rowstatustxt);
					}
				},
				error:function(response){
					//console.log(response);
				}
			});
		}
	}
</script>
<div class="creatTol">
	<h2>Recharge Schemes</h2>
	<p><a href="<?=$baseurls?>/RechargeSchemes/add">Add Recharge Scheme</a></p>
	<div class="clr"></div>
	<div class="rides index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('amount','Amount($)'); ?></th>
				<th><?php echo $this->Paginator->sort('point'); ?></th>
				<th><?php echo $this->Paginator->sort('isactive',"Status"); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($rechargeschemes as $rechargescheme): ?>
		<tr>
			<td><?php echo h($rechargescheme['RechargeScheme']['id']); ?>&nbsp;</td>
			<td><?php echo h($rechargescheme['RechargeScheme']['name']); ?>&nbsp;</td>
			<td><?php echo h($rechargescheme['RechargeScheme']['amount']); ?>&nbsp;</td>
			<td><?php echo h($rechargescheme['RechargeScheme']['point']); ?>&nbsp;</td>
			<td><a href="javascript:void(0)" class="statuschange" id="<?=$rechargescheme['RechargeScheme']['id']?>" style="color:#474747;" currstatus="<?=$rechargescheme['RechargeScheme']['isactive']?>"><?php
				$status = h($rechargescheme['RechargeScheme']['isactive']);
				if($status==1){
					echo "Active";
				}
				else{
					echo "Desable";
				}
			?></a></td>
	
			<td class="actions">
				<?php
					echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rechargescheme['RechargeScheme']['id']), array('class'=>'deletedcls'), __('Are you sure you want to delete # %s?', $rechargescheme['RechargeScheme']['id']));
					echo $this->Html->link(__('Edit'), array('action' => 'edit', $rechargescheme['RechargeScheme']['id']));
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
