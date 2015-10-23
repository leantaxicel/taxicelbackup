<?php
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol" style="width:600px; overflow-x:scroll; overflow-y:hidden;">
<div style="width:1400px;">
	<h2><?php echo __('City Price Configurations'); ?></h2>
		<p><a href="<?=$config['BaseUrl']?>admin/CityConfigurations/add">Add City Price Configuration.</a></p>
	 <div class="clr"></div>
	<div class="col-md-12 bodyinput" id="successSMS" style="display:none;">
						
	</div>
	 
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('base_fare'); ?></th>
			<th><?php echo $this->Paginator->sort('base_wait_time'); ?></th>
			<th><?php echo $this->Paginator->sort('base_distance'); ?></th>
			<th><?php echo $this->Paginator->sort('fare_per_kilometer'); ?></th>
			<th><?php echo $this->Paginator->sort('fare_per_minute'); ?></th>
			<th>Inter Fare Distance (in Meter)</th>
			<th>Inter Fare Time (In Second)</th>
			<th>Additional waiting time</th>
			<th>Additional waiting amount</th>
			
			<th>Default City Config.</th>
			<th class="actions" style="width:140px;"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cityConfigurations as $cityConfiguration): ?>
	<tr>
		<td><?php echo h($cityConfiguration['CityConfiguration']['id']); ?>&nbsp;</td>
		<!--<td>
			<?php //echo $this->Html->link($cityConfiguration['City']['name'], array('controller' => 'cities', 'action' => 'view', $cityConfiguration['City']['id'])); ?>
		</td>-->
		<td><?php echo h($cityConfiguration['City']['name']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['base_fare']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['base_wait_time']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['base_distance']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['fare_per_kilometer']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['fare_per_minute']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['inter_fare_distance']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['inter_fare_time']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['additional_wait_time']); ?>&nbsp;</td>
		<td><?php echo h($cityConfiguration['CityConfiguration']['additional_wait_amount']); ?>&nbsp;</td>
		<td>
			<?php
				$isDefault = $cityConfiguration['CityConfiguration']['isdefault'];
			?>
			<input type="radio" name="category" unique="<?php echo $cityConfiguration['CityConfiguration']['id']?>" <?php if($isDefault==1)echo "checked"; ?> class="cato" value="1">&nbsp;
		</td>
		<td class="actions">
			<!--?php echo $this->Html->link(__('View'), array('action' => 'view', $cityConfiguration['CityConfiguration']['id'])); ?-->
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cityConfiguration['CityConfiguration']['id']), null, __('Are you sure you want to delete # %s?', $cityConfiguration['CityConfiguration']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cityConfiguration['CityConfiguration']['id'])); ?>
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
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>	
</div>
<!--div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New City Configuration'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div-->


<script type="text/javascript">
var baseurl = '<?=$config['BaseUrl']?>';
$(document).ready(function(){
	$(".cato").bind('click',radiobuttonHandler);
});

var uni;
function radiobuttonHandler(e){
	$click=$(e.currentTarget);
	var uni=($click.attr('unique'));
	console.log(uni);
	console.log(baseurl);
	$.ajax({
		url:baseurl+'admin/CityConfigurations/setAsDefault',
		type:'POST',
		dataType:'json',
		data:{defaultCityId:uni},
		success:function(response){
			var output = "<p>You have set your default city successfully</p>";
		  $('#successSMS').html(output);
		  $('#successSMS').show();
			},
		error:function(response){
				console.log(response);
			}
	});
}
</script>
