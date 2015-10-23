<?php
	$baseurls = FULL_BASE_URL.$this->base;
	//echo "conteroller".strtolower($this->params->params['controller']);
	$controleraction = $this->params->params['controller']."_".$this->params->params['action'];
	//pr($this->params)
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TaxiCel: Admin Panel</title>
<link href="<?=$baseurls?>/css/style.css?<?=date("Y-m-d")?>" rel="stylesheet" type="text/css" />
<?php echo $this->Html->charset(); ?>
<?php
	echo $this->Html->meta('icon');

	//echo $this->Html->css(array('style'));
	echo $this->Html->script(array('jquery-1.9.1','AddressFinder','play.ajax','validation'));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	$config = Configure::read("TaxiCel"); // loading config	
?>
</head>
<script type="text/javascript">
	//var controllername = "<?=strtolower($this->params->params['controller']."_".$this->params->params['action'])?>";
	var controllername= "<?=strtolower($controleraction)?>";
	var transactionsarr=['userrideratings_admin_index','rides_admin_index','rides_admin_view','users_admin_drivercitymap','rides_admin_commitionsearn','commissionpayments_admin_payment','commissionpayments_admin_index'];
	var settingsarr=['pricesettings_admin_index','pricesettings_admin_add','pricesettings_admin_edit','configurations_admin_add','paymentsettings_admin_add','rechargeschemes_admin_index','rechargeschemes_admin_add','rechargeschemes_admin_edit','drivercommisiondistributions_admin_index','drivercommisiondistributions_admin_add','drivercommisiondistributions_admin_edit'];
	var masterarr=['users_admin_driver','users_admin_customer','users_admin_view','heatzones_admin_index','heatzones_admin_add','heatzones_admin_view','cities_admin_index','cities_admin_add','appgalleries_admin_index','appgalleries_admin_add','cars_admin_index','cars_admin_add','cars_admin_edit','carmodels_admin_index','vehicledetails_admin_index','driverdocuments_admin_index','vehicledetails_admin_addvehicle'];
	var sureadmincontrol = ['contactuses_admin_index','blogs_admin_index','faqs_admin_index','companies_admin_index','users_admin_retrivepass'];
	$(document).ready(function(){
		var front_end_height = $(window).height() - ( $(".header").outerHeight() + $(".footer").outerHeight() );
		$(".creatTol").css({
			"height" : (front_end_height-10)+ "px"
		});
		
		$(".navScroll").css({
			"height" : (front_end_height-10)+ "px"
		});
		
		$(".creatTol").css({
			"width" : ($('.mainWrapper').width()-$('.navgaton').width()-65)+"px"
		});
		
		$(".navgaton").css({
			"height" : front_end_height+ "px"
		});
		
		$(".flipMe").bind('click',flipMeHandler);
		//open the left pane
		if ($.inArray(controllername,transactionsarr)!=-1) {
			//alert('found');
			$("#ftrans").trigger('click');
		}
		else if ($.inArray(controllername,settingsarr)!=-1) {
			$("#fsetting").trigger('click');
		}
		else if ($.inArray(controllername,masterarr)!=-1) {
			$("#fmaster").trigger('click');
		}
		else if ($.inArray(controllername,sureadmincontrol)!=-1) {
			$("#fsuperadmin").trigger('click');
		}
		else{
			
		}
	});
	
	
	function flipMeHandler(e){
		var me = $(e.currentTarget).attr('myName');
		$(".fliper").slideUp();
		$("#"+me).toggle();
	}
	
</script>
<body>
	<div class="mainWrapper">
   		<div class="header">
			
			<?php if($this->Session->read('sitelogo')!=''){ ?>
			<a href="<?=$config['BaseUrl']?>admin/Dashboards"><img src="<?=FULL_BASE_URL.$this->base."/companyLogo/thumb_".$this->Session->read('sitelogo')?>" width="124" height="71" /></a>
			<?php } else{ ?>
			<a href="<?=$config['BaseUrl']?>admin/Dashboards"><?=$this->html->image('logo_small.png',array('width'=>'124','height'=>'71'))?></a>
			<?php } ?>
	    <h5>Administrative Panel</h5>
            <div class="afterLogin">
            	<p>Welcome, <span><?=$this->Session->read('username');?></span></p>
                <h4><a href="<?=$config['BaseUrl']?>Dashboards/logout">Logout</a></h4>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
		</div>
		<div class="mainBody">
        	<div class="navgaton">
				<div class="navScroll">
					<ul>
						<li>
							<a href="<?=$config['BaseUrl']?>admin/Dashboards"><?=$this->html->image('dashbord_icon.png',array('class'=>'naviIcon'))?>Back To Dashboard</a>
						</li>
						
						<li>
							<a href="javascript:void(0)" class="flipMe" myName="master" id="fmaster"><?=$this->html->image('arrow_icon.png',array('class'=>'naviIcon'))?> Master</a>
						</li>
						<div style="display:none;" id="master" class="fliper">
							<ul>
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Users/driver" class="<?php echo (($controleraction==='Users_admin_driver'))?'active' :'' ?>">- Drivers</a>
								</li>
								
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Users/customer" class="<?php echo (($controleraction==='Users_admin_customer'))?'active' :'' ?>">- Customers</a>
								</li>
								
								<li>
									<a href="<?=$config['BaseUrl']?>admin/HeatZones" class="<?php echo (($controleraction==='HeatZones_admin_index'))?'active' :'' ?>">- Hit Zones</a>
								</li>
								
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Cities" class="<?php echo (($controleraction==='Cities_admin_index'))?'active' :'' ?>">- Cities</a>
								</li>
								<!--<li>
									<a href="<?=$config['BaseUrl']?>admin/CityConfigurations" class="<?php echo (($controleraction==='CityConfigurations_admin_index'))?'active' :'' ?>">- City Price Config.</a>
								</li>
								-->
								<li>
									<a href="<?=$config['BaseUrl']?>admin/AppGalleries" class="<?php echo (($controleraction==='AppGalleries_admin_index'))?'active' :'' ?>">- App Gallery</a>
								</li>
								
								<!--<li>
									<a href="<?=$config['BaseUrl']?>admin/Rollmasters" class="<?php echo (($this->params['controller']==='Rollmasters'))?'active' :'' ?>">- Roll Master</a>
									<a href="#">- Roll Master</a>
								</li>-->
								<!--<li>
									<a href="<?=$config['BaseUrl']?>admin/UserRollDetails" class="<?php echo (($this->params['controller']==='UserRollDetails'))?'active' :'' ?>">- User Roll Details</a>
									<a href="#">- User Roll Details</a>
								</li>-->
								<!--<li>
									<a href="<?=$config['BaseUrl']?>admin/AssignCompanyOwnners" class="<?php echo (($this->params['controller']==='AssignCompanyOwnners'))?'active' :'' ?>">- Assign Company Owner</a>
									<a href="#">- Assign Company Owner</a>
								</li>-->
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Cars" class="<?php echo (($controleraction==='Cars_admin_index'))?'active' :'' ?>">- Cars</a>
								</li>
								<li>
									<a href="<?=$config['BaseUrl']?>admin/CarModels" class="<?php echo (($controleraction==='CarModels_admin_index'))?'active' :'' ?>">- Car Models</a>
								</li>
								<li>
									<a href="<?=$config['BaseUrl']?>admin/VehicleDetails" class="<?php echo (($controleraction==='VehicleDetails_admin_index'))?'active' :'' ?>">- Driver Vehicles</a>
								</li>
								
								<li>
								<a href="<?=$config['BaseUrl']?>admin/DriverDocuments" class="<?php echo (($controleraction==='DriverDocuments_admin_index'))?'active' :'' ?>">- Driver Documents</a>
								</li>
							</ul>
						</div>
						
						<li>
							<a href="javascript:void(0)" class="flipMe" myName="setting" id="fsetting"><?=$this->html->image('arrow_icon.png',array('class'=>'naviIcon'))?> Settings</a>
						</li>
						<div style="display:none;" id="setting" class="fliper">
							<ul>
								<li><a href="<?=$config['BaseUrl']?>admin/PriceSettings" class="<?php echo (($controleraction==='PriceSettings_admin_index'))?'active' :'' ?>">- Price Settings</a></li>
								
								<li><a href="<?=$config['BaseUrl']?>admin/Configurations/add" class="<?php echo (($controleraction==='Configurations_admin_add'))?'active' :'' ?>">- Configurations</a></li>
								
								<li><a href="<?=$config['BaseUrl']?>admin/PaymentSettings/add" class="<?php echo (($controleraction==='PaymentSettings_admin_add'))?'active' :'' ?>">- Payment Settings</a></li>
								<li><a href="<?=$config['BaseUrl']?>admin/RechargeSchemes" class="<?php echo (($controleraction==='RechargeSchemes_admin_index'))?'active' :'' ?>">- Recharge Schemes</a></li>
								<li><a href="<?=$config['BaseUrl']?>admin/DriverCommisionDistributions" class="<?php echo (($controleraction==='DriverCommisionDistributions_admin_index'))?'active' :'' ?>">- Driver Commision Distribution</a></li>
							</ul>
						</div>
						
						<li>
							<a href="javascript:void(0)" class="flipMe" myName="trans" id="ftrans"><?=$this->html->image('arrow_icon.png',array('class'=>'naviIcon'))?> Transactions</a>
						</li>
						<div style="display:none;" id="trans" class="fliper">
							<ul>
								<li><a href="<?=$config['BaseUrl']?>admin/Rides" class="<?php echo (($controleraction==='Rides_admin_index'))?'active' :'' ?>">- Rides</a></li>
								
								<li><a href="<?=$config['BaseUrl']?>admin/UserRideRatings" class="<?php echo (($controleraction==='UserRideRatings_admin_index'))?'active' :'' ?>">- Feedbacks</a></li>
								
								<li><a href="<?=$config['BaseUrl']?>admin/Users/drivercitymap" class="<?php echo (($controleraction==='Users_admin_drivercitymap'))?'active' :'' ?>">- Drivers On City Map</a></li>
								<li><a href="<?=$config['BaseUrl']?>admin/Rides/commitionsearn" class="<?php echo (($controleraction==='Rides_admin_commitionsearn'))?'active' :'' ?>">- Rides Commission</a></li>
								
								<li><a href="<?=$config['BaseUrl']?>admin/CommissionPayments/payment" class="<?php echo (($controleraction==='CommissionPayments_admin_payment'))?'active' :'' ?>">- Commissoion Paid By Drivers</a></li>
								<li><a href="<?=$config['BaseUrl']?>admin/CommissionPayments" class="<?php echo (($controleraction==='CommissionPayments_admin_index'))?'active' :'' ?>">- Drivers Scheme Recharges</a></li>
							</ul>
						</div>
							
						<li>
							<a href="javascript:void(0)" class="flipMe" myName="report"><?=$this->html->image('arrow_icon.png',array('class'=>'naviIcon'))?> Reports</a>
						</li>
						<!--div style="display:none;" id="report" class="fliper">
							<ul>
								<li><a href="javascript:void(0)">- Sales History</a></li>
							</ul>
						</div-->
						<!-- this section availfor super admin only-->
						<?
							if($this->Session->check('superadmin') && $this->Session->read('superadmin')==1){
						?>
						<li>
							<a href="javascript:void(0)" class="flipMe" myName="surepadminsec" id="fsuperadmin"><?=$this->html->image('arrow_icon.png',array('class'=>'naviIcon'))?> Super admin Control</a>
						</li>
						<div style="display:none;" id="surepadminsec" class="fliper">
							<ul>
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Contactuses" class="<?php echo (($controleraction==='Contactuses_admin_index'))?'active' :'' ?>">- Enquiries</a>
								</li>
								<!--
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Blogs" class="<?php echo (($controleraction==='Blogs_admin_index'))?'active' :'' ?>">- Post a Blog</a>
								</li>
								-->
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Faqs" class="<?php echo (($controleraction==='Faqs_admin_index'))?'active' :'' ?>">- Support & Faqs</a>
								</li>
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Companies" class="<?php echo (($controleraction==='Companies_admin_index'))?'active' :'' ?>">- Companies</a>
								</li>
								<li>
								<a href="<?=$config['BaseUrl']?>admin/Users/retrivepass" class="<?php echo (($controleraction==='Users_admin_retrivepass'))?'active' :'' ?>">- Update Password</a>
								</li>
								<!--<li>
									<a href="<?=$config['BaseUrl']?>admin/Companies/adminuser" class="<?php echo (($controleraction==='Companies_admin_adminuser'))?'active' :'' ?>">- Company Admin Users</a>
								</li>-->
							</ul>
						</div>
						<?
							}
							else{
						?>
						<li>
							<a href="javascript:void(0)" class="flipMe" myName="surepadminsec" id="fsuperadmin"><?=$this->html->image('arrow_icon.png',array('class'=>'naviIcon'))?> My Company</a>
						</li>
						<div style="display:none;" id="surepadminsec" class="fliper">
							<ul>
								<li>
									<a href="<?=$config['BaseUrl']?>admin/Companies" class="<?php echo (($controleraction==='Companies_admin_index'))?'active' :'' ?>">- Company</a>
								</li>
								<!--<li>
									<a href="<?=$config['BaseUrl']?>admin/Companies/adminuser" class="<?php echo (($controleraction==='Companies_admin_adminuser'))?'active' :'' ?>">- Company Admin Users</a>
								</li>-->
							</ul>
						</div>
						<?
							}
						?>
					</ul>
				</div>
            </div>
			<!-----------------------End_Header--------------------------------->
			<?php echo $this->Session->flash(); ?>
					
			<?php echo $this->fetch('content'); ?>
			<!-----------------------End_loremins---------------------------------->  
			</div>
			<div class="footer">
   	  		<p>&copy; Copyright <span><a href="javascript:void(0)"><? if($this->Session->check('siteurl') && $this->Session->read('siteurl')!=''){echo $this->Session->read('siteurl');}else{ echo "taxicel.com.ar";}?></a></span></p>
      	</div>
    </div>

</body>
</html>
