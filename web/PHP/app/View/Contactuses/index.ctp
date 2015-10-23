<?php
	$config = Configure::read("TaxiCel"); 
?>
<div class="contact_us">
	<h1>Contact Us</h1>
	<div class="contact_img">
    	<div class="opps" style="display:none;">
        	<p><span>Oh snap!</span> Select download type first.</p>
            <h2><a href="javascript:void(0)">&times;</a></h2>
            <div class="clr"></div>
        </div>
		<?
			if($status==1){
		?>
        <div class="opps oppsact">
        	<p>Thank you for contacting Taxicel. Our team will get back to you very soon.</p>
            <div class="clr"></div>
        </div>
		<? }
		   elseif($status==2){
		?>
		<div class="opps oppsact">
			<p style="color: red;">Invalid Email address.</p>
		    <div class="clr"></div>
		</div>
		<?
		   }
		?>
		<div class="contact_from">
			<div class="main_contact">
			  <div class="left_content">
				<h2>Address</h2>
				  <p>
					<i><?=$this->html->image('address_icon.png',array('width'=>'18','height'=>'15','class'=>'con_icon'));?></i>Plaza Provincia de San Juan 
					<br />San Nicolás, Buenos Aires <br />Buenos Aires, Argentina.
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
				<div class="right_content">
					<h2>Get In Touch</h2>
					<form id="myfrom" method="post" action="<?=$config['BaseUrl']?>Contactuses/contact">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td style="width:170px;">Name <span style="color:#ff0000">*</span></td>
								<td>
									<input name="data[Contactus][name]" id="txtname" type="text" placeholder="Name" class="contact_input" validation="blank|Please enter your name." />
									<div e_rel="txtname" class="textbox_error01"></div>
								</td>
							</tr>
							<tr>
								<td>E-mail <span style="color:#ff0000">*</span></td>
								<td>
									<input name="data[Contactus][email]" id="txtemail" type="text" placeholder="E-mail" class="contact_input" validation="email|Please enter your email."/>
									<div e_rel="txtemail" class="textbox_error01"></div>
								</td>
							</tr>
							<tr>
								<td>Contact Number <span style="color:#ff0000">*</span></td>
								<td>
									<input name="data[Contactus][contact_no]" id="txtMob" type="text" placeholder="Contact Number" class="contact_input" validation="blank|Please enter your contact detail*number|Please enter your contact detail."/>
									<div e_rel="txtMob" class="textbox_error01"></div>
								</td>
							</tr>
							<tr>
								<td>Message <span style="color:#ff0000">*</span></td>
								<td>
									<textarea name="data[Contactus][message]" id="txtMsg" cols="0" rows="5" placeholder="Message..." class="contact_input2" validation="blank|Please enter your message."></textarea>
									<div e_rel="txtMsg" class="textbox_error01"></div>
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
			return true;
		} else {
			$("html, body").animate({scrollTop:250},2000);
			return false;
		}
	}
	function quickConClearHandler1(){
		$("#txtname").val('');
		$("#txtemail").val('');
		$("#txtMob").val('');
		$("#txtMsg").val('');
	}	
</script>