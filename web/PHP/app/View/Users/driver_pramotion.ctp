<?php
	$baseurls = FULL_BASE_URL.$this->base;
	$config = Configure::read("TaxiCel"); // loading config	
?>
<div class="createView">
	<h2>Promotions</h2>
	<div class="clr"></div>
	<div class="techerTable" style="width:35%; margin:0 auto;">
		<div id="QRCode">
			<?php foreach ($pramotions as $pramotion): ?>
			<?=$this->html->image('http://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=www.taxicel.com.ar/referal_registration/'.$pramotion['User']['my_refferal_code'],array('class'=>'naviIcon'));?>
			<table>
				<tr>
					<td><p style="font-size:30px; text-align:center;"><?=$pramotion['User']['f_name']?> <?=$pramotion['User']['l_name']?></p></td>
				</tr>
				<tr>
					<td style="padding: 0 0 10px 0;"><p style="font-size:24px;">Referal Code: <?=$pramotion['User']['my_refferal_code']?></p></td>
				</tr>
			</table>
			<?php endforeach; ?>
		</div>
		<div class="browseImage">
			<p><a href="javascript:void(0);" class="viewProfilebtn" id="printQR">Print</a></p>
			<div class="clr"></div>
		</div>
	</div>
	<div class="clr"></div>
</div>
<script>
$(document).ready(function(){
	$('#printQR').bind("click",printQRCode);
});
function printQRCode(){
	//alert("ok");
	//$("#QRCode").printElement();
	var restorepage = $('body').html();
	var printcontent = $('#QRCode').clone();
	$('body').empty().html(printcontent);
	window.print();
	$('body').html(restorepage);
}
</script>