<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout; ?></title>
</head>
<?php $config = Configure::read("TaxiCel"); // loading config	?>
    <body style="@import url(http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,400italic,500italic,700,700italic,900,900italic); margin: 0; padding: 0; background: #fef4d6; font-family: 'Roboto', sans-serif;">
    
        <div style="width:600px; margin:0 auto; padding:20px 0; border-bottom:1px solid #967200;">
		 <img src="<?php echo $config['BaseUrl']?>img/logo_mail.png"/>
		 <!--img src="<?=$config['BaseUrl']?>img/logo_mail.png"/-->
		 
        </div>
        <div>
        	<div style="width:600px; margin:0 auto; padding:30px 0; background:#fde9ac; border-bottom:1px solid #967200;">
            	<h5 style="margin: 0 20px; padding: 0; color:#4e4200; font-weight:300; font-size:14px; padding:0 0 10px 0; border-bottom:1px solid #c7a026; text-align:right;"><?=date('M d Y')?></h5>
           	  	
				<?php echo $this->fetch('content'); ?>
				
				<!--h2 style="color:#3c3c3c; font-size:26px; font-weight:300; padding:30px 0 20px 0; margin: 0 20px;">Nunc eros eros eleifend pulvinar</h2>
                <h3 style="color:#3f3e3e; font-size:20px; font-weight:300; padding:0 0 20px 0; margin: 0 20px;">Ut hendrerit aliquet liberoconvallis dui lacinia eget</h3>
                <p style="color:#3f3e3e; font-size:14px; font-weight:300; padding:0 0 20px 0; margin: 0 20px;">Maecenas ut fermentum risus. Sed pellentesque commodo risus, eu sagittis est iaculis ac. Cras a lacus elit, quis condimentum risus. Duis elit nunc, sollicitudin eget aliquam fermentum, fermentum eu risus. Nam ornare lectus sed arcu facilisis ac ultricies enim mattis. Nullam ac orci elit. Ut hendrerit aliquet libero, ut convallis dui lacinia eget. </p-->
                
				<div style="margin:0 auto; padding:30px 0 0 0; margin: 0 20px;">
                    <a href="#"><div style="float:left; color:#000; width:190px; font-size:24px; font-weight:100; background: #ffcc29 url(<?php echo $config['BaseUrl']?>img/apple_iconemail.png) no-repeat 20px 11px; padding: 20px 0 20px 75px; margin: 0 20px 0 0;">
                        Get Android App
                    </div></a>
                    <a href="#"><div style="float:left; width:190px; color:#000; font-size:24px; font-weight:100; background: #ffcc29 url(<?php echo $config['BaseUrl']?>img/andro_iconemail.png) no-repeat 20px 11px; padding: 20px 0 20px 80px;">
                        Get iPhone App
                    </div></a>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
        <div class="footer">
        	<div style="width:600px; margin:0 auto; padding:20px 0;">
            	<!--p style="color:#777777; font-size:12px; font-weight:300; text-align:center; padding:0 0 10px 0; margin:0;">
                	abcWidgets and the abcWidgets Logo are registered trademarks of abcWidgets Corp. ABCWidgets Corp — 123 Some Street, City, ST 99999. Ph (+91) 98-74-577966
			  </p-->
				<p style="color:#777777; font-size:12px; font-weight:300; text-align:center; padding:0 0 10px 0; margin:0;">
               	You're receiving this newsletter because you bought widgets from us. Having trouble reading this email? <a href="javascript:void(0)" style="color:#000; text-decoration: none ;">View it in your browser.</a> Not interested anymore?<a href="javascript:void(0)" style="color:#000; text-decoration: none ;"> Unsubscribe Instantly.</a> </p>
          </div>
        </div>
    </body>
</html>