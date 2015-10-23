<?php
	$config = Configure::read("TaxiCel"); // loading config	
?>
<script type="text/javascript" src="<?php echo $config['BaseUrl'];?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo $config['BaseUrl'];?>/js/validation.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#referalregis").validation({errorClass:'validationErr', validate:false});
		 $(".refera").bind("click",quickConClearHandler1);
	});
	
	function validationCheckHandler(){
		if( $("#referalregis").validation( {errorClass:'validationErr'} ) ) {
			return true;
		} else {
			$("html, body").animate({scrollTop:250},2000);
			return false;
		}
	}
	/* function quickConClearHandler1(){
		$("#usrName").val('');
		$("#eMails").val('');
		$("#pAss").val('');
		$("#txtUaddress").val('');
	}	 */
</script>
<div class="login">
	<h1>Signup to App</h1>
		<?php
			if(isset($status) && $status==1){
		?>
        <div class="opps">
        	<p>Thank you for registration</p>
            <div class="clr"></div>
        </div>
		<? }?>
	
	<form method="post" name="referalregis" action="<?php echo $config['BaseUrl'];?>Users/savereferal_registration" id="referalregis" class="refera">
		
		<div style="padding-top:20px;">
			<input type="text" placeholder="Username" name="username" id="usrName" class="nameuser" validation="blank|Please enter name.">
			<div e_rel="usrName" class="textbox_error01" ></div>
			
			<input type="text" placeholder="E-mail" id="eMails" name="email" class="email" validation="blank|Please enter email.">  
			<div e_rel="eMails" class="textbox_error01"></div>
			
			<input type="password" placeholder="password" id="pAss" name="pass" class="password" validation="blank|Please password.">  
			<div e_rel="pAss" class="textbox_error01"></div>
			
			<input type="text" placeholder="Referrer code" id="" name="my_refferal_code">
			
			<input type="submit" value="Submit" onclick="return validationCheckHandler()"class="back2">
		</div>
	</form>	
</div>
<div class="shadow"></div>

<!-- Responsive Login css -->
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Roboto:400,300,700);

*  {  padding: 0 ;  margin: 0 ; }

body{
	font-family: 'Roboto', sans-serif;
	background:#fef4d6;
	position:relative;
}

html { height: 100% }
::-moz-selection { background: #fe57a1; color: #fff; text-shadow: none; }
::selection { background: #fe57a1; color: #fff; text-shadow: none; }
body { background-image: radial-gradient( cover, rgba(92,100,111,1) 0%,rgba(31,35,40,1) 100%), url('http://i.minus.com/io97fW9I0NqJq.png') }

.login {
  background: #fde9ac url(../img/bg_pic.png) 89% 95% no-repeat;
  border: 6px solid rgba(20, 20, 20, 0.5);
  border-radius:5px;
  margin: 12% auto 0;
  width: 285px;
  padding:0 0 20px 0;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}
.login h1 {
  border-bottom: 1px solid rgba(20, 20, 20, 0.5);
  color: #141414;
  display: block;
  padding: 15px 0;
  background: url(../img/log_icon.png) 23% 52% no-repeat;
  font: 600 18px/1 Roboto;
  margin: 0;
  text-align: center;
  text-shadow: 0 -1px 0 rgba(0,0,0,0.2), 0 1px 0 #fff;
}
input[type="password"], input[type="text"] {
  border: 1px solid #a1a3a3;
  box-sizing: border-box;
  color: #696969;
  height: 39px;
  margin: 0 0 5px 18px;
  padding-left: 26px;
  border-radius:5px;
  transition: box-shadow 0.3s;
  width: 250px;
  font-size:14px !important;
  font-family:Roboto !important;
  font-weight:300 !important;
}
input[type="password"]:focus, input[type="text"]:focus {
  box-shadow: 0 0 4px 1px rgba(55, 166, 155, 0.3);
  outline: 0;
}
.show-password {
  display: block;
  height: 16px;
  margin: 26px 0 0 28px;
  width: 87px;
}
input[type="checkbox"] {
  cursor: pointer;
  height: 16px;
  opacity: 0;
  position: relative;
  width: 64px;
}
input[type="checkbox"]:checked {
  left: 29px;
  width: 58px;
}
.toggle {
  background: url(http://i.minus.com/ibitS19pe8PVX6.png) no-repeat;
  display: block;
  height: 16px;
  margin-top: -20px;
  width: 87px;
  z-index: -1;
}
input[type="checkbox"]:checked + .toggle { background-position: 0 -16px }
.forgot {
  color: #7f7f7f;
  display: inline-block;
  float: right;
  font: 14px/1 Roboto !important;
  border-radius:5px;
  left: -19px;
  position: relative;
  text-decoration: none;
  top: 5px;
  transition: color .4s;
}
.forgot:hover { color: #3b3b3b }
.back2 {
	text-align: center !important;
	background:#141414 !important;
	font-size: 16px !important;
	padding: 8px 16px !important;
	color: #fff !important;
	font-family: Roboto !important;
	text-transform: none !important;
	border-radius:5px !important;
	border: none !important;
	cursor: pointer !important;
	font-weight: 300 !important;
	margin: 0 5px 0 18px !important;
	transition: all 0.8s ease !important;
}
.back2:hover{
	background:#ffcc29 !important;
	color:#141414 !important;
}
input[type="submit"]:active {
  top:3px;
  box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #31524d, 0px 5px 3px #999;
}
.login p.remember_me label {
	font-size: 12px;
	color: #777;
	cursor: pointer;
}
@media (max-width: 320px){
	.login {
		margin: 20% auto 0 !important;
	}
}
@media (max-width: 360px){
	.login {
		margin: 35% auto 0;
	}
}
.nameuser{
	background:#fff url(../img/user_icon.png)5px 10px no-repeat;
}
.password{
	background:#fff url(../img/password.png)5px 12px no-repeat;
}
.email{
	background:#fff url(../img/email.png)5px 14px no-repeat;
}

.textbox_error01{
	font-size:12px; 
	color:#FF0000; 
	margin:0 !important;
}
</style>