<?
	$config = Configure::read("TaxiCel"); // loading config
	$baseurls = FULL_BASE_URL.$this->base."/admin/";
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places" type="text/javascript"></script>
<script type="text/javascript">
	//var img = "";
	var map;
	var infoWindow;
	var heatzonelat = "<?=$citylat?>";
	var heatzonelon = "<?=$citylon?>";
	var cityid = "<?=$cityid?>";
	var baseurl = "<?=$baseurls?>";
	var markers=[];
	google.maps.event.addDomListener( window, 'load', initialize );
	
	function initialize() {
		//alert(img);
		var mapOptions = {
			zoom: 12,
			center: new google.maps.LatLng( heatzonelat, heatzonelon ),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false, 
		};
		map = new google.maps.Map( document.getElementById('map_canvas'), mapOptions );
		//infoWindow = new google.maps.InfoWindow();
		$(document).ready(function(){
			//alert("0000");
			$("#city").bind('change',reloadmapview)
			driversonline(cityid);
		});
	}
 
	function driversonline(){
		//console.log("kk");
		removeallmarkers();
		$.ajax({
			url:baseurl+'users/driversonline',
			type:'POST',
			data:{cityid:cityid},
			dataType:'json',
			success:resultHandler,
			error:errorHandler
		});
	}
	function resultHandler(response){
		console.log(response);
		//mumbai 19.0759837, 72.8776559
		heatzonelat = response.citycenterlat;
		heatzonelon = response.citycenterlon;
		map.setCenter(new google.maps.LatLng(heatzonelat,heatzonelon));
		//map.setZoom(12);
		var marker='';
		for( var i=0; i<response.drivers.length; i++ ) {
			var driver = response.drivers[i];
			var aLatLng = new google.maps.LatLng( driver.lat, driver.lon );
			//console.log(aLatLng);
			var name = driver.locname;
			//var carimg = img;
			marker = new google.maps.Marker({
				position:aLatLng,
				title: name,
				//icon:carimg,
				draggable: false,
				map: map
			});
			marker.setMap(map);
			markers.push(marker);
		}
		//setAllMap(map);
	}
	function removeallmarkers(){
		if (markers.length>0) {
			for (var i=0;i<markers.length;i++) {
				markers[i].setMap(null);
			}
			markers=[];
		}
	}
	function errorHandler(response){
		console.log(response);
	}
	function reloadmapview(e) {
		cityid = $(e.currentTarget).val();
		driversonline(cityid);
	}
</script>
<div class="creatTol">
	<h2>Drivers On City Map</h2>
	<?
	echo $this->Form->input('city',array('options'=>$cities,'class'=>"mapDropdown",'div'=>'mapDrop','label'=>'Choose City'));	
	?>
	<div class="clr"></div>
	<div class="faqs index">
		<div class="map" id="map_canvas" style="width:100%;height:400px;">
			<!--iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d117920.29698018322!2d88.34612!3d22.5413251!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1408602772843" width="685" height="600" frameborder="0" style="border:0"></iframe-->
		</div>
	</div>
</div>
