<?php
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="blog">
	<h1>Blog</h1>
	<?php foreach ($blogs as $blog): ?>
	<div class="page_Blog">
    	<div class="blog_Date">
				<div class="date_icon">
					<h2><?=date( 'd', strtotime( $blog['Blog']['date_time'] ) )?></h2>
					<p><?=date( 'M', strtotime( $blog['Blog']['date_time'] ) )?></p>
				</div>
				<div class="date_text">
					<p>Posted by Taxicel on <?=date( 'd', strtotime( $blog['Blog']['date_time'] ) )?> <?=date( 'M', strtotime( $blog['Blog']['date_time'] ) )?> <!--/<span> 0 Comment </span--></p>
					<h3><?=$blog['Blog']['title']?></h3>
				</div>
				<div class="clr"></div>
			</div>
		<div class="socialface">
        	<a href="https://www.facebook.com/sharer.php?u=[URL]&t=[TEXT]"><?=$this->html->image('social1.png',array('class'=>'face1'))?></a>
        	<a href="http://twitter.com/intent/tweet?source=sharethiscom&text=[TEXT]&url=[URL]"><?=$this->html->image('social2.png',array('class'=>'face1'))?></a>
        	<a href="https://m.google.com/app/plus/x/?v=compose&content=[TEXT]%20[URL]"><?=$this->html->image('social3.png',array('class'=>'face1'))?></a>
		</div>
		
		<img src="<?=FULL_BASE_URL.$this->base?>/app/webroot/blogPic/<?=$blog['Blog']['image']?>" width="100%" height="auto" class="blogditpic" /> 
			
		<p><?=substr($blog['Blog']['description'],0,300)?>[...]</p>
		<a href="<?=$config['BaseUrl']?>Blogs/detail/<?=$blog['Blog']['id']?>"><input name="cancle" type="button" value="Read More" class="back" /></a>
	</div>
	<?php endforeach; ?>
	<p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
