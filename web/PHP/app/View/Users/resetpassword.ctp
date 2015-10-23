<?php
	$config = Configure::read("TaxiCel");
	$baseurls = FULL_BASE_URL.$this->base;
?>
<div class="contact_us">
	<h1>Reset Password</h1>
	<div class="contact_img">
    	<div class="opps" style="display:none;">
        	<p><span>Oh snap!</span> Select download type first.</p>
            <h2><a href="javascript:void(0)">&times;</a></h2>
            <div class="clr"></div>
        </div>
<!--
        <div class="opps oppsact">
        	<p>Yo reset your password successfully</p>
            <div class="clr"></div>
        </div>
-->
		<div class="contact_from">
			<div class="main_contact">
			  <!--<div class="left_content">
				
				<h2>Address</h2>
				  <p>
					<i><?=$this->html->image('address_icon.png',array('width'=>'18','height'=>'15','class'=>'con_icon'));?></i>Plaza Provincia de San Juan 
					<br />San Nicol‡s, Buenos Aires <br />Buenos Aires, Argentina.
				  </p>
                  <p><i><?=$this->html->image('map_icon.png',array('width'=>'18','height'=>'18','class'=>'con_icon'));?></i><a href="javascript:void(0)">location on map</a></p>
                  <div class="clr"></div>
				  <h2>Conatct Number</h2>
				  <p>
					<i><?=$this->html->image('mobile_icon.png',array('width'=>'13','height'=>'18','class'=>'con_icon2'));?></i>+01 12547896 </p>
					<p><i><?=$this->html->image('mobile_icon.png',array('width'=>'13','height'=>'18','class'=>'con_icon2'));?></i>+01 2547896542</p>
				  <div class="clr"></div>
				  <h2>E-mail</h2>
				  <p>
					<i><?=$this->html->image('mail_icon.png',array('width'=>'15','height'=>'11','class'=>'con_icon'));?></i>taxicel@gmail.com</p>
				  
				  <div class="clr"></div>
				</div>
				-->
				
				<div class="right_content">
					<h2>New Password</h2>
					<form id="myfrom" method="post" action="<?=$baseurls?>/users/resetpassword">
						<input type="hidden" name="data[User][passid]" value="<?=$passid?>" />
						<input type="hidden" name="data[User][linkid]" value="<?=$linkid?>"/>
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td style="width:170px;">New Password<span style="color:#ff0000">*</span></td>
								<td>
									<input name="data[User][password]" id="txtpass" type="password" placeholder="New password" class="contact_input" validation="blank|Please enter your new password." />
									<div e_rel="txtpass" class="textbox_error01"></div>
								</td>
							</tr>
							<tr>
								<td>Re-Enter Password <span style="color:#ff0000">*</span></td>
								<td>
									<input name="data[User][repassword]" id="txtrepass" type="password" placeholder="Re-Enter password" class="contact_input" validation="blank|Please RE-enter your password."/>
									<div e_rel="txtrepass" class="textbox_error01" id="repss"></div>
								</td>
							</tr>
							<tr>
							    <td></td>
							    <td>
									<input name="cancle" type="submit" onclick="return validationCheckHandler()" value="Send" class="back2">
									<input name="cancle" type="button" value="Clear" id="contact_clear" class="cancel" />
							    </td>
							</tr>
						</table>
						
					</form>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myfrom").validation({errorClass:'validationErr', validate:false});
		 $("#contact_clear").bind("click",quickConClearHandler1);
		
	});
	
	function validationCheckHandler(){
		if( $("#myfrom").validation( {errorClass:'validationErr'} ) ) {
			var pass = $("#txtpass").val();
			var repass = $("#txtrepass").val();
			if (pass==repass)
			{
				return true;
			}
			else{
				$("#repss").html('password not matched');
				return false;	
			}
			
		} else {
			$("html, body").animate({scrollTop:250},2000);
			return false;
		}
	}
	function quickConClearHandler1(){
		$("#txtpass").val('');
		$("#txtrepass").val('');
	}	
</script>