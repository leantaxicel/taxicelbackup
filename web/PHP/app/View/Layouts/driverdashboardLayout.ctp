<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TaxiCel: Driver Panel</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php echo $this->Html->charset(); ?>
<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css(array('style'));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	$config = Configure::read("TaxiCel"); // loading config	
?>
</head>

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
           	  	<!--img src="img/login_img.png" width="54" height="45" /-->
				<!--?=$this->html->image('login_img.png',array('width'=>'54','height'=>'45'))?-->
                <h4><a href="<?=$config['BaseUrl']?>Dashboards/logout2">Logout</a></h4>
                <div class="clr"></div>
                <!-------------------Active & Deactive--------------------------->
                <div class="activeButton">
                <h3>Active Mode<i><?=$this->html->image('active_icon.png',array('class'=>'deacct'))?></i></h3>
                <h3 style="display:none;"><span>Deactive Mode</span><i><?=$this->html->image('deactive_icon.png',array('class'=>'deacct'))?></i></h3>
                <div class="clr"></div>
                </div>
                <!-------------------End Active & Deactive--------------------------->
            </div>
            <div class="clr"></div>
			</div>
			<!-----------------------End_Header--------------------------------->
			<?php echo $this->Session->flash(); ?>
					
			<?php echo $this->fetch('content'); ?>
			<!-----------------------End_loremins---------------------------------->  
    
			<div class="footer">
   	  		<!--p>&copy; Copyright <span><a href="javascript:void(0)"><?=$this->Session->read("dcompname")?></a></span></p-->
			
			<p>&copy; Copyright <span><a href="javascript:void(0)"><? if($this->Session->read('dcompname') && $this->Session->read('dcompname')!=''){echo $this->Session->read('dcompname');}else{ echo "taxicel.com.ar";}?></a></span></p>
      	</div>
    </div>

</body>
</html>
