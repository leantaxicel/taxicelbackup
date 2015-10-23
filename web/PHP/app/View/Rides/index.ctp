<script type="text/javascript">
	$(document).ready(function(){
		$("#frm_location").AddressFinder({selected : onSelectPickUp});
		$("#to_location").AddressFinder({selected: onSelectDropoff});
		$("#myfrom").validation({errorClass:'validationErr', validate:false});
		//$("#date_travel").datepicker({ dateFormat: "yy-mm-dd" , yearRange: "2014:3000", changeMonth: true,changeYear: true});
		$('#datetimepicker').datetimepicker({minDate:'today'});
		$("#datePick").bind('click',datePickHandler);
	});
	function onSelectPickUp(data) {
		console.log(data);
		$('#frm_lat').val(data.lat);
		$('#frm_lon').val(data.long);
	}
	function onSelectDropoff(data){
		$('#to_lat').val(data.lat);
		$('#to_lon').val(data.long);
	}
	
	function datePickHandler(){
		$("#datetimepicker").focus();
	}
	
	function validationCheckHandler(){
		if( $("#myfrom").validation( {errorClass:'validationErr'} ) ) {
			return true;
		} else {
			return false;
		}
	}
	
</script>
<div class="bookaride">
	<h1>Book a Ride</h1>
	<h5>Step - 1</h5>
	<div style="margin-top:20px;">
		<form method="post" id="myfrom" name="myfrom">
			<!-- hidden lat lon of pick uo and drop off locations -->
			<input type="hidden" name="frm_lat" id="frm_lat" value="<?=$ride['Ride']['pick_lat']?>" />
			<input type="hidden" name="frm_lon" id="frm_lon" value="<?=$ride['Ride']['pick_long']?>" />
			<input type="hidden" name="to_lat" id="to_lat" value="<?=$ride['Ride']['drop_lat']?>" />
			<input type="hidden" name="to_lon" id="to_lon" value="<?=$ride['Ride']['drop_long']?>" />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:180px;">Pickup Location <span style="color:#ff0000">*</span></td>
					<td>
						<input name="frm_location" type="text" id="frm_location" placeholder="Type your pickup location" value="<?=$ride['Ride']['pick_up']?>" validation="blank|Enter pickup location." class="location" />
						<div e_rel="frm_location" class="textbox-error"></div>
					</td>
				</tr>
				
				<tr>
					<td style="width:180px;">Drop Off Location <span style="color:#ff0000">*</span></td>
					<td>
						<input name="to_location" type="text" id="to_location" placeholder="Type your drop off location" value="<?=$ride['Ride']['drop_off']?>" validation="blank|Enter drop off location." class="location" />
						<div e_rel="to_location" class="textbox-error"></div>
					</td>
				</tr>
				
				<tr>
					<td style="width:180px;">Date of travel <span style="color:#ff0000">*</span></td>
					<td style="position:relative;">
						<input name="date_travel" id="datetimepicker" type="text"  placeholder="Select date of travel" value="<?=$ride['Ride']['date_time']?>" class="location" validation="blank|Select your date." />
							<a href="javascript:void(0)" id="datePick">
								<?=$this->html->image('date_icon.png',array('class'=>'timedata2'))?>
							</a>
						
						<div e_rel="datetimepicker" class="textbox-error"></div>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type="submit" value="Submit" onclick="return validationCheckHandler()" class="back2"/></td>
					
				</tr>
			</table>
		</form>
	</div>
</div>