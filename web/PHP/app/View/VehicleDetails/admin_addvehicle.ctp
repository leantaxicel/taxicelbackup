<?php
	$baseurls = FULL_BASE_URL.$this->base."/driver/";
?>
<script type="text/javascript">
	var baseurls="<?=$baseurls?>";

	$(document).ready(function(){
		$("#carselect").bind('change',carmodels)
	});
	function carmodels(e) {
		var carid = $(e.currentTarget).val();
		if (carid>0) {
			$("#modelselect").empty();
			$.ajax({
			url:baseurls+'VehicleDetails/carmodels',
			type:'POST',
			data:{id:carid},
			dataType:'json',
			success:function(response){
				console.log(response);
				if (response.status=="1") {
					var option='';
					if (response.models.length>0) {
						for(var i=0; i<response.models.length;i++){
							var model = response.models[i].CarModel;
							//console.log(model);
							option+="<option value='"+model.id+"'>"+model.name+"</option>";
						}
					}
					$("#modelselect").html(option);
				}
			},
			error:function(response){
				console.log(response);
			}
		});
		}
	}
</script>
<style>
	.fltrighr{
		float: right;
	}
</style>
<div class="creatTol">
<?php echo $this->Form->create('VehicleDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Driver Vehicle Details'); ?>
		<!--?php echo $this->Html->link('Back',array('action'=>'index','driver'=>true),array('class'=>'bottonbackclass'));?-->
		<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass'))?>
		
		</legend>
	<?php
		echo $this->Form->hidden('company_id',array('value'=>$company_id));
		echo $this->Form->hidden('user_id',array('value'=>$user_id));
		echo $this->Form->input('car_id',array('id'=>'carselect','class'=>'driver_dropdown'));
		echo $this->Form->input('car_model_id',array('id'=>'modelselect','class'=>'driver_dropdown'));
		echo $this->Form->input('manufactureing_date',array('class'=>'driver_dropdown'));
		echo $this->Form->input('vehicle_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
