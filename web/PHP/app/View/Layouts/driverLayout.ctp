<?php
	$controleraction = $this->params->params['controller']."_".$this->params->params['action'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TaxiCel: Driver Panel</title>
<link href="css/style.css?111" rel="stylesheet" type="text/css" />
<?php echo $this->Html->charset(); ?>
<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css(array('style'));
	echo $this->Html->script(array('jquery-1.9.1','AddressFinder','validation'));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	$config = Configure::read("TaxiCel"); // loading config	
?>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		var front_end_height = $(window).height() - ( $(".header").outerHeight() + $(".footer").outerHeight() );
		$(".creatTol").css({
			"height" : (front_end_height-10)+ "px"
		});
		
		$(".createView").css({
			"height" : (front_end_height-10)+ "px"
		});
		
		$(".navScroll").css({
			"height" : (front_end_height-10)+ "px"
		});
		
		$(".creatTol").css({
			"width" : ($('.mainWrapper').width()-$('.navgaton').width()-65)+"px"
		});
		
		$(".createView").css({
			"width" : ($('.mainWrapper').width()-$('.navgaton').width()-65)+"px"
		});
		
		$(".navgaton").css({
			"height" : front_end_height+ "px"
		});
	});
</script>
<body>

	<div class="mainWrapper">
   		<div class="header">
			<?
				if($this->Session->check('dcomlogo') && $this->Session->read('dcomlogo')!=''){
			?>
			<a href="<?=$config['BaseUrl']?>driver/Dashboards"><img src="<?=FULL_BASE_URL.$this->base."/companyLogo/thumb_".$this->Session->read('dcomlogo')?>" width="124" height="71" /></a>	
			<?	
				}
				else{
			?>
			<a href="<?php echo $config['BaseUrl']?>driver/Dashboards"><?=$this->html->image('logo_small.png',array('width'=>'124','height'=>'71'))?></a>
			<?
				}
			?>
            <h5>Driver Panel</h5>
            <div class="afterLogin">
            	<p>Welcome, <span><?=$this->Session->read('dusername');?></span></p>
                <h4><a href="<?=$config['BaseUrl']?>Dashboards/logout2">Logout</a></h4>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
			</div>
			<div class="mainBody">
        	<div class="navgaton">
				<div class="navScroll">
					<ul>
						<li><a href="<?=$config['BaseUrl']?>driver/Dashboards"><?=$this->html->image('dashbord_icon.png',array('class'=>'naviIcon'))?>Back To Dashboard</a></li>
						
						<li><a href="<?=$config['BaseUrl']?>driver/Rides" class="<?php echo (($controleraction==='Rides_driver_index'))?'active' :'' ?>"><?=$this->html->image('vehicles_icon.png',array('class'=>'naviIcon'))?>Ride Summery</a></li>
						
						<li><a href="<?=$config['BaseUrl']?>driver/Users/contactinfo" class="<?php echo (($controleraction==='Users_driver_contactinfo'))?'active' :'' ?>"><?=$this->html->image('contact_info_icon.png',array('class'=>'naviIcon'))?>Contact Info</a></li>
						
						<li><a href="<?=$config['BaseUrl']?>driver/DriverDocuments/add" class="<?php echo (($controleraction==='DriverDocuments_driver_add'))?'active' :'' ?>"><?=$this->html->image('documents_icon.png',array('class'=>'naviIcon'))?>Documents</a></li>
						
						<li><a href="<?=$config['BaseUrl']?>driver/VehicleDetails/index" class="<?php echo (($controleraction==='VehicleDetails_driver_index'))?'active' :'' ?>"><?=$this->html->image('vehicles_icon.png',array('class'=>'naviIcon'))?>Vehicles</a></li>
						
						<li><a href="<?=$config['BaseUrl']?>driver/Users/rechargescheme" class="<?php echo (($controleraction==='Users_driver_rechargescheme'))?'active' :'' ?>"><?=$this->html->image('recharge_scheme_s.png',array('class'=>'naviIcon'))?>Account Recharge</a></li>
						
						<li><a href="<?=$config['BaseUrl']?>driver/UserRideCommitions/referalearning" class="<?php echo (($controleraction==='UserRideCommitions_driver_referalearning'))?'active' :'' ?>"><?=$this->html->image('referal_earnings_s.png',array('class'=>'naviIcon'))?>Referel Earnings</a></li>
						
						<li><a href="<?=$config['BaseUrl']?>driver/Users/pramotion" class="<?php echo (($controleraction==='Users_driver_pramotion'))?'active' :'' ?>"><?=$this->html->image('pramotions_s.png',array('class'=>'naviIcon'))?>Promotions</a></li>
						
						<!--
						<li><a href="<?=$config['BaseUrl']?>driver/DriverCustoms/subindex"><?=$this->html->image('driver_icon.png',array('class'=>'naviIcon'))?>Drivers</a></li>
						-->
					</ul>
				</div>
            </div>
			<!-----------------------End_Header--------------------------------->
			<?php echo $this->Session->flash(); ?>
					
			<?php echo $this->fetch('content'); ?>
			<!-----------------------End_loremins---------------------------------->  
			</div>
			<div class="footer">
   	  		<!--p>&copy; Copyright <span><a href="javascript:void(0)"><?=$this->Session->read('dcompname')?></a></span></p-->
			
			<p>&copy; Copyright <span><a href="javascript:void(0)"><? if($this->Session->read('dcompname') && $this->Session->read('dcompname')!=''){echo $this->Session->read('dcompname');}else{ echo "taxicel.com.ar";}?></a></span></p>
			
      	</div>
    </div>

</body>
</html>
