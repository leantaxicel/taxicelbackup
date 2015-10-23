<?
	$config = Configure::read("TaxiCel"); // loading config	
	
?>
<div class="creatTol">
	<h2><?php echo __('Heat Zones'); ?></h2>
	<p><a href="<?=$config['BaseUrl']?>admin/HeatZones/add">Add Heat Zone</a></p>
	<div class="clr"></div>
	<div class="heatZones index">
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th>Zone</th>
				<th>Cords</th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($heatZones as $heatZone):?>
		<tr>
			<td><?php echo h($heatZone['HeatZone']['name']); ?>&nbsp;</td>
			<td>
				<?
					$cords = array();
					foreach($heatZone['HeatZoneCordinet'] as $val){
						array_push($cords, $val['name']);
					}
					$cod=implode(', ',$cords);
					echo $cod;
				?>
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $heatZone['HeatZone']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $heatZone['HeatZone']['id']), null, __('Are you sure you want to delete # %s?', $heatZone['HeatZone']['id'])); ?>
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

