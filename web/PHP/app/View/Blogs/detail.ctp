<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="blog_detail">
	<h1>Blog Details</h1>
	<h2><?=$blog['Blog']['title']?></h2>
	<img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/blogPic/<?=$blog['Blog']['image']?>" width="100%" height="auto" class="blogditpic" />  
	<h3><?=date( 'd', strtotime( $blog['Blog']['date_time'] ) )?>, <?=date( 'M', strtotime( $blog['Blog']['date_time'] ) )?>, <?=date( 'Y', strtotime( $blog['Blog']['date_time'] ) )?> <span>Posted by Taxicel on <?=date( 'd', strtotime( $blog['Blog']['date_time'] ) )?> <?=date( 'M', strtotime( $blog['Blog']['date_time'] ) )?> </span></h3>
	<p><?=$blog['Blog']['description']?></p>
	<a href="<?=$config['BaseUrl']?>Blogs"><input name="cancle" type="button" value="Back" class="back" /></a>
</div>