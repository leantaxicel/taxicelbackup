<?php
session_start();
?>
<style type="text/css">
#resultdiv { white-space: pre; font-family: monospace; }
</style>
<script src="js/jquery-1.9.1.js" ></script>
<script src="js/play.ajax.js" ></script>
<script language="javascript">
	var hostname = "<?php echo $_SERVER['HTTP_HOST']?>";
	var curconterller = "<?php echo $_REQUEST['c'].$_REQUEST['m']; ?>";
	$(document).ready( function () {
		$(".displayDiv").css({
			"height" : ($(window).height()-$(".header").height()-75)+ "px"
		});
		$("#formpost").bind("click", submitFormData);
		
		$("#chk_remember").bind('click',checkboxClick );
		$("input[type='radio'][name='serverset']").bind("click",radiohandler);
		checkCookie();
		highlighttheselectedcontroller();
	});

	function checkboxClick(e) {
		var isChecked = $(e.currentTarget).is(':checked');
		var userval = $('#customerId').val();
		
		if( userval != '' ) {
			setCookie( 'customerId', userval, 365 );
		}
	}
	
	function checkCookie(){
		var customerId = getCookie("customerId");
		if ( customerId!=null && customerId!="" ) {
			$("#chk_remember").attr("checked", true);
			$("#customerId").val( customerId );
		}
				//server selection
		var server = getCookie("serverselection");
		if ( server!=null && server!="" ) {
			$("input[type='radio'][name='serverset']").each(function(i,radiobox){
				var v = $(radiobox).val();
				if(v==server){
					$(radiobox).attr('checked',true);
				}
			});
		}
	}
	function radiohandler(e){
		var vl = $(e.currentTarget).val();
		setCookie('serverselection',vl,365);
	}
	
	function setCookie(c_name,value,exdays){
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	}

	function getCookie ( c_name ){
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++) {
		  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		  x=x.replace(/^\s+|\s+$/g,"");
		  if (x==c_name) {
			return unescape(y);
		  }
		}
		return null;
	}
	
	function submitFormData(){
		var act=$("#action").val();
		var controlers = $("#controler").val();
		var len = (controlers.length)-1;
		var controler = controlers.substr(0,len);
		var fields = {};
		var model = {};
		var cakedata = {};
		var serverchoose = 0;
		
 		for(var i=0;i<$(".formfield").length;i++){
			var field=$($(".formfield")[i]).attr("id");
			var value=$($(".formfield")[i]).val();
			fields[field]=value;
		}
		
		var userval = $("#customerId").val();
		if( userval != "" ) {
			fields['user_id'] = userval;
		}
		// for mobile
		//fields['mobile']='1';
		var chkradio = $("input[type='radio'][name='serverset']:checked");
		if(chkradio.length>0){
			serverchoose = chkradio.val();
		}
		if(serverchoose==1 || serverchoose==0){
			
			var url = "http://"+hostname+"/Taxicel/web/PHP/"+act;
			//var url = "http://192.168.1.4/TaxiCel/PHP/"+act;
		}
		if(serverchoose==2){
			var url ="http://www.taxicel.com.ar/developer/"+act;
		}
		if(serverchoose==3){
			var url ="http://www.taxicel.com.ar/"+act;
		}
		//console.log(url);
		$("#processing").show();

		PlayAjax.call(url,resiltHandler,faultHandler,null,fields);
		return false;
	}
	function resiltHandler( response ){
		$("#processing").hide();
		var data= JSON.stringify(response, null, "\t"); 
		var dataarray=data.split(",");
		$("#resultdiv").empty();
		//console.log( document.createTextNode(JSON.stringify(response, null, "\t")) );
		$("#resultdiv").append( document.createTextNode(JSON.stringify(response, null, 4)) );
	}
	function faultHandler( response ){
		$("#processing").hide();
		$("#resultdiv").empty();
		$("#resultdiv").append( document.createTextNode(JSON.stringify(response, null, 4)) );
	}
	function highlighttheselectedcontroller(){
		if(curconterller!=''){
			$("."+curconterller+"").css({'color':"yellow"}).focus();
		}
	}
</script>
<? 
include "config.php";
?>
<div class="header">
 <p style="width:500px; float:left; font-family:Arial;"> 
	USER ID : <input type="text" id="customerId" /> 
	( <input type="checkbox" id="chk_remember" /> Remember it. )
	<p>
	<span style="font-family:Arial;">server set : </span><input type="radio" name="serverset" value='1' checked="checked"/>  <span style="font-family:Arial;">Local</span> &nbsp;
	<input type="radio" name="serverset" value='2'/> <span style="font-family:Arial;">TexiCel Developer</span>&nbsp;
	<input type="radio" name="serverset" value='3'/> <span style="font-family:Arial;">TexiCel Au</span>
</p>
 </p>
 <p style="width:200px; float:left; background: green; display:none; padding:10px; position:absolute; z-index:999;" id="processing font-family:Arial;"> Processing... </p>
</div>
 <div style="width:100%; clear:both;">
	
	<div class="displayDiv" style=" overflow-y:auto; background-color:#999999; float:left; width:30%; font-family:Arial; padding:10px;">
		<ul>
		<?php
			//print_r($config);
			foreach($config as $name=>$controler){
				//print_r($controler);
		?>
			<h2 style="border-bottom:1px solid #fff; padding:10px;"> <?php echo $name; ?> </h2>
		<?php
				foreach($controler as $methname=>$fields){
				//print_r($methname);
		?>
			<li style="padding:10px;  width:80%; margin:5px;">
				<a href="index.php?c=<?=$name?>&m=<?=$methname?>" class="<?php echo $name.$methname;?>" style="color:#000; font-weight:bold; text-decoration:none;"> <?=ucwords($methname)?></a>
			</li>
		<?
				}
			}
		?>
		</ul>
	</div>
	
	<!-- form display div -->
	<div class="displayDiv" style="background-color:#CCCCCC; float:left; width:35%; font-family:Arial; padding:10px;">
		<?
			if( isset($_REQUEST["c"]) and isset($_REQUEST["m"]) and $_REQUEST["m"]!='' and $_REQUEST["c"]!=''){
				$action=$_REQUEST["c"]."/".$_REQUEST["m"];
				 $methodfields = $config[$_REQUEST["c"]][$_REQUEST["m"]];
				 //print_r($methodfields);
		?>
		<form name="service_page" id="service_page" action="javascript:void(0)" method="get">
			<input type="hidden" name="action" id="action" value="<?=$action?>" />
			<input type="hidden" name="controler" id="controler" value="<?=$_REQUEST["c"]?>" />
		<?
				foreach($methodfields as $filedname=>$formElenemt){
		?>
				<label><? if(isset($formElenemt['leble']) && $formElenemt['leble']!=''){ 
								echo $formElenemt['leble'];
							}
							else{
								echo $filedname;
							}
						?> :
				</label>
				<input type="<?=$formElenemt["type"]?>" name="<?=$filedname?>" id="<?=$filedname?>" class="formfield" <? if(isset($formElenemt['title'])){ ?> title="<?=$formElenemt['title']?>" <? } ?> value="<?php echo $formElenemt['value'];?>" />
				<br />
		<?
				}
		?>
			<br/>
			<input type="submit" name="formpost" id="formpost" value="Post"  />
			</form>
		<?
			}
		?>
	</div>
	
	<div class="displayDiv" style="background-color:#006600; color:#FFFFFF; float:left; width:30%; padding:10px; overflow:auto; font-family:Arial;" id="resultdiv">

	</div>
	<div style="clear:both;"></div>
</div>