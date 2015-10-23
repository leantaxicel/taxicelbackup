<html>
	<head></head>
	<body>
		<p style="color:#3f3e3e; font-size:14px; font-weight:300; padding:10px 0 20px 0; margin: 10px 20px;">
		Hello <?php echo $customername;?> ,<br/><br/>
		
		Your ride has ended. Details of the ride are given below..  
		</p>
		<ul style="padding:0 0 0 0; list-style:none; margin: 0 20px;">
			<li style="padding:5px 0; font-size:14px; color:#1e1e1e;">Pickup From : <?php echo $pickupaddress;?> 
			<li style="padding:5px 0; font-size:14px; color:#1e1e1e;">Drop off : <?php echo $dropoffaddress;?>
			<li style="padding:5px 0; font-size:14px; color:#1e1e1e;">Ride Date and Time : <?php echo $pickupdatetime;?>
			<li style="padding:5px 0; font-size:14px; color:#1e1e1e;"> Ride Cost : <?php echo $ridecost;?>
			<li style="padding:5px 0; font-size:14px; color:#1e1e1e;"> Driver Name : <?php echo $drivername;?>
			<li style="padding:5px 0; font-size:14px; color:#1e1e1e;"> Driver No : <?php echo $driverphonno;?>
			<li style="padding:5px 0; font-size:14px; color:#1e1e1e;"> Vehicle : <?php echo $vehicledetails;?>
			<div style="clear: both"></div>
		</ul>
		
		<br/></br>
		<p style="padding:10px 0; margin: 0 0 0 22px; font-size:16px; color:#1e1e1e;">
		Thanks,<br/>
		Team TaxiCel <br/>
		contact@taxicel.com.ar <br/>
		www.taxicel.com.ar<br/>
		</p>
	</body>
</html>