<script type="text/javascript">
	$(document).ready(function(){
		$("#myfrom").validation({errorClass:'validationErr', validate:false});
		$("#contact_clear").bind("click",quickConClearHandler1);
	});
	
	function validationCheckHandler(){
		if( $("#myfrom").validation( {errorClass:'validationErr'} ) ) {
			if ($("#txtUpass").val()!=$("#txtUcpass").val()) {
				alert("Password does not match");
				return false;
			}
			else{
				return true;
			}
			
		} else {
			$("html, body").animate({scrollTop:250},2000);
			return false;
		}
	}
	function quickConClearHandler1(){
		$("#txtDCity").val('');
		$("#txtUfname").val('');
		$("#txtUlname").val('');
		$("#txtUaddress").val('');
		$("#txtUmobile").val('');
		$("#txtCcname").val('');
		$("#txtCaddress1").val('');
		$("#txtCaddress2").val('');
		$("#txtCcountry").val('');
		$("#txtCcity").val('');
		$("#txtCregion").val('');
		$("#txtCpcode").val('');
		$("#txtCmobile").val('');
		$("#txtCABN").val('');
		$("#txtUname").val('');
		$("#txtUpass").val('');
		$("#txtUcpass").val('');
		$("#txtUemail").val('');
	}	
</script>

<?php 
	//pr($citi);
	//pr($country);
?>

<div class="driver_signup">
	<h1>Driver Sign Up</h1>
	<?
		if($status==5){
	?>
	<div class="opps" style="display:block;">
		<p><span>Oh snap!</span> Duplicate Email address.</p>
		<div class="clr"></div>
	</div>
	<? }?>
	
	<?
		if($status==4){
	?>
	<div class="opps" style="display:block;">
		<p><span>Oh snap!</span> All fields are mendatory.</p>
		<div class="clr"></div>
	</div>
	<? }?>
	
	<?
		if($status==3){
	?>
	<div class="opps" style="display:block;">
		<p><span>Oh snap!</span> Password doesnt match, please try again.</p>
		<div class="clr"></div>
	</div>
	<? }?>
	<?
		if($status==2){
	?>
	<div class="opps" style="display:block;">
		<p><span>Oh snap!</span> The driver could not be saved. Please, try again.</p>
		<div class="clr"></div>
	</div>
	<? }?>
	<?
		if($status==1){
	?>
	<div class="opps oppsact" style="padding:0 10px;">
		<p>You have been successfully registered.</p>
		<div class="clr"></div>
	</div>
	<? }?>
	<h2>Which city would you like to drive in?</h2>
	<form method="post" name="myfrom" id="myfrom">
        <table cellpadding="0" cellspacing="0">
            <tr>
            	<td style="width:235px;">City <span style="color:#ff0000">*</span></td>
                <td>
					<span class="custom-dropdown custom-dropdown--white">
						<select name="txtDCity" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas" id="txtDCity" validation="blank|Please select city.">
							<option value="" selected="selected">Select City</option>
							<?php foreach($citi as $cities){?>
							<option value="<?php echo $cities['City']['id']?>"><?php echo $cities['City']['name']?></option>
							<?php }?>
							
						</select>
					</span>
					<div e_rel="txtDCity" class="textbox_error01"></div>
                </td>
            </tr>
            <tr><td><h2>Personal Information</h2></td><td></td></tr>
            <tr>
            	<td>First Name <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtUfname" id="txtUfname" type="text" placeholder="First Name" class="driver_input" validation="blank|Please enter your first name." />
					<div e_rel="txtUfname" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>Last Name <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtUlname" id="txtUlname" type="text" placeholder="Last Name" class="driver_input" validation="blank|Please enter your last name." />
					<div e_rel="txtUlname" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>E-mail Address <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtUemail" id="txtUemail" type="text" placeholder="E-mail Address" validation="email|Please enter your email address." class="driver_input" />
					<div e_rel="txtUemail" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>Country <span style="color:#ff0000">*</span></td>
                <td>
					<span class="custom-dropdown custom-dropdown--white">
						<select name="txtUaddress" id="txtUaddress" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas" validation="blank|Please select your country.">
							<option value="" selected="selected">Select Country</option>
							<?php foreach($country as $ctry){?>
							<option value="<?php echo $ctry['Country']['name']?>"><?php echo $ctry['Country']['name']?></option>
						<?php }?>	
						</select>
					</span>
					<div e_rel="txtUaddress" class="textbox_error01"></div>
				</td>
            </tr>
             <tr>
            	<td style="width:235px;">Contact Number <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtUmobile" id="txtUmobile" type="text" placeholder="Contact Number" class="driver_input" validation="blank|Please enter your contact number.*number|Please enter your contact number"/>
					<div e_rel="txtUmobile" class="textbox_error01"></div>
				</td>
            </tr>
             <tr><td><h2>Company Information</h2></td><td></td></tr>
              <tr>
            	<td>Company Name <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtCcname" id="txtCcname" type="text" placeholder="Company Name" class="driver_input" validation="blank|Please enter your company name."/>
					<div e_rel="txtCcname" class="textbox_error01"></div>
				</td>
            </tr>
             <tr>
            	<td>Address 1 <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtCaddress1" id="txtCaddress1" type="text" placeholder="Address 1" class="driver_input" validation="blank|Please enter your address."/>
					<div e_rel="txtCaddress1" class="textbox_error01"></div>
				</td>
            </tr> <tr>
            	<td>Address 2</td>
                <td>
					<input name="txtCaddress2" id="txtCaddress2" type="text" placeholder="Address 2" class="driver_input" />
				</td>
            </tr>
             <tr>
            	<td>Country <span style="color:#ff0000">*</span></td>
                <td>
					<span class="custom-dropdown custom-dropdown--white">
						<select name="txtCcountry" id="txtCcountry" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas" validation="blank|Please select your country.">
							<option value="" selected="selected">Select Country</option>
							<?php foreach($country as $ctry){?>
								<option value="<?php echo $ctry['Country']['id']?>"><?php echo $ctry['Country']['name']?></option>
							<?php }?>	
						</select>
					</span>
					<div e_rel="txtCcountry" class="textbox_error01"></div>
				</td>
            </tr>
             <tr>
            	<td>City <span style="color:#ff0000">*</span></td>
                <td>
					<span class="custom-dropdown custom-dropdown--white">
						<select name="txtCcity" id="txtCcity" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas" validation="blank|Please select city.">
							<option value="" selected="selected">Select City</option>
							<?php foreach($citi as $city){?>
								<option value="<?php echo $city['City']['id']?>"><?php echo $city['City']['name']?></option>
							<?php }?>
						</select>
					</span>
					<div e_rel="txtCcity" class="textbox_error01"></div>
                </td>
            </tr>
            <tr>
            	<td>State/Province/Region <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtCregion" id="txtCregion" type="text" placeholder="State/Province/Region" class="driver_input" validation="blank|Please enter state/province/region."/>
					<div e_rel="txtCregion" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>Zip/Postal Code <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtCpcode" id="txtCpcode" type="text" placeholder="Zip/Postal Code" class="driver_input" validation="blank|Please enter zip/postal code."/>
					<div e_rel="txtCpcode" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>Contact Number <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtCmobile" id="txtCmobile" type="text" placeholder="Contact Number" class="driver_input" validation="blank|Please enter contact number.*number|Please enter contact number." />
					<div e_rel="txtCmobile" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>Argentina Business Number <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtCABN" id="txtCABN" type="text" placeholder="Argentina Business Number" class="driver_input" validation="blank|Please enter Argentina business number."/>
					<div e_rel="txtCABN" class="textbox_error01"></div>
				</td>
            </tr>
            <tr><td><h2>Create New Account</h2></td><td></td></tr>
            <tr>
            	<td>Username <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtUname" id="txtUname" type="text" placeholder="Username" class="driver_input" validation="blank|Please enter your username." />
					<div e_rel="txtUname" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>Password <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtUpass" id="txtUpass" type="password" placeholder="Password" class="driver_input" validation="blank|Please enter password." />
					<div e_rel="txtUpass" class="textbox_error01"></div>
				</td>
            </tr>
            <tr>
            	<td>Confirm Password <span style="color:#ff0000">*</span></td>
                <td>
					<input name="txtUcpass" id="txtUcpass" type="password" placeholder="Confirm Password" class="driver_input" validation="blank|Please confirm your given password." />
					<div e_rel="txtUcpass" class="textbox_error01"></div>
				</td>
            </tr>
        
			<tr><td></td>
				<td>
				<p>By signing up I agree to the Privacy Policy understand that Taxicel is a request tool  not a transportation carrier.</p>
				</td>
			</tr>
			 
			 <tr><td></td>
			 <td>
			<input name="cancle" type="submit" onclick="return validationCheckHandler()" value="Apply" class="back2">
			<input name="cancle" type="button" value="Clear" id="contact_clear" class="cancel">
			</td>
			</tr>
		</table>
	</form>
</div>