<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places" type="text/javascript"></script>
<script type="text/javascript">
	var baseurl = "<?=$config['BaseUrl']?>admin/HeatZones/";
	var map;
	var infoWindow;
	var triangleCoords = [];
	var bermudaTriangle;
	var poly;
	var heatzonelat = '22.56';
	var heatzonelon = '88.145';
	google.maps.event.addDomListener( window, 'load', initialize );
	$(document).ready( function() {
		$("#btnAddZone").bind('click',btnAddZoneclickHandler);
		//get old results
		var url=baseurl+'getselectedzones/'+<?=$id?>;
		 PlayAjax.call( url,zoneResultHandler,zoneFaultHandler);
	});
	function initialize() {
		var mapOptions = {
			zoom: 11,
			center: new google.maps.LatLng( heatzonelat, heatzonelon ),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false,
		};
		map = new google.maps.Map( document.getElementById('map-canvas'), mapOptions );
		infoWindow = new google.maps.InfoWindow();
	}
	
	//get old data for drawing zones
	function zoneResultHandler(response){
		console.log( response );
		for( var i=0; i<response.heatzones.length; i++ ) {
			var heatzone = response.heatzones[i];
			console.log(heatzone);
			// Convert each co-ordinate to latlong object
			var latlngs = [];
			for( var j=0; j<heatzone.cords.length; j++ ) {
				var acord = heatzone.cords[j];
				console.log(acord);
				var aLatLng = new google.maps.LatLng( acord.lat, acord.lon );
				latlngs.push( aLatLng );
			}
			// Construct the polygon.
			var bermudaTriangle = new google.maps.Polygon({
				paths: latlngs,
				strokeColor: '#FF0000',
				strokeOpacity: 0.8,
				strokeWeight: 1,
				fillColor: '#FF0000',
				fillOpacity: 0.35
			});
			bermudaTriangle.setMap(map);
		}
	}

	function zoneFaultHandler( response ) {
		//console.log( "could not get the address" );
	}
	
	function btnAddZoneclickHandler(){
		window.location = baseurl;
	}
	
</script>

<div class="creatTol">
	<div class="heatZones form">
			<fieldset>
				<legend><?php echo __('View Heat Zone'); ?></legend>
				<p>Zone Name : <?=$heatZone['HeatZone']['name']?></p><br/>
				<div style="width:100%;height:300px;" id="map-canvas"></div>
				<br/>
				
				<input type="button" value="Back" id="btnAddZone" class="detailsBtn" style="width:115px; height:57px; background:#cccccc;">
			</fieldset>
	</div>
</div>