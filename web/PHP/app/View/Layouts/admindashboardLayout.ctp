<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TaxiCel: Admin Panel</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php echo $this->Html->charset(); ?>
<?php
	echo $this->Html->meta('icon');
	echo $this->Html->script(array('jquery-1.9.1'));
	echo $this->Html->css(array('style'));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	$config = Configure::read("TaxiCel"); // loading config	
?>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		var front_end_height = $(window).height() - ( $(".header").outerHeight() + $(".footer").outerHeight() );
		$(".iconHolder").css({
			"height" : (front_end_height)+ "px"
		});
	});
</script>
<body>

	<div class="mainWrapper">
   		<div class="header">
			<!--<a href="<?=$config['BaseUrl']?>admin/Dashboards"><?=$this->html->image('logo_small.png',array('width'=>'124','height'=>'71'))?></a>-->
			<?php if($this->Session->read('sitelogo')!=''){ ?>
			<a href="<?=$config['BaseUrl']?>admin/Dashboards"><img src="<?=FULL_BASE_URL.$this->base."/companyLogo/".$this->Session->read('sitelogo')?>" width="124" height="71" /></a>
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
			<!-----------------------End_Header--------------------------------->
			<?php echo $this->Session->flash(); ?>
					
			<?php echo $this->fetch('content'); ?>
			<!-----------------------End_loremins---------------------------------->  
    
			<div class="footer">
   	  		<p>&copy; Copyright <span><a href="javascript:void(0)"><? if($this->Session->check('siteurl') && $this->Session->read('siteurl')!=''){echo $this->Session->read('siteurl');}else{ echo "taxicel.com.ar";}?></a></span></p>
      	</div>
    </div>

</body>
</html>
