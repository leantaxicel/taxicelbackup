<?
	$config = Configure::read("TaxiCel"); 
?>
<div class="mainBody">
    <div class="icopPart icopPartnew">
		<ul>
			<li>
				<a href="<?=$config['BaseUrl']?>driver/Rides" class="rids"></a>
				<p>Ride Summery</p>
			</li>
			<li>
				<a href="<?=$config['BaseUrl']?>driver/Users/contactinfo" class="contactinfo"></a>
				<p>Contact Info</p>
			</li>
			<li>
				<a href="<?=$config['BaseUrl']?>driver/DriverDocuments/add" class="documents"></a>
				<p>Documents</p>
			</li>
			<li>
				<a href="<?=$config['BaseUrl']?>driver/VehicleDetails/index" class="vehicles"></a>
				<p>Vehicles</p>
			</li>
			<li>
				<a href="<?=$config['BaseUrl']?>driver/Users/rechargescheme" class="rechargescm"></a>
				<p>Recharge Scheme</p>
			</li>
			<li>
				<a href="<?=$config['BaseUrl']?>driver/UserRideCommitions/referalearning" class="referalearnin"></a>
				<p>Referral Earnings</p>
			</li>
			<li>
				<a href="<?=$config['BaseUrl']?>driver/Users/pramotion" class="pramotion"></a>
				<p>Promotions</p>
			</li>
			<!--<li>
				<a href="<?=$config['BaseUrl']?>driver/DriverCustoms/subindex" class="drivers"></a>
				<p>Drivers</p>
			</li>-->
		</ul>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>