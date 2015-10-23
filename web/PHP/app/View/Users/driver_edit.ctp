<script type="text/javascript">
  $(document).ready(function(){
    $("#frmpost").bind('click',formvalidation);
   });
  function formvalidation(e) {
   //validate password section
   var pass = $("#txtPass").val();
   var cpass = $("#txtCPass").val();
   if (pass!='') {
     if (pass!=cpass) {
       alert("Confirm password does not matched");
       return false;
     }
   }
   return true;
  }
</script>
<div class="creatTol">
	<div class="users form">
	<?php echo $this->Form->create('User',array('type'=>'file')); ?>
		<fieldset>
			<legend><?php echo __('Edit Information'); ?>
			
			<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass'))?>
			
			</legend>
			<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Which city would you like to drive in?</h2>
			<div class="input text required">
				<label for="DriverCustomCity">City</label>
				<span class="custom-dropdown custom-dropdown--white">
				<select name="txtCity" required="required" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas">
					<option value="" selected="selected">Select City</option>
					<?php foreach($city as $cities){?>
							<option value="<?php echo $cities['City']['id']?>" <? if($user['DriverCustom']['city_id']==$cities['City']['id']){ echo "selected";}?>><?php echo $cities['City']['name']?></option>
					<?php }?>
				</select>
				</span>
			</div>
			<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Personal Information</h2>
			<div class="input text required">
				<label>First Name</label>
				<input name="txtFname" maxlength="200" type="text" value="<?php echo $user['User']['f_name']?>" id="txtFname" required="required">
			</div>
			<div class="input text required">
				<label for="UserL_name">Last Name</label>
				<input name="txtLname" maxlength="200" type="text" value="<?php echo $user['User']['l_name']?>" id="txtLname" required="required">
			</div>
			
			<div class="input text required">
				<label for="UserEmail">E-mail Address</label>
				<input name="txtEmail" type="email" maxlength="200"  value="<?php echo $user['User']['email']?>" id="txtEmail" required="required">
			</div>
			
			<div class="input text required">
				<label for="UserCountry_id">Country</label>
				<span class="custom-dropdown custom-dropdown--white">
				<select name="txtCountry" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas">
					<option value="" selected="selected">Select Country</option>
					<?php foreach($country as $ctry){?>
					<option value="<?php echo $ctry['Country']['id']?>" <? if($user['DriverCustom']['country_id']==$ctry['Country']['id']){ echo "selected";}?>><?php echo $ctry['Country']['name']?></option>
					<?php }?>
				</select>
				</span>
			</div>
			
			<div class="input text required">
				<label for="UserMobile">Contact Number</label>
				<input name="txtMobile" type="text" maxlength="200"   value="<?php echo $user['User']['mobile']?>" id="txtMobile" required="required">
			</div>
			
			<?=$this->Form->input('user_pic',array('type'=>'file'));?>
			
			<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Company Information</h2>
			<div class="input text required">
				<label>Company Name</label>
				<input name="txtCname" maxlength="200" type="text" value="<?php echo $user['DriverCustom']['company_name']?>" id="txtCname" required="required">
			</div>
			<div class="input text required">
				<label>Address 1</label>
				<input name="txtCadd1" maxlength="200" type="text" value="<?php echo $user['DriverCustom']['address1']?>" id="txtCadd1" required="required">
			</div>
			<div class="input text">
				<label>Address 2</label>
				<input name="txtCadd2" maxlength="200" value="<?php echo $user['DriverCustom']['address2']?>" type="text" id="txtCadd2">
			</div>
			<div class="input text required">
				<label>Country</label>
				<span class="custom-dropdown custom-dropdown--white">
				<select name="txtCcountry" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas" required >
					<option value="" selected="selected">Select Country</option>
					<?php foreach($country as $txtcountry){?>
					
						<option value="<?php echo $txtcountry['Country']['id']?>" <? if($user['DriverCustom']['country_id']==$txtcountry['Country']['id']){ echo "selected";}?>><?php echo $txtcountry['Country']['name']?></option>
					
					<?php }?>
				</select>
				</span>
			</div>
			<div class="input text required">
				<label>City</label>
				<span class="custom-dropdown custom-dropdown--white">
				<select name="txtCcity" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas" required>
					<option value="" selected="selected">Select City</option>
					<?php foreach($city as $cities){?>
						<option value="<?php echo $cities['City']['id']?>" <? if($user['DriverCustom']['city_id']==$cities['City']['id']){ echo "selected";}?>><?php echo $cities['City']['name']?></option>
					<?php }?>
				</select>
				</span>
			</div>
			<div class="input text required">
				<label>State/Province/Region</label>
				<input name="txtCregin" maxlength="200" value="<?php echo $user['DriverCustom']['region']?>" type="text" id="txtCregin" required="required">
			</div>
			<div class="input text required">
				<label>Zip/Postal Code</label>
				<input name="txtZip" maxlength="200" type="text" value="<?php echo $user['DriverCustom']['postal_code']?>" id="txtZip" required="required">
			</div>
			<div class="input text required">
				<label>Contact Number</label>
				<input name="txtCnumber" type="number" maxlength="200"  value="<?php echo $user['DriverCustom']['mobile']?>" min="0" id="txtCnumber" required="required">
			</div>
			<div class="input text required">
				<label>Argentina Business Number</label>
				<input name="txtABN" maxlength="200"  value="<?php echo $user['DriverCustom']['arg_bus_card']?>" type="text" id="txtABN" required="required">
			</div>
			
			<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Edit Account</h2>
			<div class="input text required">
				<label>Username</label>
				<input name="txtUname" maxlength="200" type="text" value="<?php echo $user['User']['username']?>" id="txtUname" required="required">
			</div>
			<div class="input text">
				<label>Password</label>
				<input name="txtPass" maxlength="200" type="password" id="txtPass">
			</div>
			<div class="input text">
				<label>Confirm Password</label>
				<input name="txtCPass" maxlength="200" type="password" id="txtCPass">
			</div>
		</fieldset>
	<?php echo $this->Form->end((array('label'=>'Update','id'=>'frmpost')));
	 //echo $this->Form->end(__('Update'));
	 ?>
	</div>
</div>
