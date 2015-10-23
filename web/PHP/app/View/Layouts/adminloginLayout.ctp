<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TaxiCel: Admin Panel</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php echo $this->Html->charset(); ?>
<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css(array('style'));
	
	echo $this->Html->script(array('jquery-1.9.1','validation'));
	echo $this->fetch('script');
	
	echo $this->fetch('meta');
	echo $this->fetch('css');
	$config = Configure::read("TaxiCel"); // loading config	
?>
</head>

<body>

	<div class="mainWrapper">
   		<div class="loginPage">
        	<?=$this->html->image('logo_admin.png')?>
            	<h5>Administrative Panel</h5>
                <div class="clr"></div>
			<!-----------------------End_Header--------------------------------->
			<?php echo $this->Session->flash(); ?>
					
			<?php echo $this->fetch('content'); ?>
			<!-----------------------End_loremins---------------------------------->  
    
		</div>
      	<div class="bg">
   	  		<?=$this->html->image('bg.jpg',array('width'=>'100%','height'=>'100%'))?>
      	</div>
    </div>

</body>
</html>
