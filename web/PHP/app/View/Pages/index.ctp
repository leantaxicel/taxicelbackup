<?php
	$config = Configure::read("TaxiCel"); 
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#main_wrapper").ms_rotationgallery();
		$("#txtFrm").AddressFinder({selected : onSelectPickUp});
		$("#txtTo").AddressFinder({selected: onSelectDropoff});
		//$("#datepicker").datepicker({ dateFormat: "yy-mm-dd" , yearRange: "2014:3000", changeMonth: true,changeYear: true});
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
	function onDateSelected() {
		alert('lll');
		//$("#datetimepicker").focusOut();
	}
	function datePickHandler(){
		$("#datetimepicker").focus();
	}
	
	function validationCheckHandler(){
		var pickup = $("#txtFrm").val();
		var dropoff = $("#txtTo").val();
		var datePick = $("#datetimepicker").val();
		var isBlank = true;
		
		if(pickup==''){
			$("#txtFrm").attr('placeholder','Enter pickup location');
			isBlank = false;
		}
		if(dropoff==''){
			$("#txtTo").attr('placeholder','Enter drop off location');
			isBlank = false;
		}
		if(datePick==''){
			$("#datetimepicker").attr('placeholder','Select your date');
			isBlank = false;
		}
		
		if(isBlank){
			return true;
		}else{
			return false;
		}
	}
	
</script>
<div class="slider">
	<div class="slide" id="main_wrapper" style="overflow:hidden;">
		<div class="slid slides" id="home_slide">
			<img src="img/slide1.jpg" width="100%" height="auto" class="imgAmit"/>
			<img src="img/slide2.jpg" width="100%" height="auto" class="imgAmit"/>
			<img src="img/slide3.jpg" width="100%" height="auto" class="imgAmit"/>
			<img src="img/slide4.jpg" width="100%" height="auto" class="imgAmit"/>
		</div>
	</div>
	<div class="slide_Input">
		<div class="slide_ipText">
			<h1>Book a Ride</h1>
			<form id="UserAddForm" method="post" action="<?=$config['BaseUrl']?>Rides">
				<!-- hidden lat lon of pick uo and drop off locations -->
				<input type="hidden" name="frm_lat" id="frm_lat" />
				<input type="hidden" name="frm_lon" id="frm_lon" />
				<input type="hidden" name="to_lat" id="to_lat" />
				<input type="hidden" name="to_lon" id="to_lon" />
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>Pickup location <span style="color:#ff0000">*</span></td>
						<td><input name="frm_location" id="txtFrm" type="text" placeholder="Type your pickup location" class="name"/></td>
						<tr>
						<td>Drop Off location <span style="color:#ff0000">*</span></td>
						<td><input name="to_location" id="txtTo" type="text" placeholder="Type your drop off location" class="name"/></td>
					</tr>
					<tr>
						<td>Date of travel <span style="color:#ff0000">*</span></td>
						<td><input name="date_travel" type="text" id="datetimepicker" placeholder="Select date of travel" class="name"/>
							  <a href="javascript:void(0)" id="datePick">
							  <?=$this->html->image('date_icon.png',array('class'=>'timedata'))?>
							  </a>
						</td>
						<tr>
							<td></td>
							<td><input type="submit" onclick="return validationCheckHandler()" value="Submit" class="submit"/></td>
						</tr>
					</tr>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
    <!-----------------------End_Slider---------------------------------->
<div class="body_text">
	<h1>Experiance Your Ride With TaxiCel</h1>
	<h2>Worry-free taxi transportation for every travelers at the same price</h2>
	<div class="appsdown">
		<a href="#"><div class="androdown">
			Get Android App
		</div></a>
		<a href="#"><div class="appledown">
			Get iPhone App
		</div></a>
		<div class="clr"></div>
	</div>
	
	<div class="subBody">
		<div class="real_Time">
			<a href="#"><center><div class="iconDiv">
			</div></center></a>
		<h3>Real Time Booking</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget placerat quis.</p>
		</div>
		
		<div class="real_Time">
			<a href="#"><div class="iconDiv iconDiv2">
			</div></a>
		<h3>Any Time Any Where</h3>
			<p>Cras convallis suscipit augue in sollicitudin. Aliquam erat volutpat. Pellentesque justo tristique mollis.</p>
		</div>
		
		<div class="real_Time">
			<a href="#"><div class="iconDiv iconDiv3">
			</div></a>
		<h3>Monitor Ride Progress</h3>
			<p>Curabitur scelerisque vehicula odio, sit amet adipiscing felis pulvinar ac. Proin sapien felis</p>
		</div>
		
		<div class="real_Time2">
			<a href="#"><div class="iconDiv iconDiv4">
			</div></a>
		<h3>Transparent Billing</h3>
			<p>Lobortis vehicula nisi eget, congue viverra metus. Vivamus ullamcorper accumsan lectus</p>
		</div>
		<div class="clr"></div>
	</div>
	
</div>
     <!-----------------------End_Bodytext---------------------------------->
     
 <div class="content_Text">
	<div class="text_Content">
		<h1>Services</h1>
		<div class="left_services">
		  <div class="number">
				<div class="number_text">
					<h2><a href="#">Nullam sit amet consequat arcu</a></h2>
					<p>In suscipit lorem. Maecenas elementum lectus nec laoreet ornare.Nunc ornare ultrices sagittis ed varius nec lectus nim.</p>
				</div>
				<img src="img/number1.png" class="number_icon"/>
				<div class="clr"></div> 
			</div>
			
			<div class="number">
				<div class="number_text">
					<h2><a href="#">Nullam sit amet consequat arcu</a></h2>
					<p>In suscipit lorem. Maecenas elementum lectus nec laoreet ornare.Nunc ornare ultrices sagittis ed varius nec lectus nim.</p>
				</div>
				<img src="img/number2.png" class="number_icon"/>
				<div class="clr"></div> 
			</div>
			
			<div class="number">
				<div class="number_text">
					<h2><a href="#">Nullam sit amet consequat arcu</a></h2>
					<p>In suscipit lorem. Maecenas elementum lectus nec laoreet ornare.Nunc ornare ultrices sagittis ed varius nec lectus nim.</p>
				</div>
				<img src="img/number3.png" class="number_icon"/>
				<div class="clr"></div> 
			</div>
		</div>
		<div class="right_services">
		  <div class="number">
				<div class="number_text2">
					<img src="img/number4.png" class="number_icon2"/>
					<h2><a href="#">Nullam sit amet consequat arcu</a></h2>
					<p>In suscipit lorem. Maecenas elementum lectus nec laoreet ornare.Nunc ornare ultrices sagittis ed varius nec lectus nim.</p>
				</div>
				<div class="clr"></div> 
			</div>
			
		  <div class="number">
				<div class="number_text2">
					<img src="img/number5.png" class="number_icon2"/>
					<h2><a href="#">Nullam sit amet consequat arcu</a></h2>
					<p>In suscipit lorem. Maecenas elementum lectus nec laoreet ornare.Nunc ornare ultrices sagittis ed varius nec lectus nim.</p>
				</div>
				<div class="clr"></div> 
			</div>
			
		  <div class="number">
				<div class="number_text2">
					<img src="img/number6.png" class="number_icon2"/>
					<h2><a href="#">Nullam sit amet consequat arcu</a></h2>
					<p>In suscipit lorem. Maecenas elementum lectus nec laoreet ornare. Nunc ornare ultrices sagittis ed varius nec lectus nim.</p>
				</div>
				<div class="clr"></div> 
			</div>
		</div>
		<div class="clr"></div>
	</div>
 </div>
<!-----------------------End_content_text----------------------------------> 
<script>
function ticker(){
	$('.testimonials p:first').slideUp( 
		function () { 
			$(this).appendTo( $('.testimonials') ).slideDown( 1000 ); 
		}
	);
}
setInterval(function(){ ticker() }, 5000);
</script>

<style>
.testimonials{
	list-style-position:outside;
	list-style-type:none;
	height:130px;
	overflow:hidden;
	
	}	
</style>
<div class="loremins testimonials">
	<p>
		Vivamus id lorem in ipsum ultrices dictum. Praesent eu enim faucibus, accumsan magna sit amet, pulvinar tellus. Morbi dapibus nunc euismod placerat auctor. Suspendisse potenti. Nullam faucibus tellus quis sapien blandit ultrices. Vestibulum mollis euismod varius. Sed quis urna pharetra, mattis purus non, tincidunt enim.
		<span><br /><br /><a href="#">- Dany Gilmar</a></span>
	</p>
	<p>
		Vivamus id lorem in ipsum ultrices dictum. Praesent eu enim faucibus, accumsan magna sit amet, pulvinar tellus. Morbi dapibus nunc euismod placerat auctor. Suspendisse potenti. Nullam faucibus tellus quis sapien blandit ultrices. Vestibulum mollis euismod varius. Sed quis urna pharetra, mattis purus non, tincidunt enim.
		<span><br /><br /><a href="#">- anup samantaray</a></span>
	</p>
	<p>
		Vivamus id lorem in ipsum ultrices dictum. Praesent eu enim faucibus, accumsan magna sit amet, pulvinar tellus. Morbi dapibus nunc euismod placerat auctor. Suspendisse potenti. Nullam faucibus tellus quis sapien blandit ultrices. Vestibulum mollis euismod varius. Sed quis urna pharetra, mattis purus non, tincidunt enim.
		<span><br /><br /><a href="#">- Samantaray</a></span>
	</p>
</div>