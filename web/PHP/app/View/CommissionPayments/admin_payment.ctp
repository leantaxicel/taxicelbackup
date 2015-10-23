<?php
	$baseurls = FULL_BASE_URL.$this->base."/admin";
	//pr($commissionpayments);
	//pr($this->params);
?>
<script type="text/javascript">
	
	/* var baseurl = "<?=$baseurls?>";
	var selecteduser = "<?=$this->params['pass']['0']?>";
	var userid = "<?=$selectusers?>";
	$(document).ready(function(){
		$("#userchoose").bind('change',userwiasepayment);
		addblankdata();
		//alert(selecteduser);
	});
	function addblankdata(){
		$("#userchoose").prepend("<option value='0'>-------</option>").val(userid);
		//if (selecteduser==0) {
		//	$("#userchoose")[0];
		//}
	}
	function userwiasepayment(e) {
		var user_id = $(e.currentTarget).val();
		if (user_id>0){
			window.location = baseurl+"/CommissionPayments/payment/"+user_id;
		}
		else{
			window.location = baseurl+"/CommissionPayments/payment";
		}
		
	} */
	
	var baseurl = "<?=$baseurls?>";
	var userid="<?=$selectusers?>";
	$(document).ready(function(){
		$("#userchoose").bind('change',userwiasepayment);
		addblankdata();
	});
	function addblankdata(){
		$("#userchoose").prepend("<option value='0'>-------</option>").val(userid);
	}
	function userwiasepayment(e) {
		var user_id = $(e.currentTarget).val();
		if (user_id>0){
			window.location = baseurl+"/CommissionPayments/payment/"+user_id;
		}
		else{
			window.location = baseurl+"/CommissionPayments/payment";
		}
		
	}
	
	
</script>
<div class="creatTol">
	<h2>Commission Payment Details</h2>
	<?
	echo $this->Form->input('user',array('options'=>$users,'class'=>"mapDropdown",'div'=>'mapDrop','label'=>'Choose User','id'=>'userchoose','selected'=>$selectusers));	
	?>
	<div class="clr"></div>
	<div class="rides index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('user_id','Driver'); ?></th>
				<th><?php echo $this->Paginator->sort('paying_cost','Amount($)'); ?></th>
				<th><?php echo $this->Paginator->sort('paying_date',"Payment Date"); ?></th>
				<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
		</tr>
		<?php foreach ($commissionpayments as $commissionpayment): ?>
		<tr>
			<td><?php echo h($commissionpayment['CommissionPayment']['id']); ?>&nbsp;</td>
			<td><?php echo h($commissionpayment['User']['email']); ?>&nbsp;</td>
			<td><?php echo h($commissionpayment['CommissionPayment']['paying_cost']); ?>&nbsp;</td>
			<td><?php echo h($commissionpayment['CommissionPayment']['paying_date']);?></td>
	
			<!--<td class="actions">
				<?php
					//echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rechargescheme['RechargeScheme']['id']), array('class'=>'deletedcls'), __('Are you sure you want to delete # %s?', $rechargescheme['RechargeScheme']['id']));
					//echo $this->Html->link(__('Edit'), array('action' => 'edit', $rechargescheme['RechargeScheme']['id']));
				?>
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
</div>
