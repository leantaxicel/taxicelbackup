<?php
	$config = Configure::read("TaxiCel"); // loading config
	$baseurls = FULL_BASE_URL.$this->base."/admin/";
?>
<!-- page scriprt -->
<!-- city status change script -->
<script type="text/javascript">
	var baseurl = "<?=$baseurls?>";
	var currenancore = '';
	$(document).ready(function(){
		$(".rowstatus").bind("click",changerowstatus);
		$(".deleteButton").bind("click",deleteButtonClickHAndler);
	});
	function changerowstatus(e) {
		var rowid = $(e.currentTarget).attr('rowid');
		var currstatus=$(e.currentTarget).attr('currstatus');
		currenancore = $(e.currentTarget);
		$.ajax({
			url:baseurl+'DriverCommisionDistributions/changestatus',
			method:'post',
			type:'json',
			data:{'rowid':rowid,currstatus:currstatus},
			error:function(response){
			},
			success:function(response){
				console.log(response);
				if (response.status=="1") {
					$(currenancore).attr('currstatus',response.rowstatus);
					$(currenancore).html(response.rowstatustxt);
				}
				
			}
		});
	}
	function deleteButtonClickHAndler(e){
	alert('deleted')
	
	}
</script>
<div class="creatTol">
	<h2>Driver Commision Distribution Settings</h2>
    <p><a href="<?=$config['BaseUrl']?>admin/DriverCommisionDistributions/add">Add Distribution Commision</a></p>
    <div class="clr"></div>
	<div class="cities index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('min_range'); ?></th>
				<th><?php echo $this->Paginator->sort('max_range'); ?></th>
				<th><?php echo $this->Paginator->sort('commision_per','Commision (%)'); ?></th>
				<th><?php echo $this->Paginator->sort('is_active','Status'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($driverCommisionDistributions as $driverCommisionDistribution): ?>
		<tr>
			<td><?php echo h($driverCommisionDistribution['DriverCommisionDistribution']['id']); ?>&nbsp;</td>
			<td><?php echo h($driverCommisionDistribution['DriverCommisionDistribution']['min_range']); ?>&nbsp;</td>
			<td><?php echo h($driverCommisionDistribution['DriverCommisionDistribution']['max_range']); ?>&nbsp;</td>
			<td><?php echo h($driverCommisionDistribution['DriverCommisionDistribution']['commision_per']); ?>&nbsp;</td>
			<td><a href="javascript:void(0)" class="rowstatus" rowid="<?=$driverCommisionDistribution['DriverCommisionDistribution']['id']?>" currstatus="<?=$driverCommisionDistribution['DriverCommisionDistribution']['is_active']?>" style="color:#474747;">
			<?php if($driverCommisionDistribution['DriverCommisionDistribution']['is_active']==1){
				echo "Active";
			}
			else{
				echo "Not Active";
			} ?></a>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $driverCommisionDistribution['DriverCommisionDistribution']['id'])); ?>
				
				<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $driverCommisionDistribution['DriverCommisionDistribution']['id']), null, __('Are you sure you want to delete # %s?', $driverCommisionDistribution['DriverCommisionDistribution']['id']));?>
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
