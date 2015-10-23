<div class="creatTol">
	<div class="users form">
	<?php echo $this->Form->create('User',array('type'=>'file')); ?>
		<fieldset>
			<legend>Edit Driver Information</legend>
			
			<h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Which city would you like to drive in?</h2>
			<div class="input text required">
				<label for="DriverCustomCity">City</label>
				<span class="custom-dropdown custom-dropdown--white">
				<select name="txtCity" required="required" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas">
					<option value="" selected="selected">Select City</option>
					<?php foreach($city as $cit){?>
					<option value="<?php echo $cit['City']['id']?>" <? if($user['DriverCustom']['city_id']==$cit['City']['id']){ echo "selected";}?>><?php echo $cit['City']['name']?></option>
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
				<input name="txtEmail" maxlength="200" type="text"  value="<?php echo $user['User']['email']?>" id="txtEmail" required="required">
			</div>
			
			<div class="input text required">
				<label for="UserCountry_id">Country </label>
				<span class="custom-dropdown custom-dropdown--white" >
				<select name="txtCountry" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas">
					<option value="" selected="selected">Select Country</option>
					<?php foreach($country as $coun){?>
						
						<option value="<?php echo $coun['Country']['id']?>" <? if($user['DriverCustom']['country_id']==$coun['Country']['id']){ echo "selected";}?>><?php echo $coun['Country']['name']?></option>
					
					<?php }?>
				</select>
				</span>
			</div>
			<div class="input text required">
				<label for="UserMobile">Contact Number</label>
				<input name="txtMobile" maxlength="200" type="text"  value="<?php echo $user['User']['mobile']?>" id="txtMobile" required="required">
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
				<select name="txtCcountry" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas">
					<option value="" selected="selected">Select Country</option>
					<?php foreach($country as $crty){?>
						<option value="<?php echo $crty['Country']['id']?>" <? if($user['DriverCustom']['country_id']==$crty['Country']['id']){ echo "selected";}?>><?php echo $crty['Country']['name']?></option>
					<?php }?>
				</select>
				</span>
			</div>
			<div class="input text required">
				<label>City</label>
				<span class="custom-dropdown custom-dropdown--white">
				<select name="txtCcity" class="custom-dropdown__select custom-dropdown__select--white combox city_parpas" required>
					<option value="" selected="selected">Select City</option>
					<?php foreach($city as $cit){?>
						<option value="<?php echo $cit['City']['id']?>" <? if($user['DriverCustom']['city_id']==$cit['City']['id']){ echo "selected";}?>><?php echo $cit['City']['name']?></option>
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
				<input name="txtCnumber" maxlength="200"  value="<?php echo $user['DriverCustom']['mobile']?>" type="text" id="txtCnumber" required="required">
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
			<div class="input text required">
				<label>Password</label>
				<input name="txtPass" maxlength="200" type="password" id="txtPass" required="required">
			</div>
		</fieldset>
	<?php echo $this->Form->end(__('Update')); ?>
	</div>
</div>
