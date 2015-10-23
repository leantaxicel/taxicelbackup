<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>Price Settings</h2>
    <p><a href="<?=$config['BaseUrl']?>admin/PriceSettings/add">Add price setting</a></p>
	<div class="clr"></div>
	<div class="priceSettings index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('city_id'); ?></th>
				<th><?php echo $this->Paginator->sort('base_fare'); ?></th>
				<th><?php echo $this->Paginator->sort('base_distance'); ?></th>
				<th><?php echo $this->Paginator->sort('fare_per_meter'); ?></th>
				<th><?php echo $this->Paginator->sort('fare_per_minute'); ?></th>
				<th><?php echo $this->Paginator->sort('base_waiting_time'); ?></th>
				<th><?php echo $this->Paginator->sort('inter_fare_distance'); ?></th>
				<th><?php echo $this->Paginator->sort('inter_fare_time'); ?></th>
				<th><?php echo $this->Paginator->sort('additional_wait_time'); ?></th>
				<th><?php echo $this->Paginator->sort('additional_wait_amount'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($priceSettings as $priceSetting): ?>
		<tr>
			<td><?php echo h($priceSetting['PriceSetting']['id']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['City']['name']); ?></td>
			<td><?php echo h($priceSetting['PriceSetting']['base_fare']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['base_distance']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['fare_per_meter']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['fare_per_minute']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['base_waiting_time']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['inter_fare_distance']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['inter_fare_time']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['additional_wait_time']); ?>&nbsp;</td>
			<td><?php echo h($priceSetting['PriceSetting']['additional_wait_amount']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $priceSetting['PriceSetting']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $priceSetting['PriceSetting']['id']), null, __('Are you sure you want to delete # %s?', $priceSetting['PriceSetting']['id'])); ?>
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
