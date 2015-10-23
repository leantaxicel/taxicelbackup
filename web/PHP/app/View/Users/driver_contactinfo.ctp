<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="createView">
	<h2>Contact Info</h2>
	<div class="clr"></div>
	<div class="techerTable contactTable" style="width:57%; float:left;">
		<!------------------------------- Company Details ---------------------->
		<table>
			<tr>
				<td><h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Company Information</h2></td>
			</tr>
			<tr>
				<td>Company Name</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['DriverCustom']['company_name']?></td>
			</tr>
			<tr>
				<td>Address Line 1</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['DriverCustom']['address1']?></td>
			</tr>
			<tr>
				<td>Address Line 2</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['DriverCustom']['address2']?></td>
			</tr>
			<!--tr>
				<td>City</td>
				<td>: <?=$user['DriverCustom']['city_id']?></td>
			</tr-->
			<tr>
				<td>State/Province/Region </td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['DriverCustom']['region']?></td>
			</tr>
			<tr>
				<td>Zip/Postal Code </td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['DriverCustom']['postal_code']?></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['DriverCustom']['mobile']?></td>
			</tr>
		</table>
		
		
		<!------------------------------- Personal Details ---------------------->
		
		<table>
			<tr>
				<td><h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Personal Information</h2></td>
			</tr>
			<tr>
				<td>First name</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['User']['f_name']?></td>
			</tr>
			<tr>
				<td>Last name</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['User']['l_name']?></td>
			</tr>
			<!--tr>
				<td>City</td>
				<td>: <?=$user['DriverCustom']['city_id']?></td>
			</tr-->
			<tr>
				<td>Mobile Phone</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['User']['mobile']?></td>
			</tr>
			<tr>
				<td>Email Address</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['User']['email']?></td>
			</tr>
		</table>
		
		<!------------------------------- Account Information ---------------------->
		<table>
			<tr>
				<td><h2 style="font-size:20px; font-weight:400; border-bottom:1px solid #E7E7E7; color:#444;">Account Information</h2></td>
				
			</tr>
			<tr>
				<td>Username</td>
				<td><span style="padding: 0  10px 0 0;">:</span><?=$user['User']['username']?></td>
			</tr>
		</table>
		
		 <div class="clr"></div>
	</div>
	
	<div class="browseImage">
		<p><a href="<?=$config['BaseUrl']?>driver/Users/edit/<?=$this->Session->read('driver_id')?>" class="viewProfilebtn">Edit Infomation</a></p>
		<div>
		<?
			if($user['DriverCustom']['user_pic']!=''){
		?>
			<img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/userPic/thumb_<?=$user['DriverCustom']['user_pic']?>" class="userPic"/>
		<?}else{
				echo $this->html->image('noimg.png',array('class'=>'userPic'));
			}
		?>
		</div>
		<!--a href="javascript:void(0)" tabindex="-1" class="password1">
			<input type="file" multiple="true" required="" name="filename" size="1" class="password2">
			<span><em></em>Change Image</span>
		</a-->
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>