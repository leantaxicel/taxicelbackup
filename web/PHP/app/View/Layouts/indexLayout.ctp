<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--link href="css/style_sheet.css" rel="stylesheet" type="text/css" /-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places" type="text/javascript"></script>
<?php echo $this->Html->charset(); ?>
 <?php
	echo $this->Html->meta('icon');
	
	//echo $this->Html->css( array('jquery-ui-1.10.3.custom.min','TextboxList.Autocomplete','TextboxList') );
	//echo $this->Html->script( array( 'mootools-1.2.1-core-yc','play.ajax',
	//							'jquery-1.7.1.min',
	//							'GrowingInput',
	//							'TextboxList',
	//							'TextboxList.Autocomplete',
	//							'TextboxList.Autocomplete.Binary'));
	
	echo $this->Html->script(array('jquery-1.9.1','ms_rotationgallery','AddressFinder','jquery-ui.min','validation','jquery.datetimepicker'));
	echo $this->fetch('script');
	echo $this->fetch('css');
	$config = Configure::read("TaxiCel"); // loading config	
?>
<title>
	TaxiCel
</title>
<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css(array('style_sheet','ui-lightness/jquery-ui-1.8.21.custom','jquery.datetimepicker'));

	echo $this->fetch('meta');
	echo $this->fetch('css');
	//echo $this->fetch('script');
?>
</head>
	
<body>
<div class="mainWrapper">
	<!-------------------------Popup------------------------------------>
	<div class="popup" style="display:none;">
		<div class="popup_content">
			<h1>Select Your Card</h1>
				
			<div class="cardNo">
				<!--table cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:375px; margin:0 0 5px 0">lg hl;fgn</td>
						<td><a href="#"><img src="img/righticon.png" width="22" height="22" /></a></td>
					</tr>
					<tr>
						<td>lg hl;fgn</td>
						<td><a href="#"><img src="img/redcrass.png" width="22" height="22" /></a></td>
					</tr>
					<tr>
						<td>lg hl;fgn</td>
						<td><a href="#"><img src="img/righticon.png" width="22" height="22" /></a></td>
					</tr>
					<tr>
						<td>lg hl;fgn</td>
						<td><a href="#"><img src="img/righticon.png" width="22" height="22" /></a></td>
					</tr>
					<tr>
						<td>lg hl;fgn</td>
						<td><a href="#"><img src="img/righticon.png" width="22" height="22" /></a></td>
					</tr>
				</table-->
				<div class="errorCardMsg">
					<p>You have not assigned any card, please add one.</p>
				</div>
			</div>
				
				<h2>- Or -</h2>
				<h2><a href="#">Add New</a></h2>
				<div class="addnew" style="display:none;">
				 <table cellpadding="0" cellspacing="0">
					 <tr>
						 <td><input name="" type="text" placeholder="Enter passenger name" class="location5" required/>
							<input type="button" value="Add New" class="back2 adden">
							</td>
						</tr>
					</table>
				</div>
			   
				<div class="buttonSubmit">
					<center><input name="cancle" type="button" value="Submit" class="buttsub"> </center>   
				</div>
		</div>
	</div>
	<!-------------------------EndPopup------------------------------------>
	<div class="header">
    	<div class="subheader">
        	<div class="logo">
       	    	<a href="#"><?=$this->Html->link($this->Html->image("logo.png"),array('controller' => 'pages', 'action' => 'index'), array('escape' => false));?></a>
            </div>
            <div class="addspanel">
            	<a href="#" class="addsdacument"><div class="discunt">
                	<p>Refer a Friend & Get a Discount</p>
                </div></a>
                <div class="apps">
                	<p>Available On</p>
                	<a href="#"><?=$this->html->image('appstore.png',array('class'=>'appleaps'))?></a>
                	<a href="#"><?=$this->html->image('googleplay.png')?></a> 
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>
        <div class="navisation">
        	<ul>
				<li><a href="<?=$config['BaseUrl']?>Pages" class="<?php echo (($this->params['controller']==='Pages')&&($this->params['action']=='index') || ($this->params['controller']==='pages') )?'active' :'' ?>">Home</a></li>
				<li><a href="<?=$config['BaseUrl']?>Aboutus" class="<?php echo (($this->params['controller']==='Aboutus')&&($this->params['action']=='index') )?'active' :'' ?>">About Us</a></li>
                <li><a href="<?=$config['BaseUrl']?>Pricing" class="<?php echo (($this->params['controller']==='Pricing')&&($this->params['action']=='index') )?'active' :'' ?>">Pricing</a></li>
                <li><a href="<?=$config['BaseUrl']?>Taxidriver" class="<?php echo (($this->params['controller']==='Taxidriver')&&($this->params['action']=='index') )?'active' :'' ?>">Be a Taxicel Driver</a></li>
                <li><a href="<?=$config['BaseUrl']?>Rides" class="<?php echo ($this->params['controller']==='Rides')?'active' :'' ?>">Book a Ride</a></li>
                <li><a href="<?=$config['BaseUrl']?>Faqs" class="<?php echo (($this->params['controller']==='Faqs')&&($this->params['action']=='index') )?'active' :'' ?>">FAQs</a></li>
               <!-- <li><a href="<?=$config['BaseUrl']?>Blogs" class="<?php echo (($this->params['controller']==='Blogs')&&($this->params['action']=='index') )?'active' :'' ?>">Blog</a></li>-->
                <li><a href="<?=$config['BaseUrl']?>Contactuses" class="<?php echo (($this->params['controller']==='Contactuses')&&($this->params['action']=='index') )?'active' :'' ?>">Contact Us</a></li>
                <div class="clr"></div>
            </ul>
        </div>
    </div>
    <!-----------------------End_Header--------------------------------->
    <?php echo $this->Session->flash(); ?>
			
	<?php echo $this->fetch('content'); ?>
    <!-----------------------End_loremins---------------------------------->  
    
    <div class="footer">
    	<div class="footerPart">
        	<div class="foot1">
            	<h3>Customer Support</h3>
                <ul>
                	<li><i><?=$this->html->image('contact_us.png',array('class'=>'footericon'))?></i><a href="<?=$config['BaseUrl']?>Contactuses" class="<?php echo (($this->params['controller']==='Contactuses')&&($this->params['action']=='index') )?'active' :'' ?>">Contact Us</a></li>
                    <li><i><?=$this->html->image('ic_faq.png',array('class'=>'footericon'))?></i><a href="<?=$config['BaseUrl']?>Faqs" class="<?php echo (($this->params['controller']==='Faqs')&&($this->params['action']=='index') )?'active' :'' ?>">FAQs</a></li>
                    <li><i><?=$this->html->image('trems&condisation_icon.png',array('class'=>'footericon'))?></i><a href="<?=$config['BaseUrl']?>Termcondition" class="<?php echo (($this->params['controller']==='Termcondition')&&($this->params['action']=='index') )?'active' :'' ?>">Terms And Conditions</a></li>
                    <li><i><?=$this->html->image('privicypollicy.png',array('class'=>'footericon'))?></i><a href="<?=$config['BaseUrl']?>Privacypolicy" class="<?php echo (($this->params['controller']==='Privacypolicy')&&($this->params['action']=='index') )?'active' :'' ?>">Privacy Policy</a></li>
					<li><i><?=$this->html->image('writetime_pollicy.png',array('class'=>'footericon'))?></i><a href="<?=$config['BaseUrl']?>Waittimepilicy" class="<?php echo (($this->params['controller']==='Waittimepilicy')&&($this->params['action']=='index') )?'active' :'' ?>">Wait Time Policy</a></li>
					<li><i><?=$this->html->image('cancel.png',array('class'=>'footericon'))?></i><a href="<?=$config['BaseUrl']?>Cancellationpolicy" class="<?php echo (($this->params['Cancellationpolicy']==='Waittimepilicy')&&($this->params['action']=='index') )?'active' :'' ?>">Cancellation Policy</a></li>
                 </ul>
            </div>
            <?php 
				$i=0;
				foreach ($blogFooter as $bl): 
				$i++;
			?>
            <div class="foot2">
				<?
					if($i==1){
				?>
            	<h3>Taxicel Blog</h3>
				<? }?>
               	<div class="imgDiv <? if($i==2){?>imgDiv2<? }?>">
					<img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/blogPic/thumb_<?=$bl['Blog']['image']?>" width="64" height="57"/>
                    <div class="picText">
                    	<p>
                        	<a href="<?=$config['BaseUrl']?>Blogs/detail/<?=$bl['Blog']['id']?>"><?=substr($bl['Blog']['description'],0,50)?>[...]</a>
                            <br /><span><?=date( 'D', strtotime( $bl['Blog']['date_time'] ) )?>, <?=date( 'd', strtotime( $bl['Blog']['date_time'] ) )?> <?=date( 'M', strtotime( $bl['Blog']['date_time'] ) )?> ,<?=date( 'Y', strtotime( $bl['Blog']['date_time'] ) )?></span>
                        </p>
                    </div> 
                    <div class="clr"></div>
                </div>
				<?
					if($i==1){
				?>
                <br /><br />
                <p>taxicel.com.ar @ 2014, All Rights Reserved.</p>
				<? }?>
            </div>
            <?php endforeach; ?>
            
            
          	<div class="foot3 ">
            	<h3>Social</h3>
           		<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
					
				<div class="fb-like-box" data-href="https://www.facebook.com/mindscale" data-width="170" data-height="191" data-colorscheme="dark" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					
            </div>
            <div class="clr"></div>
        </div>	
    </div>
    
</div>
</body>
</html>