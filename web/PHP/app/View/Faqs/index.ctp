<script>
	$(document).ready(function(){
		$(".clickDiv").bind("click",clickDivChangeHandler);
	});
	
	function clickDivChangeHandler(e){
		var parent = $(e.currentTarget).parents(".quti");
		var mode = $(e.currentTarget).attr('mode');
		console.log(mode);
		if(mode=='on'){
			$(".clickDiv").attr('mode','on');
			$(e.currentTarget).attr('mode','off');
			$(".des").hide();
			$(".des").slideUp(200);
			$($(parent).find(".des")).slideDown(200);
			$(".clickDiv").html('<img src="img/plus.png" width="24" height="24" class="icon_3"/>');
			$(e.currentTarget).html('<img src="img/nagative.png" width="24" height="24" class="icon_3" alt="close"/>');
		}else{
			$(".clickDiv").attr('mode','off');
			$(e.currentTarget).attr('mode','on');
			$($(parent).find(".des")).slideUp(200);
			$(e.currentTarget).html('<img src="img/plus.png" width="24" height="24" class="icon_3" alt="close"/>');
		}
	}
</script>

<div class="faqs ">
	<h1>Frequently Asked Questions</h1>

	<?php 
		$i=0;
		foreach ($faqs as $faq): 
		$i++;
	?>
	<div class="question quti">
		<div class="dive_q">
			<a href="javascript:void(0)" class="clickDiv" mode="<? if($i==1){?>off<?}else{?>on<?}?>"><? if($i==1){?><img src="img/nagative.png" width="24" height="24" class="nagative icon_3"  /><?}else{?><img src="img/plus.png" width="24" height="24" class="nagative icon_3"/><?}?></a>
				<h2><?php echo $faq['Faq']['question']; ?></h2>
			<div class="clr"></div>		
		</div>
		
		<div class="des" <? if($i!=1){?>style="display:none;"<?}?>>
			<p><?php echo $faq['Faq']['answer']; ?></p>
		</div>
	</div>
	<?php endforeach; ?>
</div>