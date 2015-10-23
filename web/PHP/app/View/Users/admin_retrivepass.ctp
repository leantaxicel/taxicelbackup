<?php
	$config = Configure::read("TaxiCel");
	$baseurls = FULL_BASE_URL.$this->base;
?>
<div class="creatTol">
	<div class="cities form">
		<fieldset>
			<legend><?php echo __('Enter Email'); ?>
				<?php echo $this->Html->link('Back',array('action'=>'index'),array('class'=>'bottonbackclass'));?>
			</legend>
			<form id="myfrom" name="form1" method="post" action="<?=$baseurls?>/admin/Users/retrivepass">
				
				<input name="data[email]" id="txtemail" type="text" placeholder="Enter  email" class="contact_input" style="margin-bottom:10px;" validation="email|Please enter email."/>
				<div e_rel="txtemail" class="textbox_error01"></div>
				
				<input name="data[pass]" id="txtPass" type="password" placeholder="Enter  password" class="contact_input" style="margin-bottom:10px;" validation="blank|Please enter password." />
				<div e_rel="txtPass" class="textbox_error01"></div>
				
				<input name="confirmpass" id="confirm" type="password" placeholder="Confirm password" class="contact_input" style="margin-bottom:10px;" validation="blank|Please confirm password."/>
				<div e_rel="confirm" class="textbox_error01"></div>
				<br/>
			
				<input name="cancle" type="submit" value="Submit" onclick="return validationCheckHandler()" id="submits" class="back2">
				<input name="button" type="button" value="Clear" id="contact_clear" class="back2" style="width:8%;"/>
				
			</form>
		</fieldset>	
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myfrom").validation({errorClass:'validationErr', validate:false});
		$("#contact_clear").bind("click",quickConClearHandler1);
	});
	function quickConClearHandler1(){
		$("#txtemail").val('');
		$("#txtPass").val('');
		$("#confirm").val('');
	}
	function validationCheckHandler(){
		if( $("#myfrom").validation( {errorClass:'validationErr'} ) ) {
			if ($("#txtPass").val()!=$("#confirm").val()) {
				alert("Password and confirm password does not match.");
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
	
</script>