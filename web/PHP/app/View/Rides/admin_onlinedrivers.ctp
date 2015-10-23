<?php
	$baseurls = FULL_BASE_URL.$this->base;
	//pr($drivers);
?>
<div class="creatTol">
	<h2 style="float:none;">OnLine Drivers</h2>
	<div class="rides index">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th>Driver Name</th>
				<th>Contact Details</th>
				<th>Profile Pic</th>
				<th>Driver Distance (Meter)</th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
				<?php
				if(count($drivers)>0){
					foreach ($drivers as $driver):
					?>
				<tr>
					<td><?php echo h($driver['User']['f_name'])." ".h($driver['User']['l_name']); ?>&nbsp;</td>
					<td><?php echo h($driver['User']['email'])." ".h($driver['User']['mobile']);?></td>
					<td><?php
						if($driver['DriverCustom']['user_pic']!=''){
							echo "<img width='100' height='100' src='".$baseurls."/userPic/".$driver['DriverCustom']['user_pic']."'/>";
						}
						else{
							echo "<img width='100' height='100' src='".$baseurls."/img/noimg.png' />";
						}
					?></td>
					<td><?php echo h($driver['0']['distance']); ?>&nbsp;</td>
					
					<td class="actions">
						<?php
							echo $this->Html->link(__('Dispatch'), array('action' => 'dispatchorder', $rideid,$driver['User']['id']),array('class'=>'dispatchecls'));
						?>
					</td>
				</tr>
				<?php 
				endforeach;
				}
				else{
					?>
					<tr>
						<td colspan="5">No Driver available right now</td>
					</tr>
				<?
				}
			?>
		</table>
	</div>
	<div class="clr"></div>
</div>
