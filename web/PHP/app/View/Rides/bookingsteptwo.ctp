<?php
	$config = Configure::read("TaxiCel"); // loading config
	$baseurls = FULL_BASE_URL.$this->base;
?>
<div class="bookaride">
	<h1>Passenger & Payment Information</h1>
	<h5>Step - 2</h5>
	
	<div class="passengerandpayment quti">
		<div class="passenger">
			<a href="javascript:void(0)" class="clickDiv" mode="on"><?=$this->html->image('plus.png',array('class'=>'nagatively'))?></a>
			<h2>Book A Ride</h2>
			<a href="<?=$config['BaseUrl']?>Rides/index/<?=$id?>" class="editt">Edit</a>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<div class="des" style="display:none;">
			<table style="width: 100%; margin: 0 40px;">
				<tr>
					<td><b>Pickup Location</b></td>
					<td>: <?=$ride['Ride']['pick_up']?></td>
				</tr>
				<tr>
					<td><b>Drop Off Location</b></td>
					<td>: <?=$ride['Ride']['drop_off']?></td>
				</tr>
				<tr>
					<td><b>Date</b></td>
					<td>: <?=$ride['Ride']['date_time']?></td>
				</tr>
			</table>	
		</div>
	</div>
	
	<div class="passengerandpayment quti">
		<div class="passenger">
			<a href="javascript:void(0)"><? if($status==1){ echo $this->html->image('plus.png',array('class'=>'nagatively')); }else{ echo $this->html->image('nagative.png',array('class'=>'nagatively')); }?></a>
			<h2>Passenger Sign Up or Login</h2>
			<div class="clr"></div>
		</div>
		<div style="margin: 0 40px; <? if($status==1){?>display:none;<? }?>">
			<form method="post" id="myfrom">
				<div class="signUpTwo">
					<h3>Sign up</h3>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td>First Name <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtFname" id="txtFname" type="text"  placeholder="Enter first name" class="location location2" validation="blank|Please enter your first name." />
								<div e_rel="txtFname" class="textbox-error"></div>
							</td>
						</tr>
						<tr>
							<td>Last Name <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtLname" id="txtLname" type="text"  placeholder="Enter last name" class="location location2" validation="blank|Please enter your last name."/>
								<div e_rel="txtLname" class="textbox-error"></div>
							</td>
						</tr>
						<tr>
							<td>Username <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtUname" id="txtUname" type="text"  placeholder="Enter username" class="location location2" validation="blank|Please enter your username."/>
								<div e_rel="txtUname" class="textbox-error"></div>
							</td>
						</tr>
						<tr>
							<td>Mobile No <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtMno" id="txtMno" type="text"  placeholder="Mobile No" class="location location2" validation="number|Please enter your mobile number."/>
								<div e_rel="txtMno" class="textbox-error"></div>
							</td>
						</tr>
						<tr>
							<td>Email <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtEmail" id="txtEmail" type="text"  placeholder="E-mail address" class="location location2" validation="email|Please enter your email."/>
								<div e_rel="txtEmail" id="eerror" class="textbox-error"></div>
							</td>
						</tr>
						
						<tr>
							<td>Password <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtPass" id="txtPass" type="password"  placeholder="Password" class="location location2" validation="blank|Please enter your password."/>
								<div e_rel="txtPass" class="textbox-error"></div>
							</td>
						</tr>
						
						<tr>
							<td>Re-Enter Password <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtRpass" id="txtRpass" type="password"  placeholder="Re-Enter password" class="location location2" validation="blank|Please re-enter your password."/>
								<div e_rel="txtRpass" class="textbox-error" id="erpasserror"></div>
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td>
								<input name="cancle" type="submit" onclick="return validationCheckHandler()" value="Submit" class="back2">
								<input name="cancle" type="button" id="contact_clear" value="Clear" class="cancel">
							</td>
						</tr>
					</table>
				</div>
			</form>
			<div class="loginTwo" id="loginsec">
				<h3>Login</h3>
				<div id="fgstatusdiv"></div>
				<?
					if($status=='error'){
				?>
				<div style="color:#ff0000; text-align:center;" class="sclas">Invalid email or password, please try again.</div></br/>
				<? }
					elseif($status=="fgerror"){
						echo '<div style="color:#ff0000; text-align:center;" class="sclas">Invalid email.</div></br/>';
					}
					elseif($status=="send"){
						?>
						<div style="color:green; text-align:center;" class="sclas">Password Reset Link Sent To Your Email Id .</div></br/>
						<?
					}
				?>
				<form method="post" id="myfrom2" action="<?=$config['BaseUrl']?>Rides/booklogin/<?=$id?>">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td>Email <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtemail" id="txtemail" type="text"  placeholder="Your email address here" class="location location2" validation="email|Please enter your email."/>
								<div e_rel="txtemail" class="textbox-error"></div>
							</td>
						</tr>
						
						<tr>
							<td>Password <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtpass" id="txtpass" type="password"  placeholder="Your password here" class="location location2" validation="blank|Please enter your password."/>
								<div e_rel="txtpass" class="textbox-error"></div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input name="cancle" type="submit" onclick="return validationCheckHandler2()" value="Login" class="back2">
								<input name="cancle" type="button"  id="clear_form" value="Clear" class="cancel">
							</td>
						</tr>
						<tr style="height: 20px;"><td colspan="2"></td></tr>
						<br />
						<tr>
							<td colspan="2" align="center"><a href="javascript:void(0)" id="fglnk">Forgot Password</a></td>
						</tr>
					</table>
				</form>
				
			</div>
			
			<div class="loginTwo" id="forgotpass" style="display:none;">
				<h3>Forgot Password</h3>
				
				<form method="post" id="myfrom4" action="<?=$config['BaseUrl']?>Rides/forgotpassword/<?=$id?>">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td>Email <span style="color:#ff0000">*</span></td>
							<td>
								<input name="txtfgemail" id="txtfgemail" type="text"  placeholder="Your email address here" class="location location2" validation="email|Please enter your email."/>
								<div e_rel="txtfgemail" class="textbox-error"></div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input name="cancle" type="submit" onclick="return validationCheckHandler4()" value="Send" class="back2">
								<input name="cancle" type="button"  id="fgloginbtn" value="Login" class="cancel">
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="clr"></div>
		</div>
    </div>
	
	<div class="passengerandpayment quti">
		<div class="passenger">
			<a href="javascript:void(0)"><? if($status==1){ echo $this->html->image('nagative.png',array('class'=>'nagatively')); }else{ echo $this->html->image('plus.png',array('class'=>'nagatively')); }?></a>
			<h2>Payment Information</h2>
			<div class="clr"></div>
		</div>
		<div <? if($status!=1){?>style="display:none;"<?}?>>
			<form style="padding: 0 0 30px 40px;" id="myfrom3" method="post" action="<?=$config['BaseUrl']?>Rides/paymentdetail/<?=$id?>">
				<input name="txtPoption" type="radio" value="0" class="radio cashRadio" checked /> Cash
				<input name="txtPoption" type="radio" value="1" class="radio cashRadio" /> Credit card
			
				<table style="width:100%; margin: 0 auto; display:none; padding:20px 0 0 0;" id="cardNoHolder" >
					<tr>
						<td style="width:200px;">Card Number <span style="color:#ff0000">*</span></td>
						<td>
							<input type="text" name="txtCnumber" id="txtCnumber"  placeholder="Card Number" class="location" validation="blank|Please enter card number."/>
							<div e_rel="txtCnumber" class="textbox-error"></div>
						</td>
					</tr>
					<tr>
						<td>Holder Name <span style="color:#ff0000">*</span></td>
						<td>
							<input type="text" name="txtHname" id="txtHname" placeholder="Holder Name" class="location" validation="blank|Please enter holder name."/>
							<div e_rel="txtHname" class="textbox-error"></div>
						</td>
					</tr>
					<tr>
						<td>Expiry Date <span style="color:#ff0000">*</span></td>
						<td>
							<input type="text" name="txtEDate" id="txtEDate" placeholder="Expiry Date" class="location" validation="blank|Please enter expiry date."/>
							<div e_rel="txtEDate" class="textbox-error"></div>
						</td>
					</tr>
					<tr>
						<td>CSV Number <span style="color:#ff0000">*</span></td>
						<td>
							<input type="text" name="txtCSV" id="txtCSV" placeholder="CSV Number" class="location" validation="blank|Please enter CSV number."/>
							<div e_rel="txtCSV" class="textbox-error"></div>
						</td>
					</tr>
					
					<tr>
						<td>Card Type <span style="color:#ff0000">*</span></td>
						<td>
							<input type="text" name="txtCType" id="txtCType" placeholder="Card Type" class="location" validation="blank|Please enter card type."/>
							<div e_rel="txtCType" class="textbox-error"></div>
						</td>
					</tr>
					<tr>
						<td>Billing Address <span style="color:#ff0000">*</span></td>
						<td>
							<input type="text" name="txtAddress" id="txtAddress" placeholder="Billing Address" class="location" validation="blank|Please enter address."/>
							<div e_rel="txtAddress" class="textbox-error"></div>
						</td>
					</tr>
					<tr>
						<td>Post Code <span style="color:#ff0000">*</span></td>
						<td>
							<input type="text" name="txtPCode" id="txtPCode" placeholder="Post Code" class="location" validation="blank|Please enter post code."/>
							<div e_rel="txtPCode" class="textbox-error"></div>
						</td>
					</tr>
					<tr>
						<td></td>	
						<td>
							<input name="cancle" type="submit" onclick="return validationCheckHandler3()" value="Submit" class="back2">
						</td>	
					</tr>
				</table>
				<br/><br/>
				<input name="cancle" id="cashchoose" type="submit" value="Submit" class="back2">
			</form>
		</div>
	</div>
	
</div>
<script type="text/javascript">
	var mod = false;
	var baseurl = "<?=$baseurls?>";
	var rideid = "<?=$id?>";
	$(document).ready(function(){
		$(".cashRadio").bind('click',cashClickHandler);
		$(".clickDiv").bind("click",clickDivChangeHandler);
		$("#myfrom, #myfrom2, #myfrom3, #myfrom4").validation({errorClass:'validationErr', validate:false});
		$("#txtEDate").datepicker({ dateFormat: "yy-mm-dd" , yearRange: "2014:3000", changeMonth: true,changeYear: true});
		
		$("#contact_clear").bind("click",quickConClearHandler1);
		$("#clear_form").bind("click",quickConClear);
		$("#fgloginbtn").bind("click",showloginsection);
		$("#fglnk").bind('click',showforgotsection);
	});
	
	function showloginsection(e) {
		$("#forgotpass").attr("style","display:none;");
		$("#loginsec").attr("style","display:block;");
	}
	function showforgotsection(e) {
		$(".sclas").html('');
		$("#forgotpass").attr("style","display:block;");
		$("#loginsec").attr("style","display:none;");;
	}
	
	function cashClickHandler(e){
		var cashRadio = $(e.currentTarget).val();
		if(cashRadio=='1'){
			mod = true;
			$("#cashchoose").hide();
			$("#cardNoHolder").fadeIn(200);
		}else{
			mod = false;
			$("#cashchoose").show();
			$("#cardNoHolder").fadeOut(200);
			//$("#cardNoHolder").removeAttr('placeholder');
		}
	}
	
	function clickDivChangeHandler(e){
		var parent = $(e.currentTarget).parents(".quti");
		var mode = $(e.currentTarget).attr('mode');
		console.log(mode);
		if(mode=='on'){
			$(".clickDiv").attr('mode','on');
			$(e.currentTarget).attr('mode','off');
			$(".des").hide();
			$(".des").slideUp(200);
			$($(parent).find(".des")).slideDown(200);
			$(".clickDiv").html('<?=$this->html->image('plus.png',array('class'=>'nagatively'))?>');
			$(e.currentTarget).html('<?=$this->html->image('nagative.png',array('class'=>'nagatively'))?>');
		}else{
			$(".clickDiv").attr('mode','off');
			$(e.currentTarget).attr('mode','on');
			$($(parent).find(".des")).slideUp(200);
			$(e.currentTarget).html('<?=$this->html->image('plus.png',array('class'=>'nagatively'))?>');
		}
	}
	
	function validationCheckHandler(){
		if( $("#myfrom").validation( {errorClass:'validationErr'} ) ) {
			//now validate email is new
			doemalvalidationandpassword();
			return false;
		} else {
			return false;
		}
	}
	
	function doemalvalidationandpassword(){
		var email=$("#txtEmail").val();
		var pass = $("#txtPass").val();
		var rpass = $("#txtRpass").val();
		$.ajax({
			url:baseurl+"/Rides/useremailvalidate/"+rideid,
			type:'post',
			dataType:'json',
			data:{email:email},
			success:function(response){
				
				if (response.status=='1') {
					//valid email and now validate password and re pass
					if (pass!=rpass) {
						//alert('password does not match');
						$("#erpasserror").html("Password does not matched");
					}
					else{
						$("#myfrom").submit();
					}
				}
				else{
					//alert("Email Already present");
					$("#eerror").html("Email Already registered");
				}
			},
			error:function(response){
				console.log(response);
			}
		});
	}
	
	function validationCheckHandler2(){
		if( $("#myfrom2").validation( {errorClass:'validationErr'} ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function validationCheckHandler3(){
		console.log(mod);
		if( $("#myfrom3").validation( {errorClass:'validationErr'} ) ) {
			return true;
		} else {
			if(mod==false){
				return true;
			}else{
				return false;
			}
		}
	}
	
	function validationCheckHandler4(){
		console.log(mod);
		if( $("#myfrom4").validation( {errorClass:'validationErr'} ) ) {
			sendlinkthroughajax();
			return false;
		} else {
			return false;
		}
	}
	
	function sendlinkthroughajax(){
		var email = $("#txtfgemail").val();
		$.ajax({
			url:baseurl+"/Rides/forgotpassword/"+rideid,
			type:'post',
			dataType:'json',
			data:{txtfgemail:email,isredirect:0},
			success:function(response){
				console.log(response);
				if (response.status=="send") {
					$("#txtfgemail").val('');
					$("#fgstatusdiv").html("Password Reset Link Sent To Your Email Id").attr('style','text-align:center;color:green;');
					$("#fgloginbtn").trigger('click');
				}
				else{
					$("#fgstatusdiv").html("Invalid Email").attr('style','text-align:center;color:red;');
				}
				
			},
			error:function(response){
				console.log(response);
			}
		});
	}
	
	function quickConClearHandler1(){
		$("#txtFname").val('');
		$("#txtLname").val('');
		$("#txtLname").val('');
		$("#txtUname").val('');
		$("#txtMno").val('');
		$("#txtEmail").val('');
	}	
	function quickConClear(){
		$("#txtemail").val('');
		$("#txtpass").val('');
	}	
	
</script>