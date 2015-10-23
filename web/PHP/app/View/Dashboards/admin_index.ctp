<?php 
	$config = Configure::read("TaxiCel");
?>
<div class="mainBody">
	<div class="iconHolder">
		<div class="icopPart_dash">
			<ul>
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Rides" class="rids"></a>
					<p>Rides</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Cities" class="city"></a>
					<p>Cities</p>
				</li>
				
				<!--<li>
					<a href="<?=$config['BaseUrl']?>admin/CityConfigurations" class="cityconfig"></a>
					<p>City Price Config.</p>
				</li>-->
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Users/driver" class="drivers"></a>
					<p>Drivers</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Users/customer" class="group"></a>
					<p>Customers</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Users/drivercitymap" class="driver_map"></a>
					<p>Drivers On City Map</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/PriceSettings" class="price_set"></a>
					<p>Price Setting</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Configurations/add" class="documents"></a>
					<p>Configurations</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/PaymentSettings/add" class="payment_set"></a>
					<p>Payment Settings</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/HeatZones" class="livestatus"></a>
					<p>Hit Zones</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/AppGalleries" class="promocode"></a>
					<p>App Gallery</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/UserRideRatings" class="grouplocat"></a>
					<p>Feedbacks</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Contactuses" class="contactinfo"></a>
					<p>Enquiries</p>
				</li>
				
				 <li>
					<a href="<?=$config['BaseUrl']?>admin/Faqs" class="supportandfaq"></a>
					<p>Support & Faqs</p>
				</li>
				
				 <!--li>
					<a href="<?=$config['BaseUrl']?>admin/Blogs" class="partnerinovoice"></a>
					<p>Post a Blog</p>
				</li-->
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Rides/commitionsearn" class="payment_set"></a>
					<p>Ride Commission</p>
				</li>
				
				<!--li>
					<a href="javascript:void(0)" class="tripinovoice"></a>
					<p>Sales History</p>
				</li-->
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Companies" class="companies"></a>
					<p>Companies</p>
				</li>
				
				<!--li>
					<a href="<?=$config['BaseUrl']?>admin/Rollmasters" class="rollmaster"></a>>
					<a href="#" class="rollmaster"></a>
					<p>Roll Master</p>
				</li-->
				<!--li>
					<a href="<?=$config['BaseUrl']?>admin/UserRollDetails" class="fixed_fares"></a>>
					<a href="#" class="fixed_fares"></a>
					<p>User Roll Details</p>
				</li-->
				<!--li>
					<a href="<?=$config['BaseUrl']?>admin/AssignCompanyOwnners" class="country"></a>
					<p>Assign Company Owner</p>
				</li-->
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Cars" class="models_car"></a>
					<p>Cars</p>
				</li>
				<li>
					<a href="<?=$config['BaseUrl']?>admin/DriverCommisionDistributions" class="driver_dictri"></a>
					<p>Driver Commission Distribution</p>
				</li>
				<li>
					<a href="<?=$config['BaseUrl']?>admin/CarModels" class="car_models"></a>
					<p>Car Models</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/DriverDocuments" class="driverDocument"></a>
					<p>Driver Documents</p>
				</li>
				
				<li>
					<a href="<?=$config['BaseUrl']?>admin/VehicleDetails" class="vehicleDetails"></a>
					<p>Drivers Vehicles</p>
				</li>
				<div class="clr"></div>
				<li>
					<a href="<?=$config['BaseUrl']?>admin/RechargeSchemes" class="rechargeScheme"></a>
					<p>Recharge Scheme</p>
				</li>
				<li>
					<a href="<?=$config['BaseUrl']?>admin/CommissionPayments/payment" class="paymentCommission"></a>
					<p>Commission Payment Details</p>
				</li>
				<li>
					<a href="<?=$config['BaseUrl']?>admin/CommissionPayments" class="schemeRecharge"></a>
					<p>Driver Scheme Recharge</p>
				</li>
				<li>
					<a href="<?=$config['BaseUrl']?>admin/Users/retrivepass" class="passwordChangeAdmin"></a>
					<p>Update Password</p>
				</li>
				
				<!--
				<li><a href="<?=$config['BaseUrl']?>admin/CommissionPayments/payment" class="">- Commissoion Paid By Drivers</a></li>
				<li><a href="<?=$config['BaseUrl']?>admin/CommissionPayments" class="">- Drivers Scheme Recharges</a></li>
				
				-->
					
				<!--li>
					<a href="javascript:void(0)" class="fare_reviews"></a>
					<p>Fare Reviews</p>
				</li-->
				
				<!--li>
					<a href="javascript:void(0)" class="group"></a>
					<p>Groups</p>
				</li>
				<li>
					<a href="javascript:void(0)" class="grouplocat"></a>
					<p>Group locations</p>
				</li-->
				<!--li>
					<a href="javascript:void(0)" class="promocode"></a>
					<p>Promocodes</p>
				</li-->
				<!--li>
					<a href="javascript:void(0)" class="banking"></a>
					<p>Fare Review Options</p>
				</li-->
				<!--li>
					<a href="javascript:void(0)" class="car_catagories"></a>
					<p>Car Categories</p>
				</li-->
				<!--li>
					<a href="javascript:void(0)" class="models_car"></a>
					<p>Car Models</p>
				</li-->
				<!--li>
					<a href="javascript:void(0)" class="currency"></a>
					<p>Currency</p>
				</li-->
			</ul>
			<!--ul style="width: 815px; margin: 0 auto;">
			   
			   
			</ul-->
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>
</div>