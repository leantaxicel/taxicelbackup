<?php
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="creatTol">
	<h2>Replay Email</h2>
	<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass2'))?>

	<form id="myfromsmtd" method="post" action="<?=$config['BaseUrl']?>admin/Contactuses/replay">
		<input name="id" type="hidden" value="<?php echo $Contactus['Contactus']['id']?>" />
		<input name="name" type="hidden" value="<?php echo $Contactus['Contactus']['name']?>" />
		<table class="reply_Email">
			<tr>
				<td>Email ID</td>
				<td>
					<input name="txtEmail" maxlength="200" type="text" value="<?php echo $Contactus['Contactus']['email']?>" readonly />
				</td>
			</tr>
			<tr>
				<td>Contact No</td>
				<td>
					<input name="txtContact" maxlength="200" type="text" value="<?php echo $Contactus['Contactus']['contact_no']?>" readonly />
				</td>
			</tr>
			<tr>
				<td>Message</td>
				<td>
					<textarea id="txtMsg" name="message" cols="0" rows="5" placeholder="Insert Message Here..."  required /></textarea>
					
				</td>
			</tr>
			<tr>
				<td>
					<input name="submit" type="submit" onclick="return validationCheckHandler()" value="Send" class="viewProfilebtn">
				</td>
			</tr>
		</table>
	</form>
</div>


